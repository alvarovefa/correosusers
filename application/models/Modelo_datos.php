<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_datos extends CI_Model {

	function __construct() {
	    parent::__construct();

}

   public function acceso($correo, $pass){
      $this->db->select('nombre');
      $this->db->from('usuarios');
      $this->db->where('correo', $correo);
      $this->db->where('pass', $pass);
      $consulta = $this->db->get();
      $resultado = $consulta->row();
      return $resultado;
   }


	public function alias($value){
	 	$this->db->select('alias');
	 	$this->db->where('correo',$value);
	 	$consulta = $this->db->get('contactos');

	 	if ($consulta->num_rows() > 0) {
	 		return $consulta->row_array();
	 	}else{
	 		echo "No hay datos asociados";
	 	}
	 }


 public function mostrar($valor){
 	$this->db->like("nombre", $valor);
 	$this->db->from("contactos");
 	$this->db->join("categorias", "contactos.id_categoria = categorias.id_categoria");
 	$consulta = $this->db->get();

 	if ($consulta->num_rows() > 0) {
 		return $consulta->result();
 	}else{
 		echo "No hay datos";
 	}

 }
public function buscar($buscar)
	{
	
		$this->db->like("nombre_empresa",$buscar);
		$this->db->or_like("contacto",$buscar);
		
		$this->db->select("contacto, nombre_empresa, correo");
			$consulta = $this->db->get("contactos");
			return $consulta->result();
	}

public function buscarC($buscarC)
	{

		$this->db->where("id_categoria",$buscarC);
		
		$this->db->select("contacto, nombre_empresa");
			$consulta = $this->db->get("contactos");
			return $consulta->result();
	}

public function buscarContactos()
	{
		$consulta = $this->db->get("contactos");
		return $consulta->result();
	}

public function historial($data){


	$this->db->insert("historial", $data);

}

public function registroUsuario($value){

	$this->db->select('id');
	$this->db->where('correo', $value);
	$query = $this->db->get('contactos');

		if ($query->num_rows()>0) {
			$result = $query->row();
			return $result->id;
		}else{
			return false;
		}
}

}
