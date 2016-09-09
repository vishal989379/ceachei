<?php

class RecaudacionController extends BaseController
{

    public function ListaRecaudaciones(){

        //print_r(Recaudacion::with('sucursal','gastos')->get()->toArray());
        $filter = DataFilter::source(Recaudacion::with('sucursal','gastos')->orderBy('fecha', 'desc'));
        $filter->attributes(array('class'=>'form-inline'));
        $filter->add('sucursal.nombre', 'Nombre Sucursal', 'text');
        $filter->add('fecha','Fecha','daterange')->format('d/m/Y', 'es');
        $filter->submit('Buscar');
        $filter->build();

        $grid = DataSet::source($filter);
        $grid->paginate(10);
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

    public function ListaInformeMensual(){
        $sucursales = Sucursal::lists('nombre', 'id');
        $sucursal_id = Input::get('sucursal_id');
        $date = Input::get('date', null);
        $informe = array();
        if($date != null){
            $month = $month = date("n");
            $informe = Recaudacion::selectRaw('id, sum(efectivo_real) as efectivo, fecha')
                        ->where(DB::raw('MONTH(fecha)'), $month )->groupBy('fecha')->get();
        }else{
            $date = date('Y-m-d');
            $month = date("m", strtotime($date));
            $informe = Recaudacion::selectRaw('id, sum(efectivo_real) as efectivo, fecha')
                        ->where(DB::raw('MONTH(fecha)'), $month)->groupBy('fecha')->get();
        }

        return View::make('recaudaciones.informe_mensual', compact('sucursales','informe',''));
    }

    public function ListaInformeAnual(){
        $sucursales = Sucursal::lists('nombre', 'id');

        return View::make('recaudaciones.informe_anual', compact('sucursales'));
    }

}