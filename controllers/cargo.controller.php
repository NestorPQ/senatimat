<?php

require_once '../models/Cargo.php';

if(isset($_POST['operacion'])){

  $cargo = new Cargo();

  if($_POST['operacion'] == 'listar'){
    $data = $cargo->listarCargo();

    if ($data){
      echo "<option value='' selected>Seleccione</option>";
      foreach($data as $registro){
        echo "<option value='{$registro['idcargo']}'>{$registro['cargo']}</option>";
      }
    }else{
      echo "<option value=''>No encontramos datos</option>";
    }
  }
}