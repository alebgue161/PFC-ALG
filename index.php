<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    Proyecto BootStrap - Página Overwatch 2 - Álvaro Lebrón Guerra
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
</head>

<body>
  <video muted loop autoplay src="./Media/fondo.mp4" type="video/mp4"></video>
  <div class="container-fluid">
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
                  <a href="index.php">
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
                      <div id="panelsStayOpen-collapse1" class="accordion-collapse collapse"
                        aria-labelledby="headingOne" data-bs-parent="#accordionPanelsStayOpen1">
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
                      <div id="panelsStayOpen-collapse2" class="accordion-collapse collapse"
                        aria-labelledby="headingTwo" data-bs-parent="#accordionPanelsStayOpen1">
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
              <img src="Media/Overwatch_2_logo.svg(1).png" alt="Logo Overwatch" width="55px" />
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
              <button class="fondo btn d-none d-lg-block dropdown-toggle bg-transparent text-black border-0"
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
              <button class="fondo btn d-none d-lg-block dropdown-toggle bg-transparent text-black border-0"
                type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
    </header>
    <main>
      <div class="main d-flex flex-column align-items-center justify-content-center" style="height: 90vh">
        <img src="Media/Overwatch2.png" class="rounded mx-auto d-block" alt="Overwatch 2" width="650" />
        <br>
        <p class="poppins-bold-italic mt-4 fs-1 text-white">UN FUTURO POR EL QUE VALE LA PENA LUCHAR</p>
        <p class="poppins-medium  fs-5 text-white">ACCIÓN EN EQUIPO • GRATIS</p>
      </div>
    </main>
    <footer class="text-center d-lg-flex flex-row justify-content-center align-items-center">
      <a href="https://eu.shop.battle.net/es-es/product/overwatch?blzcmp=ow_gamesite"><img
          src="Media/logo_battlenet.png" alt="Battle.net Logo" class="d-none d-lg-flex"></a>
      <a href="https://www.xbox.com/es-ES/games/store/overwatch-origins-edition/C1C4DZJPBC2V/0001"><img
          src="Media/xbox_logo.png" alt="Xbox Logo" class="d-none d-lg-flex"></a>
      <a href="https://www.playstation.com/es-es/games/overwatch/"><img src="Media/play_logo.png"
          alt="Play Station Logo" class="d-none d-lg-flex"></a>
      <a href="https://www.nintendo.com/us/store/products/overwatch-2-switch/"><img src="Media/switch_logo.png"
          alt="Nintendo Switch Logo" width="130" class="d-none d-lg-flex"></a>
      <a href="https://store.steampowered.com/app/2357570/Overwatch_2/"><img src="Media/steam_logo.png" alt="Steam Logo"
          class="d-none d-lg-flex"></a>
      <a href="https://eu.shop.battle.net/es-es/product/overwatch?blzcmp=ow_gamesite"><img src="Media/blizzard_solo.png"
          alt="Steam Logo" class="d-lg-none" width="80"></a>
      <a href="https://www.xbox.com/es-ES/games/store/overwatch-origins-edition/C1C4DZJPBC2V/0001"><img
          src="Media/xbox_solo.svg" alt="Steam Logo" class=" d-lg-none" width="80"></a>
      <a href="https://www.playstation.com/es-es/games/overwatch/"><img src="Media/psn_solo.png" alt="Steam Logo"
          class=" d-lg-none" width="80"></a>
      <a href="https://www.nintendo.com/us/store/products/overwatch-2-switch/"><img src="Media/switch_solo.svg"
          alt="Steam Logo" class=" d-lg-none" width="80"></a>
      <a href="https://store.steampowered.com/app/2357570/Overwatch_2/"><img src="Media/steam_solo.svg" alt="Steam Logo"
          class=" d-lg-none" width="70"></a>
    </footer>
  </div>
</body>
<script src="src/js/bootstrap.bundle.js"></script>

</html>