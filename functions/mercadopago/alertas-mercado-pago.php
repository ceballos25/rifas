<?php
// Verifica que la solicitud provenga de Mercado Pago
$header = getallheaders();
$topic = $header['x-topic'];
$signature = $header['x-signature'];

// Verifica la autenticidad de la solicitud usando tu clave secreta de Webhooks
$secret_key = "1e5d1f19675aff82050591c31e1482ba1dbcc3e50176c271e1292d41881028bb"; // Reemplaza con tu clave secreta de Webhooks

$body = file_get_contents('php://input');
$expected_signature = hash_hmac('sha256', $body, $secret_key);

if ($signature == $expected_signature) {
    // La solicitud es auténtica, procesa el evento recibido
    $payload = json_decode($body, true);

    // Aquí puedes realizar acciones en base al evento recibido
    // Por ejemplo, actualizar el estado de una orden, enviar notificaciones, etc.
    
    // Log de eventos (opcional)
    file_put_contents('webhooks.log', date('Y-m-d H:i:s') . " - Evento recibido: " . $topic . "\n" . $body . "\n\n", FILE_APPEND);
    
    // Responde a Mercado Pago con un código 200 para confirmar la recepción del evento
    http_response_code(200);
    echo "Evento recibido y procesado exitosamente.";
} else {
    // La solicitud no es auténtica, ignora el evento
    // Log de eventos (opcional)
    file_put_contents('webhooks.log', date('Y-m-d H:i:s') . " - Solicitud no auténtica: " . $topic . "\n" . $body . "\n\n", FILE_APPEND);

    // Responde con un código 401 para indicar que la solicitud no es auténtica
    http_response_code(401);
    echo "Solicitud no auténtica.";
}
?>
