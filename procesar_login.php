<?php
include_once 'conexion.php';

$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];

// Buscar usuario por correo
$sql = "SELECT * FROM usuarios WHERE correo = :correo";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':correo', $correo);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user && password_verify($contrasena, $user['contrasena'])) {
    // Login exitoso, puedes guardar datos en sesión aquí si deseas
    header("Location: index2.html"); // Redirige al index
    exit;
} else {
    echo "Correo o contraseña incorrectos";
}
?>
