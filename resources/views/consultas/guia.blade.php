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
		<center><strong>ORDEN DE EXAMENES</strong> </center>


	</div>
</div>
<div>
	<div class="col-6" >
		Fecha de Impresión: {{ Carbon\Carbon::now()->format('d/m/Y') }}
	</div>
	<div class="col-6 text-right">
		Hora de Impresión: {{ Carbon\Carbon::now('America/Lima')->format('h:i a') }}
	</div> 
</div>

<div style="font-weight: bold; font-size: 14px">
		FECHA CONSULTA:  {{ $consulta->created_at }} 
</div>
<div style="font-weight: bold; font-size: 14px">
		PACIENTE:  {{ $consulta->apellidos }} {{ $consulta->nombres }}
</div>

<div style="font-weight: bold; font-size: 14px">
		DOCTOR:  {{ $consulta->laste }} {{ $consulta->namee }}
</div>
<br>
<br>






<div style="font-weight: bold; font-size: 14px">
		SERVICIOS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Detalle</th>
		</tr>
		@foreach ($hist_s as $s)
			<tr>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $s->servicio }}</td>
			</tr>
		@endforeach
	
	</table>
</div>

<div style="font-weight: bold; font-size: 14px">
		LABORATORIOS
</div>
<div style="margin-top:10px; background: #eaeaea;">
	<table style="">
		<tr>
			<th style="padding: 0;width: 5%;text-overflow: ellipsis;">Detalle</th>
		</tr>
		@foreach ($hist_l as $l)
			<tr>
				<td style="padding: 0;width: 5%;text-overflow: ellipsis;">{{ $l->laboratorio }}</td>
			</tr>
		@endforeach
	
	</table>
</div>

