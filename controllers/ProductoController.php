<?php 

namespace Controllers;
use MVC\Router;
use Model\Producto;
use Intervention\Image\ImageManagerStatic as Image;
use Stripe\Stripe;



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
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            //Imagen
            if(!empty($_FILES['imagen']['tmp_name'])){
                $carpeta_imagenes ='../public/build/img';
                //Crear carpeta
                if(is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes ,0755,true);
                }
                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('jpg',80);

                $nombre_imagen = md5(uniqid( rand(),true));

                $_POST['imagen']= $nombre_imagen;
            }

            $producto->sincronizar($_POST);
            
            //$alertas= $producto->validar();
            if(empty($alertas)){
                $imagen_png->save($carpeta_imagenes . '/'. $nombre_imagen.".jpg");
                
                $resultado= $producto->guardar();
                if($resultado){
                    header('Location: /productos');
                }
                
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
        $producto->imagenActual= $producto->imagen;

        $alertas = [];
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            if(!empty($_FILES['imagen']['tmp_name'])){
                $carpeta_imagenes ='../public/build/img';
                //Crear carpeta
                if(is_dir($carpeta_imagenes)){
                    mkdir($carpeta_imagenes ,0755,true);
                }
                $imagen_png = Image::make($_FILES['imagen']['tmp_name'])->fit(800,800)->encode('jpg',80);

                $nombre_imagen = md5(uniqid( rand(),true));

                $_POST['imagen']= $nombre_imagen;
            } else{
                $_POST['imagen']=$producto->imagenActual;
            }


            $producto->sincronizar($_POST);
            
            $alertas=$producto->validar();

            if(empty($alertas)){
                if(isset($nombre_imagen)){
                    $imagen_png->save($carpeta_imagenes . '/'. $nombre_imagen.".jpg");
                }
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

    public static function pagar(Router $router){

        
        $router->render('producto/pagar',[
            'nombre'=> $_SESSION['nombre'],
            'producto' => $producto,
            'aletas'=>$alertas
        ]);
        

    }
}