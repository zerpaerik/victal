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
	<title>Resultado de LABORATORIO</title>

</head>
<body>

     <img src="/var/www/html/victal/public/image.png"  style="width: 20%;"/>
    <div>
	<div class="text-center title-header col-12">
		<center>Informe <strong># LAB00{{ $res_i->id}}</strong> </center>
	</div>
</div>



  <p><strong>Paciente:</strong> {{ $res_i->apellidos.' '.$res_i->nombres}}</p>
  <p><strong>Dni:</strong> {{ $res_i->dni}}</p>
  <p><strong>Analisis de Laboratorio: </strong> {{ $res_i->detalle}}</p>
  <p><strong>Fecha: </strong> {{ date('d-m-Y', strtotime($res_i->created_at))}}</p>

  <br><br>




<table style="margin-top: -30px;border: none;border-collapse:collapse;">
  <thead>
  
    <tr><th style="width:25%;" scope="col">Nombre</th>
    <th style="width:20%;" scope="col">Resultado</th>
	<th style="width:20%;" scope="col">UM</th>
    <th style="width:35%;text-overflow:ellipsis;" scope="col">Rango de Referencia</th>
  
  
 
  </thead>
  <tbody>
    @foreach($res as $r)
    <tr><td style="padding: 0;">{{$r->nom_val}}</td>
    <td style="padding: 0;">{{$r->valor}}</td>
	<td style="padding: 0;">{{$r->medida}}</td>
    <td style="padding: 0;">{{$r->referencia}}</td>
    @endforeach
 </tbody>






</table>


</body>
</html>
