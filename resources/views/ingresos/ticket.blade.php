<head>
    <style type="text/css">
      {
        margin: 0;
        padding: 0;
      }
      .table-main{
       margin-left:-55px;
       margin-right:-56px;
      }
      .cl{
        margin: 0;
        padding: 0;

      }
      .truncate {
        width: 1px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
      @page {
        header: page-header;
        footer: page-footer;
      }
      footer {
        border:solid red;
      }
    </style>

    <meta charset="utf-8">

  </head>

    <body style="width:100%; position:fixed: top: 1px; ">

    <br><br>

    <div  style="font-size: 15px; text-align: center;margin-bottom:-60px;margin-top: -30px;">
		<p><strong>TICKET INGRESO</strong></p>
		<p style="margin-top: -20px;"><strong></strong></p>


    <p><strong>FECHA:</strong> {{$ingreso->created_at}} </p>

    <p style="margin-top: -20px;"><strong>________________________________________________________</strong>  </p>
    <p style="margin-top: -15px;font-size: 14px;text-align: center;"><strong>NÚMERO DE RECIBO ELECTRÓNICO:0000{{$ingreso->id}}</strong></p>
    <p style="margin-top: -30px;"><strong>________________________________________________________</strong>  </p>


	

	</div>
    <br><br>
    <div  style="font-size: 15px; text-align: left;margin-bottom:-60px;margin-top: 20px;">
	
	</div>
  <br><br><br>

    <table width="100%" class="table-main">
      <thead>
        <tr>
          <th style="font-size: 15px"><center>Cantidad.<center></th>
          <th style="font-size: 15px"><center>Descripción.<center></th>
          <th style="font-size: 15px"><center>Monto.<center></th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <td style="font-size: 15px; line-height: 30px;" align="center">01</td>
            @if(strpos($ingreso->descripcion, 'HABITACION') !== false)
            <td style="font-size: 15px; line-height: 30px;" align="center">VARIOS</td>
            @else
            <td style="font-size: 15px; line-height: 30px;" align="center">{{$ingreso->descripcion}}</td>
            @endif
            <td style="font-size: 15px; line-height: 30px;" align="center">{{$ingreso->monto}}</td>
          </tr>
      </tbody>
    </table>
    <p style="margin-left: -40px;font-size:13px;"><strong>TIPO DE PAGO:</strong> {{ $ingreso->tipopago}}</p>


    <br>

    <table width="100%">
      <tbody>
        <tr>
          <td style="width: 100%;">
            <table width="100%">
              <tbody>
                   

                    <tr>
                      <td align="left" style="font-size: 15px;margin-left:150px;">MONTO TOTAL</td>
                      <td align="right" style="font-size: 15px;margin-left:150px;">{{$ingreso->monto }}</td>
                    </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>

    

    </body>
