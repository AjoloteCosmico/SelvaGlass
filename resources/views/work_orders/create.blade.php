@extends('adminlte::page')

@section('title', 'CLIENTES')

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
                                <x-jet-label value=" Descripcion del Producto" />
                                <x-jet-input type="text" name="descripcion" class="w-full text-xs " />
                                <x-jet-input-error for='descripcion' />
                            </div>
                           
                            <div class="form-group">
                               <x-jet-label value="* Tipo de producto" />
                                <select class="form-capture  w-full text-xs uppercase"  name='product_type"'> 
                                    <option value='HOJA' @if(old('product_type"')=='HOJA') selected @endif> HOJA</option>
                                    <option value='CORTE' @if(old('product_type"')=='CORTE') selected @endif> CORTE</option>
                                    <option value='MAQUILA' @if(old('product_type"')=='MAQUILA') selected @endif> MAQUILA</option>
                                </select>
                              <x-jet-input-error for='type' />
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
                                <x-jet-label value="* Medida de largp" />
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
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h5 text-center fw">Datos del contacto</h1>
                        </div>
                        <div class="card-body">
                        <div class="form-group">
                                <x-jet-label value="* Nombre del contacto" />
                                <x-jet-input type="text" name="contact_name" class="w-full text-xs " value="{{old('contact_name')}}"/>
                                <x-jet-input-error for='contact_name' />
                        </div>
                        <div class="form-group">
                                <x-jet-label value="* Puesto del contacto" />
                                <x-jet-input type="text" name="contact_charge" class="w-full text-xs " value="{{old('contact_charge')}}"/>
                                <x-jet-input-error for='contact_charge' />
                        </div>
                        <div class="form-group">
                                <x-jet-label value="* Email Personal" />
                                <x-jet-input type="text" name="contact_email" class="w-full text-xs " value="{{old('contact_email')}}"/>
                                <x-jet-input-error for='contact_email' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Email Coorporativo" />
                                <x-jet-input type="text" name="customer_email" class="w-full text-xs " value="{{old('customer_email')}}"/>
                                <x-jet-input-error for='customer_email' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Teléfono Personal" />
                                <x-jet-input type="text" name="contact_telephone" class="w-full text-xs " value="{{old('contact_telephone')}}"/>
                                <x-jet-input-error for='contact_telephone' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Teléfono Empresarial" />
                                <x-jet-input type="text" name="customer_telephone" class="w-full text-xs " value="{{old('customer_telephone')}}"/>
                                <x-jet-input-error for='customer_telephone' />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="h5 text-center fw">Domicilio Fiscal</h1>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <x-jet-label value="* Estado" />
                                <x-jet-input type="text" name="customer_state" class="w-full text-xs " value="{{old('customer_state')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='customer_state' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Ciudad" />
                                <x-jet-input type="text" name="customer_city" class="w-full text-xs " value="{{old('customer_city')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='customer_city' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Colonia" />
                                <x-jet-input type="text" name="customer_suburb" class="w-full text-xs " value="{{old('customer_suburb')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='customer_suburb' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Calle" />
                                <x-jet-input type="text" name="customer_street" class="w-full text-xs " value="{{old('customer_street')}}" onkeyup="javascript:this.value=this.value.toUpperCase();"/>
                                <x-jet-input-error for='customer_street' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Número Exterior" />
                                <x-jet-input type="text" name="customer_outdoor" class="w-full text-xs " value="{{old('customer_outdoor')}}" />
                                <x-jet-input-error for='customer_outdoor' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="Número Interior" />
                                <x-jet-input type="text" name="customer_indoor" class="w-full text-xs " value="{{old('customer_indoor')}}"/>
                                <x-jet-input-error for='customer_indoor' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* C.P." />
                                <x-jet-input type="text" name="customer_zip_code" class="w-full text-xs " value="{{old('customer_zip_code')}}"/>
                                <x-jet-input-error for='customer_zip_code' />
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
<script type="text/javascript" src="{{ asset('vendor/mystylesjs/js/rfc_disponible.js') }}"></script>

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