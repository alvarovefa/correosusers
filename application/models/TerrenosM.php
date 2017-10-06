<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TerrenosM extends CI_Model
{

	var $table = 'terrenos';

	public function lista(){

		$query = $this->db->get('terrenos');

		if ($query->num_rows()>0) {
				return $query->result();
		}else{
			return false;
		}
}
	public function get_by_id($id_terreno)
	{
		$this->db->from($this->table);
		$this->db->where('id_terreno',$id_terreno);
		$query = $this->db->get();

		return $query->row();
	}
	public function terreno_add($data)
	{

		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}


	public function terreno_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id_terreno)
	{
		$this->db->where('id_terreno', $id_terreno);
		$this->db->delete($this->table);
	}

}
