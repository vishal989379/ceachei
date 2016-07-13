<?php

class RecaudacionController extends BaseController
{

    public function ListaRecaudaciones(){

        $filter = DataFilter::source(new Recaudacion);
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('fecha','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        $filter->build();

        $grid = DataSet::source($filter);
        $grid->orderBy('id','desc');
        $grid->paginate(10);
        $grid->build();

        return View::make('recaudaciones.lista', compact('filter', 'grid'));
    }

    public function CrudRecaudaciones(){
        $edit = DataEdit::source(new Recaudacion());
        $edit->add('fecha','Fecha', 'date')->format('d/m/Y', 'es');
        $edit->link("admin/recaudaciones/lista","Lista Recaudaciones", "TR")->back();
        $edit->add('registro','Registro', 'text')->rule('required');
        $edit->add('nulos','Nulos', 'text');
        $edit->add('efectivo_real','Efectivo Real', 'text');
        $edit->add('redcompra','Redcompra', 'text');

        return View::make('recaudaciones.crud', compact('edit'));
    }



}