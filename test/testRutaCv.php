<?php

require_once '../models/Colaboradores.php';

echo "<h1>Hola</h1>";
$colaborador = new Colaborador();

$datosObtenidos = $colaborador->listarColaboradores();

// echo "<pre>";
// print_r($datosObtenidos);
// echo "</pre>";

// echo "<pre>";
// var_dump($datosObtenidos);
// echo "</pre>";

// Eliminacion de un archivo
$id_buscado = 140;
$indice = array_search($id_buscado, array_column($datosObtenidos, 'idcolaborador'));

echo "$indice";
echo "<br>";

if ($indice !== false) {
    $nombre = $datosObtenidos[$indice]['cv'];
    echo "El cv de la persona con ID $id_buscado es: $nombre";

    $ruta = "../views/doc/pdf/".$nombre;

    if(unlink($ruta)){
      echo "Archivo ".$nombre." a sido borrado";
    } else{
      echo "El archivo no se pudo borrar";
    }
} else {
    echo 'No se encontró al colaborador $id_buscado';
}