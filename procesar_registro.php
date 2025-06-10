<?php
include_once 'conexion.php';

$nombre = $_POST['nombre'];
$correo = $_POST['correo'];
$usuario = $_POST['usuario'];
$contrasena = $_POST['contrasena'];
$contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);

// Verificar si el correo ya está registrado
$check = $conn->prepare("SELECT COUNT(*) FROM usuarios WHERE correo = :correo");
$check->bindParam(':correo', $correo);
$check->execute();
$count = $check->fetchColumn();

if ($count > 0) {
    echo "Este correo ya está registrado. <a href='registro.html'>Intenta con otro</a>.";
    exit;
}

// Insertar nuevo usuario
$sql = "INSERT INTO usuarios (nombre, correo, usuario, contrasena) VALUES (:nombre, :correo, :usuario, :contrasena)";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':nombre', $nombre);
$stmt->bindParam(':correo', $correo);
$stmt->bindParam(':usuario', $usuario);
$stmt->bindParam(':contrasena', $contrasena_hash);

if ($stmt->execute()) {
    header("Location: index2.html");
    exit;
} else {
    echo "Error al registrar usuario";
}
?>
