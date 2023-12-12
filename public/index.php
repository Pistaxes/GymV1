<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\APIController;
use Controllers\LoginController;
use Controllers\ProductoController;
use Controllers\AdminController;

use MVC\Router;

$router = new Router();
//FrontEnd
$router->get('/',[LoginController::class, 'index']);


//Incio de sesion
$router->get('/login',[LoginController::class,'login']);
$router->post('/login',[LoginController::class,'login']);
$router->get('/logout',[LoginController::class,'logout']);

//recuperar password
$router->get('/olvide',[LoginController::class, 'olvide']);
$router->post('/olvide',[LoginController::class, 'olvide']);
$router->get('/recuperar',[LoginController::class,'recuperar']);
$router->post('/recuperar',[LoginController::class,'recuperar']);

//Crear Cuenta  

$router->get('/crear-cuenta',[LoginController::class,'crear']);
$router->post('/crear-cuenta',[LoginController::class,'crear']);

$router->get('/confirmar-cuenta',[LoginController::class,'confirmar']);
$router->get('/mensaje',[LoginController::class,'mensaje']);

//Productos

$router->get('/producto',[ProductoController::class,'index']);

//Front

$router->get('/contacto',[LoginController::class,'contacto']);
$router->get('/nosotros',[LoginController::class,'nosotros']);

//Api productos
$router->get('/api/productos',[APIController::class,'index']);

//Admin
$router->get('/admin',[AdminController::class,'index']);

//CRUD de productos

$router->get('/productos',[ProductoController::class,'mostrar']);
$router->get('/crear',[ProductoController::class,'crear']);
$router->post('/crear',[ProductoController::class,'crear']);
$router->get('/actualizar',[ProductoController::class,'actualizar']);
$router->post('/actualizar',[ProductoController::class,'actualizar']);
$router->post('/eliminar',[ProductoController::class,'eliminar']);

$router->get('/carrito',[ProductoController::class,'carrito']);
$router->post('/carrito',[ProductoController::class,'carrito']);

$router->post('/pagar',[ProductoController::class,'pagar']);

$router->get('/api/carrito',[APIController::class,'carroGet']);
$router->post('/api/carrito',[APIController::class,'agregar']);


//Graficas

$router->get('/api/graficas',[APIController::class,'graficas']);


$router->get('/grafica',[ProductoController::class,'graficas']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();