<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\BillPeriod;


use Illuminate\Http\Request;

class BillsController extends Controller
{
    
    public function index(){
        $Bills=Bill::all();
        return view('bills.index',compact('Bills'));
    }
}
