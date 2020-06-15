<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generate extends CI_Controller {

	public function index()
	{
		$data = [
			'templates' => $this->db->get('template')->result_array()
		];
		
		$metadata = [
			'component' => 'generate',
			'data' => $data
        ];
		$this->load->view('root', $metadata);
	}
	public function preparation()
	{
		//load MODEL
		$this->load->model('UID');
		//Initiation
		$proc_id = $this->UID->generate('proc-','process','id');
		$templates = implode(',',$_POST['templates']);
		//DB Insertion
		$db_data = [
			'id' => $proc_id,
			'templates' => $templates,
			'stage' => 1
		];
		$this->db->insert('process',$db_data);
		redirect(base_url('generate/pre_upload/'.$proc_id));
	}
	public function pre_upload($proc_id='')
	{
		$data = [
			'proc_id'=> $proc_id
		];
		$metadata = [
			'component' => 'upload',
			'data' => $data
        ];
		$this->load->view('root', $metadata);
	}
	//upload function (do-upload, Extraction)
	public function upload()
	{
		$config['upload_path']      = './file/extract';
		$config['allowed_types']    = 'csv';
		$config['file_name'] 		= $_POST['proc_id'];
		
		$this->load->library('upload', $config);

		if ( ! $this->upload->do_upload('userfile'))
		{
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}
		else
		{
			$this->load->model('Extractor');
			$this->Extractor->extract($_POST['proc_id']);
			//print_r($data);
			redirect(base_url('generate/confirmation/'.$_POST['proc_id']));
		}
	}
	public function confirmation($proc_id)
	{
		//*VALIDATION
		//init
		$mp[0] = 0;
		$dt[0] = 0;
		$mp[1] = [];
		$dt[1] = [];
		//load
		$this->load->model('Validation');
		$mp = $this->Validation->param_comp($proc_id);
		$dt = $this->Validation->data_type($proc_id);
		//pagination
		$num_rows = $this->db->get_where('confirmation',['proc_id'=>$proc_id])->num_rows();
		$start_index = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
		$this->load->model('Item');
		$config = $this->Item->pagination_conf('/Generate/confirmation/'.$proc_id,$num_rows,4);		
		$this->pagination->initialize($config);
		//data display
		$this->db->where('proc_id',$proc_id);
		$extract_data = $this->db->get('confirmation', 10, $start_index)->result_array();
		//set stage
		$this->db->set('stage', 2);
		$this->db->where('id', $proc_id);
		$this->db->update('process');

		$metadata = [
			'component' => 'confirmation',
			'total_row' => $num_rows,
			'pagination' => $this->pagination->create_links(),
			'extract_data' => $extract_data,
			'fault_count' => $mp[0]+$dt[0],
			'dt_fault_msg' => $dt[1],
			'mp_fault_msg' => $mp[1],
			'proc_id' => $proc_id
        ];
		$this->load->view('root', $metadata);
	}
	//Generate Function (run-generate)
	public function exec_generate(){
		$this->load->model('Generatorx');
		$proc_id = $_POST['proc_id'];
		$query_result = $this->Generatorx->exec($proc_id);
		$fp = fopen('./file/result/'.$proc_id.'.sql','a');
		foreach($query_result as $query){
			fwrite($fp, $query.PHP_EOL);
		}
		fclose($fp);
		redirect(base_url('Generate/result/'.$proc_id));
	}
	public function result($proc_id)
	{
		//set stage
		$this->db->set('stage', 3);
		$this->db->where('id', $proc_id);
		$this->db->update('process');

		$metadata = [
			'proc_id' => $proc_id,
            'component' => 'result'
        ];
		$this->load->view('root', $metadata);
	}
	public function download($proc_id)
	{
		$this->load->helper('download');
        force_download('./file/result/'.$proc_id.'.sql', NULL);
        redirect(base_url().'/Generate/result/'.$proc_id);
	}
}
