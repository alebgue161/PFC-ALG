<?php
session_start();
require_once 'conexion.php';

// Suponemos que $_SESSION['user_id'] contiene el ID del usuario logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Borrar cuenta
    $userId = intval($_SESSION['user_id']);
    $stmt = $mysqli->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param('i', $userId);
    if ($stmt->execute()) {
        // Destruir sesión y redirigir
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    } else {
        $message = 'Error al borrar la cuenta. Intenta de nuevo.';
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Borrar Cuenta – Overwatch ALG</title>
  <link rel="stylesheet" href="src/css/bootstrap.css" />
</head>
<body class="d-flex align-items-center justify-content-center" style="height:100vh; background:url('./Media/fondo-ow.jpg') center/cover no-repeat;">
  <div class="card p-4" style="max-width: 400px; width:100%;">
    <h4 class="card-title mb-3 text-center">Borrar Cuenta</h4>
    <?php if ($message): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <p>¿Estás seguro de que deseas eliminar tu cuenta? Esta acción no se puede deshacer.</p>
    <form method="post">
      <button type="submit" class="btn btn-danger w-100">Confirmar Borrado</button>
      <a href="productos.php" class="btn btn-secondary w-100 mt-2">Cancelar</a>
    </form>
  </div>
</body>
</html>
