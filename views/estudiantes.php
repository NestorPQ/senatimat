<!doctype html>
<html lang="es">

<head>
  <title>Estudiantes</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

  <!-- Lightbox CSS -->
  <link rel="stylesheet" href="../dist/lightbox2/src/css/lightbox.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab&display=swap" rel="stylesheet">

  <style>
    #tabla {
      font-family: 'Roboto Slab', serif;
    }
  </style>

</head>

<body>
  
  <?php include("navbar.php"); ?>
  
  <!-- Inicio del card -->
  <div class="container mt-3 mb-5" id="tabla" style="padding-top: 80px;">
    <div class="card border border-secondary border-1.5 rounded-2 bg-light shadow-lg">
      <div class="card-header bg-secondary text-light">
        <div class="row">
          <div class="col-md-6">
            <strong>Lista de estudiantes</strong>
          </div>
          <div class="col-md-6 text-end">
            <button class="btn btn-success btn-sm" id="abrir-modal" data-bs-toggle="modal" data-bs-target="#modal-estudiante">
              <i class="bi bi-person-plus">
              Agregar Estudiante
            </i>
          </button>
        </div>        
      </div> 
    </div>

    <div class="container table-responsive">
      <table id="tabla-estudiantes" class="table table-striped table-sm text-nowrap table-bordered">
    
        <thead  class="text-center">
          <tr>
            <th>#</th>
            <th>Apellidos</th>
            <th>Nombres</th>
            <th>Tipo</th>
            <th>Documento</th>
            <th>Nacimiento</th>
            <th>Carrera</th>
            <th>Operaciones</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
    
        </tbody>
      </table>
    </div>
    
    </div>
  </div>
  <!-- Fin del card -->
  
  
  <!-- Modal Body -->
  <div class="modal fade" id="modal-estudiante" tabindex="-1" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-secondary text-light">
          <h5 class="modal-title" id="modalTitleId">Registro de estudiantes</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          
          <form action="" autocomplete="off" id="formulario-estudiantes" enctype="multipart/form-data">
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control form-control-sm" id="apellidos" placeholder="apellido" autofocus require>
              </div>
              <div class="mb-3 col-md-6">
                <label for="nombres" class="form-label">Nombres:</label>
                <input type="text" class="form-control form-control-sm" id="nombres" placeholder="nombre" require>
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="tipodocumento" class="form-label">Tipo documento:</label>
                <select name="tipodocumento" id="tipodocumento" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                  <option value="D">DNI</option>
                  <option value="C">Carnet de Extranjería</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="nrodocumento" class="form-label">Nro documento:</label>
                <input type="text" class="form-control form-control-sm" id="nrodocumento" placeholder="Numero del documento" maxlength="8" inputmode="numeric" require>
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="fechanacimiento" class="form-label">Fecha nacimiento:</label>
                <input type="date" class="form-control form-control-sm" id="fechanacimiento">
              </div>
              <div class="mb-3 col-md-6">
                <label for="sede" class="form-label">Sede:</label>
                <select name="sede" id="sede" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="mb-3 col-md-6">
                <label for="escuela" class="form-label">Escuela:</label>
                <select name="escuela" id="escuela" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
              <div class="mb-3 col-md-6">
                <label for="carrera" class="form-label">Carreras:</label>
                <select name="carrera" id="carrera" class="form-select form-select-sm">
                  <option value="">Seleccione</option>
                </select>
              </div>
            </div>

            <div class="mb-3">
              <label for="fotografia">Fotografía:</label>
              <input type="file" id="fotografia" accept=".jpg" class="form-control form-control-sm">
            </div>
          </form>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-sm btn-primary" id="guardar-estudiante">Guardar</button>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>

  <!-- jQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <!-- SweetAlert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Lightbox JS -->
  <script src="../dist/lightbox2/src/js/lightbox.js"></script>

  <script>
    $(document).ready(function (){
      
      function obtenerSedes(){
        $.ajax({
          url: '../controllers/sede.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function(result){
            $("#sede").html(result);
          }
        });
      }


      function obtenerEscuelas(){
        $.ajax({
          url: '../controllers/escuela.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function (result){
            $("#escuela").html(result);
          }
        });
      }
      

      function registrarEstudiante (){
        console.log("Guardando con ajax");

        //  Enviaremos los datos dentro de un OBJETO
        var formData = new FormData();

        formData.append("operacion",        "registrar");
        formData.append("apellidos",        $("#apellidos").val());
        formData.append("nombres",          $("#nombres").val());
        formData.append("tipodocumento",    $("#tipodocumento").val());
        formData.append("nrodocumento",     $("#nrodocumento").val());
        formData.append("fechanacimiento",  $("#fechanacimiento").val());
        formData.append("idcarrera",        $("#carrera").val());
        formData.append("idsede",           $("#sede").val());
        formData.append("fotografia",       $("#fotografia")[0].files[0]);

        $.ajax({
          url: '../controllers/estudiante.controller.php',
          type: 'POST',
          data: formData,
          contentType: false,
          processData: false,
          cache: false,
          success: function (){
            $("#formulario-estudiantes")[0].reset();
            $("#modal-estudiante").modal("hide");
            alert("Guardado correctamente");
          }
        });
      }

      function preguntarRegistro(){
        Swal.fire({
          icon: 'question',
          title: 'Matrículas',
          text: '¿Está seguro de registrar al estudiante?',
          footer: 'Desarrollado con PHP',
          confirmButtonText: 'Aceptar',
          confirmButtonColor: '#3498DB',
          showCancelButton: true,
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          //Identificando acción del usuario
          if (result.isConfirmed){
            registrarEstudiante();
          }
        });
      }

      function mostrarEstudiantes(){
        console.log("Mostrar Estudiantes");

        $.ajax({
          url: '../controllers/estudiante.controller.php',
          type: 'POST',
          data: {operacion: 'listar'},
          dataType: 'text',
          success: function (result){
            $("#tabla-estudiantes tbody").html(result);
          }
        });
      }

      //  EVENTOS
      $("#guardar-estudiante").click(preguntarRegistro);

      //  Al cambiar una escuela, se actualizará las carreras
      $("#escuela").change(function (){
        const idescuelaFiltro = $(this).val();

        $.ajax({
          url: '../controllers/carrera.controller.php',
          type: 'POST',
          data: {
            operacion     : 'listar',
            idescuela     : idescuelaFiltro
          },
          dataType: 'text',
          success: function(result){
            $("#carrera").html(result);
          }
        });
      });

      //  Predeterminamos un control dentro del modal
      $("#modal-estudiante").on("shown.bs.modal", event => {
        $("#apellidos").focus();
        obtenerSedes();
        obtenerEscuelas();
      });

      //  Eliminar
      $("#tabla-estudiantes tbody").on("click", ".eliminar", function(){
        const idestudianteEliminar = $(this).data("idestudiante");

        if(confirm("¿Estas seguro de proceder?")){
          $.ajax({
            url: '../controllers/estudiante.controller.php',
            type: 'POST',
            data: {
              operacion       : 'eliminar',
              idestudiante    : idestudianteEliminar
            },
            success: function(result){
              if (result == ""){
                mostrarEstudiantes();
              }
            }
          });
        }
      });


      //  ejecucion automatica
      mostrarEstudiantes();
    });
  </script>

</body>

</html>