<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TerrenosM extends CI_Model
{

	public function lista(){

		$query = $this->db->get('terrenos');

		if ($query->num_rows()>0) {
				return $query->result();
		}else{
			return false;
		}


	}

}
