<?php 

namespace Model;

class Producto extends ActiveRecord{

    protected static $tabla = 'producto';
    protected static $columnasDB = ['id','nombre','precio','imagen','categoriaId'];

    public $id;
    public $nombre;
    public $precio;
    public $imagen;
    public $categoriaId;

    public function __construc($args =[]){
        $this->id =$args['id']  ?? null;
        $this->nombre =$args['nombre']  ?? '';
        $this->precio =$args['precio']  ?? '';
        $this->imagen =$args['imagen']  ?? '';
        $this->categoriaId =$args['categoriaId']  ?? null;

    }

}