<?php

class ProductosController extends BaseController
{

   public function ListaProductos(){
        $filter = DataFilter::source(Productos::with('proveedor'));
        $filter->attributes(array('class'=>'form-inline'));

        $grid = DataGrid::source($filter);
        $grid->attributes(array("class"=>"table table-hover"));
        $grid->add('nombre','Nombre', true);
        $grid->add('precio_unitario','Precio Unitario', true);
        $grid->add('precio_unitario','Precio Unitario', true);
        $grid->add('proveedor.nombre','Proveedor', true);
        $grid->edit(url().'/admin/productos/edit', 'Editar/Borrar','modify|delete');
        $grid->orderBy('id','desc');
        $grid->paginate(10);

        return View::make('productos.lista', compact('filter', 'grid'));
    }

    public function CrudProductos(){
        $productos = Proveedor::lists('nombre', 'id');
        $edit = DataEdit::source(new Productos());
        $edit->link("admin/productos/lista","Lista Productos", "TR")->back();
        $edit->add('nombre','Nombre', 'text');
        $edit->add('precio_unitario','Precio Unitario', 'text');
        $edit->add('proveedor_id','Proveedor','select')->options($productos);

        return View::make('productos.crud', compact('edit'));
    }
}