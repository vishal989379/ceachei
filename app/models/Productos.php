<?php


class Productos extends Eloquent  {


    public $table = 'productos';
    public $timestamps = false;

    public function proveedor(){
        return $this->belongsTo('Proveedor', 'proveedor_id');
    }

}