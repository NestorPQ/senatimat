<!doctype html>
<html lang="es">

<head>
  <title>Colaboradores</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <!-- Iconos de Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

</head>

<body>

  <div class="container mt-3">
    <div class="card">
      <div class="card-header bg-secondary text-light">
        <div class="row">

          <div class="col-md-6">
            <strong>Lista de colaboradores</strong>
          </div>

          
          <div class="col-md-6 text-end">
            <button class="btn btn-success btn-sm" id="abrir-modal" data-bs-toggle="modal" data-bs-target="#modal-registro-colaborador">
              <i class="bi bi-patch-plus">
                Agregar Colaborador
              </i>
            </button>
          </div>
        </div>
      </div>
    </div class="card-body">
      <table class="table table-sm table-striped" id="tabla-colaboradores">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Cargo</th>
            <th>Sede</th>
            <th>Telefono</th>
            <th>TipoContrato</th>
            <th>Direccion</th>
            <th>Operaciones</th>
          </tr>
        </thead>
        <tbody>
          
        </tbody>
      </table>
  </div>
  
  

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <script>

    $(document).ready(function(){
      
      function mostrarColaboradores(){
        console.log("hola");
        $.ajax({
          url:'../controllers/colaborador.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#tabla-colaboradores tbody").html(result);
          }
        });
      }

      //  Ejecución automatica
      mostrarColaboradores();

    });


    

  </script>
</body>

</html>