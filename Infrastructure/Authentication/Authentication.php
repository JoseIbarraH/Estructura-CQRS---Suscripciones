<?php
session_start();
require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/vendor/autoload.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/vendor/php-patterns/activerecord/ActiveRecord.php';
require_once $_SERVER["DOCUMENT_ROOT"] . '/suscripciones/Infrastructure/Libs/Orm/config.php';

// Asegúrate de que el uso de las entidades y la configuración sean correctos
use Database\Entities\Cliente;
use ActiveRecord\Config;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cedula = trim($_POST['cedula']);
    $clave = trim($_POST['clave']);

    try {
        if (empty($cedula) || empty($clave)) {
            throw new Exception("Por favor, complete todos los campos.");
        }

        // Consulta correcta con parámetros enlazados
        $cliente = Cliente::find($cedula);

        if ($cliente->cedula == $cedula and $cliente->clave == $clave and $cliente->tipo == "administrador") {
            $_SESSION['username'] = $cliente->nombre;
            $_SESSION['cedula'] = $cliente->cedula;

            $cliente->ultima_fecha_entrada = date('Y-m-d H:i:s');
            $cliente->save();

            header('Location: /suscripciones/Public/Views/Forms/menu_Admin.php');
            exit;
        } else if ($cliente->cedula == $cedula and $cliente->clave == $clave and $cliente->tipo == "cliente"){
            $_SESSION['username'] = $cliente->nombre;
            $_SESSION['cedula'] = $cliente->cedula;

            $cliente->ultima_fecha_entrada = date('Y-m-d H:i:s');
            $cliente->save();

            header('Location: /suscripciones/Public/Views/Forms/menu_User.php');
            exit;
        }
    } catch (Exception $e) {
        $error_message = "Cedula o Clave incorrecta.";
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <title>Error de Autenticación</title>
            <style>
                .error-message {
                    color: red;
                    padding: 10px;
                    margin: 10px;
                    border: 1px solid red;
                    background-color: #ffe6e6;
                    border-radius: 5px;
                }
                .back-link {
                    margin-top: 10px;
                    display: inline-block;
                    padding: 5px 10px;
                    background-color: #f0f0f0;
                    text-decoration: none;
                    color: #333;
                    border-radius: 3px;
                }
            </style>
        </head>
        <body>
            <div class="error-message">
                <?php echo $error_message; ?>
            </div>
            <a href="javascript:history.back()" class="back-link">Volver al formulario</a>
        </body>
        </html>
        <?php
    }
}
?>
