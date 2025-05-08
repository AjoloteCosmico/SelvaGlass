@extends('adminlte::page')

@section('title', 'ORDEN DE TRABAJO')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-users-cog"></i>&nbsp; Orden de Trabajo</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp; Agregar Partidas de Orden de Trabajo::
            </h5>
        </div >
        <form action="{{ route('work_orders.store_partidas')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="row p-4">
                <div class=" col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h5 text-center fw">Partidas</h1>
                        </div>
                        <div class="card-body">
                        <div class="col-sm-12 text-right">
                @can('CREAR ORDEN')
                <a href="{{ route('items.creation',$WorkOrder->id)}}" class="btn btn-green">
                    <i class="fas fa-plus-circle"></i>&nbsp; Nueva
                </a>
                @endcan
            </div>
            <div class="w-75">&nbsp;</div>
            <div class="col-sm-12 table-responsive">
                
            <table id="example"  class="table table-striped text-xs font-medium" >
                    <thead>
                        <tr>
                            <th>Pos</th>
                            <th>Descripcion</th>
                            <th>Cantidad</th>
                            <th>Ancho</th>
                            <th>Largo</th>
                            <th>Precio Unitario</th>
                            <th>Precio total</th>
                            <th>dibujo</th>
                            <th style="width : 10%;">&nbsp;&nbsp; </th>
                        </tr>
                    </thead>
                     <tbody>
                        @foreach ($Items as $row)
                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{$row->description}} </td>
                            <td>{{$row->amount}} </td>
                            
                            <td>{{$row->ancho}}  </td>
                            <td>{{$row->largo}} </td>
                            <td>${{number_format($row->total_price/$row->amount,2)}} </td>
                            
                            <td>${{number_format($row->total_price,2)}} </td>
                            <td>NA</td>
                            <td class="w-15">
                                <div class="row">
                                    <div class="col-6 text-center w-10">
                                        @can('EDITAR ORDEN')
                                        <a href="{{ route('items.edit', $row->id)}}">
                                        <button type="submit" class="btn btn-blue ">
                                                <i class="fas fa-edit items-center fa-xl"></i>
                                            </button>
                                        </a>
                                        @endcan
                                    </div>
                                    &nbsp;&nbsp;
                                    <div class="col-6 text-center w-10">
                                        @can('BORRAR ORDEN')
                                        <form class="DeleteReg" action="{{ route('items.destroy', $row->id) }}" method="POST">
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
            <h1><b>TOTAL: ${{number_format($Items->sum('total_price'),2)}}
            </b> </h1>
        </div>
                    </div>
                </div>
               </div>
            <div class="col-12 text-right p-2 gap-2">
                <a href="{{ route('customers.index')}}" class="btn btn-black mb-2">
                    <i class="fas fa-times fa-2x"></i>&nbsp;&nbsp; Cancelar
                </a>
                <button type="submit" class="btn btn-green mb-2">
                    <i class="fas fa-save fa-2x"></i>&nbsp; &nbsp; Guardar
                </button>
            </div>
        </div>
        </form>
    </div>
@stop

@section('css')
    
@stop

@section('js')
<!-- <script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/rfc_disponible.js') }}"></script> -->

<script>
    $(document).ready(function () {     
$('#legal_name').change(function(){
var seleccionado = $(this).val();
if(seleccionado=='otra'){
document.getElementById('otra').style.display="block";
}
else{
    document.getElementById('otra').style.display="none"; 
}

})
});
</script>
@stop