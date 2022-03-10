<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin: 0cm 0cm;
            }

            body {
                margin-top: 3cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: -10cm;
            }

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

            table{
                width: 100%;
                text-align: center;
                /*margin: 10px 0;*/
            }

            .col-12{
		width: 100%;
	}

    .col-4{
		width: 33.33%;
		float: left;
		padding: 8px 5px;
		font-size: 18px;
	}
    .col-3{
		width: 25%;
		float: left;
		padding: 8px 5px;
		font-size: 18px;
	}
	
	.col-6{
		width: 49%;
		float: left;
		padding: 8px 5px;
		font-size: 18px;
	}

    .col-8{
		width: 75%;
		float: left;
		padding: 8px 5px;
		font-size: 18px;
	}

    .col-12{
		width: 100%;
		font-size: 16px;
	}

	.text-center{
		text-align: center;
	}
	
	.text-right{
		text-align: right;
	}

    .signature{
        background-image: url("https://picsum.photos/200/300?random=1");
    }

	.title-header{
		font-size: 22px; 
		text-transform: uppercase; 
		padding: 12px 0;
	}
	table{
		width: 100%;
		text-align: center;
		/*margin: 10px 0;*/
	}
	
	tr th{
		font-size: 13px;
		/*text-transform: uppercase;*/
		padding: 8px 5px;
	}

	tr td{
		font-size: 14px;
		padding: 8px 5px;
	}
	
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
        <img src="header.PNG" width="100%" height="100%"/>
        </header>

        <footer>
        <img src="footer2.PNG" width="100%" height="100%"/>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
        <strong style="margin-top: -10px;">Paciente:</strong> {{ $res_i->apellidos.' '.$res_i->nombres}} - 
        <strong>{{ $res_i->tipo_doc}}:</strong> {{ $res_i->dni}} - 
        <strong>Edad:</strong> {{ $edad}} 
        <br>
        <strong>Examen:</strong> {{ $res_i->detalle}} - Fecha : {{ date('d-m-Y', strtotime($res_i->created_at))}}


        <table style="">
                <thead>
                
                    <tr>
                    <th style="width:25%;"></th>
                    <th style="width:25%;" >Nombre</th>
                    <th style="width:15%;" >Resultado</th>
                    <th style="width:15%;" >UM</th>
                    <th style="width:35%;text-overflow:ellipsis;" scope="col">Rango de Referencia</th>

                
                
                
                </thead>
        <tbody>
            @foreach($res as $r)
            <tr>
            <td style="padding: 0;background: #ECE6EF;font-size: 10px;"><strong>{{$r->subtitulo}}<strong></td>
            <br>
            <tr>
            <td style="padding: 0;font-size: 12px;"><strong><strong></td>
            <td style="padding: 0;font-size: 12px;">{{$r->nom_val}}</td>
            <td style="padding: 0;font-size: 12px;">{{$r->valor}}</td>
            <td style="padding: 0;font-size: 12px;">{{$r->medida}}</td>
            <td style="padding: 0;font-size: 10px;">{{$r->referencia}}</td>
            @endforeach

        </tbody>


    </table>
           
            
        </main>
    </body>
</html>