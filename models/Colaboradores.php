<?php

require_once '../models/Conexion.php';

class Colaborador extends Conexion{
  private $accesoBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }

  // Método registrar colaborador
  public function registrarColaborador($datos = []){
    try{
      $consulta = $this->acceso->prepare("CALL spu_colaboradores_registrar(?,?,?,?,?,?,?,?)");

      $consulta->execute(
        array(
          $datos['nombres'],
          $datos['apellidos'],
          $datos['idcargo'],
          $datos['idsede'],
          $datos['telefono'],
          $datos['tipocontrato'],
          $datos['cv'],
          $datos['direccion'],
        )
      );
    }catch(Exception $e){
      die($e->getMessage());
    }
  }

  //  Método listar colaborador
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