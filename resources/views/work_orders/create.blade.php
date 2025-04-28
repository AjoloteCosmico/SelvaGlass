@extends('adminlte::page')

@section('title', 'ORDEN DE TRABAJO')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-users-cog"></i>&nbsp; Orden de Trabajo</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp; Crear Nueva Orden de Trabajo::
            </h5>
        </div >
        <form action="{{ route('work_orders.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="row p-4">
                <div class="col-sm-6 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h5 text-center fw">Datos Generales</h1>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                               <x-jet-label value="* Cliente" />
                                <select class="form-capture  w-full text-xs uppercase"  name='cliente'> 
                                    @foreach($Customers as $row)
                                    <option value='{{$row->id}}' @if(old('cliente"')==$row->id) selected @endif>{{$row->customer}} </option>
                                    @endforeach
                                 </select>
                              <x-jet-input-error for='cliente' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value=" Descripcion del Producto" />
                                <x-jet-input type="text" name="descripcion" class="w-full text-xs " />
                                <x-jet-input-error for='descripcion' />
                            </div>
                           
                            
                            <div class="form-group">
                                <x-jet-label value="* Medida de largo" />
                                <x-jet-input type="number" name="large" class="w-full text-xs " value="{{old('large')}}"/>
                                <x-jet-input-error for='large' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Medida de ancho" />
                                <x-jet-input type="number" name="deep" class="w-full text-xs " value="{{old('deep')}}"/>
                                <x-jet-input-error for='deep' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Saldo disponible" />
                                <x-jet-input type="number" name="available_balance" class="w-full text-xs " value="{{old('available_balance')}}"/>
                                <x-jet-input-error for='available_balance' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Status" />
                                <select class="form-capture  w-full text-xs uppercase"  name="status">
                 
                                    <option value="ACTIVO" @if(old('status')=='ACTIVO') selected @endif>INACTIVO</option>
                                    <option value="INACTIVO" @if(old('status')=='INACTIVO') selected @endif>ACTIVO</option>
                                    
                                </select>
                                <x-jet-input-error for='status' />
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