<?php
session_start();

// Inicializar el saldo si no existe
if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 0;
}

// Mensaje de validación
$message = '';

// Si viene por POST, procesamos la recarga
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Convertimos coma a punto y forzamos float
    $amount = floatval(str_replace(',', '.', $_POST['amount']));
    if ($amount > 0) {
        $_SESSION['balance'] += $amount;
        // Redirigimos de vuelta a productos.php para ver el nuevo saldo
        header('Location: productos.php');
        exit;
    } else {
        $message = 'Introduce una cantidad válida.';
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Recargar Saldo – Overwatch ALG</title>
  <link rel="stylesheet" href="src/css/bootstrap.css">
</head>
<body class="d-flex align-items-center justify-content-center" style="height:100vh; background:url('./Media/fondo-ow.jpg') center/cover no-repeat;">
  <div class="card p-4" style="max-width: 350px; width:100%;">
    <h4 class="card-title mb-3 text-center">Recargar Saldo</h4>
    <?php if ($message): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>
    <form method="post" action="recarga.php">
      <div class="mb-3">
        <label for="amount" class="form-label">Cantidad (€):</label>
        <input
          type="number"
          step="0.01"
          name="amount"
          id="amount"
          class="form-control"
          required
        >
      </div>
      <button type="submit" class="btn btn-primary w-100">Recargar</button>
      <a href="productos.php" class="btn btn-link w-100 mt-2">Cancelar</a>
    </form>
  </div>
</body>
</html>
