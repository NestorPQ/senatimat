<?php

require_once 'Conexion.php';

class Cargo extends Concexion{
  private $accesBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }

  public function listarCargo(){
    try{
      $consulta = $this-accesoBD->prepare("CALL spu_cargos_listar()");
      $consulta->execute();

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }catch(Exception $e){
      die($e->getMessage());
    }
  }
}