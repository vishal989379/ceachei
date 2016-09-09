@extends('layouts.layout')
@section('head')
@stop
@section('title')
Lista Gastos
<div class="pull-right">
	<a href="{{ URL::to('/admin/recaudaciones') }}/edit?modify={{ $recaudacion_id }}" class="btn btn-info">Editar Recaudación</a>
    <a href="{{ URL::to('/') }}/admin/gastos/{{ $recaudacion_id }}/crear" class="btn btn-success">Crear Nuevo</a>
</div>
@stop
@section('sidebar')
    @parent
@stop
@section('content')
{{ $filter }}
<br />
<div class="row">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-body table-responsive no-padding">
               <table class="table">
                <thead>
                    <tr>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        
                    </tr>
                </tbody>


               </table>
            </div>
        </div>
    </div>
</div>
@stop