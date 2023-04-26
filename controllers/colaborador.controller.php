
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
        <a href='#' class='btn btn-info btn-sm' title='No tiene CV'>
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
              echo "<a href='../views/doc/pdf/{$registro['cv']}' data-idcolaborador='{$registro['idcolaborador']}' class='btn btn-info btn-sm' target='_blank'>
                      <i class='bi bi-filetype-pdf'></i>
                    </a>
                    
                    <a href='#' data-idcolaborador='{$registro['idcolaborador']}' class='btn btn-secondary btn-sm' data-bs-toggle='modal' data-bs-target='#pdfModal'><i class='bi bi-eye'></i></a>  

                    <div class='modal fade' id='pdfModal' tabindex='-1' aria-labelledby='pdfModalLabel' aria-hidden='true'>
                    <div class='modal-dialog modal-lg'>
                      <div class='modal-content'>
                        <div class='modal-header'>
                          <h5 class='modal-title' id='pdfModalLabel'>Título del PDF</h5>
                          <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Cerrar'></button>
                        </div>
                        <div class='modal-body'>
                          <embed src='doc/pdf/{$registro['cv']}' type='application/pdf' width='770' height='800' />
                        </div>
                      </div>
                    </div>
                  </div>
                    ";
            }


            echo "</td>
                </tr>";
          
          echo("Lista de colaboradores");
          $numeroFila++;
      }
    }
  }

  if($_POST['operacion'] == 'eliminar'){

    $colaborador->eliminarColaborador($_POST['idcolaborador']);

    $arrayCola = $colaborador->listarColaboradores();

    
    // Buscar cv
    $id_buscado = $_POST['idcolaborador'];
    $indice = array_search($id_buscado, array_column($arrayCola, 'idcolaborador'));

    if ($indice !== false) {
        $ruta = $arrayCola[$indice]['cv'];

        // Eliminar el pdf
        $archivo = "../views/js/eliminarArchivo.js"; // Ruta del archivo script eliminarArchivo.js
        $nombreArchivo = "../views/doc/pdf/.$ruta"; // Ruta del archivo para eliminar
        
        echo $nombreArchivo;
        print_r($nombreArchivo);
        var_dump($nombreArchivo);
  
        exec("node $archivo $nombreArchivo", $output, $return_var);
    
        if ($return_var !== 0) {
          echo "Se ha producido un error al eliminar el archivo.";
        } else {
          echo "El archivo ha sido eliminado exitosamente.";
        }

    }
    
    

  }
}