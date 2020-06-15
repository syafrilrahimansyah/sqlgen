<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Extractor extends CI_Model {

	
	public function extract($id)
	{
        $file = file('./file/extract/'.$id.'.csv');
        foreach($file as $row){
            $raw_value[] = explode(';',$row);
        }
        foreach($raw_value[0] as $raw_key){
            $key[] = $raw_key;
        }
        unset($raw_value[0]);
        
        foreach($raw_value as $raw_data){
            $n = 1;
            $uid = uniqid('data-');
            while($this->db->get_where('extract',['data_id'=>$uid])->num_rows()>0){
                $uid = uniqid('data-');
            }
            while($n < count($key)){
                $row_uid = uniqid('row-');
                while($this->db->get_where('extract',['id'=>$row_uid])->num_rows()>0){
                    $row_uid = uniqid('row-');
                }
                $name = $key[$n];
                $value = (isset($raw_data[$n]))?$raw_data[$n]:'';
                $set[] = ['id'=>$row_uid,'proc_id'=>$id,'data_id'=>$uid,'name'=>trim($name),'value'=>trim($value)];
                $n+=1;
            }
            $confirmation_id = uniqid('confirm-');
            $offer_id = ['id'=>$confirmation_id,'data_id'=>$uid,'default_name'=>$raw_data[0],'proc_id'=>$id];
            $this->db->insert('confirmation',$offer_id); 
        }
        foreach($set as $data){
            $this->db->insert('extract',$data);
        }
        return $offer_id;
    }
    public function query($name)
    {
        $file = file('./file/template/'.$name.'.txt');
        foreach($file as $row){
            $id = uniqid('query-');
            $row = explode('~',$row);
            $data = [
                'row_id' => $id,
                'param' => $row[1],
                'loop_opt' => (isset($row[2]))?$row[2]:'',
                'col_ch' => (isset($row[3]))?trim($row[3]):'',
                'query' => $row[0]
            ];
            $this->db->insert('query',$data);
            $query_id[] = $id;
        }
        return $query_id;
    }
}
