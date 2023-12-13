<?php 

namespace Model;

class DetalleCarro extends ActiveRecord{

    protected static $tabla = 'carrito';
    protected static $columnasDB = ['id','producto','cantidad','precio','imagen','usuario','total'];

    public $id;
    public $producto;
    public $cantidad;
    public $precio;
    public $imagen;
    public $usuario;
    public $total;

    public function __construc($args =[]){
        $this->id =$args['id']  ?? null;
        $this->producto =$args['producto']  ?? null;
        $this->cantidad =$args['cantidad']  ?? '';
        $this->precio =$args['precio']  ?? '';
        $this->imagen =$args['imagen']  ?? '';
        $this->usuario =$args['usuario']  ?? null;
        $this->total =$args['total']  ?? null;

    }

}