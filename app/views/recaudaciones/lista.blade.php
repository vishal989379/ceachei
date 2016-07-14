@extends('layouts.layout')
@section('head')
@stop
@section('title')
Administración Recaudaciones
    <div class="pull-right">
        <a href="{{ URL::to('/') }}/admin/recaudaciones/crear" class="btn btn-success">Agregar Recaudación</a>
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
                    <table class="table table-hover">
                    <thead>
                    <tr>
                                 <th>
                                                                <a href="{{ URL::to('/') }}/admin/recaudaciones/lista?ord=id">
                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                    </a>
                                                                    <span class="glyphicon glyphicon-arrow-down"></span>
                                                             ID
                            </th>
                                 <th>
                                                                <a href="{{ URL::to('/') }}/admin/recaudaciones/lista?ord=registro">
                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                    </a>
                                                                    <a href="{{ URL::to('/') }}/admin/recaudaciones/lista?ord=-registro">
                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                    </a>
                                                             Registro
                            </th>
                                 <th>
                                                                <a href="{{ URL::to('/') }}/admin/recaudaciones/lista?ord=nulos">
                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                    </a>
                                                                    <a href="{{ URL::to('/') }}/admin/recaudaciones/lista?ord=-nulos">
                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                    </a>
                                                             Nulos
                            </th>
                             <th>
                                            Total Gastos
                            </th>
                            <th>
                                            Total
                            </th>
                             <th>
                                                                <a href="{{ URL::to('/') }}/admin/recaudaciones/lista?ord=efectivo_real">
                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                    </a>
                                                                    <a href="{{ URL::to('/') }}/admin/recaudaciones/lista?ord=-efectivo_real">
                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                    </a>
                                                             Efectivo Real
                            </th>
                                 <th>
                                                                <a href="{{ URL::to('/') }}/admin/recaudaciones/lista?ord=redcompra">
                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                    </a>
                                                                    <a href="{{ URL::to('/') }}/admin/recaudaciones/lista?ord=-redcompra">
                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                    </a>
                                                             Redcompra
                            </th>
                            <th>
                                            Total Final
                            </th>
                            <th>
                                            Diferencia Final
                            </th>
                                 <th>
                                                                <a href="{{ URL::to('/') }}/admin/recaudaciones/lista?ord=fecha">
                                        <span class="glyphicon glyphicon-arrow-up"></span>
                                    </a>
                                                                    <a href="{{ URL::to('/') }}/admin/recaudaciones/lista?ord=-fecha">
                                        <span class="glyphicon glyphicon-arrow-down"></span>
                                    </a>
                                                             Fecha
                            </th>
                            <th>
                                            Sucursal
                            </th>
                            <th>
                                            Gastos
                            </th>
                            @if(Entrust::hasRole('administracion'))
                                 <th>
                                            Editar/Borrar
                                </th>
                            @endif
                         </tr>
                    </thead>
                    <tbody>
                        @foreach ($grid->data as $item)
                            <tr>
                                <td>{{ $item->id }}</td>
                                <td>{{ $item->registro }}</td>
                                <td>{{ $item->nulos }}</td>
                                <td>{{ $item->gastos()->sum('monto') }}</td>
                                <td>{{ ($item->registro - $item->nulos - $item->gastos()->sum('monto')) }}</td>
                                <td>{{ $item->efectivo_real }}</td>
                                <td>{{ $item->redcompra }}</td>
                                <td>{{ ($item->efectivo_real + $item->redcompra) }}</td>
                                <td>{{ ($item->efectivo_real + $item->redcompra) - ($item->registro - $item->nulos - $item->gastos()->sum('monto')) }}</td>
                                <td>{{ date("d/m/Y", strtotime($item->fecha)) }}</td>
                                <td>{{ $item->sucursal['nombre'] }}</td>
                                <td><a href="{{ URL::to('/') }}/admin/gastos/lista/{{ $item->id }}">Ver</a></td>
                                @if(Entrust::hasRole('administracion'))
                                    <td>
                                        <a class="" title="Modify" href="{{ URL::to('/') }}/admin/recaudaciones/edit?modify={{ $item->id }}"><span class="glyphicon glyphicon-edit"> </span></a>
                                        <a class="text-danger" title="Delete" href="{{ URL::to('/') }}/admin/recaudaciones/edit?delete={{ $item->id }}"><span class="glyphicon glyphicon-trash"> </span></a>
                                    </td>
                                @endif
                            </tr>
                          @endforeach
                    </tbody>
                </table>
                {{ $grid->links() }}
            </div>
        </div>
    </div>
</div>
@stop