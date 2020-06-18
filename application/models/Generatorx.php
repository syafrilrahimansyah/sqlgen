<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Generatorx extends CI_Model {

	
	public function exec($proc_id)
	{
		$query_result = [];
		$qry_idx = 0;
		//$proc_id = $_POST['proc_id'];
		$extc = $this->db->get_where('extract',['proc_id'=>$proc_id])->result_array();
		foreach($extc as $extc_idx){
			$extc_data[] = $extc_idx['data_id'];
		}
		
		$extc_data = array_unique($extc_data);
		foreach($extc_data as $data_id){
			$tmplt_id = explode(',',$this->db->get_where('process',['id'=>$proc_id])->row()->templates);
			foreach($tmplt_id as $tmplt){
				$query_id = explode(',',$this->db->get_where('template',['id'=>$tmplt])->row()->queries);
				foreach($query_id as $query){
					$row_query = $this->db->get_where('query',['row_id'=>$query])->row();
					$param = explode(',',$row_query->param);
					//LOOP OFF
					if($row_query->loop_opt == ''){
						$query_result[$qry_idx] = $row_query->query;
						foreach($param as $name){
							$name = explode('|',$name);
							$value = $this->db->get_where('extract',['data_id'=>$data_id,'name'=>$name[0]])->row()->value;
							$query_result[$qry_idx] = str_replace('%'.trim($name[0]).'%',$value,$query_result[$qry_idx]); 
						}
						$qry_idx += 1;
					}
					//LOOP ON
					else{
						$loop_opt = explode(',',$row_query->loop_opt);
						$col_ch = explode(',',$row_query->col_ch);
						switch($loop_opt[0]){
							case 'col':
								$loop_value = explode(',',$this->db->get_where('extract',['data_id'=>$data_id,'name'=>$loop_opt[1]])->row()->value);
								
								$loop_index = 0;
								foreach($loop_value as $value_ch){
									$query_result[$qry_idx] = $row_query->query;
									foreach($param as $name){
										$name = explode('|',$name);
										if(in_array($name[0],$col_ch)){
											$multi_val_ch = explode(',',$this->db->get_where('extract',['data_id'=>$data_id,'name'=>$name[0]])->row()->value);
											$value = (isset($multi_val_ch[$loop_index]))?$multi_val_ch[$loop_index]:'';
										}else{
											$value = $this->db->get_where('extract',['data_id'=>$data_id,'name'=>$name[0]])->row()->value;
										}
										$query_result[$qry_idx] = str_replace('%'.trim($name[0]).'%',$value,$query_result[$qry_idx]);
									}
									$qry_idx += 1;
									$loop_index += 1;
								}
							break;
							case 'num':
								$n = 0;
								while($n < $loop_opt[1]){
									$query_result[$qry_idx] = $row_query->query;
									foreach($param as $name){
										$name = explode('|',$name);
										
										$value = $this->db->get_where('extract',['data_id'=>$data_id,'name'=>$name[0]])->row()->value;
										
										$query_result[$qry_idx] = str_replace('%'.trim($name[0]).'%',$value,$query_result[$qry_idx]);
									}
									$qry_idx += 1;
									$n += 1;
								}
							break;
							default:
								
						}
					}
				}
			}
        }
        return $query_result;
	}
}
