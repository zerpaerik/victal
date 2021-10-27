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
	<title>Cierre de Caja</title>
</head>

<div>
	<div class="text-center title-header col-12">
		<center><strong>REPORTE DE CIERRE DE CAJA</strong> </center>
		<strong>SEDE:</strong> {{ Session::get('sedeName') }}
	</div>
</div>
<div>
	<div class="col-6">
		Fecha de Impresión: {{ Carbon\Carbon::now()->format('d/m/Y') }}
	</div>
	<div class="col-6 text-right">
		Hora de Impresión: {{ Carbon\Carbon::now('America/Lima')->format('h:i a') }}
	</div> 
</div>



<div style="background: #eaeaea;">
	<table>
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">CIERRE</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">FECHA</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">MONTO DE CIERRE</th>
            <th style="padding: 0;width: 5%;text-overflow: ellipsis;">CERRADO POR:</th>
		</tr>
		<tr>
                @if($caja->primer_turno)
                <td style="padding: 0;width: 5%;text-overflow: ellipsis;">Primer Turno: {{$caja->primer_turno}}</td>
                @else
                <td style="padding: 0;width: 5%;text-overflow: ellipsis;">Segundo Turno: {{$caja->segundo_turno}}</td>
                @endif			
                <td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$caja->created_at}}</td>
                @if($caja->primer_turno)
                <td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$caja->primer_turno}}</td>
                @else
                <td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$caja->segundo_turno}}</td>
                @endif	
			    <td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{$caja->name}},{{$caja->lastname}}</td>
		</tr>
	
		
	</table>
</div>

<div style="background: #eaeaea;">
	<table>
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">INGRESOS</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">CANTIDAD</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">MONTO</th>
		</tr>
		
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Servicios</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $servicios->cantidad }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $servicios->monto }}</td>
		</tr>
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Ecografias</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $eco->cantidad }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $eco->monto }}</td>
		</tr>
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">RayosX</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $rayos->cantidad }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $rayos->monto }}</td>
		</tr>
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Laboratorios</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->cantidad }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $lab->monto }}</td>
		</tr>
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Paquetes</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $paq->cantidad }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $paq->monto }}</td>
		</tr>
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Consultas</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $consultas->cantidad }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $consultas->monto }}</td>
		</tr>
	
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Cuentas por Cobrar</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $cuentasXcobrar->cantidad }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $cuentasXcobrar->monto }}</td>
		</tr>
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Métodos Anticonceptivos</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $metodos->cantidad }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $metodos->monto }}</td>
		</tr>

		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Otros Ingresos</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $ingresos->cantidad }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $ingresos->monto }}</td>
		</tr>
		
	</table>
</div>

<div style="font-weight: bold; font-size: 14px">
		EGRESOS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Descripción</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Tipo</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Recibido Por:</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Origen</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Monto</th>
		</tr>
		@foreach ($egresos as $egreso)
			<tr>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $egreso->descripcion }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $egreso->tipo }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $egreso->recibido }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $egreso->origen }}</td>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $egreso->monto }}</td>
			</tr>
		@endforeach
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">Total</td>
			<td></td>
			<td></td>
			<td width="80">{{ $totalEgresos }}</td>
		</tr>
	</table>
</div>
<div style="font-weight: bold; font-size: 14px">
		TIPO DE INGRESO AL CIERRE
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table>
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">efectivo</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">tarjeta</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">deposito</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;"> yape</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;"> total</th>

		</tr>
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $efectivo->monto }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $tarjeta->monto }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $deposito->monto }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $yape->monto }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $efectivo->monto + $tarjeta->monto + $deposito->monto + $yape->monto}}</td>

		</tr>
		
	</table>
</div>
<div style="font-weight: bold; font-size: 14px">
		SALDO AL CIERRE
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table>
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Ingresos</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Egresos</th>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">tOTAL EFECTIVO</th>
		</tr>
		<tr>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $efectivo->monto }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $totalEgresos }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $efectivo->monto - $totalEgresos }}</td>
			
		</tr>
		
	</table>
</div>
