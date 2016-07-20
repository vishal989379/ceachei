<?php

class ProveedorController extends BaseController
{

   public function ListaProveedores(){
        $filter = DataFilter::source(new Proveedor);
        $filter->attributes(array('class'=>'form-inline'));

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-hover"));
        $grid->add('nombre','Nombre', true);
        $grid->add('direccion','Dirección', true);
        $grid->add('email','Email', true);
        $grid->add('telefono','Teléfono', true);
        $grid->edit(url().'/admin/proveedores/edit', 'Editar/Borrar','modify|delete');
        $grid->orderBy('id','desc');
        $grid->paginate(10);

        return View::make('proveedores.lista', compact('filter', 'grid'));
    }

    public function CrudProveedores(){
        $edit = DataEdit::source(new Proveedor());
        $edit->label('Gastos');
        $edit->link("admin/proveedores/lista","Lista Proveedores", "TR")->back();
        $edit->add('nombre','Nombre', 'text')->rule('required');
        $edit->add('direccion','Dirección', 'text')->rule('required');
        $edit->add('email','Email', 'text')->rule('required');
        $edit->add('telefono','telefono', 'text')->rule('required');

        return View::make('proveedores.crud', compact('edit'));
    }
}