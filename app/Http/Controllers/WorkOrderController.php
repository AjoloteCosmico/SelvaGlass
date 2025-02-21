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
        ->select('work_orders.*','sellers.name','customers.customer')
        ->join('customers','customers.id','work_orders.customer_id')
        ->join('sellers','sellers.id','work_orders.seller_id')
        ->get();
        
        return view('work_orders.index',compact('Orders'));
    }
    public function create(){
        $Customers=Customer::all();
        $Sellers=Sellers::all();
        return view('work_orders.create',compact('Sellers','Customers'));

    }
    public function store(Request $request){


        return redirect()->route('work_orders.index');
    }
}
