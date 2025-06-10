<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login1.php');
    exit;
}
require 'conexion.php';
$userId = (int) $_SESSION['user_id'];
// Obtener datos actuales del usuario
if ($stmt = $mysqli->prepare("SELECT nombre, email FROM usuarios WHERE id = ?")) {
    $stmt->bind_param('i', $userId);
    $stmt->execute();
    $stmt->bind_result($nombre, $email);
    $stmt->fetch();
    $stmt->close();
} else {
    $nombre = '';
    $email = '';
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Editar Perfil - <?= htmlspecialchars($nombre, ENT_QUOTES) ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('./Media/fondo-ow.jpg') center center / cover no-repeat fixed;
      font-family: 'Segoe UI', sans-serif;
      padding-top: 4rem;
      margin: 0;
      height: 100%;
    }
    .header-edit {
      background: linear-gradient(135deg, #f28c29, #f2c029);
      color: #fff;
      text-align: center;
      padding: 2rem;
      background-image: url('./Media/overwatch-logo.png');
      background-repeat: no-repeat;
      background-position: center 20px;
      background-size: 120px auto;
      margin-bottom: 2rem;
    }
    .form-card {
      background: rgba(255,255,255,0.9);
      padding: 1.5rem;
      border-radius: .5rem;
    }
    .btn-save {
      background-color: #f28c29;
      color: #fff;
    }
    .btn-save:hover {
      background-color: #d96f1f;
    }
  </style>
</head>
<body>
  <!-- Header temático -->
  <div class="header-edit">
    <h1>Editar Perfil</h1>
  </div>
  <main class="container">
    <div class="row justify-content-center">
      <div class="col-md-6 form-card shadow">
        <form action="editar2.php" method="post">
          <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" id="nombre" name="nombre" class="form-control" value="<?= htmlspecialchars($nombre, ENT_QUOTES) ?>" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Correo electrónico</label>
            <input type="email" id="email" name="email" class="form-control" value="<?= htmlspecialchars($email, ENT_QUOTES) ?>" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Nueva contraseña (opcional)</label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Dejar en blanco para mantener actual">
          </div>
          <div class="mb-3">
            <label for="password_confirm" class="form-label">Confirmar contraseña</label>
            <input type="password" id="password_confirm" name="password_confirm" class="form-control" placeholder="Repetir contraseña">
          </div>
          <div class="d-grid mt-4">
            <button type="submit" class="btn btn-save">Guardar cambios</button>
            <a href="ajustes.php" class="btn btn-secondary mt-2">Volver</a>
          </div>
        </form>
      </div>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
