<?php

class RecaudacionController extends BaseController
{

    public function ListaRecaudaciones(){

        //print_r(Recaudacion::with('sucursal','gastos')->get()->toArray());
        $filter = DataFilter::source(Recaudacion::with('sucursal','gastos'));
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('sucursal.nombre', 'Nombre Sucursal', 'text');
        $filter->add('fecha','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        $filter->build();

        $grid = DataSet::source($filter);
        $grid->orderBy('id','desc');
        $grid->paginate(10);
        $grid->orderBy('fecha');
        $grid->build();

        return View::make('recaudaciones.lista', compact('filter', 'grid'));
    }

    public function CrudRecaudaciones(){
        $sucursales = Sucursal::lists('nombre', 'id');
        $edit = DataEdit::source(new Recaudacion());
        $edit->add('fecha','Fecha', 'date')->format('d/m/Y', 'es');
        $edit->link("admin/recaudaciones/lista","Lista Recaudaciones", "TR")->back();
        $edit->add('registro','Registro', 'text')->rule('required');
        $edit->add('nulos','Nulos', 'text');
        $edit->add('observacion','Observación', 'textarea');
        $edit->add('efectivo_real','Efectivo Real', 'text');
        $edit->add('redcompra','Redcompra', 'text');
        $edit->add('sucursal_id','Sucursal','select')->options($sucursales);

        return View::make('recaudaciones.crud', compact('edit'));
    }



}