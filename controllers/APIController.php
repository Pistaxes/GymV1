<?php

namespace Controllers;

use Model\Producto;
use Model\Carrito;
use Model\DetalleCarro;
use Model\DetalleCompra;

class APIController{
    public static function index(){
        $productos = Producto::all();
        echo json_encode($productos);
    }
    public static function agregar(){
        try{
        session_start();
        $data = (json_decode(file_get_contents('php://input'),true));
        $carro= new Carrito;
        $datos = [
            'productoId' => $data['id'],
            'usuarioId' => $_SESSION['id'],
            'cantidad'=> 1
        ];

        $carro->agregarCarrito($data['id'],$_SESSION['id']);
        $array = array(
            "error" => false,
            "message" => 'Se registro' 
        );
        echo json_encode($array);
        
    } catch(Exception $e){
       
        $array = array(
            "error" => true,
            "message" => $e->getMessage()
        );
        echo json_encode($array);
    }
    }

    public static function carroGet(){

        //CONSULTA SQL
        session_start();
        $id= $_SESSION['id'];
        $consulta = "SELECT car.id,p.nombre as producto,car.cantidad,p.precio,p.imagen,us.nombre as usuario, p.precio * car.cantidad as total
        FROM carrito car
        INNER JOIN producto p ON car.productoId = p.id
        INNER JOIN usuarios us ON car.usuarioId = us.id WHERE car.usuarioId = '${id}';";
        
        $productos = DetalleCarro::SQL($consulta);

        echo json_encode($productos);
    }
    public static function graficas(){
        $consulta = "SELECT p.nombre as producto,p.precio,p.imagen,us.nombre as usuario, p.precio as total
        FROM detallecompra dc
        INNER JOIN producto p ON dc.productoId = p.id
        INNER JOIN usuarios us ON dc.usuarioId = us.id";
        $productos = DetalleCarro::SQL($consulta);
        echo json_encode($productos);
    }
    public static function eliminarUsuario(){

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try{
            // Obtener el ID del dato a eliminar desde la URL
            $id = $_GET['id'];
            
            $productos= DetalleCarro::eliminarCarrito($id);

            $array = array(
                "error" => false,
                "message" => 'Se Elimino' 
            );
            echo json_encode($array);
            }catch(Exception $e){
                $array = array(
                    "error" => true,
                    "message" => $e->getMessage()
                );
                echo json_encode($array);
            }
        }
    }

}