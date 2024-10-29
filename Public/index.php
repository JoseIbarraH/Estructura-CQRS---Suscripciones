<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="/suscripciones/Public/Views/Css/Login.css"> <!-- Enlaza tu CSS aquí -->
</head>
<body>
    <div class="container">
        <h2>Iniciar Sesión</h2>
        <form action="../Infrastructure/Authentication/Authentication.php" method="POST">
            <label for="cedula">Cedula:</label>
            <input type="text" id="cedula" name="cedula" required>

            <label for="clave">Clave:</label>
            <input type="password" id="clave" name="clave" required>

            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
