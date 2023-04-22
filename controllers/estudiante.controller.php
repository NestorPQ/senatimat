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
    $datosObtenidos = $estudiante->listarEstudiantes();

    if ($datosObtenidos){
      $numeroFila = 1;
      $datosEstudiante = '';
      $botonNulo = "
        <a href='#' class='btn btn-sm btn-warning' title='No tiene fotografia'>
          <i class='bi bi-x-circle'></i>
        </a>" ;

      foreach($datosObtenidos as $registro){

        $datosEstudiante = $registro['apellidos']. ' ' . $registro['nombres'] ;

        //  La primera parte a RENDERIZAR, es lo standart (siempre se muestra)
        echo "
          <tr>
            <td>{$numeroFila}</td>
            <td>{$registro['apellidos']}</td>
            <td>{$registro['nombres']}</td>
            <td>{$registro['tipodocumento']}</td>
            <td>{$registro['nrodocumento']}</td>
            <td>{$registro['fechanacimiento']}</td>
            <td>{$registro['carrera']}</td>
            <td>    
              <a href='#' data-idplato='{$registro['idestudiante']}' class='btn btn-danger btn-sm eliminar'>
                <i class='bi bi-trash3'></i>
              </a>
              <a href='#' data-idplato='{$registro['idestudiante']}' class='btn btn-success btn-sm editar'>
                <i class='bi bi-pencil'></i>
              <a>";

            //  La segunda parte a RENDERIZAR, el el botón VER FOTOGRAFÍA
            if($registro['fotografia'] == ''){
              echo $botonNulo;
            }else {
              echo " <a href='../views/img/fotografias/{$registro['fotografia']}' data-lightbox='{$registro['idestudiante']}' data-title='{$datosEstudiante}' class='btn btn-sm btn-warning'>
                      <i class='bi bi-eye-fill'></i>
                    </a> ";
            }

            //  La tercera parte a RENDERIZAR, cierre de la fila
            echo "</td>
                </tr>";

          echo("lista de usuarios");
          $numeroFila++;
      }
    }
  }
}