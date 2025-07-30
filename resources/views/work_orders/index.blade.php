@extends('adminlte::page')

@section('title', 'ORDEN DE TRABAJO')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-file"></i>&nbsp; ORDENES DE TRABAJO</h1>
@stop

@section('content')
    <div class="container-flex m-1 bg-gray-300 shadow-lg rounded-lg">
        <div class="row p-3 m-2 rounded-lg shadow-xl bg-white">
            <div class="col-sm-12 text-right">
                @can('CREAR ORDEN DE TRABAJO')
                <a href="{{ route('work_orders.create')}}" class="btn btn-green">
                    <i class="fas fa-plus-circle"></i>&nbsp; Nueva
                </a>
                @endcan
            </div>
            <div class="w-100">&nbsp;</div>
            <div class="col-sm-12 table-responsive">
                
            <table id="example"  class="table table-striped text-xs font-medium" >
                    <thead >
                        <tr >
                            <th>Id</th>
                            <th>Vendedor</th>
                            
                            <th>Cliente</th>
                            <th>Nombre Corto</th>
                            <th>Proceso</th>
                            <th style="width : 10%;">&nbsp;&nbsp; </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Orders as $row)
                        <tr>
                            <td>{{$row->id}}</td>
                            <td>{{$row->customer}}</td>
                            
                            <td>VENDEDOR PRUEBA</td>
                            <td>{{$row->process}}</td>
                            <td> </td>
                            <td class="w-15">
                                
                                <div class="row">
                                <div class="col-6 text-center w-10">
                                        <a href="{{ route('work_orders.show', $row->id)}}">
                                            <i class="fa-solid fa-eye btn btn-blue  "></i></span>
                                        </a>
                                    </div>
                                    <div class="col-6 text-center w-10">
                                        @can('EDITAR ORDEN DE TRABAJO')
                                        <a href="{{ route('work_orders.partidas', $row->id)}}">
                                        <button type="submit" class="btn btn-blue ">
                                                <i class="fas fa-edit items-center fa-xl"></i>
                                            </button>
                                        </a>
                                        @endcan
                                    </div>
                                    &nbsp;&nbsp;
                                    <div class="col-6 text-center w-10">
                                        @can('BORRAR ORDEN DE TRABAJO')
                                        <form class="DeleteReg" action="{{ route('work_orders.destroy', $row->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-red">
                                                <i class="fas fa-trash items-center fa-xl"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop

@section('css')
 <style>
    table th {
    background-color: #1a521d !important;
    color: white !important; /* Para contraste */
  }
 </style>

@stop

@section('js')
<script>

$(document).ready(function () {
    $('#example').DataTable();
});
</script>

<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/tablecatalogocustomers.js') }}"></script>

<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/alert_delete_reg.js') }}"></script>

@if (session('create_reg') == 'ok')
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/confirm_create_reg.js') }}"></script>
@endif

@if (session('eliminar') == 'ok')
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/confirm_delete_reg.js') }}"></script>
@endif

@if (session('error_delete') == 'ok')
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/error_delete_reg.js') }}"></script>
@endif

@if (session('update_reg') == 'ok')
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/update_reg.js') }}"></script>
@endif
@stop
