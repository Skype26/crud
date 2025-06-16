<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="css/estilos.css">
    <title>Login</title>
</head>
<body>
    <div class="login-box">
        <h2>Iniciar Sesion</h2>
        <form action="conexion/validar.php" method="POST">
            <div class="input-group">
                 <input type="text" name="txtusu" placeholder="Usuario" required>
                 <i class="fa fa-user"></i>
            </div>
            <div class="input-group">
                 <input type="password" name="txtpass" placeholder="Contraseña" required>
                 <i class="fa fa-lock"></i>
            </div>

            <button type="submit">Iniciar Sesion</button>
            <div class="links">
                <p><a href="#">¿Olvidaste tu contraseña?</a></p>
                <p><a href="login_add.php">Registrarse</a></p>
            </div>
        </form>
    </div>
</body>
</html>