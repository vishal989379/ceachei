<?php

class Recaudacion extends Eloquent  {

    public $table = 'recaudacion_diaria';
    public $timestamps = true;

    public function gastos(){
        return $this->hasMany('Gastos', 'recaudacion_id');
    }

    public function sucursal(){
        return $this->hasOne('Sucursal','id', 'sucursal_id');
    }

}