<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login1.php');
    exit;
}
require 'conexion.php';
$userId = (int)$_SESSION['user_id'];
// Obtener datos del usuario
if ($stmt = $mysqli->prepare("SELECT nombre, email FROM usuarios WHERE id = ?")) {
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($nombre, $email);
    $stmt->fetch();
    $stmt->close();
} else {
    // fallback en caso de error
    $nombre = '';
    $email = '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
 ta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ajustes de Cuenta - <?= htmlspecialchars($nombre, ENT_QUOTES) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }
    body {
      background: url('./Media/fondo-ow.jpg') center center / cover no-repeat fixed;
      font-family: 'Segoe UI', sans-serif;
      padding-top: 4rem;
      background-color: #000;
    }
    .header-ajustes {
      background: linear-gradient(135deg, #f28c29, #f2c029);
      padding: 2rem;
      text-align: center;
      color: #fff;
      background-image: url('./Media/overwatch-logo.png');
      background-repeat: no-repeat;
      background-position: center 20px;
      background-size: 120px auto;
      margin-bottom: 2rem;
    }
    .header-ajustes h1 { margin-top: 100px; font-size: 2rem; text-shadow: 1px 1px 3px rgba(0,0,0,0.5); }
    .ajustes-card { background: rgba(255,255,255,0.9); border-radius: .5rem; padding: 1.5rem; }
    .btn-ajuste { background-color: #f28c29; color: #fff; }
    .btn-ajuste:hover { background-color: #d96f1f; }
  </style>
</head>
<body>
  <!-- Header temático -->
  <div class="header-ajustes">
    <h1>Ajustes de Cuenta</h1>
  </div>
  <main class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 ajustes-card shadow">
        <h2 class="h5 mb-4">Datos Generales</h2>
        <p><strong>Nombre:</strong> <?= htmlspecialchars($nombre, ENT_QUOTES) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($email, ENT_QUOTES) ?></p>
        <div class="d-grid gap-2 mt-4">
          <a href="editar1.php" class="btn btn-ajuste">Modificar Perfil</a>
          <a href="eliminar_cuenta.php" class="btn btn-outline-danger">Eliminar Cuenta</a>
          <a href="index.php" class="btn btn-secondary">Volver</a>
        </div>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
