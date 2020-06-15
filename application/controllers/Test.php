<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends CI_Controller {

	
	public function index()
	{
        $str = 'Abc/hello@gmail.com/1267890%-A-29-% blabla %-lll-% yesyesyes %-hhh-%';
        while(strpos($str, '%-')!==false){
            $start = strpos( $str,'%-') +2;
            $end = strpos( $str,'-%');

            $param[] = substr($str, $start, ($end-$start));

            $first = substr($str, $start, ($end-$start));
            $first_len = strlen($first);

            $start1 = strpos( $str,'%-'.$first.'-%') +4 + $first_len;
            $end1 = strpos( $str,'%-');

            $str = substr($str, $start1);
        }
        print_r($param);
        
    }
    public function test1()
    {
        $proc_id = 'proc-5ede11ea73051';
        $dt_fault_count = 0;
		$tmplt_id = explode(',',$this->db->get_where('process',['id'=>$proc_id])->row()->templates);
		foreach($tmplt_id as $id){
			$query_id = explode(',',$this->db->get_where('template',['id'=>$id])->row()->queries);
			foreach($query_id as $row_id){
				$params = explode(',',$this->db->get_where('query',['row_id'=>$row_id])->row()->param);
				foreach($params as $param){
					$param1 = explode('|',$param);
					
					$data = ['proc_id'=>$proc_id,'name'=>$param1[0]];
					$extc_param = $this->db->get_where('extract',$data)->row()->value;
					print_r($proc_id);
					print_r($param1[0]);
					
					if($param1[1]=='num' && is_numeric($extc_param)==false)
						$dt_fault_count += 1; 
					
				}
			}
		}
    }
    public function test2()
    {
        $this->db->where('name', 'NAME');
        $this->db->where('proc_id', 'proc-5ede115347630');
        print_r($this->db->get('extract')->row()->value);

    }
    public function updt_tm($id)
    {
        $this->db->query("UPDATE process SET timestamp = CURRENT_TIMESTAMP WHERE id = '".$id."'");
    }
    public function test_query($name)
    {
        $file = file('./file/template/'.$name.'.csv');
        foreach($file as $row){
            $id = uniqid('query-');
            $row = explode(';',$row);
            $data = [
                'row_id' => $id,
                'param' => $row[1],
                'loop_opt' => (isset($row[2]))?$row[2]:'',
                'col_ch' => (isset($row[3]))?$row[3]:'',
                'query' => $row[0].';'
            ];
            $query_id[] = $id;
        }
        print_r($file);
    }
    public function tmpltxt()
    {
        $file = file('./file/test.txt');
        foreach($file as $row){
            echo $row;
        }
    }
}
