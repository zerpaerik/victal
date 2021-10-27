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

<div>
	<div class="text-center title-header col-12">
		<center><strong>REPORTE DETALLADO DE {{ $sede }}</strong> </center>
		<center><strong>DESDE: </strong>- {{ $f1 }} <strong>DESDE: </strong>{{ $f2 }}</center>

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

<br>

<div style="font-weight: bold; font-size: 14px">
		DETALLE
</div>

<div style="background: #eaeaea;">
	<table>
		<tr>
		   <th style="padding: 0;width: 10%;text-overflow: ellipsis;">FECHA</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">VENTA TOTAL</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">P.EFE</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">P.TARJ</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">P.DEPOS</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">P.YAPE</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">EGRESOS</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">TOTAL</th>





		</tr>
		@foreach($efectivo as $ingreso)
		<tr>
		    <td style="padding: 0;width: 10%;text-overflow: ellipsis;">{{ $ingreso->fecha }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $ingreso->monto }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $ingreso->efectivo }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $ingreso->tarjeta }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $ingreso->deposito }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $ingreso->yape }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $ingreso->egre }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $ingreso->efectivo - $ingreso->egre }}</td>

		</tr>
		@endforeach
	</table>

	<table>
		<tr>
		   <th style="padding: 0;width: 10%;text-overflow: ellipsis;">----</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">----</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">----</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">----</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">----</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">----</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">----</th>
			<th style="padding: 0;width: 10%;text-overflow: ellipsis;">----</th>





		</tr>
		<tr>
		    <td style="padding: 0;width: 10%;text-overflow: ellipsis;">TOTALES</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $totales->monto }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $totales->efectivo }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $totales->tarjeta }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $totales->deposito }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $totales->yape }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $totales->egre }}</td>
			<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $totales->efectivo - $totales->egre }}</td>

		</tr>
	</table>


</div>
<br>






