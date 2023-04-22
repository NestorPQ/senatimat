
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

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" integrity="sha512-qH+7Ou6G8XyAK1nK5OlDztVUxHx8hZVUeZ6DbnGMEuLZd8nJW4p4zPwp7PhRfRc8ya2M27YjmTEUK3qL1nEzlw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <style>
    img {
    display: block;
    margin: 0 auto;
}
  </style>

</head>

<body>

  <img src="users.png" alt="user">

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
            <h4 class="text-center">Inicio de sesión</h4>
          </div>
          <div class="card-body">
            <form>
              <div class="form-group">
                <label for="usuario">Usuario:</label>
                <input type="text" class="form-control" id="usuario" placeholder="Ingresa tu usuario">
              </div>
              <div class="form-group">
                <label for="contrasena">Contraseña:</label>
                <input type="password" class="form-control" id="contrasena" placeholder="Ingresa tu contraseña">
              </div>
              <div class="form-group form-check">
                <label class="form-check-label">
                  <input class="form-check-input" type="checkbox"> Recordar contraseña
                </label>
              </div>
              <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>

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

    
    });
  </script>

</body>

</html>