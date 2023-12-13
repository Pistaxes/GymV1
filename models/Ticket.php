<?php 

namespace Model;

class Ticket extends ActiveRecord{

    protected static $tabla = 'carrito';
    protected static $columnasDB = ['id','productoId','usuarioId','cantidad','nombre','precioUnitario','subtotal'];

    public $id;
    public $productoId;
    public $usuarioId;
    public $cantidad;
    public $nombre;
    public $precioUnitario;
    public $subtotal;

    public function __construc($args =[]){
        $this->id =$args['id']  ?? null;
        $this->productoId =$args['productoId']  ?? null;
        $this->usuarioId =$args['usuarioId']  ?? '';
        $this->cantidad =$args['cantidad']  ?? '';
        $this->nombre =$args['nombre']  ?? '';
        $this->precioUnitario =$args['precioUnitario']  ?? null;
        $this->subtotal =$args['subtotal']  ?? null;

    }

}