<!DOCTYPE html>
<html lang="en">
<style>
	.row{
		width: 1024px;
		margin: 0 auto;
	}

	.col-12{
		width: 100%;
	}
	
	.col-6{
		width: 49%;
		float: left;
		padding: 8px 5px;
		font-size: 18px;
	}

	.text-center{
		text-align: center;
	}
	
	.text-right{
		text-align: right;
	}

	.title-header{
		font-size: 22px; 
		text-transform: uppercase; 
		padding: 12px 0;
	}
	table{
		width: 100%;
		text-align: center;
		margin: 10px 0;
	}
	
	tr th{
		font-size: 14px;
		text-transform: uppercase;
		padding: 8px 5px;
	}

	tr td{
		font-size: 14px;
		padding: 8px 5px;
	}

	
</style>
<head>
	<title>Recibo de Cobro de Factura</title>

</head>
<body>

    <img src="victal.PNG"  style="width: 20%;"/>




  <p><strong>EMPRESA:</strong>{{ $ticketu->lasto.' '.$ticketu->nameo}}</p>
  <p><strong>RECIBO: </strong>REC-2022-{{ $ticketu->recibo}}</p>
  <p><strong>TIPO DE PAGO: </strong>{{ $ticketu->tipop}}</p>






<table style="margin-top: -30px;border: none;border-collapse:collapse;">
  <thead>
  
    <tr><th style="width:35%;" scope="col">PACIENTE</th>
    <th style="width:15%;" scope="col">FECHA</th>
    <th style="width:35%;text-overflow:ellipsis;" scope="col">DETALLE</th>
    <th scope="col">MONTO</th>
  
  
 
  </thead>
  <tbody>
    @foreach($ticket as $recibo)
    <tr><td style="padding: 0;text-align: left;">{{substr($recibo->apellidos.' '.$recibo->nombres,0,24)}}</td>
    <td style="padding: 0;">{{date('d-m-Y', strtotime($recibo->created_at))}}</td>
    <td style="padding: 0;text-align: left;width: 5%;text-overflow: ellipsis;">{{$recibo->detalle}}</td>
    <td style="padding: 0;">{{$recibo->total}}</td>
    @endforeach
 </tbody>


 @foreach($total as $tot)
 <p style="margin-left: 570px;"><strong>TOTAL:</strong>{{ $tot->totalrecibo}}</p>
  @endforeach

<p style="text-align: left"><strong>FECHA EMISIÒN: {{$ticketu->fecha_pago}}</strong></p>



</table>


</body>
</html>
