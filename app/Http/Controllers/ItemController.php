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
        
            
        
        
        
            return redirect()->route('work_orders.partidas',$WorkOrder->id)->with('create_reg', 'ok');
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
        
       
        ];

        $messages = [
            'amount.required' => 'La Cantidad es requerida',
            
        ];

            $request->validate($rules, $messages);
            $Items=Item::find($id);
            // dd($Item,$request);
            $WorkOrder=WorkOrder::find($Items->work_order_id);
    
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
        
        
            return redirect()->route('work_orders.partidas',$WorkOrder->id)->with('update_reg', 'ok');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $Item = Item::find($id);
        $Products = Product::all();
        return view('items.edit', compact('Item','Products'));
    }
    
    
    public function update(Request $request, $id)
    {
          $rules = [
            'amount' => 'required',
        
       
        ];

        $messages = [
            'amount.required' => 'La Cantidad es requerida',
            
        ];

            $request->validate($rules, $messages);
            $Item=Item::find($id);
            $WorkOrder=WorkOrder::find($Item->work_order_id);
        
        
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
        
        
            return redirect()->route('work_orders.partidas',$WorkOrder->id)->with('update_reg', 'ok');
    }

    public function destroy(Request $request,$id)
    {   $order_id=Item::find($id)->work_order_id;
        Item::destroy($id);
        return redirect('work_orders/partidas/'.$order_id)->with('eliminar', 'ok');;
    
    }
}
