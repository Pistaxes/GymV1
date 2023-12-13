<?php 

namespace Controllers;
use MVC\Router;
use Model\Producto;
use Model\DetalleCarro;
use Model\DetalleCompra;
use Intervention\Image\ImageManagerStatic as Image;
use Stripe\Stripe;



class ProductoController{

    public static function index(Router $router){

        session_start();
        $productos= Producto::all();
        
       $router->render('producto/index',[
        'nombre'=> $_SESSION['nombre'],
        'productos'=>$productos
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
        session_start();
        
        

        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            $id= $_POST['id'];
            $producto= Producto::find($id);
        }
        $router->render('producto/carrito',[
            'nombre'=> $_SESSION['nombre'],
            'productos' => $productos,
        ]);
    }
//asdasd
    public static function pagar(Router $router){
        session_start();
        if($_SERVER['REQUEST_METHOD']=== 'POST'){
            //Agregar a la tabla de Detalle compra
            $consulta ="INSERT INTO detallecompra (usuarioId, productoId, fecha)
            SELECT cc.usuarioId, cc.productoId, CURDATE() as fecha
            FROM carrito cc;";

            $compra = DetalleCompra::SQLCompra($consulta);
            $id= $_SESSION['id'];
            
        }
        
        $router->render('producto/pagar',[
            'nombre'=> $_SESSION['nombre'],

            
        ]);
        

    }

    public static function graficas(Router $router){
        session_start();
        isAdmin();

        $router->render('admin/graficas',[
            'nombre'=> $_SESSION['nombre'],
        ]);
    }
   
}