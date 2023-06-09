
<!doctype html>
<html lang="es">

<head>
  <title>Usuarios</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

    <!-- Iconos de Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">

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


  <div class="container mt-3 mb-5" id="tabla" style="padding-top: 80px;">
    <div class="card border border-secondary border-1.5 rounded-2 bg-light shadow-lg"">
      <div class="card-header bg-secondary text-light">
        <div class="row">
          <div class="col-md-6">
            <strong>LISTA DE USUARIOS</strong>
          </div>
          <div class="col-md-6 text-end">
            <button class="btn btn-success btn-sm" id="abrir-modal" data-bs-toggle="modal" data-bs-target="#modal-registro-usuarios">
              <i class="bi bi-plus-circle-fill">
                Agregar Usuario
              </i>
            </button>
          </div>
        </div>
      </div>

      <div class="card-body table-responsive">
        <table class="table table-sm table-striped text-nowrap table-bordered" id="tabla-usuarios">
          <colgroup>
            <col width = "5%">
            <col width = "25%">
            <col width = "25%">
            <col width = "35%">
            <col width = "10%">
          </colgroup>

          <thead class="text-center">
            <tr>
              <th>#</th>
              <th>Usuario</th>
              <th>Nombre</th>
              <th>Apellido</th>
              <th>Operaciones</th>
            </tr>
          </thead>
          <tbody class="table-group-divider text-center">

          </tbody>
        </table>
      </div>
    </div>
  </div> <!-- Fin de container -->

  <!-- Inicio del Modal-->

  <?php include("modal-registrarse.php"); ?>

  <!-- Fin del Modal -->


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
    //  Ejecutamos el código JavaScript después de que se haya cargado completamente el DOM
    $(document).ready(function(){

      //  Declaramos variables de ambito de bloque
      let datosNuevos = true;
      let idusuarioactualizar = -1;

      //  Hacemos una consulta asincrona al servidor
      //  Función mostrar platos
      function mostrarUsuarios(){
        //  Enviamos una solicitud AJAX al controlador
        //  usando el método POST
        //  y enviamos un objeto de datos con la propiedad 'operacion' con valor 'listar'
          $.ajax({
            url: '../controllers/usuario.controller.php',
            type: 'POST',
            data: {operacion: 'listar'},
            dataType: 'text',
            success: function(result){
              $("#tabla-usuarios tbody").html(result);
            }
          });
      }  // Fin de la función mostrar usuarios

      function eliminarUsuario(){
        console.log("Eliminando");
      }
      
      function registrarUsuario(){
        console.log("Registrando....");
        
        if(confirm("¿Estas segura guardar los datos?")){

          let datos = {
              operacion         : 'registrar',
              idusuario         :  idusuarioactualizar,
              nombreusuario     :  $("#nombreusuario").val(),
              nombres           :  $("#nombres").val(),
              apellidos         :  $("#apellidos").val(),
              claveacceso       :  $("#claveacceso").val()
          };

          if(!datosNuevos){
            datos["operacion"] = "actualizar";
          }

          $.ajax({
            url: '../controllers/usuario.controller.php',
            type: 'POST',
            data: datos,
            success: function(result){
              if(result == ""){
                $("#formulario-usuarios")[0].reset();
                
                mostrarUsuarios();
                
                $("#modal-registro-usuarios").modal('hide');
              }
            }
          });
        }
      }
      
      function abrirModal(){
        datosNuevos = true;
        $("#modal-titulo").html("Registro del usuario");
        $("#formulario-usuarios")[0].reset();
      }
      
      //  EVENTOS
      $("#guardar-usuario").click(registrarUsuario);
      $("#abrir-modal").click(abrirModal);
      //  enfocar la primera entrada al abrir el modal
      $('#modal-registro-usuarios').on("shown.bs.modal", event => {
        $("#nombreusuario").focus();
      });


      $("#tabla-usuarios tbody").on("click", ".eliminar", function(){
        const idusuarioEliminar = $(this).data("idusuario");

        if(confirm("¿Estas seguro de proceder?")){
          $.ajax({
            url: '../controllers/usuario.controller.php',
            type: 'POST',
            data: {
              operacion : 'eliminar',
              idusuario : idusuarioEliminar
            },
            success: function(result){
              if (result == ""){
                mostrarUsuarios();
              }
            }
          });
        }
      });

      $("#tabla-usuarios tbody").on ("click", ".editar", function(){
        const idusuarioeditar = $(this).data("idusuario");
        console.log("Actualizando");

        $.ajax({
          url : '../controllers/usuario.controller.php',
          type : 'POST',
          data : {
            operacion     : 'obtenerusuario',
            idusuario   : idusuarioeditar
          },
          dataType : 'JSON',
          success : function(result){
            console.log(result);

            datosNuevos = false;

            idusuarioactualizar = result["idusuario"];
            idusuario     :   idusuarioactualizar;
            $("#nombreusuario").val(result["nombreusuario"]);
            $("#nombres").val(result["nombres"]);
            $("#apellidos").val(result["apellidos"]);
            $("#claveacceso").val(result["claveacceso"]);
            $("#modal-titulo").html("Actualizar datos de usuario");
            $("#modal-registro-usuarios").modal("show");
          }
        });
      })


      //  Ejecución automatica
      mostrarUsuarios();
    });

  </script>
    
</body>

</html>
