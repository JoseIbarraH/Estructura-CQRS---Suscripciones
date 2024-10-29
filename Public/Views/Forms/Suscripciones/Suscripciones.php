<?php
// Inicia la sesión (asegúrate de hacerlo al principio del script)
session_start();

// Verifica si 'cedula' existe en la sesión
if (isset($_SESSION['cedula'])) {
    $cedula = $_SESSION['cedula'];
    echo "La cédula es: " . htmlspecialchars($cedula);
} else {
    echo "No se encontró la cédula en la sesión.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Suscripciones</title>
    <style>
        /* Fuente y color de fondo de la página */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
            padding: 0;
        }

        /* Título principal */
        h2 {
            color: #444;
            font-size: 2em;
            margin: 20px 0;
            text-align: center;
        }

        /* Contenedor de las tarjetas */
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        /* Estilos para cada tarjeta */
        .card {
            background-color: #fff;
            border: 1px solid #e0e6ed;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            flex: 1 1 calc(33.33% - 20px);
            box-sizing: border-box;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            overflow: hidden;
        }

        /* Efecto hover */
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            border-color: #3a8dde;
        }

        /* Títulos y textos en las tarjetas */
        .card h3 {
            margin-top: 0;
            font-size: 1.5em;
            color: #3a8dde;
            margin-bottom: 10px;
        }

        .card p {
            font-size: 1em;
            color: #666;
            line-height: 1.6;
        }

        /* Estilos de los botones */
        button {
            background-color: #3a8dde;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
            margin-top: 10px;
        }

        button:hover {
            background-color: #3271b9;
        }

        button:active {
            background-color: #2b5c99;
        }

        /* Ajustes para hacer que las tarjetas se adapten en pantallas pequeñas */
        @media (max-width: 768px) {
            .card {
                flex: 1 1 calc(50% - 20px); /* Cambia a dos columnas en pantallas medianas */
            }
        }

        @media (max-width: 480px) {
            .card {
                flex: 1 1 100%; /* Cambia a una columna en pantallas pequeñas */
            }
        }
    </style>
</head>
<body>
    <form action="/Suscripciones/Public/Views/Forms/menu_User.php">
        <button type="submit">Volver</button>
    </form>
    <h2>Listado de Suscripciones</h2>

    <!-- Contenedor principal para las tarjetas -->
    <div class="container">
        <!-- Tarjeta de suscripción de ejemplo 1 -->
        <?php if (!empty($tipoSuscripciones)): ?>
            <?php foreach ($tipoSuscripciones as $suscripcion): ?>
                <div class="card">
                    <h3><?= htmlspecialchars($suscripcion->getNombreTipo()); ?></h3>
                    <p><?= htmlspecialchars($suscripcion->getDescripcion()); ?></p>
                    <p><?= htmlspecialchars($suscripcion->getPrecioBase()); ?></p>
                    <form action="../Controller/SuscripcionController.php">
                        <input type="hidden" name="id" value="<?= htmlspecialchars($suscripcion->getIdTipoSuscripcion()); ?>">
                        <input type="hidden" name="cedula" value="<?= $cedula ?>">
                        <button type="submit" name="action" value="suscribirse">Suscribirse</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card">
                <h3>No hay suscripciones registradas</h3>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
