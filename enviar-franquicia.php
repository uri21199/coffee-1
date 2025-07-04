<?php
// Configuración
$to = "lautarouab@gmail.com"; // Reemplazar por el mail real
$subject = "📩 Nueva solicitud de franquicia";

// Datos del formulario
$nombre = $_POST['nombre'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$nacimiento = $_POST['nacimiento'];
$negocio = $_POST['negocio'];
$horario = $_POST['horario'];

// Armado del mensaje
$message = "📦 Nueva solicitud de franquicia\n\n";
$message .= "Nombre: $nombre\n";
$message .= "Email: $email\n";
$message .= "Teléfono: $telefono\n";
$message .= "Fecha de nacimiento: $nacimiento\n";
$message .= "¿Tuvo un negocio antes?: $negocio\n";
$message .= "Horario de contacto preferido: $horario\n";

// Headers
$headers = "From: $nombre <$email>\r\n";
$headers .= "Reply-To: $email\r\n";

// Envío
if (mail($to, $subject, $message, $headers)) {
    echo "<script>
            alert('✅ Tu solicitud fue enviada correctamente. ¡Gracias!');
            window.history.back();
        </script>";
} else {
    echo "<script>
