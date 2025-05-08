<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Seller;
use App\Models\Customer;

use App\Models\Item;
use App\Models\WorkOrder;
use DB;
use PDF;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;
use Milon\Barcode\Facades\DNS2DFacade as DNS2D;
use Illuminate\Support\Facades\Hash;
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
        $Items=Item::where('work_order_id',$id)->get();

        return view('work_orders.partidas',compact('WorkOrder','Items'));
    }

    public function store_partidas(Request $request){
        //si hay otros campos guardar
        return redirect()->route('work_orders.index');
    }
    
    public function show($id){
        $WorkOrder=WorkOrder::find($id);
        $Items=Item::where('work_order_id',$id)->get();
        $Ticket=substr(Hash::make($WorkOrder->id.$WorkOrder->type),20,30);
        $Customer=Customer::find($WorkOrder->customer_id);
        return view('work_orders.show',compact('WorkOrder','Items','Customer','Ticket'));
      }
    public function ticket($id){
        $WorkOrder=WorkOrder::find($id);
        $Items=Item::where('work_order_id',$id)->get();
    
        // Combinar ID y tipo para formar el texto del código de barras
        $barcodeText = str_pad( $WorkOrder->id, 4, "0", STR_PAD_LEFT ); // Ejemplo: "PED-ABC123"
        // Generar código de barras CODE 128 (formato común para letras y números)
        $barcodeHTML = DNS1D::getBarcodeHTML($barcodeText, 'C128',4,44);
        // Opcional: Generar como SVG o PNG
        $barcodeSVG = DNS1D::getBarcodeSVG($barcodeText, 'C128');
        $barcodePNG = DNS1D::getBarcodePNG($barcodeText, 'C128');
        // Crear PDF a partir de una vista Blade
        $pdf = Pdf::loadView('work_orders.ticket', [
            'barcodeHTML' => $barcodeHTML,
            'barcodeText' => $barcodeText,
            'WorkOrder' => $WorkOrder,
            'Items' => $Items,
        ]);
        
        // Opciones del PDF (opcional)
        $pdf->setPaper('A4', 'portrait'); // Tamaño y orientación

        // Descargar el PDF directamente
        return $pdf->download('codigo_barras_' . $WorkOrder->id . '.pdf');

        
        
    }
    public function destroy($id){
        
        return redirect()->route('work_orders.index');

    }
}