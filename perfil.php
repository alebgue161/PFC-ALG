<?php
session_start();

if (empty($_SESSION['user_id'])) {
  header('Location: login1.php');
  exit;
}

require 'conexion.php';
$userId = (int) $_SESSION['user_id'];
$userName = htmlspecialchars($_SESSION['user_name'], ENT_QUOTES);

// Obtener horas jugadas (o simular si no hay datos)
$hoursPlayed = 0;
if ($stmt = $mysqli->prepare("SELECT hours_played FROM user_stats WHERE usuario_id = ?")) {
  $stmt->bind_param('i', $userId);
  $stmt->execute();
  $stmt->bind_result($hours);
  if ($stmt->fetch()) {
    $hoursPlayed = (int) $hours;
  }
  $stmt->close();
}
if ($hoursPlayed === 0) {
  $hoursPlayed = rand(50, 2000);
}

// Obtener top 3 héroes o simular si no hay datos
$favorites = [];
if (
  $stmt = $mysqli->prepare(
    "SELECT h.name, uhs.play_count
     FROM user_hero_stats uhs
     JOIN heroes h ON uhs.hero_id = h.hero_id
     WHERE uhs.usuario_id = ?
     ORDER BY uhs.play_count DESC
     LIMIT 3"
  )
) {
  $stmt->bind_param('i', $userId);
  $stmt->execute();
  $res = $stmt->get_result();
  while ($row = $res->fetch_assoc()) {
    $favorites[] = $row;
  }
  $stmt->close();
}

if (empty($favorites)) {
  // Simular top héroes distribuyendo las horas totales
  $count = rand(4, 6);
  $res = $mysqli->query("SELECT name FROM heroes ORDER BY RAND() LIMIT {$count}");
  $simHeroes = [];
  while ($h = $res->fetch_assoc()) {
    $simHeroes[] = ['name' => $h['name']];
  }
  $totalWeight = 0;
  foreach ($simHeroes as &$hero) {
    $hero['weight'] = rand(1, 100);
    $totalWeight += $hero['weight'];
  }
  unset($hero);
  $assigned = 0;
  $n = count($simHeroes);
  foreach ($simHeroes as $i => &$hero) {
    if ($i === $n - 1) {
      $hero['play_count'] = $hoursPlayed - $assigned;
    } else {
      $hero['play_count'] = intdiv($hero['weight'] * $hoursPlayed, $totalWeight);
      $assigned += $hero['play_count'];
    }
  }
  unset($hero);
  usort($simHeroes, fn($a, $b) => $b['play_count'] - $a['play_count']);
  $favorites = array_slice($simHeroes, 0, 3);
}

// Simular estadísticas por rol distribuyendo horas totales
$roles = [];
$roleNames = ['Tank', 'Damage', 'Support'];
// Generar pesos aleatorios
$weights = [];
$totalWeight = 0;
foreach ($roleNames as $role) {
  $w = rand(1, 100);
  $weights[$role] = $w;
  $totalWeight += $w;
}
// Asignar horas según proporción
$assignedRoles = 0;
foreach ($roleNames as $i => $role) {
  if ($i === count($roleNames) - 1) {
    $time = $hoursPlayed - $assignedRoles;
  } else {
    $time = intdiv($weights[$role] * $hoursPlayed, $totalWeight);
    $assignedRoles += $time;
  }
  // Simular wins as proporción o aleatorio dentro de rango
  $wins = rand(intval($time * 0.8), intval($time * 1.2));
  $roles[] = ['role' => $role, 'time' => $time, 'wins' => $wins];
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Perfil de <?= $userName ?></title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <title>
    Proyecto IAW - Página Overwatch 2 - Álvaro Lebrón Guerra
  </title>
  <link rel="stylesheet" href="src/css/bootstrap.css" />
  <link rel="stylesheet" href="src/style.css" />
  <link rel="icon" href="Media/Overwatch_2_logo.svg(1).png" type="image/png" sizes="16x16" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet" />
  <style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,700;1,700&display=swap");
  </style>
  <style>
    body {
      background: url('./Media/fondo-ow.jpg') center center / cover no-repeat;
      font-family: 'Segoe UI', sans-serif;
    }

    .profile-header {
      padding: 4rem 0;
      background: linear-gradient(135deg, #f28c29, #f2c029);
      color: #fff;
      text-align: center;
      background-image: url('./Media/overwatch-logo.png');
      background-repeat: no-repeat;
      background-position: center 20px;
      background-size: 150px auto;
    }

    .profile-header h1 {
      margin-top: 120px;
      font-size: 2.75rem;
      text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.5);
    }

    .profile-header p.lead {
      font-size: 1.25rem;
    }

    .stats-circle {
      width: 200px;
      height: 200px;
      border-radius: 50%;
      background: #fff;
      margin: auto;
      display: flex;
      align-items: center;
      justify-content: center;
      animation: pulse 2s infinite;
    }

    .stats-circle::before {
      content: '';
      position: absolute;
      inset: 0;
      border-radius: 50%;
      border: 12px solid rgba(242, 140, 41, 0.3);
    }

    .stats-circle span {
      font-size: 2.25rem;
      font-weight: bold;
      color: #f28c29;
      z-index: 1;
    }

    @keyframes pulse {

      0%,
      100% {
        box-shadow: 0 0 0 0 rgba(242, 140, 41, 0.7);
      }

      50% {
        box-shadow: 0 0 10px 20px rgba(242, 140, 41, 0);
      }
    }

    main>.row {
      border: 2px solid #f2c029;
      border-radius: 8px;
      padding: 1.5rem;
      background: rgba(255, 255, 255, 0.85);
    }

    .hero-card {
      border: none;
      border-radius: .5rem;
      overflow: hidden;
      transition: transform .2s;
    }

    .hero-card:hover {
      transform: translateY(-4px);
    }

    .hero-card img {
      object-fit: cover;
      height: 160px;
      width: 100%;
    }

    .hero-count {
      color: #f28c29;
      font-weight: 600;
    }
  </style>
</head>

<body>

  <div class="menu m-4 rounded sticky-top">
    <header>
      <div class="row">
        <div class=" logo d-none col-lg-1 d-lg-flex justify-content-center bg-white rounded-start-2">
          <div class="dropdown d-inline-block">
            <a class="btn dropdown-toggle border-0" href="#" role="button" data-bs-toggle="dropdown"
              aria-expanded="false">
              <img src="Media/Blizzard_Logo.png" alt="Logo Blizzard" class="logo1" />
            </a>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="https://www.blizzard.com/">Visita Blizzard.com</a>
              </li>
              <li>
                <a class="dropdown-item" href="https://www.blizzard.com/games">Todos los juegos</a>
              </li>
            </ul>
          </div>
        </div>
        <div
          class="nav col-12 col-lg-11 d-lg-flex justify-content-around align-items-center bg-dark-subtle rounded-end-2">
          <div class="canva d-block justify-content-start d-lg-none">
            <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas"
              data-bs-target="#offcanvasWithBothOptions" aria-controls="offcanvasWithBothOptions"><svg
                xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-list"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                  d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
              </svg></button>

            <div class="offcanvas offcanvas-start" data-bs-scroll="true" tabindex="-1" id="offcanvasWithBothOptions"
              aria-labelledby="offcanvasWithBothOptionsLabel">
              <div class="offcanvas-header">
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>

              <!-- Logos -->
              <div class="offcanvas-header d-flex justify-content-center">
                <a href="https://www.blizzard.com/">
                  <img src="Media/Blizzard_Logo.png" width="100" alt="Blizzard">
                </a>
              </div>
              <div class="offcanvas-header d-flex justify-content-center">
                <a href="index.html">
                  <img src="Media/ow_logo_breakpoint.avif" width="400" alt="OW2">
                </a>
              </div>

              <!-- offcanvas-body FORZADO BLANCO -->
              <div class="offcanvas-body bg-white p-0">
                <div class="accordion accordion-flush" id="accordionPanelsStayOpen1">

                  <!-- 1) Información del juego -->
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                      <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapse1" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapse1">
                        Información del juego
                      </button>
                    </h2>
                    <div id="panelsStayOpen-collapse1" class="accordion-collapse collapse" aria-labelledby="headingOne"
                      data-bs-parent="#accordionPanelsStayOpen1">
                      <div class="accordion-body">
                        <a href="https://overwatch.blizzard.com/start"
                          class="d-block py-2 px-3 text-black text-decoration-none">
                          Resumen
                        </a>
                        <a href="https://overwatch.blizzard.com/media"
                          class="d-block py-2 px-3 text-black text-decoration-none">
                          Multimedia
                        </a>
                        <a href="https://overwatch.blizzard.com/news/patch-notes"
                          class="d-block py-2 px-3 text-black text-decoration-none">
                          Notas del parche
                        </a>
                      </div>
                    </div>
                  </div>

                  <!-- 2) Comunidad -->
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                      <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapse2" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapse2">
                        Comunidad
                      </button>
                    </h2>
                    <div id="panelsStayOpen-collapse2" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                      data-bs-parent="#accordionPanelsStayOpen1">
                      <div class="accordion-body">
                        <a href="https://eu.forums.blizzard.com/es/overwatch/"
                          class="d-block py-2 px-3 text-black text-decoration-none">
                          Foros
                        </a>
                        <a href="https://overwatch.blizzard.com/search"
                          class="d-block py-2 px-3 text-black text-decoration-none">
                          Perfiles de jugadores
                        </a>
                        <a href="#" class="d-block py-2 px-3 text-black text-decoration-none disabled">
                          ESPORTS
                        </a>
                        <a href="https://esports.overwatch.com/en-us/news/2024-owcs-emea-na-competitive-details"
                          class="d-block py-2 px-3 text-black text-decoration-none">
                          Esports OW 2024
                        </a>
                      </div>
                    </div>
                  </div>

                  <!-- 3) Tienda -->
                  <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                      <button class="accordion-button collapsed border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#panelsStayOpen-collapse3" aria-expanded="false"
                        aria-controls="panelsStayOpen-collapse3">
                        Tienda
                      </button>
                    </h2>
                    <div id="panelsStayOpen-collapse3" class="accordion-collapse collapse"
                      aria-labelledby="headingThree" data-bs-parent="#accordionPanelsStayOpen1">
                      <div class="accordion-body">
                        <a href="./productos.php"
                          class="d-block py-2 px-3 text-black text-decoration-none">
                          Tienda
                          <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor"
                            class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                              d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                          </svg>
                        </a>
                      </div>
                    </div>
                  </div>

                </div>

                <!-- Botón final ancho 100% -->
                <a class="juega2 btn mt-4 border-0 text-white py-3 w-100 text-center"
                  href="https://download.battle.net/es-es?product=ow&blzcmp=ow_gamesite">
                  Juega Ya
                </a>

              </div>
            </div>

          </div>
          <div class="logo_OW d-none d-lg-flex">
            <a href="./index.php"><img src="Media/Overwatch_2_logo.svg(1).png" alt="Logo Overwatch" width="55px" /></a>
          </div>
          <div class="dropdown-center align-items-center">
            <button class="fondo btn d-none d-lg-block bg-transparent text-dark border-0" type="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Información del juego
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="https://overwatch.blizzard.com/start">Resumen</a></li>
              <li>
                <a class="dropdown-item" href="https://overwatch.blizzard.com/media">Multimedia</a>
              </li>
              <li>
                <a class="dropdown-item" href="https://overwatch.blizzard.com/news/patch-notes">Notas del parche</a>
              </li>
            </ul>
          </div>
          <a class="fondo btn d-none d-lg-block bg-transparent text-black border-0" href="heroes.html"
            role="button">Héroes</a>
          <a class="fondo btn d-none d-lg-block bg-transparent text-black border-0"
            href="https://overwatch.blizzard.com/es-es/season/" role="button">Temporada</a>
          <a class="fondo btn d-none d-lg-block bg-transparent text-black border-0"
            href="https://overwatch.blizzard.com/es-es/news/" role="button">Noticias</a>
          <div class="dropdown-center">
            <button class="fondo btn d-none d-lg-block dropdown-toggle bg-transparent text-black border-0" type="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Comunidad
            </button>
            <ul class="dropdown-menu">
              <li>
                <a class="dropdown-item" href="https://eu.forums.blizzard.com/es/overwatch/">Foros</a>
              </li>
              <li>
                <a class="dropdown-item" href="https://overwatch.blizzard.com/search">perfiles de jugadores</a>
              </li>
              <li><a class="dropdown-item disabled" href="#">ESPORTS</a></li>
              <li>
                <a class="dropdown-item"
                  href="https://esports.overwatch.com/en-us/news/2024-owcs-emea-na-competitive-details">Esports de
                  Overwatch 2024</a>
              </li>
            </ul>
          </div>
          <div class="dropdown-center">
            <button class="fondo btn d-none d-lg-block dropdown-toggle bg-transparent text-black border-0" type="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              Tienda
            </button>
            <ul class=" dropdown-menu">
              <li>
                <a class="dropdown-item" href="./productos.php">Tienda
                  <svg xmlns="http://www.w3.org/2000/svg" width="13" height="13" fill="currentColor"
                    class="bi bi-arrow-up-right" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                      d="M14 2.5a.5.5 0 0 0-.5-.5h-6a.5.5 0 0 0 0 1h4.793L2.146 13.146a.5.5 0 0 0 .708.708L13 3.707V8.5a.5.5 0 0 0 1 0z" />
                  </svg>
                </a>
              </li>
            </ul>
          </div>
          <a href="https://overwatch.blizzard.com/es-es/search/">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor"
              class="bi bi-search text-black d-none d-lg-block" viewBox="0 0 16 16">
              <path
                d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>
          </a>
          <li class="nav-item dropdown me-3 d-flex align-items-center">
            <a class="nav-link dropdown-toggle poppins-medium text-dark d-flex align-items-center fondo rounded"
              href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <!-- icono de usuario -->
              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                class="bi bi-person me-2" viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6z" />
                <path fill-rule="evenodd" d="M14 14s-1-1.5-6-1.5S2 14 2 14s1-4 6-4 6 4 6 4z" />
              </svg>

              <?php if (!empty($_SESSION['user_id'])): ?>
                <!-- Usuario logueado: muestro nombre -->
                <?= htmlspecialchars($_SESSION['user_name'], ENT_QUOTES, 'UTF-8') ?>
              <?php else: ?>
                <!-- Invitado: muestro “Cuenta” -->
                <span>Cuenta</span>
              <?php endif; ?>
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
              <?php if (!empty($_SESSION['user_id'])): ?>
                <!-- Opciones para usuario logueado -->
                <li><a class="dropdown-item" href="perfil.php">Perfil</a></li>
                <li><a class="dropdown-item" href="ajustes.php">Ajustes de cuenta</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="logout.php">Cerrar sesión</a></li>
              <?php else: ?>
                <!-- Opciones para invitado -->
                <li><a class="dropdown-item" href="login1.php" style="background-color: #e3f2fd;">Iniciar sesión</a>
                </li>
                <li><a class="dropdown-item" href="registrar1.php">Inscribirse</a></li>
              <?php endif; ?>
            </ul>
          </li>

          <a class="juega btn mt-2 mb-2 d-lg-flex border-0 text-white"
            href="https://download.battle.net/es-es?product=ow&blzcmp=ow_gamesite" role="button">Juega Ya</a>
        </div>
      </div>
  </div>

  <main class="container my-5">
    <div class="row mb-5 align-items-center">
      <div class="col-md-4 text-center mb-4 mb-md-0">
        <div class="stats-circle">
          <span><?= $hoursPlayed ?>H</span>
        </div>
        <p class="mt-3 text-secondary">Total de horas jugadas</p>
      </div>
      <div class="col-md-8">
        <h3 class="mb-3">Estadísticas por rol</h3>
        <div class="table-responsive">
          <table class="table table-borderless align-middle text-center">
            <thead class="bg-white">
              <tr>
                <th class="text-start">Rol</th>
                <th>Tiempo</th>
                <th>Partidas ganadas</th>
              </tr>
            </thead>
            <tbody class="bg-light">
              <?php foreach ($roles as $r): ?>
                <tr>
                  <td class="text-start"><?= htmlspecialchars($r['role'], ENT_QUOTES) ?></td>
                  <td><?= $r['time'] ?>H</td>
                  <td><?= $r['wins'] ?></td>
                </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="row">
      <h3 class="mb-4">Tus héroes más jugados</h3>
      <?php foreach ($favorites as $hero):
        $base = 'Media/' . strtolower(str_replace([' ', ':'], ['_', ''], $hero['name']));
        $filePath = file_exists($base . '.jpg') ? $base . '.jpg'
          : (file_exists($base . '.png') ? $base . '.png'
            : 'Media/placeholder.jpg');
        ?>
        <div class="col-sm-4 mb-4">
          <div class="card hero-card shadow">
            <img src="<?= htmlspecialchars($filePath, ENT_QUOTES) ?>"
              alt="<?= htmlspecialchars($hero['name'], ENT_QUOTES) ?>">
            <div class="card-body text-center">
              <h5 class="card-title mb-2"><?= htmlspecialchars($hero['name'], ENT_QUOTES) ?></h5>
              <p class="hero-count mb-0"><?= $hero['play_count'] ?>H</p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>