<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iniciar sesión – Overwatch ALG</title>

  <!-- Google Fonts Poppins -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="./src/css/bootstrap.css">
  <!-- Tu CSS custom -->
  <link rel="stylesheet" href="./src/style.css">
</head>
<body class="canvabg">

  <!-- Copia aquí tu navbar completo de index.php -->
  <?php /* Si tu navbar está en PHP, inclúyelo; si no, pégalo manualmente. */ ?>

  <!-- FORMULARIO INICIO DE SESIÓN -->
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow">
          <div class="card-body px-3 px-md-5">
            <h2 class="card-title poppins-bold text-center mb-4">
              Iniciar sesión
            </h2>
            <form action="./login2.php" method="post">
              <div class="mb-3">
                <label for="email" class="form-label poppins-medium">
                  Correo electrónico
                </label>
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
                <label for="password" class="form-label poppins-medium">
                  Contraseña
                </label>
                <input
                  type="password"
                  class="form-control"
                  id="password"
                  name="password"
                  placeholder="••••••••"
                  required
                >
              </div>
              <button
                type="submit"
                class="btn juega w-100 poppins-medium"
              >
                Iniciar sesión
              </button>
            </form>
            <p class="text-center mt-3 poppins-regular">
              ¿No tienes cuenta?
              <a href="./registrar1.php">Regístrate aquí</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="./src/js/bootstrap.bundle.js"></script>
</body>
</html>