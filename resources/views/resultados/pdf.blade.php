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

    <img src="/var/www/html/sistemaVICTAL/public/image.png"  style="width: 20%; color: black;"/>
    <div>
	<div class="text-center title-header col-12">
	   <center><strong>CLINICA VICTAL</strong> </center>
		<center><strong>RESULTADO DE LABORATORIO</strong> </center>


	</div>
</div>



  <p><strong>PACIENTE:</strong>{{ $res_i->apellidos.' '.$res_i->nombres}}</p>
  <p><strong>DNI PACIENTE:</strong>{{ $res_i->dni}}</p>
  <p><strong>EXAMEN: </strong>{{ $res_i->detalle}}</p>
  <p><strong>FECHA: </strong>{{ date('d-m-Y', strtotime($res_i->created_at))}}</p>

  <br><br>




<table style="margin-top: -30px;border: none;border-collapse:collapse;">
  <thead>
  
    <tr><th style="width:35%;" scope="col">NOMBRE</th>
    <th style="width:15%;" scope="col">RESULTADO</th>
    <th style="width:35%;text-overflow:ellipsis;" scope="col">VALOR DE REFERENCIA</th>
  
  
 
  </thead>
  <tbody>
    @foreach($res as $r)
    <tr><td style="padding: 0;text-align: left;">{{$r->nom_val}}</td>
    <td style="padding: 0;text-align: left;width: 5%;text-overflow: ellipsis;">{{$r->valor}}</td>
    <td style="padding: 0;">{{$r->referencia}}</td>
    @endforeach
 </tbody>






</table>


</body>
</html>
