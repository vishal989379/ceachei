<?php

class Sucursal extends Eloquent  {

    public $table = 'sucursal';
    public $timestamps = true;

    public function recaudaciones(){
        return $this->hasMany('Recaudacion', 'sucursal_id');
    }

}