<?php

require_once '../models/Conexion.php';

class Colaborador extends Conexion{
  private $accesoBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }


  //  Método listar usuarios
  public function listarColaboradores(){
    
    try {
      $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_listar()");
      $consulta->execute();
  
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      die($e->getMessage());
    }
  }

  
}