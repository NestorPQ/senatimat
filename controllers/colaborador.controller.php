<?php

require_once '../models/Colaboradores.php';

if(isset($_POST['operacion'])){
  $colaborador = new Colaborador();

  if($_POST['operacion'] == 'listar'){
    $datosObtenidos = $colaborador->listarColaboradores();

    if($datosObtenidos){
      $numeroFila = 1;

      foreach($datosObtenidos as $registro){
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
              <a href='#' data-idcolaborador='{$registro['idcolaborador']}' class='btn btn-info btn-sm editar' style='float: right;'><i class='bi bi-filetype-pdf'></i></a>
            </td>
          </tr>
          
          ";
          $numeroFila++;
      }
    }
  }
}