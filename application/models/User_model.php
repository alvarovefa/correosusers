<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model
{

	var $table = 'usuarios';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function get_all_users()
		{

		$this->db->from('usuarios');
		$this->db->where('id_tipo_usuario', '2');
		$query=$this->db->get();
		return $query->result();
		}


	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id_usuario',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function user_add($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function user_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id_usuario', $id);
		$this->db->delete($this->table);
	}

	public function firma($id){

		$this->db->select('firma');
		$this->db->where('id_usuario', $id);
		$this->db->from('usuarios');
		$query = $this->db->get();

			if ($query->num_rows()>0) {
				return $query->result();
			}else{
				echo false;
			}
	}

}
