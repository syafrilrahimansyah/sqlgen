<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UID extends CI_Model {

	
	public function generate($pref,$tbl,$id_col)
	{
        $id = uniqid($pref);
        while($this->db->get_where($tbl,[$id_col=>$id])->num_rows()>0){
            $id = uniqid($pref);
        }
        return($id);
	}
}
