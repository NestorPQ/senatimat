<?php

require_once 'Conexion.php';

class Estudiante extends Conexion{
  private $accesoBD;

  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion();
  }

  //  Funciones
  //  Datos[] es un array associativo, que contiene la información a guardar proveniente del controlador
  public function registrarEstudiante($datos = []){
    try {
      //  preparamos la consulat
      $consulta = $this->accesoBD->prepare("CALL spu_estudiantes_registrar(?,?,?,?,?,?,?,?)");

      //  ejecutamos la consulat
      $consulta ->execute(
        array(
          $datos['apellidos'],
          $datos['nombres'],
          $datos['tipodocumento'],
          $datos['nrodocumento'],
          $datos['fechanacimiento'],
          $datos['idcarrera'],
          $datos['idsede'],
          $datos['fotografia']
        )
      );
      //  retornamos la consulta

    } catch (Exception $e) {
      die($e -> getMessage());
    }
  }
}