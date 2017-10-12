<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Book_model extends CI_Model
{

	var $table = 'contactos';
	var $table2 = 'categorias';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}


public function get_all_books()
{
	$this->db->select('contactos.id, categorias.nombre, contactos.nombre_empresa, contactos.contacto, contactos.correo, contactos.celular, contactos.alias');
	$this->db->from('contactos');
	$this->db->join('categorias', 'categorias.id_categoria = contactos.id_categoria');
	$query=$this->db->get();
	return $query->result();
}


	public function get_by_id($id)
	{
		$this->db->select('contactos.id, categorias.id_categoria, categorias.nombre, contactos.nombre_empresa, contactos.contacto, contactos.correo, contactos.celular, contactos.alias');
		$this->db->from('contactos');
		$this->db->join('categorias', 'categorias.id_categoria = contactos.id_categoria');
		$this->db->where('id',$id);
		$query=$this->db->get();
		/*
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();
		*/
		return $query->row();
	}

	public function book_add($data)
	{
		$this->db->insert($this->table, $data);
		//return $this->db->insert_id();
	}

	public function cat_add($data)
	{
		$this->db->insert($this->table2, $data);
		//return $this->db->insert_id();
	}

	public function book_update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}


}
