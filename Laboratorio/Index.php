<?php

/*Rutas*/
define('ASSETS', './view/public');
define('ROUTE','http://127.0.0.1/laboratorio/'); //url del proyecto

/*Conexion Base de Datos*/
define('HOST','127.0.0.1');
define('USER','root');
define('PASSWORD','');
define('DATABASE','facturacion_tienda_db');
define('PORT','3306');

  session_start();

  require_once "./controller/Database.php";
  require_once './controller/Router.php';
  require_once './controller/Views.php';

  /*Controladores*/ 
  require_once "./controller/userController.php";
  require_once "./controller/invoiceController.php";

  /*Archivos del modelo*/ 
  require_once "./model/user.php";
  require_once "./model/product.php";
  require_once "./model/invoice.php";

  /*instancia del router*/
  $router = new Router();
  $url = isset($_GET['url']) ? $_GET['url'] : '/';

  /*rutas la aplicacion*/
  $router->addRoute('/', 'UserController::index');              // Index => Todo usuario debera iniciar sesion para salir de esta view
  $router->addRoute('home', 'UserController::login');          // home => Ruta para usuarios que han iniciado sesion
  $router->addRoute('logout', 'UserController::logout');      // Logout => Ruta cierre de sesion
  $router->addRoute('register', 'UserController::register'); //  Registrar datos del cliente

  $router->addRoute('product', 'invoiceController::addProducts');       // Product => Ruta para agregar Articulos al carrito
  $router->addRoute('productList', 'invoiceController::listProducts'); // ProductList => Ruta para ver los productos del carrito
  $router->addRoute('cancel', 'invoiceController::cancelPurchase');   // Cancel => Ruta para vaciar el carrito de compras

  $router->addRoute('facturas', 'invoiceController::return_invoices'); //ruta para retornar factura
  $router->addRoute('save', 'invoiceController::save_invoice'); //guardar factura

  $router->handleRequest($url);