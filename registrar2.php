<?php
session_start();
require './conexion.php';

// Solo procesamos POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ./registrar1.php');
    exit;
}

// Recogida y saneado básico
$nombre    = trim($_POST['nombre']    ?? '');
$email     = trim($_POST['email']     ?? '');
$password  = $_POST['password']       ?? '';
$password2 = $_POST['password2']      ?? '';

// Validaciones
if ($nombre === '' || $email === '' || $password === '' || $password2 === '') {
    $error = 'Por favor, rellena todos los campos.';
} elseif ($password !== $password2) {
    $error = 'Las contraseñas no coinciden.';
} else {
    // Hasheamos la contraseña
    $hash = password_hash($password, PASSWORD_DEFAULT);

    // Preparamos INSERT
    $sql   = "INSERT INTO usuarios (nombre, email, password_hash) VALUES (?, ?, ?)";
    $stmt  = $mysqli->prepare($sql);

    // -- DEBUG: si prepare falla, muestro el error real de MySQL
    if (! $stmt) {
        die("MySQL prepare error: " . htmlspecialchars($mysqli->error, ENT_QUOTES, 'UTF-8'));
    }
    // --------------------------------------------

    $stmt->bind_param('sss', $nombre, $email, $hash);

    if ($stmt->execute()) {
        $success = true;
    } else {
        // Duplicado de email u otro fallo
        if ($mysqli->errno === 1062) {
            $error = 'Este correo ya está registrado.';
        } else {
            $error = 'Error al guardar en la base de datos. Inténtalo de nuevo.';
        }
    }
    $stmt->close();
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registro – Overwatch ALG</title>
  <link rel="stylesheet" href="./src/css/bootstrap.css">
  <link rel="stylesheet" href="./src/style.css">
</head>
<body class="canvabg">

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">

        <div class="card shadow">
          <div class="card-body px-3 px-md-5 py-4 text-center">

            <?php if (! empty($success)): ?>
              <h2 class="poppins-bold text-success mb-3">¡Registro completado!</h2>
              <p>Te hemos registrado correctamente. Redirigiendo al inicio de sesión...</p>
              <?php header("refresh:3;url=login1.php"); exit; ?>

            <?php else: ?>
              <h2 class="poppins-bold text-danger mb-3">Error al registrar</h2>
              <p class="mb-4"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
              <a href="registrar1.php" class="btn juega poppins-medium">
                Volver atrás
              </a>
            <?php endif; ?>

          </div>
        </div>

      </div>
    </div>
  </div>

  <script src="./src/js/bootstrap.bundle.js"></script>
</body>
</html>
