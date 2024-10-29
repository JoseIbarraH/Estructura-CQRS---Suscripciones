<?php
// Inicia la sesión (asegúrate de hacerlo al principio del script)
session_start();

// Verifica si 'cedula' existe en la sesión
if (isset($_SESSION['cedula'])) {
    $cedula = $_SESSION['cedula'];
} else {
    echo "No se encontró la cédula en la sesión.";
}
?>

<html>

<head>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f5f5f5;
            padding: 20px;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .title {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 24px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th {
            background: #3498db;
            color: white;
            padding: 12px;
            text-align: left;
            font-weight: 500;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            color: #555;
        }

        tr:hover {
            background: #f8f9fa;
        }

        .activa {
            color: #27ae60;
            font-weight: 500;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
        }

        .precio {
            font-weight: 500;
            color: #2c3e50;
        }

        .actions {
            display: flex;
            gap: 8px;
        }

        .btn {
            padding: 6px 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-edit {
            background: #f1c40f;
            color: white;
        }

        .btn-delete {
            background: #e74c3c;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
        }
    </style>
</head>

<body>
    <div class="container">
        <form action="/Suscripciones/Public/Views/Forms/menu_Admin.php">
            <button type="submit">Volver</button>
        </form>
        <h1 class="title">Gestión de Suscripciones</h1>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>password</th>
                    <th>Email</th>
                    <th>Cédula Cliente</th>
                    <th>Fecha Suscripción</th>
                    <th>Estado</th>
                    <th>Tipo Suscripción</th>
                    <th>Fecha Expiración</th>
                    <th>Precio</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($suscripciones)): ?>
                    <?php foreach ($suscripciones as $suscripcion): ?>
                        <?php if ($cedula == $suscripcion->getCedulaCliente()): ?>
                            <tr>
                                <td><?= htmlspecialchars($suscripcion->getCodigo()); ?></td>
                                <td><?= htmlspecialchars($suscripcion->getPassword()); ?></td>
                                <td><?= htmlspecialchars($suscripcion->getEmail());?></td>
                                <td><?= htmlspecialchars($suscripcion->getCedulaCliente());?></td>
                                <td><?= htmlspecialchars($suscripcion->getFechaSuscripcion());?></td>
                                <td><?= htmlspecialchars($suscripcion->getEstado());?></td>
                                <td><?= htmlspecialchars($suscripcion->getTipoSuscripcion());?></td>
                                <td><?= htmlspecialchars($suscripcion->getFechaExpiracion());?></td>
                                <td class="precio"><?= htmlspecialchars($suscripcion->getPrecio());?></td>
                                <td>
                                    <form action="../Controller/SuscripcionController.php" method="POST">
                                        <div class="actions">
                                            <input type="hidden" name="codigo" value="<?= htmlspecialchars($suscripcion->getCodigo()); ?>">
                                            <button class="btn btn-delete" type="submit" name="action" value="Eliminar">Eliminar</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td colspan="5">No hay suscripciones registradas</td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">No hay suscripciones registradas</td>
                    </tr>
                <?php endif; ?>
                <!-- Más filas se pueden agregar aquí -->
            </tbody>
        </table>
    </div>


</body>

</html>