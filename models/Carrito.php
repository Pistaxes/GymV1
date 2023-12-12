<?php 

namespace Model;

class Carrito extends ActiveRecord{
    protected static $tabla = 'carrito';
    protected static $columnasDB = ['id','productoId','usuarioId','cantidad'];

    public $id;
    public $productoId;
    public $usuarioId;
    public $cantidad;
    
    public function __construc($args =[]){
        $this->id =$args['id']  ?? null;
        $this->productoId =$args['productoId']  ?? null;
        $this->usuarioId =$args['usuarioId']  ?? null;
        $this->cantidad =$args['cantidad']  ?? null;
        
    }
}