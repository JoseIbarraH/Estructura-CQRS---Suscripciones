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
            <h2>Registro de Cliente</h2>
            <form action="../Controller/ClienteController.php" method="POST">
                <div class="form-group">
                    <div>
                        <label for="cedula">Cédula:</label>
                        <input type="text" id="cedula" name="cedula" required>
                    </div>
                    <div>
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required>
                    </div>
                    <div>
                        <label for="apellidos">Apellidos:</label>
                        <input type="text" id="apellidos" name="apellidos" required>
                    </div>
                    <div>
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div>
                        <label for="telefono">Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono" required>
                    </div>
                    <div>
                        <label for="tipo">Tipo:</label>
                        <input type="text" id="tipo" name="tipo" value="cliente" required>
                    </div>
                    <div>
                        <label for="clave">Clave:</label>
                        <input type="password" id="clave" name="clave" required>
                    </div>
                    <div>
                        <label for="direccion">Dirección:</label>
                        <input type="text" id="direccion" name="direccion" required>
                    </div>
                </div>
                <div class="botones">
                    <div>
                        <button class="columna" type="submit" name="action" value="Guardar">Guardar Cliente</button>
                    </div>
                    <div>
                        <button class="columna" type="submit" name="action" value="Editar">Editar Cliente</button>
                    </div>
                </div>
            </form>
            <div class="form-footer">
                <p>Todos los campos son obligatorios</p>
            </div>
        </div>
        <div class="table-container">
            <h2>Lista de Clientes</h2>
            <span style="color: red"><?= @$_REQUEST["message"] ?></span>
            <table>
                <thead>
                    <tr>
                        <th>Cédula</th>
                        <th>Nombre</th>
                        <th>Apellidos</th>
                        <th>Correo</th>
                        <th>Teléfono</th>
                        <th>Tipo</th>
                        <th>Dirección</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($clientes)): ?>
                        <?php foreach ($clientes as $cliente): ?>
                            <tr>
                                <td><?= htmlspecialchars($cliente->getCedula()); ?></td>
                                <td><?= htmlspecialchars($cliente->getNombre()); ?></td>
                                <td><?= htmlspecialchars($cliente->getApellidos()); ?></td>
                                <td><?= htmlspecialchars($cliente->getEmail()); ?></td>
                                <td><?= htmlspecialchars($cliente->getTelefono()); ?></td>
                                <td><?= htmlspecialchars($cliente->getTipo()); ?></td>
                                <td><?= htmlspecialchars($cliente->getDireccion()); ?></td>
                                <td>
                                    <form action="../Controller/ClienteController.php" method="POST">
                                        <input type="hidden" name="cedula" value="<?= htmlspecialchars($cliente->getCedula()); ?>">
                                        <button type="submit" name="action" value="Eliminar">Eliminar</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8">No hay clientes registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
