@extends('adminlte::page')

@section('title', 'PRODUCTOS')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-object-group"></i>&nbsp; PRODUCTOS</h1>
@stop

@section('content')
    <div class="container-flex m-1 bg-gray-300 shadow-lg rounded-lg">
        <div class="row p-3 m-2 rounded-lg shadow-xl bg-white">
            <div class="col-sm-12 text-right">
                @can('CREAR PRODUCTOS')
                <a href="{{ route('products.create')}}" class="btn btn-green">
                    <i class="fas fa-plus-circle"></i>&nbsp; Nueva
                </a>
                @endcan
            </div>
            <div class="w-100">&nbsp;</div>
            <div class="col-sm-12 table-responsive">
                <table class="table mytable table-striped text-xs font-medium" id="example">

                    <thead >
                        <tr class="text-center" >
                            <th>ID</th>
                            <th>Producto</th>
                            <th>Precio</th>
                            <th>Paq templado</th>
                            <th>Precio al corte </th>
                            
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Productos as $row)
                        <tr class="text-center">
                            <td>{{$row->id}}</td>
                            <td>{{$row->description}} {{$row->grosor}}MM {{$row->ancho}}x{{$row->alto}} </td>
                            <td>${{number_format($row->price,2)}}</td>
                            <td>${{number_format($row->templado,2)}}</td>
                            <td>${{number_format($row->cut_price,2)}}</td>
                            <td class="w-15">
                                <div class="row">
                                    <div class="col-6 text-center">
                                        @can('EDITAR PRODUCTOS')
                                        <a href="{{ route('products.edit', $row->id)}}">
                                        <button class="btn btn-blue">
                                                <i class="fas fa-xl fa-edit   "></i>
                                                </button>
                                        </a>
                                        @endcan
                                    </div>
                                    <div class="col-6 text-center">
                                        @can('BORRAR PRODUCTOS')
                                        <form class="DeleteReg" action="{{ route('products.destroy', $row->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-red ">
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
    .mytable{

        th{
    background-color:#1a521d !important;
    }
    }
</style>
@stop


@section('js')
<script>
    
$(document).ready(function () {
    $('#example').DataTable();
});
</script>
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