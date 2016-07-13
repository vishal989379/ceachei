<?php

class GastosController extends BaseController
{

   public function ListaGastos($recaudacion_id){
        $gastos = Gastos::where('recaudacion_id', $recaudacion_id);
        $filter = DataFilter::source($gastos);
        $filter->attributes(array('class'=>'form-inline'));

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-hover"));
        $grid->add('id','ID', true);
        $grid->add('monto','Monto', true);
        $grid->add('descripcion','Descripción', true);
        $grid->add('choices','B/F', true);
        $grid->add('num_doc','Numero de Documento', true);
        $grid->edit(url().'/admin/gastos/'.$recaudacion_id.'/edit', 'Editar/Borrar','modify|delete');
        $grid->orderBy('id','desc');
        $grid->paginate(10);

        return View::make('gastos.lista', compact('filter', 'grid', 'recaudacion_id'));
    }

    public function CrudGastos($recaudacion_id){
        $activo = array('B' => 'Boleta', 'F' => 'Factura');
        $edit = DataEdit::source(new Gastos());
        $edit->label('Gastos');
        $edit->link("admin/gastos/lista/".$recaudacion_id,"Lista Gastos", "TR")->back();
        $edit->add('monto','Monto', 'text')->rule('required');
        $edit->add('descripcion','Descripción', 'textarea')->rule('required');
        $edit->add('choices','B/F','select')->options($activo);
        $edit->add('num_doc','Numero Documento', 'text')->rule('required');
        $edit->set('recaudacion_id',$recaudacion_id);


        return View::make('gastos.crud', compact('edit'));
    }
}