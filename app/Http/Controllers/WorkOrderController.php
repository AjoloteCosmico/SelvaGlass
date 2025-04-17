<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seller;
use App\Models\Customer;
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
    public function partidas(Request $request){
        
        //faltan validaciones
        $Order=new WorkOrder();
        $Order->customer_id=$request->cliente;
        $Order->date=now()->format('Y-m-d');
        $Order->seller_id=1;
        $Order->process=$request->product_type;
        $Order->save();
        return view('work_orders.partidas');
        
    }

    public function store(Request $request){

        
        return redirect()->route('work_orders.index');
    }
}
