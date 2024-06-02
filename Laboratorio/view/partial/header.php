<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo ASSETS; ?>/css/reset.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS; ?>/css/header.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS; ?>/css/home.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS; ?>/css/clientForm.css" type="text/css">
    <link rel="stylesheet" href="<?php echo ASSETS; ?>/css/footer.css" type="text/css">
</head>

<body>
    <div class="home">
        <header class="home__header">
            <div class="home__header__div">
                <img class="home__header__img" src="<?php echo ASSETS; ?>/img/icon.png" alt="icono ecomerce">
            </div>
            <div class="home__header__div">
            <div class="home__header__div__div">
                    <a href="<?php echo ROUTE ?>" class="home__header__div__div__a">Tienda</a>
                </div>
                <div class="home__header__div__div">
                    <a href="<?php echo ROUTE ?>facturas" class="home__header__div__div__a">Facturas</a>
                </div>
                <div class="home__header__div__div">
                    <a href="<?php echo ROUTE ?>register" class="home__header__div__div__a">Generar Factura <?php if(isset($_SESSION['shoppingCar'])){print_r(count($_SESSION['shoppingCar']));} ?></a>
                </div>
                <div class="home__header__div__div">
                    <a href="<?php echo ROUTE ?>cancel" class="home__header__div__div__a">Cancelar Carrito</a>
                </div>
                <div class="home__header__div__div">
                    <a href="<?php echo ROUTE ?>productList" class="home__header__div__div__a">Ver Carrito</a>
                </div>
                <div class="home__header__div__div">
                    <a href="<?php echo ROUTE ?>logout" class="home__header__div__div__a">Cerrar Sesion</a>
                </div>
            </div>
        </header>
        
        <section class="home__section">
            <div class="home__section__div">