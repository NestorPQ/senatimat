<?php
session_start();

if (!isset($_SESSION['login']) || $_SESSION['login'] == false){
  header('Location:../index.php');
}
?>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Secular+One&display=swap" rel="stylesheet">

<style>
  #navbar {
    font-family: 'Secular One', sans-serif;
  }
</style>

<nav class="navbar navbar-expand-sm navbar-light bg-light navbar-dark bg-dark fixed-top" id="navbar" >
  <div class="container">
    <a class="navbar-brand">
      Senatimat
    </a>
    <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavId">
      <ul class="navbar-nav me-auto mt-2 mt-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="colaboradores.php" aria-current="page">Colaboradores <span class="visually-hidden">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="estudiantes.php" aria-current="page">Estudiantes <span class="visually-hidden">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="usuarios.php" aria-current="page">Usuarios <span class="visually-hidden">(current)</span></a>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="menu.php">Inicio</a>
        </li>
      </ul>
      
      <!-- Cerrar session -->
      <form class="d-flex">
        <a href="../controllers/usuario.controller.php?operacion=finalizar" class="btn btn-outline-danger" id="cerrar-sesion">
          log out  <i class="bi bi-box-arrow-right"></i>
        </a>

        
      </form>
    </div>
  </div>
</nav>