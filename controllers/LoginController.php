<?php

namespace Controllers;

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
        echo 'olvide';
    }
    public static function recuperar(Router $router){
       echo 'recuperar';
    }
    public static function crear(Router $router){
        $router->render('auth/crear-cuenta',[ ]);
     }
}