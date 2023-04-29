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

  public function listarEstudiantes(){
    try {
      //  preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_estudiantes_listar()");
      $consulta -> execute();

      return $consulta->fetchAll(PDO::FETCH_ASSOC);
      //

    }catch (Exception $e) {
      die($e -> getMessage());
    }
  }

  public function eliminarEstudiante($idestudiante = 0){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_estudiante_eliminar(?)");
      $consulta->execute(array($idestudiante));
      
    } catch(Exception $e){
      die($e->getMessage());
    }
    
  }

  public function eliminarFoto($id = 0){
    try{

      $datosObtenidos = $this->listarEstudiantes();
  
      //  buscamos si el id existe, si existe se almacena el indice numerio
      $indice = array_search($id, array_column($datosObtenidos, 'idestudiante'));
  
      // se accede a la condicional si el valor de indice es diferente a falso
      if ($indice !== false){
  
        // accedemos al nombre del archivo con el nombre del array y un indice
        $nombre = $datosObtenidos[$indice]['fotografia'];
  
        // almacenamos la ruta con juntos con el nombre del archivo
        $ruta = '../views/img/fotografias/'.$nombre;
  
        if(unlink($ruta)){
          echo "<h1>La foto a sido borrado</h1>";
        } else{
          echo "<h1>La foto no se pudo borrar</h1>";
        }
        
      } else {
        echo "<h1> No se encontró al estudiante </h1>";
      }
      
    }catch (Exception $e){
      die($e->getMessage());
    }

  }

}