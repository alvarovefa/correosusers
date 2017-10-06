<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriasM extends CI_Model
{

	var $table = 'categorias';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


	public function lista()
		{

		$this->db->from('categorias');
		$this->db->order_by("nombre", "asc");
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

function getImage($id){
    $this->db->where($id, 'id_usuario');
    $query = $this->db->get("usuarios");

    if($query->num_rows()>0){
      return $query->row_array();
    }else{
      return false;
    }  

}

}
