<?php
session_start();
require './conexion.php';

// 1) Si no es POST => volvemos al formulario
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login1.php');
    exit;
}

$email    = trim($_POST['email']);
$password = $_POST['password'];

// 2) Preparamos y ejecutamos SELECT
$sql  = "SELECT id, nombre, password_hash FROM usuarios WHERE email = ? LIMIT 1";
$stmt = $mysqli->prepare($sql);
if (! $stmt) {
    die("MySQL prepare error: " . htmlspecialchars($mysqli->error, ENT_QUOTES, 'UTF-8'));
}
$stmt->bind_param('s', $email);
$stmt->execute();
$stmt->store_result();

// 3) Si encontramos un usuario…
if ($stmt->num_rows === 1) {
    $stmt->bind_result($id, $nombre, $hash);
    $stmt->fetch();
    if (password_verify($password, $hash)) {
        // Éxito: guardamos y redirigimos
        $_SESSION['user_id']   = $id;
        $_SESSION['user_name'] = $nombre;
        header('Location: index.php');
        exit;
    }
}

// 4) Si llegamos aquí, error de credenciales
$error = 'Usuario o contraseña incorrectos.';
$stmt->close();
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Error – Iniciar sesión</title>
  <link rel="stylesheet" href="./src/css/bootstrap.css">
  <link rel="stylesheet" href="./src/style.css">
</head>
<body class="canvabg">

  <!-- Navbar u header personalizado si aplica -->

  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-12 col-md-6 col-lg-4">
        <div class="card shadow">
          <div class="card-body px-3 px-md-5 py-4 text-center">
            <h2 class="poppins-bold text-danger mb-3">¡Error al iniciar sesión!</h2>
            <p class="poppins-regular mb-4">
              <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
            </p>
            <a href="login1.php" class="btn juega w-100 poppins-medium">
              Volver a Iniciar sesión
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="./src/js/bootstrap.bundle.js"></script>
</body>
</html>
