<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Cliente</title>
    <link rel="stylesheet" href="/suscripciones/Public/Views/Css/Crud_Clientes.css">
</head>
<body>
    <div class="container">
        <div class="form-container">
            <form action="/Suscripciones/Public/Views/Forms/menu_Admin.php">
                <button type="submit">Volver</button>
            </form>
            <h2>Registro de Suscripciones</h2>
            <form action="../Controller/TipoSuscripcionController.php" method="POST">
                <div class="form-group">
                    <div>
                        <label for="cedula">Titulo de Suscripcion:</label>
                        <input type="text" id="titulo" name="titulo" required>
                    </div>
                    <div>
                        <label for="apellidos">Precio de Suscripcion:</label>
                        <input type="text" id="precio" name="precio" required>
                    </div> 
                    <div>
                        <label for="nombre">Descripcion:</label>
                        <input type="text" id="descripcion" name="descripcion" required>
                    </div>             
                </div>
                <div class="botones">
                    <div>
                        <button class="columna" type="submit" name="action" value="Guardar">Guardar Suscripcion</button>
                    </div>
                </div>
            </form>
            <div class="form-footer">
                <p>Todos los campos son obligatorios</p>
            </div>
        </div>
        <div class="table-container">
            <h2>Lista de Suscripciones</h2>
            <span style="color: red"><?= @$_REQUEST["message"] ?></span>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Precio</th>
                        <th>Descripcion</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($tipoSuscripciones)): ?>
                        <?php foreach ($tipoSuscripciones as $suscripcion): ?>
                            <tr>
                                <td><?= htmlspecialchars($suscripcion->getIdTipoSuscripcion()); ?></td>
                                <td><?= htmlspecialchars($suscripcion->getNombreTipo()); ?></td>
                                <td><?= htmlspecialchars($suscripcion->getPrecioBase()); ?></td>
                                <td><?= htmlspecialchars($suscripcion->getDescripcion()); ?></td>
                                <td>
                                    <form action="../Controller/TipoSuscripcionController.php" method="POST">
                                        <input type="hidden" name="id" value="<?= htmlspecialchars($suscripcion->getIdTipoSuscripcion()); ?>">
                                        <button type="submit" name="action" value="Eliminar">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No hay suscripciones registradas</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
