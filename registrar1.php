<?php
  // arrancamos sesión y conexión
  if (session_status() === PHP_SESSION_NONE) session_start();
  require './conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Crear cuenta – Overwatch ALG</title>

  <!-- Google Fonts: Poppins -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./src/css/bootstrap.css">

  <!-- Tu CSS custom -->
  <link rel="stylesheet" href="./src/style.css">
</head>

<body class="canvabg">

  <!-- NAVBAR COMPLETO -->
<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-12 col-md-8 col-lg-8">
      
      <!-- HEADER con fondo azul -->
      <header class="navbar-custom mt-3 p-3 rounded">
        <div class="row align-items-center">
          <!-- Logo Blizzard -->
          <div class="col-2 d-flex justify-content-center">
            <div class="dropdown">
              <a class="btn dropdown-toggle border-0 p-0" href="#" data-bs-toggle="dropdown">
                <img src="Media/Blizzard_Logo.png" class="logo1" alt="Blizzard">
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="https://www.blizzard.com/">Visita Blizzard.com</a></li>
                <li><a class="dropdown-item" href="https://www.blizzard.com/games">Todos los juegos</a></li>
              </ul>
            </div>
          </div>

          <!-- Logo OW2 + REGISTRAR centrado -->
          <div class="col-8 d-flex flex-column align-items-center">
            <a href="./index.php"><img src="Media/Overwatch_2_logo.svg(1).png" width="55" class="mb-1" alt="Overwatch 2"></a>
            <h1 class="poppins-bold mb-0 text-white">REGISTRAR</h1>
          </div>

          <!-- Botón Juega Ya a la derecha -->
          <div class="col-2 d-flex justify-content-center">
            <a href="./login1.html" class="btn juega poppins-medium">
              Juega Ya
            </a>
          </div>
        </div>
      </header>

    </div>
  </div>
</div>



  <!-- FORMULARIO EN TARJETA CENTRADA -->
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-8">
        <div class="card shadow">
          <div class="card-body px-3 px-md-5">
            <h2 class="card-title poppins-bold text-center mb-4">
              Crear cuenta
            </h2>
            <form action="./registrar2.php" method="post">
              <div class="mb-3">
                <label
                  for="nombre"
                  class="form-label poppins-medium"
                >Nombre completo</label>
                <input
                  type="text"
                  class="form-control"
                  id="nombre"
                  name="nombre"
                  placeholder="Tu nombre completo"
                  required
                >
              </div>
              <div class="mb-3">
                <label
                  for="email"
                  class="form-label poppins-medium"
                >Correo electrónico</label>
                <input
                  type="email"
                  class="form-control"
                  id="email"
                  name="email"
                  placeholder="usuario@ejemplo.com"
                  required
                >
              </div>
              <div class="mb-3">
                <label
                  for="password"
                  class="form-label poppins-medium"
                >Contraseña</label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  name="password"
                  placeholder="••••••••"
                  required
                >
              </div>
              <div class="mb-3">
                <label
                  for="password2"
                  class="form-label poppins-medium"
                >Repite la contraseña</label>
                <input
                  type="password"
                  class="form-control"
                  id="password2"
                  name="password2"
                  placeholder="••••••••"
                  required
                >
              </div>
              <button
                type="submit"
                class="btn juega w-100 poppins-medium"
              >Registrar</button>
            </form>
            <p class="text-center mt-3 poppins-regular">
              ¿Ya tienes cuenta?
              <a href="./login1.php">Inicia sesión aquí</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS -->
  <script src="./src/js/bootstrap.bundle.js"></script>
</body>
</html>
