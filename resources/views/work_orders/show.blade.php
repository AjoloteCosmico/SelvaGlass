@extends('adminlte::page')

@section('title', 'ORDEN DE TRABAJO')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-users-cog"></i>&nbsp; Orden de Trabajo {{str_pad( $WorkOrder->id, 4, "0", STR_PAD_LEFT )}}</h1>
@stop

@section('content')
    <div class="container shadow-lg rounded-lg">
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl ">
            <div class="col">
                <div class="row"> 
                    <div class="col"> 
                        <div class="row">  <img src="{{asset('img/logo/logo.svg')}}" alt="SELVA GLASS"  style="align-self: left; width: 35%"></div>
                        
                        <div class="row"> <h4>Selva Glass</h4></div>
                    </div>
                    <div class="col" style="padding: 18.vw;"><center></center> <h1 class="h1 text-center fw">Orden de Trabajo</h1> <center></div>
                    <div class="col"> 
                        
                        <table>
                            <tr>
                                <th>Pedido</th>
                                <td>{{$WorkOrder->id}}</td>
                            </tr>
                            <tr>
                                <th>Fecha</th>
                                <td>{{$WorkOrder->date}}</td>
                            </tr>
                            <tr>
                                <th>Contacto</th>
                                <td>{{$Customer->customer_email}}</td>
                            </tr>
                            <tr>
                                <th>Ticket</th>
                                <td>{{$Ticket}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row">
                <table>
                            <tr>
                                <th>Cliente</th>
                                <td>{{$Customer->customer}}</td>
                            </tr>
                        </table>
                </div>
                        <div class="card-header">
                            <h1 class="h2 text-center fw">Partidas</h1>
                        </div>
                      
                        <div class="col-sm-12 text-right">
               
            </div>
            <div class="w-75">&nbsp;</div>
            <div class="row table-responsive">
                
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
        <div class="row">
            <div class="col-sm-12 text-right">
                @can('GENERAR CODIGO DE BARRAS')
                <a href="{{ route('work_orders.ticket',$WorkOrder->id)}}" class="btn btn-blue">
                    <i class="fas fa-barcode"></i>&nbsp; TICKET
                </a>
                @endcan
                </div>
            <div class="col-sm-12 text-right">
                @can('IMPRIMIR ORDEN DE TRABAJO')
                <button type = "button" class="btn btn-red " style="background-color: rgb(220 ,38 ,38);color: white;" mb-2"  onclick="window.print();"> <i class="fas fa-file-pdf fa-xl"> &nbsp; PDF </i> </button>
                @endcan
                </div>
        </div>
        </div>
            </div>
  
@stop

@section('css')
    <style>
        table th {
    background-color: #1a521d !important;
    color: white !important; /* Para contraste */
    border: 2px solid white !important;
    border-radius: 5px !important;
    padding: 0.8vw;
    font-weight: bold;
  }
  
  table td{
    border: 2px solid gray !important;
    border-radius: 5px !important;
    padding: 0.8vw;
  }
    </style>
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