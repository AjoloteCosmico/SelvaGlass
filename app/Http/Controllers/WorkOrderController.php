<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seller;
use App\Models\Customer;

use App\Models\Item;
use App\Models\WorkOrder;
use DB;

class WorkOrderController extends Controller
{
    public function index(){
        $Orders=DB::table('work_orders')
        ->select('work_orders.*','customers.customer')
        ->join('customers','customers.id','work_orders.customer_id')
        ->get();
        return view('work_orders.index',compact('Orders'));
    }
    public function create(){
        $Customers=Customer::all();
        return view('work_orders.create',compact('Customers'));

    }
    public function store(Request $request){
        
        //faltan validaciones
        $WorkOrder=new WorkOrder();
        $WorkOrder->customer_id=$request->cliente;
        $WorkOrder->date=now()->format('Y-m-d');
        $WorkOrder->seller_id=1;
        $WorkOrder->process=$request->product_type;
        $WorkOrder->save();
        return redirect()->route('work_orders.partidas',$WorkOrder->id);

        
    }

    public function partidas($id){

        $WorkOrder=WorkOrder::find($id);
        $Items=Item::where('order_id',$id);

        return view('work_orders.partidas',compact('WorkOrder','Items'));
    }
}
