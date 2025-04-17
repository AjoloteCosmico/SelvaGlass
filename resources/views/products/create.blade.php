@extends('adminlte::page')

@section('title', 'PRODUCTOS')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-object-group"></i>&nbsp; PRODUCTOS</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp; Agregar Producto:
            </h5>
        </div>
        <form action="{{ route('products.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="row p-4">
                <div class="col-sm-12 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <x-jet-label value="* Producto" />
                                <x-jet-input type="text" name="description" class="w-full text-xs " value="{{old('description')}}"/>
                                <x-jet-input-error for='description' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Grosor en MM" />
                                <x-jet-input type="number" step="1" name="grosor" class="w-full text-xs " value="{{old('grosor')}}"/>
                                <x-jet-input-error for='exchange_sell' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Ancho en cm" />
                                <x-jet-input type="number" step="1" name="ancho" class="w-full text-xs " value="{{old('ancho')}}"/>
                                <x-jet-input-error for='ancho' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Alto en cm" />
                                <x-jet-input type="number" step="1" name="alto" class="w-full text-xs " value="{{old('alto')}}"/>
                                <x-jet-input-error for='alto' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Precio" />
                                <x-jet-input type="number" step="0.01" name="price" class="w-full text-xs " value="{{old('price')}}"/>
                                <x-jet-input-error for='price' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Paq templado" />
                                <x-jet-input type="number" step="0.01" name="templado" class="w-full text-xs " value="{{old('exchange_rate')}}"/>
                                <x-jet-input-error for='templado' />
                            </div>
                            <div class="form-group">
                                <x-jet-label value="* Precio al corte" />
                                <x-jet-input type="number" step="0.01" name="cut_price" class="w-full text-xs " value="{{old('cut_price')}}"/>
                                <x-jet-input-error for='cut_price' />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 text-right p-2 gap-2">
                <a href="{{ route('coins.index')}}" class="btn btn-black mb-2">
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

@stop