<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class="register-box">
        <h2>Registrarse</h2>
        <form action="controlador/registrar.php" method="POST">
            <div class="input-group">
                <input type="text" name="txtusu" placeholder="Usuario" required>
                <i class="fa fa-user"></i>
            </div>
            <div class="input-group">
                <input type="password" name="txtpass" placeholder="Contraseña" required>
                <i class="fa fa-lock"></i>
            </div>
            <button type="submit">Registrarse</button>
            <div class="links">
                <p><a href="#">¿Olvidaste tu contraseña?</a></p>
                <p><a href="index.php">Iniciar Sesión</a></p>
            </div>
        </form>

    </div>
</body>
</html>