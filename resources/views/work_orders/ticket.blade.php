<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Código de Barras - Orden de trabajo{{ $barcodeText }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .barcode-container { text-align: center; margin-top: 50px; }
        .barcode-text { margin-top: 10px; font-size: 16px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="barcode-container">
    <table>
        <tr>
            <td> <img src="{{asset('img/logo/logo.svg')}}" alt="SELVA GLASS"  style="align-self: left; width: 70%"></td>
            <td>SELVA GLASS</td>
            <td> Orden de trabajo {{str_pad( $WorkOrder->id, 4, "0", STR_PAD_LEFT )}}</td>
        </tr>
    </table>
    
    
    <div class="barcode-text">
             {{ $barcodeText }}
            <br>
            Fecha: {{ now()->format('Y-m-d') }}

            @if($Items->where('type', 'PRODUCTO')->count() > 0)
                <br>
                {{$Items->where('type', 'PRODUCTO')->first()->largo}} x  {{$Items->where('type', 'PRODUCTO')->first()->ancho}}
            @endif
            @if($Items->where('type', 'PROCESO')->count() > 0)
                <br>
                {{$Items->where('type', 'PROCESO')->first()->description}} 
            @endif

        </div>
        <!-- Código de barras -->
        {!! $barcodeHTML !!}
       
    </div>
</body>
</html>