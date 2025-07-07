<?php
$to = "lautarouab@gmail.com";
$subject = "📩 Nueva postulación desde la web - Trabajá con nosotros";

// Datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$localidad = $_POST['localidad'];
$nacimiento = $_POST['nacimiento'];

// Archivo
$file_tmp = $_FILES['cv']['tmp_name'];
$file_name = $_FILES['cv']['name'];
$file_type = $_FILES['cv']['type'];
$file_size = $_FILES['cv']['size'];

$handle = fopen($file_tmp, "r");
$content = fread($handle, $file_size);
fclose($handle);
$content = chunk_split(base64_encode($content));

$boundary = md5("cv");

// Headers
$headers = "From: $nombre <$email>\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: multipart/mixed; boundary=\"".$boundary."\"\r\n";

// Cuerpo del mensaje
$message = "--$boundary\r\n";
$message .= "Content-Type: text/plain; charset=UTF-8\r\n";
$message .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
$message .= "📄 Nuevo formulario de 'Trabajá con nosotros'\n\n";
$message .= "Nombre: $nombre\n";
$message .= "Email: $email\n";
$message .= "Teléfono: $telefono\n";
$message .= "Localidad: $localidad\n";
$message .= "Nacimiento: $nacimiento\n\n";
$message .= "CV adjunto: $file_name\n\n";

$message .= "--$boundary\r\n";
$message .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
$message .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n";
$message .= "Content-Transfer-Encoding: base64\r\n\r\n";
$message .= $content . "\r\n";
$message .= "--$boundary--";

// Enviar
if (mail($to, $subject, $message, $headers)) {
    header("Location: trabaja.html?enviado=1");
    exit;
} else {
    echo "❌ Error al enviar el mensaje. Intentá nuevamente.";
}
