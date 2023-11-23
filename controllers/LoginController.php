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
       $router->render('auth/login',[ ]);
    }
    public static function logout(Router $router){
       echo'logout';
    }
    public static function olvide(Router $router){
        $router->render('auth/olvide',[ ]);
    }
    public static function recuperar(Router $router){
       echo 'recuperar';
    }
    public static function crear(Router $router){
        $usuario = new Usuario($_POST);
        //Alertas 
        $alertas=[];
        if($_SERVER['REQUEST_METHOD'] ==='POST' ){
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
}