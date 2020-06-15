<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Validation extends CI_Model {

	
	public function param_comp($proc_id)
	{
		$count = 0;
		$msg= [];
		$tmplt_id = explode(',',$this->db->get_where('process',['id'=>$proc_id])->row()->templates);	
		//parameter completeness
		foreach($tmplt_id as $id){
			$query_id = explode(',',$this->db->get_where('template',['id'=>$id])->row()->queries);
			$tmplt_name = $this->db->get_where('template',['id'=>$id])->row()->name;
			$query_num = 0;
			foreach($query_id as $row_id){
				$query_num += 1;
				$params = explode(',',$this->db->get_where('query',['row_id'=>$row_id])->row()->param);	
				foreach($params as $param){
					$param1 = explode('|',$param);
					$this->db->where('proc_id',$proc_id);
					$this->db->where('name',$param1[0]);
					if($this->db->get('extract')->num_rows()<1){
						$msg[] = 'missing parameter <b>'.$param1[0].'</b>';
						$count += 1;
					}
				}
			}
        }
        return([$count,$msg]);
    }
    public function data_type($proc_id)
    {
        //init
		$count = 0;
		$msg= [];
		$tmplt_id = explode(',',$this->db->get_where('process',['id'=>$proc_id])->row()->templates);
        //data type
        foreach($tmplt_id as $id){
			$query_id = explode(',',$this->db->get_where('template',['id'=>$id])->row()->queries);
			$tmplt_name = $this->db->get_where('template',['id'=>$id])->row()->name;
			$query_num = 0;
			foreach($query_id as $row_id){
				$query_num += 1;
				$params = explode(',',$this->db->get_where('query',['row_id'=>$row_id])->row()->param);	
				foreach($params as $param){
					$param1 = explode('|',$param);					
					$this->db->where('proc_id',$proc_id);
					$this->db->where('name',$param1[0]);
					if($this->db->get('extract')->num_rows()>1){
						$this->db->where('proc_id',$proc_id);
						$this->db->where('name',$param1[0]);
						$extc_param = $this->db->get('extract')->row()->value;					
						//$test_out[] = $extc_param;
						if($param1[1]=='num' && preg_match("/[a-z]/i", $extc_param)){
							$count += 1;
							$msg[] = 'data type mismatch between COLUMN_NAME <b>'.$param1[0].'</b> and TEMPLATE_NAME <b>'.$tmplt_name.'</b> QUERY_NUMBER <b>'.$query_num.'</b> (number only)';
						}
					}
				}
			}
        }
        return([$count,$msg]);
    }

}
