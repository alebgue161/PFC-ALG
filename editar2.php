<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login1.php');
    exit;
}
require 'conexion.php';
$userId = (int) $_SESSION['user_id'];

// Recoger datos del formulario
$nombre = trim($_POST['nombre'] ?? '');
$email = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$passwordConfirm = $_POST['password_confirm'] ?? '';

$errors = [];
// Validar campos básicos
if ($nombre === '') {
    $errors[] = 'El nombre no puede estar vacío.';
}
// Se asume validación de email con "required" y tipo email en el formulario HTML

// Si se ha introducido nueva contraseña, validar confirmación
$updatePassword = false;
if ($password !== '') {
    if ($password !== $passwordConfirm) {
        $errors[] = 'Las contraseñas no coinciden.';
    } else {
        $updatePassword = true;
    }
}

if (!empty($errors)) {
    // Redirigir con errores
    $_SESSION['editar_errors'] = $errors;
    header('Location: editar1.php');
    exit;
}

// Construir y ejecutar UPDATE
if ($updatePassword) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
    $sql = "UPDATE usuarios SET nombre = ?, email = ?, password_hash = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('sssi', $nombre, $email, $hash, $userId);
} else {
    $sql = "UPDATE usuarios SET nombre = ?, email = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ssi', $nombre, $email, $userId);
}

if (!$stmt->execute()) {
    // Error en BD
    $_SESSION['editar_errors'] = ['Error al actualizar los datos.'];
    $stmt->close();
    header('Location: editar1.php');
    exit;
}
$stmt->close();

// Éxito: redirigir a ajustes.php
$_SESSION['editar_success'] = 'Perfil actualizado correctamente.';
header('Location: ajustes.php');
exit;
