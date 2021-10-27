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
	<title>Recibo de Comisión</title>

</head>
<body>

    <img src="/var/www/html/sistemaVICTAL/public/image.png"  style="width: 20%; color: black;"/>


	<p style="margin-left: 550px;margin-top: -100px;"><strong>SEDE:</strong>{{ Session::get('sedeName') }}</p>


  <p><strong>DOCTOR:</strong>{{ $ticketu->lasto.' '.$ticketu->nameo}}</p>
  <p><strong>CONSULTORIO:</strong>VICTAL</p>
  <p><strong>RECIBO: </strong>REC-2021-{{ $ticketu->recibo}}</p>





<table style="margin-top: -30px;border: none;border-collapse:collapse;">
  <thead>
  
    <tr><th style="width:35%;" scope="col">PACIENTE</th>
    <th style="width:15%;" scope="col">FECHA</th>
    <th style="width:35%;text-overflow:ellipsis;" scope="col">DETALLE</th>
    <th scope="col">MONTO</th>
    <th scope="col">PORC</th>
    <th scope="col">COMISION</th></tr>
  
 
  </thead>
  <tbody>
    @foreach($ticket as $recibo)
    <tr><td style="padding: 0;text-align: left;">{{substr($recibo->apellidos.' '.$recibo->nombres,0,24)}}</td>
    <td style="padding: 0;">{{date('d-m-Y', strtotime($recibo->created_at))}}</td>
    <td style="padding: 0;text-align: left;width: 5%;text-overflow: ellipsis;">{{$recibo->detalle}}</td>
    <td style="padding: 0;">{{$recibo->total}}</td>
    <td style="padding: 0;">{{$recibo->porcentaje}}</td>
    <td style="padding: 0;">{{$recibo->monto}}</td></tr>
    @endforeach
 </tbody>


 @foreach($total as $tot)
 <p style="margin-left: 570px;"><strong>TOTAL:</strong>{{ $tot->totalrecibo}}</p>
  @endforeach

<p style="text-align: left"><strong>FECHA EMISIÒN: {{$ticketu->fecha_pago}}</strong></p>



</table>


</body>
</html>
