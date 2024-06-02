<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Online</title>
    <link rel="stylesheet" href="<?php  echo ASSETS; ?>/css/reset.css">
    <link rel="stylesheet" href="<?php  echo ASSETS; ?>/css/login.css">
</head>

<body>
    <div class="login">
        <div class="login__div">
            <form method="POST" class="login__div__form">
                <h1 class="login__div__form__h1">Iniciar Sesion</h1>
                <input class="login__div__form__input" type="mail" name="mail" placeholder="Correo" required>
                <input class="login__div__form__input" type="password" name="password" placeholder="Contraseña" required>
                <input class="login__div__form__input btn" type="submit" value="Iniciar Sesion">
            </form>
        </div>
    </div>
</body>

</html>