<?php

require_once '../models/Colaboradores.php';

if(isset($_POST['operacion'])){
  $colaborador = new Colaborador();

  if($_POST['operacion'] == 'registrar'){
    $datosGuardar = [
      "apellidos"       =>    $_POST['apellidos'],
      "nombres"         =>    $_POST['nombres'],
      "idcargo"         =>    $_POST['idcargo'],
      "idsede"          =>    $_POST['idsede'],
      "telefono"        =>    $_POST['telefono'],
      "tipocontrato"    =>    $_POST['tipocontrato'],
      "direccion"       =>    $_POST['direccion'],
      "cv"              =>    ''
    ];

    if(isset($_FILES['cv'])){
      $rutaDestino = '../views/doc/pdf/';
      $fechaActual = date('c');
      $nombreArchivo = sha1($fechaActual).".pdf";
      $rutaDestino.=$nombreArchivo;

      if(move_uploaded_file($_FILES['cv']['tmp_name'], $rutaDestino)){
        $datosGuardar['cv'] = $nombreArchivo;
      }
    }

    $colaborador->registrarColaborador($datosGuardar);
  }

  if($_POST['operacion'] == 'listar'){
    $datosObtenidos = $colaborador->listarColaboradores();

    if($datosObtenidos){
      $numeroFila = 1;
      $datosColaborador = '';
      $botonNulo = "
        <a href='#' class='btn btn-info btn-sm' title='No tiene CV' style='float: right;'>
          <i class='bi bi-x-circle'></i>
        </a>
      ";

      foreach($datosObtenidos as $registro){
        $datosColaborador = $registro['nombres']. ' ' . $registro['apellidos'];

        echo  "
          <tr>
            <td>{$numeroFila}</td>
            <td>{$registro['nombres']}</td>
            <td>{$registro['apellidos']}</td>
            <td>{$registro['cargo']}</td>
            <td>{$registro['sede']}</td>
            <td>{$registro['telefono']}</td>
            <td>{$registro['tipocontrato']}</td>
            <td>{$registro['direccion']}</td>
            <td>
              <a href='#' data-idcolaborador='{$registro['idcolaborador']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash'></i></a>
              <a href='#' data-idcolaborador='{$registro['idcolaborador']}' class='btn btn-warning btn-sm editar'><i class='bi bi-pencil'></i></a>                     
              ";
            if($registro['cv'] == ''){
              echo $botonNulo;
            }else {
              echo " <a href='../views/doc/pdf/{$registro['cv']}' data-idcolaborador='{$registro['idcolaborador']}' class='btn btn-info btn-sm' style='float: right;' target='_blank'>
                      <i class='bi bi-filetype-pdf'></i>
                    </a>";
            }


            echo "</td>
                </tr>";
          
          echo("Lista de colaboradores");
          $numeroFila++;
      }
    }
  }
}