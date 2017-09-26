<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HistorialM extends CI_Model
{

	public function lista(){

		$this->db->select("historial.fecha, usuarios.nombres, contactos.contacto, contactos.correo");
		$this->db->from("historial");
		$this->db->join("usuarios", "historial.id_usuario = usuarios.id_usuario");
		$this->db->join("contactos", "historial.id = contactos.id");

		$query = $this->db->get();

		if ($query->num_rows()>0) {
				return $query->result();
		}else{
			return false;
		}


	}

}
