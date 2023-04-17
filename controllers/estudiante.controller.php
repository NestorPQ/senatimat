<?php

require_once '../models/Estudiante.php';

if (isset($_POST['operacion'])){

  $estudiante = new Estudiante();

  if($_POST['operacion'] == 'registrar'){

    //  PASO 1: Recolectar todos los valores enviados pos la vista y almacenarlo en un array
    $datosGuardar = [
      "apellidos"       => $_POST['apellidos'],
      "nombres"         => $_POST['nombres'],
      "tipodocumento"   => $_POST['tipodocumento'],
      "nrodocumento"    => $_POST['nrodocumento'],
      "fechanacimiento" => $_POST['fechanacimiento'],
      "idcarrera"       => $_POST['idcarrera'],
      "idsede"          => $_POST['idsede'],
      "fotografia"      => ''
    ];

    //  Vamos a verificar si el usuario nos envio una FOTOGRAFIA
    if(isset($_FILES['fotografia'])){

      $rutaDestino = '../views/img/fotografias/';
      $fechaActual = date('c');  //  Complete, AÑO/MES/DIA/HORA/MINUTO/SEGUNDO
      $nombreArchivo = sha1($fechaActual).".jpg";
      $rutaDestino .= $nombreArchivo;

      //  Guardamos la fotgrafia en el servidor
      if (move_uploaded_file($_FILES['fotografia']['tmp_name'], $rutaDestino)) {
        $datosGuardar['fotografia'] = $nombreArchivo;
      }
    }

    // PASO 2: Enviar el array al método registrar
    $estudiante->registrarEstudiante($datosGuardar);
  }

  if($_POST['operacion'] == 'listar'){
    $data = $sede->listarEstudiantes();
    
    //Enviar los datos a la vista
    //Si contiene información, si no está vacío...
    if ($data){
      foreach($data as $registro){
        
      }
    }else{
      echo "<option value=''>No encontramos datos</option>";
    }
  }
}