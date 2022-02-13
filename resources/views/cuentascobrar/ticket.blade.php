

<head>
    <style type="text/css">
      {
        margin: 0;
        padding: 0;
      }
      .table-main{
       margin-left:-45px;
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

	<div class="" style="font-size: 35px; text-align: center;margin-bottom: 15px;">
		<img src="victal.png" style="width: 20%;"/>
	</div>

    <div  style="font-size: 15px; text-align: center;margin-bottom:-60px;margin-top: -30px;">
    @if(Session::get('sedeName') == 'PROCERES')

		<p><strong>VICTAL SAC-{{Session::get('sedeName')}}</strong></p>
		<p style="margin-top: -20px;"><strong>RUC: 20600971116</strong></p>
        <p style="margin-top: -10px;"><strong>Dirección: Av Próceres de la independencia 1781
3er piso SJL</strong></p>
		<p style="margin-top: -20px;"><strong>Teléfono:  01 3764637</strong></p>
		<p style="margin-top: -20px;"><strong>WhatsApp: 978 216 135</strong></p>
   @elseif(Session::get('sedeName') == 'CANTO REY')
   <p><strong>VICTAL SAC-{{Session::get('sedeName')}}</strong></p>
		<p style="margin-top: -20px;"><strong>RUC: 20600971116</strong></p>
        <p style="margin-top: -10px;"><strong>Dirección: Av Wiesse 3331 2do piso  SJL</strong></p>
		<p style="margin-top: -20px;"><strong>Teléfono:  01 2534502</strong></p>
		<p style="margin-top: -20px;"><strong>WhatsApp: 978 216 135</strong></p>
        @elseif(Session::get('sedeName') == 'VIDA FELIZ')
   <p><strong>VIDA FELIZ SAC- VICTAL</strong></p>
		<p style="margin-top: -20px;"><strong>RUC: 20602415539</strong></p>
        <p style="margin-top: -10px;"><strong>Dirección: Av Próceres de la independencia 1795
2do piso SJL</strong></p>
		<p style="margin-top: -20px;"><strong>Teléfono:  01 4596494</strong></p>
		<p style="margin-top: -20px;"><strong>WhatsApp: 978 216 315</strong></p>
    @elseif(Session::get('sedeName') == 'INDEPENDENCIA')
   <p><strong>SYSMEDIC PERU SAC -INDEPENDENCIA</strong></p>
		<p style="margin-top: -20px;"><strong>RUC: 20606283980</strong></p>
        <p style="margin-top: -10px;"><strong>Dirección: AV.CHINCHAYSUYO 323 TAHUANTINSUYO</strong></p>
		<p style="margin-top: -20px;"><strong>Teléfono: 01 5265711</strong></p>
		<p style="margin-top: -20px;"><strong>WhatsApp: 940 309 507</strong></p>
    @elseif(Session::get('sedeName') == 'ZARATE')
    <p><strong>SYSMEDIC PERU SAC</strong></p>
    <p style="margin-top: -20px;"><strong>RUC: 20606283980</strong></p>
        <p style="margin-top: -10px;"><strong>Dirección:  Av. gran chimu 745 Zarate SJL</strong></p>
		<p style="margin-top: -20px;"><strong>Teléfono:   01 7820512</strong></p>
		<p style="margin-top: -20px;"><strong>WhatsApp: 924 520 026</strong></p>

    @else
   <p><strong>SYSMEDIC PERU SAC -LOS OLIVOS</strong></p>
		<p style="margin-top: -20px;"><strong>RUC: 20606283980</strong></p>
        <p style="margin-top: -10px;"><strong>Dirección: AV.PROCERES 7832 URB PRO</strong></p>
		<p style="margin-top: -20px;"><strong>Teléfono: 01 5390547</strong></p>
		<p style="margin-top: -20px;"><strong>WhatsApp: 940 309 506</strong></p>
	
    @endif
		



    <p style="margin-top: -20px;"><strong>________________________________________________________</strong>  </p>
    <p style="margin-top: -15px;font-size: 14px;text-align: center;"><strong>RECIBO PAGO A CUENTA Nº:0000{{$ticket->id}}</strong></p>
    <p style="margin-top: -30px;"><strong>________________________________________________________</strong>  </p>

    <p style="margin-left: -80px;font-size: 14px;"><strong>FECHA:</strong> {{ date('d/m/Y h:i a', strtotime($ticket->created_at)) }}</p>

	

	</div>
    <br><br>
    <div  style="font-size: 15px; text-align: left;margin-bottom:-20px;margin-top: 20px;">
		<p style="margin-left: -40px;"><strong>PACIENTE:</strong> {{$ticket->apellidos}},{{$ticket->nombres}}</p>
    <p style="margin-left: -40px;margin-top: -10px;"><strong>DNI:</strong> {{ $ticket->dni}}</p>
	
	</div>
  <br><br>

  
  <table width="100%" class="table-main">
      <thead>
        <tr>
          <th style="font-size: 15px"><center>Detalle.<center></th>
          <th style="font-size: 15px"><center>Monto.<center></th>
        </tr>
      </thead>
      <tbody>
          <tr>
            <td style="font-size: 15px; line-height: 30px;" align="center">CUENTA POR COBRAR</td>
            <td style="font-size: 15px; line-height: 30px;" align="center">{{ $ticket->monto}}</td>
          </tr>
      </tbody>
    </table>




    <br>


	<table width="100%">
      <tbody>
        <tr>
          <td style="width: 100%;">
            <table width="100%">
              <tbody>
                   

                    <tr>
                      <td align="left" style="font-size: 15px;margin-left:150px;">MONTO</td>
                      <td align="right" style="font-size: 15px;margin-left:150px;">{{ $ticket->total}}</td>
                    </tr>
					<tr>
                      <td align="left" style="font-size: 15px;margin-left:150px;">PAGADO</td>
                      <td align="right" style="font-size: 15px;margin-left:150px;">{{ $ticket->monto}}</td>
                    </tr>
                    <tr>
                      <td align="left" style="font-size: 15px;margin-left:150px;">RESTA</td>
                      <td align="right" style="font-size: 15px;margin-left:150px;">{{ $ticket->resta}}</td>
                    </tr>
					<tr>
                      <td align="left" style="font-size: 15px;margin-left:150px;">TIPO DE PAGO</td>
                      <td align="right" style="font-size: 15px;margin-left:150px;">{{ $ticket->tipopago}}</td>
                    </tr>
              </tbody>
            </table>
          </td>
        </tr>
      </tbody>
    </table>

	

    

    </body>
