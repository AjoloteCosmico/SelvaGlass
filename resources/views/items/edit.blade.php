@extends('adminlte::page')

@section('title', 'PARTIDA')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-money-bill-1"></i>&nbsp; PARTIDA</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp; Agregar Partida:
            </h5>
        </div>
        <form action="{{ route('items.redefine',$Item->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="row p-4">
                <div class="col-sm-12 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-body">
                        <div class="form-group">
                               <x-jet-label value="* Tipo de producto" />
                                <select class="form-capture  w-full text-xs uppercase" id="type" name='type' onchange="cambio_tipo()"> 
                                       <option value=""></option>
                                       <option value='PRODUCTO' @if($Item->type=="PRODUCTO") selected @endif> PRODUCTO</option>
                                       <option value='PROCESO' @if($Item->type=="PROCESO") selected @endif> PROCESO</option>
                                       <option value='PAQUETE' @if($Item->type=="PAQUETE") selected @endif> PAQUETE</option>
                                </select>
                              <x-jet-input-error for='type' />
                            </div>
                            <div class="form-group">
                               <x-jet-label value=" HOJA" />
                                <select class="form-capture  w-full text-xs uppercase"  name='product_id' id='product_id'> 
                                <option value=""></option>   
                                @foreach($Products as $row)
                                       <option value='{{$row->id}}' @if($Item->product_id==$row->id) selected @endif> {{$row->description}} {{$row->grosor}}MM {{$row->ancho}}x{{$row->alto}}</option>
                                    @endforeach
                                </select>
                              <x-jet-input-error for='product_id' />
                            </div>
                            <div class="form-group">
                               <x-jet-label value=" Proceso" />
                                <select class="form-capture  w-full text-xs uppercase"  name='process' id='process'> 
                                   
                                       <option value='LAMINADO' @if($Item->process=='LAMINADO') selected @endif> LAMINADO</option>
                                       <option value='BISEL' @if($Item->process=='BISEL') selected @endif> BISEL</option>
                                       <option value='SERIGRAFIA' @if($Item->process=='SERIGRAFIA') selected @endif> SERIGRAFIA</option>
                                    
                                </select>
                              <x-jet-input-error for='process' />
                            </div>
                            <div class="form-group">      
                                <x-jet-label value="* Tipo de Cristal" />
                                    <select class="form-capture  w-full text-xs uppercase"  name='crystal_type'> 
                                        <option value='TEMPLADO' @if(old('crystal_type')=='TEMPLADO') selected @endif> TEMPLADO</option>
                                        <option value='SIN TEMPLAR' @if(old('crystal_type')=='SIN TEMPLAR') selected @endif> SIN TEMPLAR</option>
                                    </select>
                                    <x-jet-input-error for='crystal_type' />
                                </div>
                            <div class="form-group">
                                <x-jet-label value="* Cantidad" />
                                <x-jet-input type="number"  step="1" name="amount" class="w-full text-xs " value="{{$Item->amount}}"/>
                                <x-jet-input-error for='amount' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Costo" />
                                <x-jet-input type="number"  step="0.01" name="price" id="price" class="w-full text-xs " value="{{$Item->price}}"/>
                                <x-jet-input-error for='price' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Medida de largo" />
                                <x-jet-input type="number" name="largo" id="largo" class="w-full text-xs " value="{{$Item->largo}}"/>
                                <x-jet-input-error for='largo' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Medida de ancho" />
                                <x-jet-input type="number" name="ancho" id="ancho" class="w-full text-xs " value="{{$Item->ancho}}"/>
                                <x-jet-input-error for='ancho' />
                            </div>
                            <div class="form-group">
                            <x-jet-label value="* Dibujos (ingrese maximo 10)" />
                            <input type="file" id="files" name="files" multiple>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right p-2 gap-2">
                <a href="{{ route('work_orders.partidas',$Item->work_order_id)}}" class="btn btn-black mb-2">
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
<script>

function cambio_tipo(){
    val=document.getElementById("type").value;
    console.log(val);
    if(val=='PROCESO'){
        document.getElementById("product_id").disabled=true;
        document.getElementById("product_id").style.backgroundColor='gray';
        document.getElementById("product_id").value='';
        
        document.getElementById("process").disabled=false;
        document.getElementById("process").style.backgroundColor='white';
        
        document.getElementById("price").disabled=false;
        document.getElementById("price").style.backgroundColor='white';
        document.getElementById("ancho").disabled=true;
        document.getElementById("ancho").style.backgroundColor='gray';
        document.getElementById("ancho").value='';
        document.getElementById("largo").disabled=true;
        document.getElementById("largo").style.backgroundColor='gray';
        document.getElementById("largo").value='';
    }
    if(val=='PRODUCTO'){
        document.getElementById("process").disabled=true;
        document.getElementById("process").style.backgroundColor='gray';
        document.getElementById("process").value='';
        document.getElementById("price").disabled=true;
        document.getElementById("price").style.backgroundColor='gray';
        document.getElementById("price").value='';
        document.getElementById("product_id").disabled=false;
        document.getElementById("product_id").style.backgroundColor='white';

        document.getElementById("ancho").disabled=false;
        document.getElementById("ancho").style.backgroundColor='white';
        document.getElementById("largo").disabled=false;
        document.getElementById("largo").style.backgroundColor='white';
    }
    if(val=='PAQUETE'){
        document.getElementById("process").disabled=false;
        document.getElementById("process").style.backgroundColor='white';
        document.getElementById("product_id").disabled=false;
        document.getElementById("product_id").style.backgroundColor='white';
        
        document.getElementById("price").disabled=false;
        document.getElementById("price").style.backgroundColor='white';

        document.getElementById("ancho").disabled=true;
        document.getElementById("ancho").style.backgroundColor='gray';
        document.getElementById("ancho").value='';
        document.getElementById("largo").disabled=true;
        document.getElementById("largo").style.backgroundColor='gray';
        document.getElementById("largo").value='';
    }
}

cambio_tipo();
</script>
@stop