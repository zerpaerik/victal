<html>
    <head>
        <style>
            /** 
                Establezca los márgenes de la página en 0, por lo que el pie de página y el encabezado
                puede ser de altura y anchura completas.
             **/
            @page {
                margin: 0cm 0cm;
            }

            /** Defina ahora los márgenes reales de cada página en el PDF **/
            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 2cm;
            }

            /** Definir las reglas del encabezado **/
            header {
                position: fixed;
                top: 0cm;
                left: 0cm;
                right: 0cm;
                height: 3cm;
            }

            /** Definir las reglas del pie de página **/
            footer {
                position: fixed; 
                bottom: 0cm; 
                left: 0cm; 
                right: 0cm;
                height: 2cm;
            }

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

	/** 
            * Defina el ancho, alto, márgenes y posición de la marca de agua.
            **/
            #watermark {
                position: fixed;
                bottom:   0px;
                left:     0px;
                /** El ancho y la altura pueden cambiar
                    según las dimensiones de su membrete
                **/
                width:    21.8cm;
                height:   28cm;

                /** Tu marca de agua debe estar detrás de cada contenido **/
                z-index:  -1000;
            }



        </style>
    </head>
    <body>
        <!-- Defina bloques de encabezado y pie de página antes de su contenido -->
        <header>
            <img src="header.PNG" width="100%" height="100%"/>
        </header>

        <footer>
            <img src="footer.PNG" width="100%" height="100%"/>
        </footer>

		<div id="watermark">
            <img src="water.PNG" height="100%" width="100%" />
        </div>

        <!-- Envuelva el contenido de su PDF dentro de una etiqueta principal -->
        <main>
		<div>

  <p><strong>Paciente:</strong> {{ $res_i->apellidos.' '.$res_i->nombres}}</p>
  <p><strong>Dni:</strong> {{ $res_i->dni}}</p>
  <p><strong>Analisis de Laboratorio: </strong> {{ $res_i->detalle}}</p>
  <p><strong>Fecha: </strong> {{ date('d-m-Y', strtotime($res_i->created_at))}}</p>
  </div>


  <br><br>




<table style="margin-top: -30px;border: none;border-collapse:collapse;">
  <thead>
  
    <tr><th style="width:25%;" scope="col">Nombre</th>
    <th style="width:15%;" scope="col">Resultado</th>
	<th style="width:15%;" scope="col">UM</th>
    <th style="width:35%;text-overflow:ellipsis;" scope="col">Rango de Referencia</th>
	<th style="width:15%;" scope="col">Método</th>

  
  
 
  </thead>
  <tbody>
    @foreach($res as $r)
    <tr>
	<td style="padding: 0;">{{$r->nom_val}}</td>
    <td style="padding: 0;">{{$r->valor}}</td>
	<td style="padding: 0;">{{$r->medida}}</td>
    <td style="padding: 0;">{{$r->referencia}}</td>
	<td style="padding: 0;">{{$r->metodo}}</td>
    @endforeach
 </tbody>






</table>
        </main>
    </body>
</html>