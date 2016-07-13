<?php

class SucursalesController extends BaseController
{

   public function ListaSucursales(){
        $filter = DataFilter::source(new Sucursal);
        $filter->add('nombre','Nombre','text');
        $filter->attributes(array('class'=>'form-inline'));
        $filter->submit('Buscar');

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-hover"));
        $grid->add('id','ID', true);
        $grid->add('nombre','Nombre', true);
        $grid->add('direccion','Dirección', true);
        $grid->edit(url().'/admin/sucursales/edit', 'Editar/Borrar','modify|delete');
        $grid->orderBy('id','desc');
        $grid->paginate(10);

        return View::make('sucursales.lista', compact('filter', 'grid'));
    }

    public function CrudSucursales(){
        $edit = DataEdit::source(new Sucursal());
        $edit->link("admin/sucursales/lista","Lista Sucursales", "TR")->back();
        $edit->add('nombre','Nombre', 'text')->rule('required');
        $edit->add('direccion','Dirección', 'text')->rule('required');

        return View::make('sucursales.crud', compact('edit'));
    }
}