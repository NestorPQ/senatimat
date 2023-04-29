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
      $consulta = $this->accesoBD->prepare("CALL spu_colaboradores_registrar(?,?,?,?,?,?,?,?)");

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

  //  Método eliminar colaborador
  public function eliminarColaborador($idcolaborador = 0){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_colaborador_eliminar(?)");
      $consulta->execute(array($idcolaborador));

      $this->eliminarPDF($idcolaborador);

      
    }catch(Exception $e){
      die($e->getMessage());
    }
  }

  //  Método eliminar PDF
  public function eliminarPDF($idcola = 0){
    try{

      $datosObtenidos = $this->listarColaboradores();
  
      //  buscamos si el id existe, si existe se almacena el indice numerio
      $indice = array_search($idcola, array_column($datosObtenidos, 'idcolaborador'));
  
      // se accede a la condicional si el valor de indice es diferente a falso
      if ($indice !== false){
  
        // accedemos al nombre del archivo con el nombre del array y un indice
        $nombre = $datosObtenidos[$indice]['cv'];
  
        // almacenamos la ruta con juntos con el nombre del archivo
        $ruta = '../views/doc/pdf/'.$nombre;
  
        if(unlink($ruta)){
          echo "<h1>Archivo a sido borrado</h1>";
        } else{
          echo "<h1>El archivo no se pudo borrar</h1>";
        }
        
      } else {
        echo "<h1> No se encontró al colaborador </h1>";
      }
      
    }catch (Exception $e){
      die($e->getMessage());
    }
  }
  
}