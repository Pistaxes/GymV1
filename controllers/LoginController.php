<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController{
    public static function index(Router $router){
        $alertas=[];
        $router->render('front/index',[
            'alertas'=>$alertas
        ]);
        
    }
    public static function login(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            
            $auth->validarLogin(); 
            if(empty($alertas)){
                $usuario = Usuario::where('email',$auth->email);
                
                if($usuario){
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        session_start();

                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " ". $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;
                       
                        if($usuario->admin === "1"){
                            //Admin
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');

                        }else{
                            //Cliente
                           
                            header('Location: /producto');
                        }
                    }

                }else{
                    Usuario::setAlerta('error','Usuario no encontrado');
                }
            }
        }

        $alertas = Usuario::getAlertas();

       $router->render('auth/login',[ 
        'alertas' => $alertas
       ]);
    }
    public static function logout(Router $router){
        session_start();

        $_SESSION = [];

        header('Location: /');;
    }
    public static function olvide(Router $router){

        $alertas=[];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            
            $alertas= $auth->validarCorreo();
            
            if(empty($alertas)){
                $usuario= Usuario::where('email',$auth->email);
                
                if($usuario && $usuario->confirmado==="1"){
                    //Generar token
            
                    $usuario->crearToken();
                    $usuario->guardar();

                    $email=new Email($usuario->email,$usuario->nombre,$usuario->token);
                    $email->enviarInstrucciones();
                    Usuario::setAlerta('exito', 'Revisa tu email');

        
                }else{
                    Usuario::setAlerta('error','El usuario no existe o no esta confirmado');
                    
                }
                
            }
        }
        $alertas= Usuario::getAlertas();
        $router->render('auth/olvide-password',[
            'alertas'=>$alertas
        ]);
    }
    public static function recuperar(Router $router){

       $alertas =[];
       $error=false;

       $token= s($_GET['token']);

       $usuario= Usuario::where('token',$token);

       if(empty($usuario)){
        Usuario::setAlerta('error','token no valido');
        $error=true;
       }

       if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $password =new Usuario($_POST);
            $alertas = $password->validarPassword();
            if(empty($alertas)){
                $usuario->password=null;

                $usuario->password=$password->password;
                $usuario->token=null;
                $usuario->hashPassword();   
                $resultado=$usuario->guardar();
                if($resultado){
                    header('Location: /login');
                }
            }
       }

       $alertas= Usuario::getAlertas();
       $router->render('auth/recuperar-password',['alertas'=>$alertas,'error'=>$error]);
       
    }
    public static function crear(Router $router){
        $usuario = new Usuario($_POST);
        //Alertas 
        $alertas=[];
        if($_SERVER['REQUEST_METHOD'] ==='POST'){
            $usuario->sincronizar($_POST);
            
            $alertas=$usuario->validarNuevaCuenta();
            //Revisar las alertas

            if(empty($alertas)){
                
                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                } else {
                    $usuario->hashPassword();

                    $usuario->crearToken();

                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);

                    $email ->enviarConfirmacion();

                    $resultado= $usuario->guardar();

                    if($resultado){
                        header('Location: /mensaje');
                    }
                }
            }

        
        }
            $router->render('auth/crear-cuenta',[
                'usuario'=> $usuario,
                'alertas' => $alertas

            ]);
     }

     public static function mensaje(Router $router){
        $router->render('auth/mensaje');
     }
     public static function confirmar(Router $router){

        $alertas=[];
        $token=s($_GET['token']);
        $usuario= Usuario::where('token',$token);
        if(empty($usuario)){
            //Mensaje de error
            Usuario::setAlerta('error', 'Token no valido');
        }else{
            //Confirmar usuario
            echo "Token valido";
            $usuario->confirmado="1";
            $usuario->token=null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta comprobada correctamente');
        }
        $alertas= Usuario::getAlertas();
        $router->render('auth/confirmar-cuenta',['alertas'=> $alertas]);
     }

     public static function contacto(Router $router){
        $router->render('front/contacto',[]);
     }
     public static function nosotros(Router $router){
        $router->render('front/nosotros',[]);
     }
}