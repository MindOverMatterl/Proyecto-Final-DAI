<?php
include 'template/header.php'; // Incluye el encabezado

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeroWhatsApp = $_POST['numeroWhatsApp'];
    $mensaje = $_POST['mensaje']; // Nuevo campo para el mensaje

    if (!empty($numeroWhatsApp) && !empty($mensaje)) {
        // Definir las variables para Green API
        $idInstance = '7103866602';  // Reemplaza con tu ID de instancia de Green
        $apiTokenInstance = '1376dc4fcc814d759784de71e695a05a6d61ad965f9144afbe'; // Reemplaza con tu token de API de Green
        $chatId = $numeroWhatsApp . '@c.us'; // Reemplaza con el número de WhatsApp al que deseas enviar el mensaje

        $data = array(
            'chatId' => $chatId,
            'message' => $mensaje // Utiliza el mensaje ingresado por el usuario
        );

        $options = array(
            'http' => array(
                'header' => "Content-Type: application/json\r\n",
                'method' => 'POST',
                'content' => json_encode($data)
            )
        );

        $context = stream_context_create($options);

        $url = "https://api.green-api.com/waInstance{$idInstance}/sendMessage/{$apiTokenInstance}";
        $response = file_get_contents($url, false, $context);

        if ($response) {
            $responseData = json_decode($response, true);

            if (isset($responseData['idMessage'])) {
                echo "Mensaje enviado exitosamente con el ID: " . $responseData['idMessage'];
            } else {
                echo "Error al enviar el mensaje. Por favor, intenta de nuevo.";
            }
        } else {
            echo "Error al enviar el mensaje. Por favor, intenta de nuevo.";
        }
    } else {
        echo "Por favor, ingresa tanto el número de WhatsApp como el mensaje.";
    }
}
?>

<h2>Enviar Mensaje de WhatsApp</h2>
<form method="post" action="enviar_mensaje.php">
    <div class="form-group">
        <label for="numeroWhatsApp">Número de WhatsApp:</label>
        <input type="text" id="numeroWhatsApp" name="numeroWhatsApp" required>
    </div>
    <div class="form-group">
        <label for="mensaje">Mensaje:</label>
        <textarea class="form-control" id="mensaje" name="mensaje" required></textarea>
    </div>
    <button type="submit">Enviar Mensaje</button>
</form>

<?php
include 'template/footer.php'; // Incluye el pie de página
?>
