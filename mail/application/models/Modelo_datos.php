<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_datos extends CI_Model {

	function __construct() {
	    parent::__construct();

}
 
public function guardar($param){
		$campos = array(
			'categoria' => $param['pcategoria'],
			'nombre_empresa' => $param['pempresa'],
			'contacto' =>$param['pnombre'],
			'correo' => $param['pcorreo'],
			'celular' => $param['pcelular'],
			'alias' => $param['palias']
			);
		$query = $this->db->insert('contactos', $campos);
			if ($query = true) {
				echo "Datos almacenados <a href='index'>Volver</a>";
			}else{
				echo "Error al guardar";
			}
	}

 public function verTodo(){ 
 	$this->db->get('contactos');

 }
  public function verTodol(){
 	$query = $this->db->get('contactos');
 	if ($query->num_rows() > 0) {
 		return $query;
 	}else{
 		return FALSE;
 	}
 }

 public function eliminar($id){
 	$this->db->where('id', $id);
 	$this->db->delete('contactos');
 }

 public function obtenerDatos($id){
 	$this->db->where('id', $id);
 	$query = $this->db->get('contactos');
 		if ($query->num_rows() > 0) {
 			return $query;
 		}else{
 			return FALSE;
 		}
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

 public function editarContacto($id, $data){
 	$this->db->where('id', $id);
 	$this->db->update('contactos', $data);
 }

 public function mostrar($valor){
 	$this->db->like("contacto", $valor);

 	$consulta = $this->db->get("contactos");

 	if ($consulta->num_rows() > 0) {
 		return $consulta->result();
 	}else{
 		echo "No hay datos";
 	}

 }
public function buscar($buscar)
	{
		$this->db->like("contacto",$buscar);
		$this->db->or_like("nombre_empresa",$buscar);
		$this->db->or_like("correo",$buscar);
		$this->db->or_like("celular",$buscar);
		$this->db->or_like("alias",$buscar);
		$this->db->select("contacto, correo,nombre_empresa");
			$consulta = $this->db->get("contactos");
			return $consulta->result();
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

public function historial($data){


	$this->db->insert("historial", $data);

    }

}
