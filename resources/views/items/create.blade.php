@extends('adminlte::page')

@section('title', 'PARTIDA')

@section('content_header')
    <h1 class="font-bold"><i class="fas fa-money-bill-1"></i>&nbsp; PARTIDA</h1>
@stop

@section('content')
    <div class="container bg-gray-300 shadow-lg rounded-lg">
        <div class="row rounded-b-none rounded-t-lg shadow-xl bg-white">
            <h5 class="card-title p-2">
                <i class="fas fa-plus-circle"></i>&nbsp; Agregar Moneda:
            </h5>
        </div>
        <form action="{{ route('items.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row rounded-b-lg rounded-t-none mb-4 shadow-xl bg-gray-300">
            <div class="row p-4">
                <div class="col-sm-12 col-xs-12 shadow rounded-xl p4">
                    <div class="card">
                        <div class="card-body">
                            
                            <div class="form-group">
                                <x-jet-label value="* Cantidad" />
                                <x-jet-input type="number"  step="1" name="amount" class="w-full text-xs " value="{{old('amount')}}"/>
                                <x-jet-input-error for='amount' />
                            </div>
                            <div class="form-group">
                               <x-jet-label value="* Tipo de producto" />
                                <select class="form-capture  w-full text-xs uppercase"  name='product_type'> 
                                    @foreach($Products as $row)
                                       <option value='{{$row->id}}' @if(old('product_type')==$row->id) selected @endif> {{$row->description}} {{$row->grosor}}MM {{$row->ancho}}x{{$row->alto}}</option>
                                    @endforeach
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