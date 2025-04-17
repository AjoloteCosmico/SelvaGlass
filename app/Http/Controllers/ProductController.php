<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    
    public function index(){
        $Productos=Product::all();
        return view('products.index',compact('Productos'));
    }
    public function create(){
        return view('products.create');
    }
    public function store(Request $request){
        
        $rules = [
            'description' => 'required',
            'grosor' => 'required',
            'alto' => 'required',
            'ancho' => 'required',
            'price' => 'required',
            'cut_price' => 'required',
        ];
    
        $messages = [
            'description.required' => 'La descripcion del producto es requerida',
            'grosor.required' => 'El grosor es requerida',
            'alto.required' => 'El alto es requerida',
            'ancho.required' => 'El ancho requerido',
            'price.required' => 'El precio es requerida',
            'cut_price.required' => 'El precio al corte es requerido',
        ];

        $request->validate($rules, $messages);
        
        
            $Product = new Product();
            $Product->description = $request->description;
            $Product->grosor = $request->grosor;
            $Product->ancho = $request->alto;
            $Product->alto = $request->ancho;
            $Product->price = $request->price;
            $Product->cut_price = $request->cut_price;
            $Product->save();
        
        return redirect()->route('products.index')->with('create_reg','ok');
    }
    public function edit(){
        $Productos=Product::all();
        return view('products.index',compact('Productos'));
    }
    public function update(Request $request){
        $Productos=Product::all();
        return view('products.index',compact('Productos'));
    }
    public function destroy(Request $request){
        $Productos=Product::all();
        return view('products.index',compact('Productos'));
    }

}
