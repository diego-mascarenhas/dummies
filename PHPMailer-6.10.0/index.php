<?php
/**
 * PHPMailer Test Script
 * Email sending test with different SMTP configurations
 */

// Load PHPMailer classes
require_once 'src/PHPMailer.php';
require_once 'src/SMTP.php';
require_once 'src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Test configurations
$configurations = [
    'gmail_587' => [
        'host' => 'smtp.gmail.com',
        'port' => 587,
        'encryption' => PHPMailer::ENCRYPTION_STARTTLS,
        'name' => 'Gmail (Port 587 - STARTTLS)'
    ],
    'gmail_465' => [
        'host' => 'smtp.gmail.com',
        'port' => 465,
        'encryption' => PHPMailer::ENCRYPTION_SMTPS,
        'name' => 'Gmail (Port 465 - SSL/TLS)'
    ],
    'outlook_587' => [
        'host' => 'smtp-mail.outlook.com',
        'port' => 587,
        'encryption' => PHPMailer::ENCRYPTION_STARTTLS,
        'name' => 'Outlook (Port 587 - STARTTLS)'
    ],
    'yahoo_587' => [
        'host' => 'smtp.mail.yahoo.com',
        'port' => 587,
        'encryption' => PHPMailer::ENCRYPTION_STARTTLS,
        'name' => 'Yahoo (Port 587 - STARTTLS)'
    ],
    'custom' => [
        'host' => '',
        'port' => 587,
        'encryption' => PHPMailer::ENCRYPTION_STARTTLS,
        'name' => 'Servidor SMTP Personalizado'
    ]
];

// Configuration variables (change according to your credentials)
$userEmail = 'tu-email@ejemplo.com'; // Change to your email
$userPassword = 'tu-password-o-app-password'; // Change to your password or app password
$destinationEmail = 'destino@ejemplo.com'; // Change to destination email

// Function to test email sending
function testEmailSending($config, $userEmail, $userPassword, $destinationEmail, $customConfig = null)
{
    $mail = new PHPMailer(true);

    try
    {
        // Use custom configuration if provided
        if ($customConfig && !empty($customConfig['host']))
        {
            $config = $customConfig;
        }

        // SMTP server configuration
        $mail->isSMTP();
        $mail->Host = $config['host'];
        $mail->SMTPAuth = true;
        $mail->Username = $userEmail;
        $mail->Password = $userPassword;
        $mail->SMTPSecure = $config['encryption'];
        $mail->Port = $config['port'];

        // Enable detailed debug
        $mail->SMTPDebug = SMTP::DEBUG_CONNECTION;
        $mail->Debugoutput = function ($str, $level)
        {
            echo "<pre style='background: #f0f0f0; padding: 5px; margin: 2px; border-left: 3px solid #007cba;'>DEBUG: $str</pre>";
        };

        // Sender configuration
        $mail->setFrom($userEmail, 'Test PHPMailer');
        $mail->addAddress($destinationEmail, 'Test User');

        // Email content
        $mail->isHTML(true);
        $mail->Subject = 'Test Email - ' . $config['name'];
        $mail->Body = "
            <h2>Test Email</h2>
            <p>This is a test email sent using:</p>
            <ul>
                <li><strong>Server:</strong> {$config['host']}</li>
                <li><strong>Port:</strong> {$config['port']}</li>
                <li><strong>Encryption:</strong> " . ($config['encryption'] == PHPMailer::ENCRYPTION_STARTTLS ? 'STARTTLS' : 'SSL/TLS') . "</li>
                <li><strong>Date:</strong> " . date('Y-m-d H:i:s') . "</li>
            </ul>
            <p>If you receive this email, the configuration is working correctly.</p>
        ";

        $mail->AltBody = 'Test email - ' . $config['name'] . ' - ' . date('Y-m-d H:i:s');

        $mail->send();
        return ['success' => true, 'message' => 'Email sent successfully'];

    }
    catch (Exception $e)
    {
        return ['success' => false, 'message' => "Error: {$mail->ErrorInfo}"];
    }
}

?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHPMailer Test - Envío de Emails</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
            text-align: center;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        input[type="email"],
        input[type="password"],
        input[type="text"],
        input[type="number"],
        select {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[type="email"]:focus,
        input[type="password"]:focus,
        input[type="text"]:focus,
        input[type="number"]:focus,
        select:focus {
            border-color: #007cba;
            outline: none;
        }

        button {
            background-color: #007cba;
            color: white;
            padding: 12px 30px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #005a8a;
        }

        .resultado {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            border-left: 4px solid;
        }

        .exito {
            background-color: #d4edda;
            border-color: #28a745;
            color: #155724;
        }

        .error {
            background-color: #f8d7da;
            border-color: #dc3545;
            color: #721c24;
        }

        .debug-output {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 15px;
            margin-top: 20px;
            max-height: 400px;
            overflow-y: auto;
        }

        .config-info {
            background: #e9f7ff;
            border: 1px solid #b3d9ff;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .warning {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            border-radius: 5px;
            padding: 15px;
            margin-bottom: 20px;
            color: #856404;
        }

        .custom-config {
            background: #f0f8ff;
            border: 2px solid #007cba;
            border-radius: 5px;
            padding: 20px;
            margin-top: 15px;
            display: none;
        }

        .custom-config.show {
            display: block;
        }

        .custom-config h4 {
            margin-top: 0;
            color: #007cba;
        }
    </style>
    <script>
        function toggleCustomConfig() {
            const select = document.getElementById('configuracion');
            const customDiv = document.getElementById('custom-config');

            if (select.value === 'custom') {
                customDiv.classList.add('show');
            } else {
                customDiv.classList.remove('show');
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <h1>📧 PHPMailer Test - Envío de Emails</h1>

        <div class="warning">
            <strong>⚠️ Importante:</strong> Asegúrate de cambiar las credenciales antes de probar. Para Gmail,
            necesitarás usar una "App Password" en lugar de tu contraseña normal.
        </div>

        <form method="POST">
            <div class="form-group">
                <label for="email_usuario">Tu Email:</label>
                <input type="email" id="email_usuario" name="email_usuario"
                    value="<?php echo htmlspecialchars($userEmail); ?>" required>
            </div>

            <div class="form-group">
                <label for="password_usuario">Tu Password (o App Password):</label>
                <input type="password" id="password_usuario" name="password_usuario"
                    value="<?php echo htmlspecialchars($userPassword); ?>" required>
            </div>

            <div class="form-group">
                <label for="email_destino">Email de Destino:</label>
                <input type="email" id="email_destino" name="email_destino"
                    value="<?php echo htmlspecialchars($destinationEmail); ?>" required>
            </div>

            <div class="form-group">
                <label for="configuracion">Configuración SMTP:</label>
                <select id="configuracion" name="configuracion" onchange="toggleCustomConfig()" required>
                    <option value="">Selecciona una configuración</option>
                    <?php foreach ($configurations as $key => $config): ?>
                        <option value="<?php echo $key; ?>"><?php echo $config['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div id="custom-config" class="custom-config">
                <h4>🔧 Configuración de Servidor Personalizado</h4>
                <div class="form-group">
                    <label for="custom_host">Servidor SMTP:</label>
                    <input type="text" id="custom_host" name="custom_host" placeholder="ej: mail.tudominio.com">
                </div>

                <div class="form-group">
                    <label for="custom_encryption">Encriptación:</label>
                    <select id="custom_encryption" name="custom_encryption">
                        <option value="starttls">STARTTLS (Puerto 587)</option>
                        <option value="ssl">SSL/TLS (Puerto 465)</option>
                        <option value="none">Sin encriptación (Puerto 25)</option>
                    </select>
                </div>

                <div class="warning">
                    <strong>💡 Tips para servidor propio:</strong>
                    <ul>
                        <li><strong>Puerto 587:</strong> Recomendado para STARTTLS</li>
                        <li><strong>Puerto 465:</strong> Para SSL/TLS</li>
                        <li><strong>Puerto 25:</strong> Para conexiones sin encriptación (no recomendado)</li>
                        <li>Verifica que tu servidor permita autenticación SMTP</li>
                    </ul>
                </div>
            </div>

            <button type="submit" name="probar" style="margin-top: 25px;">🚀 Probar Envío de Email</button>
        </form>

        <?php
        if (isset($_POST['probar']))
        {
            $userEmail = $_POST['email_usuario'];
            $userPassword = $_POST['password_usuario'];
            $destinationEmail = $_POST['email_destino'];
            $selectedConfig = $_POST['configuracion'];

            $customConfig = null;

            // Handle custom configuration
            if ($selectedConfig === 'custom')
            {
                $customHost = $_POST['custom_host'] ?? '';
                $customEncryption = $_POST['custom_encryption'] ?? 'starttls';

                if (empty($customHost))
                {
                    echo "<div class='resultado error'>";
                    echo "<h4>❌ Error</h4>";
                    echo "<p>Debes especificar el servidor SMTP personalizado.</p>";
                    echo "</div>";
                }
                else
                {
                    // Convert encryption selection to PHPMailer constants and set appropriate port
                    $encryptionConfig = [
                        'starttls' => ['encryption' => PHPMailer::ENCRYPTION_STARTTLS, 'port' => 587],
                        'ssl' => ['encryption' => PHPMailer::ENCRYPTION_SMTPS, 'port' => 465],
                        'none' => ['encryption' => '', 'port' => 25]
                    ];

                    $selectedEncryption = $encryptionConfig[$customEncryption];

                    $customConfig = [
                        'host' => $customHost,
                        'port' => $selectedEncryption['port'],
                        'encryption' => $selectedEncryption['encryption'],
                        'name' => "Servidor Personalizado ($customHost:{$selectedEncryption['port']})"
                    ];
                }
            }

            if (isset($configurations[$selectedConfig]) || $customConfig)
            {
                $config = $customConfig ?: $configurations[$selectedConfig];

                echo "<div class='config-info'>";
                echo "<h3>📋 Configuración Seleccionada: " . $config['name'] . "</h3>";
                echo "<p><strong>Servidor:</strong> " . $config['host'] . "</p>";
                echo "<p><strong>Puerto:</strong> " . $config['port'] . "</p>";
                echo "<p><strong>Encriptación:</strong> " . ($config['encryption'] == PHPMailer::ENCRYPTION_STARTTLS ? 'STARTTLS' : ($config['encryption'] == PHPMailer::ENCRYPTION_SMTPS ? 'SSL/TLS' : 'Sin encriptación')) . "</p>";
                echo "</div>";

                echo "<div class='debug-output'>";
                echo "<h4>🔍 Debug Output:</h4>";

                $result = testEmailSending($configurations[$selectedConfig] ?? [], $userEmail, $userPassword, $destinationEmail, $customConfig);

                echo "</div>";

                $resultClass = $result['success'] ? 'exito' : 'error';
                echo "<div class='resultado $resultClass'>";
                echo "<h4>" . ($result['success'] ? '✅ Éxito' : '❌ Error') . "</h4>";
                echo "<p>" . htmlspecialchars($result['message']) . "</p>";
                echo "</div>";
            }
        }
        ?>

        <div style="margin-top: 30px; padding: 20px; background: #f8f9fa; border-radius: 5px;">
            <h3>💡 Tips para Debug:</h3>
            <ul>
                <li><strong>Puerto 587:</strong> Usa STARTTLS (más común y recomendado)</li>
                <li><strong>Puerto 465:</strong> Usa SSL/TLS (más antiguo pero aún funcional)</li>
                <li><strong>Puerto 25:</strong> Sin encriptación (solo para servidores locales)</li>
                <li><strong>Gmail:</strong> Necesitas habilitar "App Passwords" en tu cuenta</li>
                <li><strong>Outlook:</strong> Puede requerir autenticación de dos factores</li>
                <li><strong>Servidor Propio:</strong> Verifica firewall y configuración de autenticación SMTP</li>
                <li><strong>Debug Output:</strong> Te mostrará exactamente qué está pasando con la conexión SMTP</li>
            </ul>
        </div>

        <div style="margin-top: 20px; padding: 20px; background: #e9f7ff; border-radius: 5px;">
            <h3>🔧 Configuraciones Disponibles:</h3>
            <?php foreach ($configurations as $key => $config): ?>
                <?php if ($key !== 'custom'): ?>
                    <p><strong><?php echo $config['name']; ?>:</strong>
                        <?php echo $config['host']; ?>:<?php echo $config['port']; ?></p>
                <?php else: ?>
                    <p><strong><?php echo $config['name']; ?>:</strong> Configura tu propio servidor SMTP</p>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>