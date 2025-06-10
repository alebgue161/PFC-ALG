<?php
session_start();
require_once 'conexion.php';

// Inicializar carrito y balance en sesión
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (!isset($_SESSION['balance'])) {
    $_SESSION['balance'] = 0;
}

// Manejo de acciones: add, checkout y clear
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $id     = intval($_GET['id'] ?? 0);

    switch ($action) {
        case 'add':
            if ($id) {
                if (!isset($_SESSION['cart'][$id])) {
                    $_SESSION['cart'][$id] = 0;
                }
                $_SESSION['cart'][$id]++;
            }
            break;

        case 'checkout':
            // Calcular total
            $total = 0;
            foreach ($_SESSION['cart'] as $pid => $qty) {
                $row   = $mysqli->query("SELECT precio FROM productos WHERE id=$pid")->fetch_assoc();
                $total += $row['precio'] * $qty;
            }
            // Validar saldo y vaciar carrito
            if ($total <= $_SESSION['balance']) {
                $_SESSION['balance'] -= $total;
                $_SESSION['cart'] = [];
                $_SESSION['message'] = 'Pedido realizado con éxito.';
            } else {
                $_SESSION['message'] = 'Saldo insuficiente.';
            }
            break;

        case 'clear':
            // Vaciar carrito
            $_SESSION['cart'] = [];
            $_SESSION['message'] = 'Carrito vaciado.';
            break;
    }

    // Redirigir para limpiar parámetros GET
    header('Location: productos.php');
    exit;
}

// Obtener productos
$result    = $mysqli->query('SELECT id, nombre, precio, imagen FROM productos LIMIT 7');
$productos = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Productos – Overwatch ALG</title>
  <link rel="stylesheet" href="src/css/bootstrap.css" />
  <style>
    body {
      background: url('./Media/fondo-ow.jpg') center/cover no-repeat;
      font-family: 'Poppins', sans-serif;
      padding-top: 4rem;
    }
    .card-product {
      max-width: 250px;
      margin: auto;
      border: none;
      border-radius: 1rem;
      overflow: hidden;
      background: rgba(255,255,255,0.9);
    }
    .card-img-top {
      height: 150px;
      object-fit: cover;
      width: 100%;
    }
  </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-dark bg-dark fixed-top">
    <div class="container-fluid justify-content-center">
      <a class="navbar-brand" href="index.php">
        <img src="Media/Overwatch_2_logo.svg(1).png" height="50" alt="Logo Overwatch" />
      </a>
    </div>
  </nav>

  <main class="container mt-5 pt-4">
    <?php if (isset($_SESSION['message'])): ?>
      <div class="alert alert-info"><?= htmlspecialchars($_SESSION['message']) ?></div>
      <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!-- Listado de Productos -->
    <div class="row gx-4 gy-4">
      <?php foreach ($productos as $p): ?>
      <div class="col-6 col-md-4 col-lg-3">
        <div class="card card-product">
          <img
            src="<?= htmlspecialchars($p['imagen']) ?>"
            class="card-img-top"
            alt="<?= htmlspecialchars($p['nombre']) ?>"
          >
          <div class="card-body text-center">
            <h5 class="card-title"><?= htmlspecialchars($p['nombre']) ?></h5>
            <p class="text-muted"><?= number_format($p['precio'], 2, ',', '.') ?>€</p>
            <a href="?action=add&id=<?= $p['id'] ?>" class="btn btn-primary btn-sm">
              Agregar
            </a>
          </div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <!-- Botón Carrito -->
    <button
      class="btn btn-warning position-fixed"
      style="top:1rem; right:1rem; z-index:1100;"
      type="button"
      data-bs-toggle="offcanvas"
      data-bs-target="#cartOffcanvas"
      aria-controls="cartOffcanvas"
    >
      🛒 (<?= array_sum($_SESSION['cart']) ?>)
    </button>

    <!-- Offcanvas Carrito -->
    <div
      class="offcanvas offcanvas-end"
      tabindex="-1"
      id="cartOffcanvas"
      aria-labelledby="cartOffcanvasLabel"
    >
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="cartOffcanvasLabel">Carrito</h5>
        <button
          type="button"
          class="btn-close text-reset"
          data-bs-dismiss="offcanvas"
          aria-label="Cerrar"
        ></button>
      </div>
      <div class="offcanvas-body">
        <?php if (empty($_SESSION['cart'])): ?>
          <p>No hay productos.</p>
        <?php else: ?>
          <!-- Botón Limpiar Carrito -->
          <a href="?action=clear" class="btn btn-sm btn-outline-danger w-100 mb-2">
            Limpiar Carrito
          </a>

          <ul class="list-group mb-3">
            <?php
            $total = 0;
            foreach ($_SESSION['cart'] as $pid => $qty):
              $row = $mysqli->query("SELECT nombre, precio FROM productos WHERE id=$pid")->fetch_assoc();
              $sub = $row['precio'] * $qty;
              $total += $sub;
            ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
              <?= htmlspecialchars($row['nombre']) ?> x <?= $qty ?>
              <span><?= number_format($sub, 2, ',', '.') ?>€</span>
            </li>
            <?php endforeach; ?>
          </ul>

          <div class="d-flex justify-content-between mb-3">
            <strong>Total:</strong>
            <span><?= number_format($total, 2, ',', '.') ?>€</span>
          </div>
          <div class="mb-3">
            <strong>Saldo:</strong>
            <?= number_format($_SESSION['balance'], 2, ',', '.') ?>€
          </div>

          <a href="recarga.php" class="btn btn-outline-success w-100 mb-2">Recargar</a>

          <?php if ($total > $_SESSION['balance']): ?>
            <!-- Saldo insuficiente: botón en rojo e inhabilitado -->
            <button class="btn btn-danger w-100" disabled>
              Pagar (saldo insuficiente)
            </button>
          <?php else: ?>
            <a href="?action=checkout" class="btn btn-success w-100">
              Pagar
            </a>
          <?php endif; ?>

        <?php endif; ?>
      </div>
    </div>
  </main>

  <script src="src/js/bootstrap.bundle.js"></script>
</body>
</html>
