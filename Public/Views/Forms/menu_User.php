<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Administrador</title>
    <link rel="stylesheet" href="/suscripciones/Public/Views/Css/Admin.css">
</head>
<body>
    <div class="menu-container">
        <h2>Menú Cliente</h2>
        
        <form action="../../../Controller/TipoSuscripcionController.php" method="POST">
            <button type="submit" name="action" value="Suscribirse">Suscribirse</button>
        </form>
        <form action="../../../Controller/SuscripcionController.php" method="POST">
            <button type="submit" name="action" value="Mis_suscripciones">Mis Suscripciones</button>
        </form>
        <div class="placeholder" style="margin-bottom: 5px">Espacio para más opciones</div>
        <form action="../../../Public/index.php">
            <button type="submit" style="background-color: blue">Volver</button>
        </form>
    </div>
</body>
</html>
