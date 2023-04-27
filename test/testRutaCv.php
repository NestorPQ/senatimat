<?php

require_once '../models/Colaboradores.php';

echo "<h1>Hola</h1>";
$colaborador = new Colaborador();

$datosObtenidos = $colaborador->listarColaboradores();

echo "<pre>";
print_r($datosObtenidos);
echo "</pre>";

// echo "<pre>";
// var_dump($datosObtenidos);
// echo "</pre>";

$id_buscado = 11;
$indice = array_search($id_buscado, array_column($datosObtenidos, 'idcolaborador'));

echo "$indice" ,"=======";

if ($indice !== false) {
    $nombre = $datosObtenidos[$indice]['cv'];
    echo "El nombre de la persona con ID $id_buscado es: $nombre";
} else {
    echo "No se encontró una persona con ID $id_buscado";
}

// eliminar
$archivo = "../views/js/eliminarArchivo.js"; // Ruta del archivo script eliminarArchivo.js
$nombreArchivo = "../views/doc/pdf/2faeca65cb46a4f98ae23732c84582335472f5bb.pdf"; // Ruta del archivo para eliminar
// $nombreArchivo .= $ruta;

exec("node $archivo $nombreArchivo", $output, $return_var);

if ($return_var !== 0) {
  echo "Se ha producido un error al eliminar el archivo.";
} else {
  echo "El archivo ha sido eliminado exitosamente.";
}

// $hola = $colaborador->listarColaboradores($datosObtenidos[0]['idcolaborador']);

echo '<pre>';
print_r($hola);
echo '</pre>';

echo '<pre>';
echo("node $archivo $nombreArchivo");
echo '</pre>';

