<?php

session_start();

// Vaciar todas las variables de sesión
$_SESSION = [];

// Destruir la sesión
session_destroy();

// Redirigir inmediatamente al index
header('Location: index.php');
exit;