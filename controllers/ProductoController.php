<?php 

namespace Controllers;
use MVC\Router;
use Model\Producto;

class ProductoController{

    public static function index(Router $router){

        session_start();
        
        
       $router->render('producto/index',[
        'nombre'=> $_SESSION['nombre'],
        
            ]);
    }

    public static function mostrar(Router $router){
        session_start();
        isAdmin();
        $productos= Producto::all();
        
       $router->render('producto/mostrar',[
        'nombre'=> $_SESSION['nombre'],
        'productos'=>$productos
            ]);
    }

    public static function crear(Router $router){
        session_start();
        isAdmin();
        $producto = new Producto;
        $alertas = [];
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $producto->sincronizar($_POST);
            
            $alertas= $producto->validar();
            if(empty($alertas)){
                $producto->guardar();
                header('Location: /productos');
            }
        }
        $router->render('producto/crear',[
            'nombre'=> $_SESSION['nombre'],
            'producto'=> $producto,
            'alertas'=> $alertas
        ]);
    }
    public static function actualizar(Router $router){
        session_start();
        isAdmin();
        
        if(!is_numeric($_GET['id'])) return;
        
        $producto = Producto::find($_GET['id']);
        
        $alertas = [];
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $producto->sincronizar($_POST);
            
            $alertas=$producto->validar();

            if(empty($alertas)){
                $producto->guardar();
                header('Location:/productos');
            }
        }
-
        $router->render('producto/actualizar',[
            'nombre'=> $_SESSION['nombre'],
            'producto' => $producto,
            'aletas'=>$alertas
        ]);
    }
    public static function eliminar(){
        session_start();
        isAdmin();
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $id=$_POST['id'];
            $producto= Producto::find($id);
            $producto->eliminar();
            header('Location: /productos');
        }
    }

    public static function carrito(Router $router){
        $router->render('producto/carrito',[]);
    }
}