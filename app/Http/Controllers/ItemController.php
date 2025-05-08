<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RequisitionController;
use App\Models\Item;
use App\Models\Customer;
use App\Models\Family;
use App\Models\Requisition;
use App\Models\Unit;

use App\Models\Product;
use App\Models\WorkOrder;

use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        //
    }

    public function create($id)
    {
          
        $WorkOrder=WorkOrder::find($id);
        $Items = Item::where('work_order_id', $id)->OrderBy('id', 'DESC')->first();

        if($Items){
            $Item = $Items->item + 1;
        }else{
            $Item = 1;
        }

        $Products = Product::all();

        return view('items.create', compact(
            'WorkOrder',
            'Item',
            'Products',
        ));
    }

    public function store(Request $request)
    {
         
        $rules = [
            'amount' => 'required',
        
       
        ];

        $messages = [
            'amount.required' => 'La Cantidad es requerida',
            
        ];

        $request->validate($rules, $messages);
            $WorkOrder=WorkOrder::find($request->work_order_id);
        
        
            $Items = new Item();
            $Items->work_order_id = $request->work_order_id;
            $Items->amount = $request->amount;
            $Items->type = $request->type;
            $Items->product_id = $request->product_id;
            $Items->process = $request->process;
            if($request->type=='PRODUCTO'){
                $product=Product::find($request->product_id);
                $Items->description=$product->description.' '.$product->grosor.'MM '.$product->ancho.'x'.$product->alto;
                $Items->total_price = $product->price * $request->amount;
                $Items->largo=$request->largo;
                $Items->ancho=$request->ancho;
            }
            else{
                $Items->total_price = $request->amount*$request->price;
                $Items->description=$request->process; 
                $Items->product_id =0;
            }
           
            $Items->save();
        
            
        
        
        
            return redirect()->route('work_orders.partidas',$WorkOrder->id);
    }
    public function edit_item($id)
    {

        $Item = Item::find($id);
        $Units = Unit::all();
        $Families = Family::all();
        $InternalOrders = $Item->internal_order_id;
        return view('admin.items.edit_item', compact(
            'InternalOrders',
            'Item',
            'Units',
            'Families',
        ));
    }

    public function redefine(Request $request,$id)
    {
        
        $rules = [
            'amount' => 'required',
            'unit' => 'required',
            'family' => 'required',
            
            
            'sku' => 'required',
            'description' => 'required',
            'unit_price' => 'required',
        ];
    
        $messages = [
            'amount.required' => 'La Cantidad es requerida',
            'unit.required' => 'La unidad es requerida',
            'family.required' => 'La familia es requerida',
            
            
            'sku.required' => 'SKU requerido',
            'description.required' => 'La descripción es requerida',
            'unit_price.required' => 'El precio unitario es requerido',
        ];

        $request->validate($rules, $messages);

        $Import = $request->amount * $request->unit_price;

        
        
            $Items = Item::find($id);
            $Items->item = $request->item;
            $Items->amount = $request->amount;
            $Items->unit = $request->unit;
            $Items->family = $request->family;
            $Items->code = $request->code;
            $Items->description = $request->description;
            $Items->unit_price =(float) $request->unit_price;
            $Items->import = $Import;
            $Items->save();
        
        
        // $InternalOrders = InternalOrder::where('id', $Items->internal_orders_id)->first();
        
        // $Items = Item::where('internal_order_id', $InternalOrders->id)->get();

        // if(count($Items) > 0){
        //     $Subtotal = Item::where('internal_order_id', $InternalOrders->id)->sum('import');
        // }else{
        //     $Subtotal = '0';
        // }

        // $Iva = $Subtotal * 0.16;
        // $Total = $Subtotal + $Iva;

        return redirect('internal_orders/edit/'.$Items->internal_order_id);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }
    
    
    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {   $order_id=Item::find($id)->internal_order_id;
        Item::destroy($id);
        return redirect('internal_orders/edit/'.$order_id);
    
    }
}
