<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config extends CI_Controller {

	
	public function template()
	{
		//search conf
		$search = (isset($_GET['search']))?$_GET['search']:'';
		if($search!=''){
			$this->db->like('id',$search);
			$this->db->or_like('name',$search);
			$this->db->or_like('created',$search);
			$this->db->or_like('last_updated',$search);
		}
		$search_data = $this->db->get('template'); 
		//pagination
		$num_rows = $search_data->num_rows();
		$start_index = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$this->load->model('Item');
		$config = $this->Item->pagination_conf('/config/template',$num_rows,3);		
		$this->pagination->initialize($config);
		//data display
		if($search!=''){
			$this->db->like('id',$search);
			$this->db->or_like('name',$search);
			$this->db->or_like('created',$search);
			$this->db->or_like('last_updated',$search);
		}
		$data = $this->db->get('template',10,$start_index)->result_array();
        $metadata = [
			'search' => $search,
			'component' => 'conf_template',
			'data' => $data,
			'total_row' => $num_rows,
			'pagination' => $this->pagination->create_links(),
        ];
		$this->load->view('root', $metadata);
	}
	public function add_template()
	{
		$this->load->model('UID');
		$tmplt_id = $this->UID->generate('tmplt-','template','id');
		$name = trim($_POST['name'],' ');
		if($this->db->get_where('template',['name'=>$name])->num_rows() != 0){
			redirect(base_url('Config/alert/name/'.$name));
		}else{
			$config['upload_path']      = './file/template';
			$config['allowed_types']    = 'csv';
			$config['file_name'] 		= $name;
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('userfile'))
			{
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			}
			else
			{
				date_default_timezone_set('Asia/Jakarta');
				$this->load->model('Extractor');
				$query_id = $this->Extractor->query($name);
				$data = [
					'id' => $tmplt_id,
					'name' => $name,
					'queries' => implode(',',$query_id),
					'created' => date('Y-m-d H:i:s')
				];
				$this->db->insert('template',$data);
				redirect(base_url('Config/template'));
			}
		}
	}
	public function updt_template()
	{
		$tmplt_id = $_POST['id'];
		$name = trim($_POST['name'],' ');
		$valid_name = 0;
		if($this->db->get_where('template',['name'=>$name])->num_rows() != 0){
			if($this->db->get_where('template',['name'=>$name,'id'=>$tmplt_id])->num_rows() != 0)
				$valid_name = true;
			else
				$valid_name = false;
		}else{
			$valid_name = true;
		}
		if(!$valid_name){
			redirect(base_url('Config/alert/name/'.$name));
		}else{
			$config['upload_path']      = './file/template';
			$config['allowed_types']    = 'csv';
			$config['file_name'] 		= $name;
			$config['overwrite']    = TRUE;
			
			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('userfile'))
			{
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			}
			else
			{
				//get date
				$created = $this->db->get_where('template',['id'=>$tmplt_id])->row()->created;
				//deletion
				$queries = $this->db->get_where('template',['id'=>$tmplt_id])->row()->queries;
				$queries = explode(',',$queries);
				foreach($queries as $query_id){
					$this->db->where('row_id',$query_id);
					$this->db->delete('query');
				}
				$this->db->where('id',$tmplt_id);
				$this->db->delete('template');
				//insertion
				$this->load->model('Extractor');
				$query_id = $this->Extractor->query($name);
				$data = [
					'id' => $tmplt_id,
					'name' => $name,
					'queries' => implode(',',$query_id),
					'created' => $created
				];
				$this->db->insert('template',$data);
				redirect(base_url('Config/template'));
			}
		}

	}
	public function del_template(){
		$tmplt_id = $_POST['id'];
		$queries = $this->db->get_where('template',['id'=>$tmplt_id])->row()->queries;
		$queries = explode(',',$queries);
		foreach($queries as $query_id){
			$this->db->where('row_id',$query_id);
			$this->db->delete('query');
		}
		$this->db->where('id',$tmplt_id);
		$this->db->delete('template');
		redirect(base_url('Config/template'));
	}
	public function download($tmplt)
	{
		$this->load->helper('download');
        force_download('./file/template/'.$tmplt.'.csv', NULL);
        //redirect(base_url().'/Config/template/');
	}
	public function alert($type,$value){
		$metadata = [
			'component' => 'alert',
			'type' => $type,
			'value' => $value
		];
		$this->load->view('root', $metadata);
	}
}
