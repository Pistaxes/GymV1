<?php 

namespace Model;

class DetalleCompra extends ActiveRecord{
    protected static $tabla = 'detallecompra';
    protected static $columnasDB = ['id','usuarioId','productoId','fecha'];

    public $id;
    public $usuarioId;
    public $productoId;
    public $fecha;
    
    
    public function __construc($args =[]){
        $this->id =$args['id']  ?? null;
        $this->usuarioId =$args['usuarioId']  ?? null;
        $this->productoId =$args['productoId']  ?? null;
        $this->fecha =$args['fecha']  ?? null;
        
    }
}