<?php

session_start();

if(isset($_SESSION['login']) && $_SESSION['login']){
  header('Location:views/menu.php');
}

?>

<!doctype html>
<html lang="es">

<head>
  <title>Bienvenido</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS v5.2.1 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

  <style>
    img {
    display: block;
    margin: 0 auto;
    }

    label { 
		  font-family:Arial, Helvetica, sans-serif ;
      font-weight: bold;
      font-size: 14px;
		}
    
  </style>

</head>

<body>

  <div style="padding-top: 80px;">
    <img src="assets/css/img/users.png" alt="user">
  </div>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Inicio de sesión</h4>
          </div>
          <div class="card-body">
            <form autocomplete="off">
              <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control" id="usuario" placeholder="Ingresa tu usuario" required autofocus>
              </div>
              <div class="form-group">
                <label for="clave">Contraseña:</label>
                <input type="password" class="form-control" id="clave" placeholder="Ingresa tu contraseña" required>
              </div>
              <div class="form-group form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox"> Recordar contraseña
                </label>
              </div>
              <button type="submit" id="iniciar-sesion" class="btn btn-success">Iniciar sesión</button>

              <div class="text-center mt-3">
                ¿No tienes una cuenta? 
                <a href="#" id="abrir-modal" data-bs-toggle="modal" data-bs-target="#modal-registro-usuarios">
                  Regístrate aquí
                </a>
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <?php include("views/modal-registrarse.php"); ?>
  

  <!-- Bootstrap JavaScript Libraries -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js"
    integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous">
  </script>
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    $(document).ready(function(){

      function iniciarSesion(){
        const usuario = $("#usuario").val();
        const clave = $("#clave").val();

        if(usuario != "" && clave !=""){
          $.ajax({
            url: 'controllers/usuario.controller.php',
            type: 'POST',
            data: {
              operacion   : 'login',
              nombreusuario : usuario,
              claveIngresada  : clave
            },
            dataType: 'JSON',
            success: function(result){
              console.log(result);
              if(result["status"]){
                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
                })
                window.location.href = "views/menu.php"
              }else {
                alert(result["mensaje"]);
                
              }
            }

          });
        }
      }

      function registrarUsuarios(){
      console.log("Registrando....");
      
        if(confirm("¿Estas segura de registrar en este usuario?")){
          $.ajax({
            url: 'controllers/usuario.controller.php',
            type: 'POST',
            data: {
              operacion  : 'registrar',
              nombreusuario    :  $("#nombreusuario").val(),
              nombres    :  $("#nombres").val(),
              apellidos    :  $("#apellidos").val(),
              claveacceso    :  $("#claveacceso").val(),
            },
            success: function(result){
              if(result == ""){           
                $("#modal-registro-usuarios").modal('hide');
              }
            }
          });
        }
      }


    //  EVENTOS
    $("#guardar-usuario").click(registrarUsuarios);
    $("#iniciar-sesion").click(iniciarSesion);
    
    });
  </script>

</body>

</html>