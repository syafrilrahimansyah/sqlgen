<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Archives extends CI_Controller {

	
	public function index()
	{
		//pagination
		$num_rows = $this->db->get_where('process',['stage'=>3])->num_rows();
		$start_index = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$this->load->model('Item');
		$config = $this->Item->pagination_conf('/archives/index',$num_rows,3);		
		$this->pagination->initialize($config);
		//data display
		$this->db->where('stage',3);
		$data = $this->db->get('process',10,$start_index)->result_array();
        $metadata = [
			'component' => 'archives',
			'data' => $data,
			'total_row' => $num_rows,
			'pagination' => $this->pagination->create_links(),
        ];
		$this->load->view('root', $metadata);
	}
	public function search()
	{
		//search conf
		$search = $_GET['search'];
		$tmplt_search = ($this->db->get_where('template',['name'=>$search])->num_rows()!=0)?$this->db->get_where('template',['name'=>$search])->row()->id:$search;
		if($search!=''){
			$this->db->like('timestamp',$search);
			$this->db->or_like('id',$search);
			$this->db->or_like('templates',$tmplt_search);
		}
		$this->db->where('stage',3);
		$search_data = $this->db->get('process'); 
		//pagination
		$num_rows = $search_data->num_rows();
		$start_index = ($this->uri->segment(2)) ? $this->uri->segment(3) : 0;
		$this->load->model('Item');
		$config = $this->Item->pagination_conf('/archives/index',$num_rows,3);		
		$this->pagination->initialize($config);
		//data display
		if($search!=''){
			$this->db->like('timestamp',$search);
			$this->db->or_like('id',$search);
			$this->db->or_like('templates',$tmplt_search);
		}
		$this->db->where('stage',3);
		$data = $this->db->get('process',10,$start_index)->result_array();
        $metadata = [
			'search' => $search,
			'component' => 'archives',
			'data' => $data,
			'total_row' => $num_rows,
			'pagination' => $this->pagination->create_links(),
        ];
		$this->load->view('root', $metadata);
	}
}
