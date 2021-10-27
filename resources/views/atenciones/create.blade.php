<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VICTAL | Admin</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
  <!-- summernote -->
  <link rel="stylesheet" href="../../plugins/summernote/summernote-bs4.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="../../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed" OnKeyPress="return disableEnterKey(event)">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
  @include('layouts.navbar')
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    @include('layouts.sidebar')
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Registro de Atención</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Agregar</h3>
              </div>
              @include('flash-message')

             
              <!-- /.card-header -->
              <!-- form start -->
                    <div class="card-body">
                      <a class="btn btn-success btn-sm" href="pacientes-create2">
                        <i class="fas fa-add">
                        </i>
                        Crear Paciente
                    </a>
                    <form method="get" action="atenciones-create">		
                    {{ csrf_field() }}  
			

                    <div class="row">
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Buscar Paciente</label>
                    <input type="text" class="form-control" id="el1" name="pac" placeholder="Buscar por dni" onsubmit="datapac()">
                  </div>

                  <div class="col-md-2" style="margin-top: 30px;">
                  <button type="submit" class="btn btn-primary">Buscar</button>

                  </div>
                  

                  
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Total</label>

                    <input class="number form-control" type="text" name="total" id="total" readonly="readonly" value="0.00">
                    </div>
                    
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Abono</label>

                    <input class="form-control" type="text" name="abono" id="abono" readonly="readonly" value="0.00">
                    </div>

                    <div class="col-md-2">
                      <label for="exampleInputEmail1">Resta</label>
  
                      <input class="form-control" type="text" name="resta" id="resta" readonly="readonly" value="0.00">
                    </div>
                      
                
                 
                  </form>

                  
                  </div>
                  <br>
                  
                    <form method="post" action="atenciones/create" >			
                  {{ csrf_field() }}  
                  @if($paciente && $res == 'SI')
                  <input type="hidden" name="paciente" value="{{$paciente->id}}">
                  <p style="">Datos de Paciente</p>
                  <div class="row" style="background:yellowgreen;">
                    <div class="col-md-2">
                      <strong>Nombres:</strong>{{$paciente->nombres}}
                    </div>
                    <div class="col-md-2">
                      <strong>Apellidos:</strong>{{$paciente->apellidos}}
                    </div>
                    <div class="col-md-2">
                      <strong>TipoDoc:</strong>{{$paciente->tipo_doc}}
                    </div>
                    <div class="col-md-2">
                      <strong>DNI:</strong>{{$paciente->dni}}
                    </div>
                    
                    <div class="col-md-2">
                      <strong>Teléfono:</strong>{{$paciente->telefono}}
                    </div>
                    
                   
                    </div>
                  @else
                  <label for="exampleInputEmail1">NO EXISTE EL PACIENTE</label>

                
                  @endif

                  <br>
                  <div class="row">
                  <div class="col-md-3">
                  <label>Origen</label>
                        <select class="form-control" name="origen" id="el2">
                            <option value="">Seleccione</option>
							              <option value="1">Personal</option>
                            <option value="2">Profesional</option>
                            <option value="3">Otro</option>

                        </select>
                  </div>
                  <div class="col-md-6">
                      <div id="siniestro" class="siniestro">

                  </div>
                  </div>
                  <br>
                  <br>
                  <br>



                  
                  				
                  <ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link active" data-toggle="tab" href="#serv">Procedimiento</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#eco">Ecografias</a>
    
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#ray">Rayos X</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#sal">Salud Mental</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#lab">Laboratorios</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#paq">Paquetes</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#con">Consultas/Controles</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" data-toggle="tab" href="#met">Métodos Anticonceptivos</a>
  </li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
  <div class="tab-pane container active" id="serv">
  <div class="row">
            <label class="col-sm-6 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Procedimiento Seleccionadas</label>
            <!-- sheepIt Form -->
            <div id="servicios" class="embed ">
            
                <!-- Form template-->
                <div id="servicios_template" class="template row">

                <label for="servicios_#index#_servicio" class="col-sm-1 control-label">Procedimiento</label>
                    <div class="col-sm-3">
                      <select id="servicios_#index#_servicio" name="id_servicio[servicios][#index#][servicio]" class="selectServ form-control">
                      <option value="1">Seleccionar Procedimiento</option>
                        @foreach($otros as $ot)
                          <option value="{{$ot->id}}">
                            {{$ot->nombre}} Precio:{{$ot->precio}}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <label for="servicios_#index#_monto" class="col-sm-1 control-label">Monto</label>
                    <div class="col-sm-1">
                      <input id="servicios_#index#_montoHidden" name="monto_h[servicios][#index#][montoHidden]" class="text" type="hidden" value="">

                      <input id="servicios_#index#_monto" name="monto_s[servicios][#index#][monto]" type="number" class="number form-control monto" onchange="sumar();"  placeholder="Precio"  data-toggle="tooltip" data-placement="bottom" title="Precio">
                    </div>

                    <label for="servicios_#index#_abonoS" class="col-sm-1 control-label">Abono.</label>
                    <div class="col-sm-1">

                      <input id="servicios_#index#_abonoS" name="monto_abol[servicios][#index#][abono]" type="float" class="number form-control abonoS abono" onchange="sumar_ab();"  onkeyup="myFunction()" placeholder="Abono" data-toggle="tooltip" data-placement="bottom" title="Abono">
                    </div>
                    <label for="servicios_#index#_tipop" class="col-sm-1 control-label">TipoPago</label>
                    <div class="col-sm-2">
                      <select id="servicios_#index#_servicio" name="id_pago[servicios][#index#][tipop]" class="form-control">
                        <option value="EF">Efectivo</option>
                        <option value="TJ">Tarjeta</option>
                        <option value="DP">Depósito</option>
                        <option value="YP">Yape</option>

                      </select>
                    </div>

                   

                    <a id="servicios_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
                <!-- /Form template-->
                
                <!-- No forms template -->
                <div id="servicios_noforms_template" class="noItems col-sm-12 text-center">Ningún Procedimiento</div>
                <!-- /No forms template-->
                
                <!-- Controls -->
                <div id="servicios_controls" class="controls col-sm-11 col-sm-offset-1">
                    <div id="servicios_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar Procedimiento</span></a></div>
                </div>
                <!-- /Controls -->
                
            </div>
            <!-- /sheepIt Form --> 
          </div>
  </div>
  <div class="tab-pane container fade" id="eco">
  <div class="row">
            <label class="col-sm-6 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Ecografias Seleccionadas</label>
            <!-- sheepIt Form -->
            <div id="ecografias" class="embed ">
            
                <!-- Form template-->
                <div id="ecografias_template" class="template row">

                <label for="ecografias_#index#_ecografia" class="col-sm-1 control-label">Ecografias</label>
                    <div class="col-sm-3">
                      <select id="ecografias_#index#_ecografia" name="id_ecografia[ecografias][#index#][ecografia]" class="selectEco form-control">
                        <option value="1">Seleccionar Ecografia</option>
                        @foreach($ecografias as $eco)
                          <option value="{{$eco->id}}">
                            {{$eco->nombre}} Precio:{{$eco->precio}}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <label for="ecografias_#index#_monto" class="col-sm-1 control-label">Monto</label>
                    <div class="col-sm-1">
                      <input id="ecografias_#index#_montoHidden" name="monto_h[ecografias][#index#][montoHidden]" class="text" type="hidden" value="">

                      <input id="ecografias_#index#_monto" name="monto_s[ecografias][#index#][monto]" type="text" class="number form-control monto" onchange="sumar();" placeholder="Precio" data-toggle="tooltip" data-placement="bottom" title="Precio">
                    </div>

                    <label for="ecografias_#index#_abonoL" class="col-sm-1 control-label">Abono.</label>
                    <div class="col-sm-1">

                      <input id="ecografias_#index#_abonoL" name="monto_abol[ecografias][#index#][abono]" type="float" class="number form-control abonoL abono" onchange="sumar_ab();" placeholder="Abono" data-toggle="tooltip" data-placement="bottom" title="Abono">
                    </div>

                    <label for="ecografias_#index#_tipop" class="col-sm-1 control-label">TipoPago</label>
                    <div class="col-sm-2">
                      <select id="ecografias_#index#_ecografia" name="id_pago[ecografias][#index#][tipop]" class="form-control">
                      <option value="" disabled>Seleccione</option>
                        <option value="EF">Efectivo</option>
                        <option value="TJ">Tarjeta</option>
                        <option value="DP">Depósito</option>
                        <option value="YP">Yape</option>

                      </select>
                    </div>

                   

                    <a id="ecografias_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
                <!-- /Form template-->
                
                <!-- No forms template -->
                <div id="ecografias_noforms_template" class="noItems col-sm-12 text-center">Ningún Producto</div>
                <!-- /No forms template-->
                
                <!-- Controls -->
                <div id="ecografias_controls" class="controls col-sm-11 col-sm-offset-1">
                    <div id="ecografias_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar Ecografia</span></a></div>
                </div>
                <!-- /Controls -->
                
            </div>
            <!-- /sheepIt Form --> 
          </div>
  </div>
  <div class="tab-pane container fade" id="ray">
  <div class="row">
            <label class="col-sm-6 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Rayos X Seleccionadas</label>
            <!-- sheepIt Form -->
            <div id="rayos" class="embed ">
            
                <!-- Form template-->
                <div id="rayos_template" class="template row">

                <label for="rayos_#index#_rayo" class="col-sm-1 control-label">Rayos X</label>
                    <div class="col-sm-3">
                      <select id="rayos_#index#_rayo" name="id_rayo[rayos][#index#][rayo]" class="selectRayos form-control">
                        <option value="1">Seleccionar Rayos X</option>
                        @foreach($rayos as $ray)
                          <option value="{{$ray->id}}">
                            {{$ray->nombre}} Precio:{{$ray->precio}}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <label for="rayos_#index#_monto" class="col-sm-1 control-label">Monto</label>
                    <div class="col-sm-1">
                      <input id="rayos_#index#_montoHidden" name="monto_h[rayos][#index#][montoHidden]" class="text" type="hidden" value="">

                      <input id="rayos_#index#_monto" name="monto_s[rayos][#index#][monto]" type="text" class="number form-control monto" onchange="sumar();" placeholder="Precio" data-toggle="tooltip" data-placement="bottom" title="Precio">
                    </div>

                    <label for="rayos_#index#_abonoL" class="col-sm-1 control-label">Abono.</label>
                    <div class="col-sm-1">

                      <input id="rayos_#index#_abonoL" name="monto_abol[rayos][#index#][abono]" type="float" class="number form-control abonoL abono" onchange="sumar_ab();" placeholder="Abono" data-toggle="tooltip" data-placement="bottom" title="Abono">
                    </div>

                    <label for="rayos_#index#_tipop" class="col-sm-1 control-label">TipoPago</label>
                    <div class="col-sm-2">
                      <select id="rayos_#index#_rayo" name="id_pago[rayos][#index#][tipop]" class="form-control">
                        <option value="EF">Efectivo</option>
                        <option value="TJ">Tarjeta</option>
                        <option value="DP">Depósito</option>
                        <option value="YP">Yape</option>

                      </select>
                    </div>

                   

                    <a id="rayos_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
                <!-- /Form template-->
                
                <!-- No forms template -->
                <div id="rayos_noforms_template" class="noItems col-sm-12 text-center">Ningún Producto</div>
                <!-- /No forms template-->
                
                <!-- Controls -->
                <div id="rayos_controls" class="controls col-sm-11 col-sm-offset-1">
                    <div id="rayos_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar Rayos X</span></a></div>
                </div>
                <!-- /Controls -->
                
            </div>
            <!-- /sheepIt Form --> 
          </div>

  </div>

  <div class="tab-pane container fade" id="sal">
    <div class="row">
              <label class="col-sm-6 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Salud M Seleccionadas</label>
              <!-- sheepIt Form -->
              <div id="salud" class="embed ">
              
                  <!-- Form template-->
                  <div id="salud_template" class="template row">
  
                  <label for="salud_#index#_salu" class="col-sm-1 control-label">Salud Mental</label>
                      <div class="col-sm-3">
                        <select id="salud_#index#_salu" name="id_salu[salud][#index#][salu]" class="selectSalud form-control">
                          <option value="1">Seleccionar Salud M</option>
                          @foreach($salud as $sa)
                            <option value="{{$sa->id}}">
                              {{$sa->nombre}} Precio:{{$sa->precio}}
                            </option>
                          @endforeach
                        </select>
                      </div>
  
                      <label for="salud_#index#_monto" class="col-sm-1 control-label">Monto</label>
                      <div class="col-sm-1">
                        <input id="salud_#index#_montoHidden" name="monto_h[salud][#index#][montoHidden]" class="text" type="hidden" value="">
  
                        <input id="salud_#index#_monto" name="monto_s[salud][#index#][monto]" type="text" class="number form-control monto" onchange="sumar();" placeholder="Precio" data-toggle="tooltip" data-placement="bottom" title="Precio">
                      </div>
  
                      <label for="salud_#index#_abonoL" class="col-sm-1 control-label">Abono.</label>
                      <div class="col-sm-1">
  
                        <input id="salud_#index#_abonoL" name="monto_abol[salud][#index#][abono]" type="float" class="number form-control abonoL abono" onchange="sumar_ab();" placeholder="Abono" data-toggle="tooltip" data-placement="bottom" title="Abono">
                      </div>
  
                      <label for="salud_#index#_tipop" class="col-sm-1 control-label">TipoPago</label>
                      <div class="col-sm-2">
                        <select id="salud_#index#_salu" name="id_pago[salud][#index#][tipop]" class="form-control">
                        <option value="" disabled>Seleccione</option>
                          <option value="EF">Efectivo</option>
                          <option value="TJ">Tarjeta</option>
                          <option value="DP">Depósito</option>
                          <option value="YP">Yape</option>
  
                        </select>
                      </div>
  
                     
  
                      <a id="salud_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                  </div>
                  <!-- /Form template-->
                  
                  <!-- No forms template -->
                  <div id="salud_noforms_template" class="noItems col-sm-12 text-center">Ningún Producto</div>
                  <!-- /No forms template-->
                  
                  <!-- Controls -->
                  <div id="salud_controls" class="controls col-sm-11 col-sm-offset-1">
                      <div id="salud_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar SaludM</span></a></div>
                  </div>
                  <!-- /Controls -->
                  
              </div>
              <!-- /sheepIt Form --> 
            </div>
  
    </div>

  <div class="tab-pane container fade" id="lab">
  <div class="row">
            <label class="col-sm-6 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Laboratorios Seleccionadas</label>
            <!-- sheepIt Form -->
            <div id="analisis" class="embed ">
            
                <!-- Form template-->
                <div id="analisis_template" class="template row">

                <label for="analisis_#index#_rayo" class="col-sm-2 control-label">Laboratorios</label>
                    <div class="col-sm-3">
                      <select id="analisis_#index#_sayo" name="id_analisi[analisis][#index#][analisi]" class="selectLab form-control">
                        <option value="1" >Seleccionar Labo.</option>
                        @foreach($analisis as $ana)
                          <option value="{{$ana->id}}">
                            {{$ana->nombre}} Precio:{{$ana->precio}}
                          </option>
                        @endforeach
                      </select>
                    </div>

                    <label for="analisis_#index#_monto" class="col-sm-1 control-label">Monto</label>
                    <div class="col-sm-1">
                      <input id="analisis_#index#_montoHidden" name="monto_h[analisis][#index#][montoHidden]" class="text" type="hidden" value="">

                      <input id="analisis_#index#_monto" name="monto_s[analisis][#index#][monto]" type="text" class="number form-control monto" onchange="sumar();" placeholder="Precio" data-toggle="tooltip" data-placement="bottom" title="Precio">
                    </div>

                    <label for="analisis_#index#_abonoL" class="col-sm-1 control-label">Abono.</label>
                    <div class="col-sm-1">

                      <input id="analisis_#index#_abonoL" name="monto_abol[analisis][#index#][abono]" type="float" class="number form-control abonoL abono" onchange="sumar_ab();" placeholder="Abono" data-toggle="tooltip" data-placement="bottom" title="Abono">
                    </div>

                    
                    <label for="analisis_#index#_tipop" class="col-sm-1 control-label">TipoPago</label>
                    <div class="col-sm-2">
                      <select id="analisis_#index#_analisi" name="id_pago[analisis][#index#][tipop]" class="form-control">
                      <option value="" disabled>Seleccione</option>
                        <option value="EF">Efectivo</option>
                        <option value="TJ">Tarjeta</option>
                        <option value="DP">Depósito</option>
                        <option value="YP">Yape</option>

                      </select>
                    </div>

                   

                    <a id="analisis_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
                <!-- /Form template-->
                
                <!-- No forms template -->
                <div id="analisis_noforms_template" class="noItems col-sm-12 text-center">Ningún Producto</div>
                <!-- /No forms template-->
                
                <!-- Controls -->
                <div id="analisis_controls" class="controls col-sm-11 col-sm-offset-1">
                    <div id="analisis_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar Laboratorio</span></a></div>
                </div>
                <!-- /Controls -->
                
            </div>
            <!-- /sheepIt Form --> 
          </div>
  </div>
  <div class="tab-pane container fade" id="paq">

    <div class="row">
      <label class="col-sm-6 alert"><i class="fa fa-tasks" aria-hidden="true"></i> Paquetes Seleccionadas</label>
      <!-- sheepIt Form -->
      <div id="paquetes" class="embed ">
      
          <!-- Form template-->
          <div id="paquetes_template" class="template row">

          <label for="paquetes_#index#_paquete" class="col-sm-2 control-label">Paquetes</label>
              <div class="col-sm-3">
                <select id="paquetes_#index#_paquete" name="id_paquete[paquetes_][#index#][paquete]" class="selectPaq form-control">
                  <option value="1" >Seleccionar Paquete.</option>
                  @foreach($paquetes as $paq)
                    <option value="{{$paq->id}}">
                      {{$paq->nombre}} Precio:{{$paq->precio}}
                    </option>
                  @endforeach
                </select>
              </div>

              <label for="paquetes_#index#_monto" class="col-sm-1 control-label">Monto</label>
              <div class="col-sm-1">
                <input id="paquetes_#index#_montoHidden" name="monto_h[paquetes][#index#][montoHidden]" class="text" type="hidden" value="">

                <input id="paquetes_#index#_monto" name="monto_s[paquetes][#index#][monto]" type="text" class="number form-control monto" onchange="sumar();" placeholder="Precio" data-toggle="tooltip" data-placement="bottom" title="Precio">
              </div>

              <label for="paquetes_#index#_abonoL" class="col-sm-1 control-label">Abono.</label>
              <div class="col-sm-1">

                <input id="paquetes_#index#_abonoL" name="monto_abol[paquetes][#index#][abono]" type="float" class="number form-control abonoL abono" onchange="sumar_ab();" placeholder="Abono" data-toggle="tooltip" data-placement="bottom" title="Abono">
              </div>

              
              <label for="paquetes_#index#_tipop" class="col-sm-1 control-label">TipoPago</label>
              <div class="col-sm-2">
                <select id="paquetes_#index#_paquete" name="id_pago[paquetes][#index#][tipop]" class="form-control">
                <option value="" disabled>Seleccione</option>
                  <option value="EF">Efectivo</option>
                  <option value="TJ">Tarjeta</option>
                  <option value="DP">Depósito</option>
                  <option value="YP">Yape</option>

                </select>
              </div>

             

              <a id="paquetes_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
          </div>
          <!-- /Form template-->
          
          <!-- No forms template -->
          <div id="paquetes_noforms_template" class="noItems col-sm-12 text-center">Ningún Producto</div>
          <!-- /No forms template-->
          
          <!-- Controls -->
          <div id="paquetes_controls" class="controls col-sm-11 col-sm-offset-1">
              <div id="paquetes_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar Paquete</span></a></div>
          </div>
          <!-- /Controls -->
          
      </div>
      <!-- /sheepIt Form --> 
    </div>

  </div>
  <div class="tab-pane container fade" id="con">  
  <div class="card-body">
                    <div class="row" width="100%">
                    <div class="col-md-3">
                  <label>Tipo</label>
                        <select class="form-control" name="tipo_con">
						              	<option value="" disabled>Seleccione</option>
                            <option value="1">Consulta</option>
                            <option value="2">Control</option>
                        </select>
                  </div>
                  <div class="col-md-3">
                  <label>Especialista</label>
                        <select class="form-control" name="esp_con">
                          <option value="">Seleccione</option>
                          @foreach($personal as $p)
                          <option value="{{$p->id}}">{{$p->lastname}} {{$p->name}}</option>
                          @endforeach
                        </select>
                  </div>
                  <div class="col-md-3">
                    <label for="exampleInputEmail1">Precio</label>
                    <input type="float" class="form-control monto abono" id="email" name="precio_con" placeholder="Precio" onchange="sumar();sumar_ab()" >
                  </div>
                  <div class="col-md-3">
                  <label>TipoPago</label>
                        <select class="form-control" name="tipop_con">
						              	<option value="" disabled>Seleccione</option>
                            <option value="EF">Efectivo</option>
                            <option value="TJ">Tarjeta</option>
                            <option value="DP">Depósito</option>
                            <option value="YP">Yape</option>
                        </select>
                  </div>


                  </div>
                 

                 
                  </div>
                  </div>
  <div class="tab-pane container fade" id="met"> <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
                  <label>Producto</label>
                  <select class="form-control" name="metodo">
                    <option value="">Seleccione</option>
                  @foreach($met as $m)
                  <option value="{{$m->id}}">{{$m->nombre}}</option>
                  @endforeach
                </select>

                      
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Precio</label>
                    <input type="float" class="form-control monto abono" id="email" name="precio_met" placeholder="Precio" onchange="sumar();sumar_ab()">
                  </div>
                  <div class="col-md-4">
                  <label>TipoPago</label>
                        <select class="form-control" name="tipop_met">
						              	<option value="" disabled>Seleccione</option>
                            <option value="EF">Efectivo</option>
                            <option value="TJ">Tarjeta</option>
                            <option value="DP">Depósito</option>
                            <option value="YP">Yape</option>
                        </select>
                  </div>


                  </div>
                 

                 
                  </div>
                  </div>


</div>
</div>


                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

         
            <!-- /.card -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

    
    

  <!-- /.content-wrapper -->
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>

<!-- sheepit -->

<script src="../../plugins/sheepit/jquery.sheepItPlugin.min.js"></script>

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../plugins/select2/js/select2.full.min.js"></script>

<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<!-- Summernote -->
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>

<script language="javascript">

function disableEnterKey(e) 
{ 
  var key; 
  if(window.event) 
     key = window.event.keyCode; 
   else key = e.which; //firefox 
   return (key != 13); 
  }

</script>

<script>
function myFunction() {
  var x = document.getElementById("abonoS");
  sumar_ab();
}
</script>

<script>
function datapac(){
      
      $('#el1').on('submit',function(){
           var link;
             link = '/solicitudes/dataPacientes/'+$(this).val();
   
   
           $.ajax({
                  type: "get",
                  url:  link,
                  success: function(a) {
                     $('#pacientes').html(a);
                  }
           });
   
         });
       }

</script>

<script type="text/javascript">
      $(document).ready(function(){
        $('#el2').on('change',function(){
          var link;
          if ($(this).val() == 1) {
            link = '/atenciones/personal/';

          }else if ($(this).val() == 2) {
            link = '/atenciones/profesionales/';
          } else {
		    link = '/atenciones/particular/';
		  }

          $.ajax({
                 type: "get",
                 url:  link,
                 success: function(a) {
                    $('#siniestro').html(a);
                 }
          });

        });
        

      });
       
    </script>



<script type="text/javascript">
  $(document).ready(function() {
    var total = 0;

    $(".monto, .montol, .montop").keyup(function(event) {
      sumar();
    });




$(".abonoS").keyup(function(){
  alert('aquiiii');
    
});






$(document).on('change','.selectServ',function(){
      var labId = $(this).attr('id');
      var labArr = labId.split('_');
      var id = labArr[1];

      $.ajax({
         type: "GET",
         url:  "atenciones/getServicio/"+$(this).val(),
         success: function(a) {
            $('#servicios_'+id+'_montoHidden').val(a.precio);
            $('#servicios_'+id+'_monto').val(a.precio);
            var total = parseFloat($('#total').val());
            $("#total").val(total + parseFloat(a.precio));
            sumar();

          
         }
      });
    });

    $(document).on('change','.selectEco',function(){
      var labId = $(this).attr('id');
      var labArr = labId.split('_');
      var id = labArr[1];

      $.ajax({
         type: "GET",
         url:  "atenciones/getServicio/"+$(this).val(),
         success: function(a) {
            $('#ecografias_'+id+'_montoHidden').val(a.precio);
            $('#ecografias_'+id+'_monto').val(a.precio);
            var total = parseFloat($('#total').val());
            $("#total").val(total + parseFloat(a.precio));
            sumar();
          
          
         }
      });
    });

    $(document).on('change','.selectRayos',function(){
      var labId = $(this).attr('id');
      var labArr = labId.split('_');
      var id = labArr[1];

      $.ajax({
         type: "GET",
         url:  "atenciones/getServicio/"+$(this).val(),
         success: function(a) {
           
            $('#rayos_'+id+'_montoHidden').val(a.precio);
            $('#rayos_'+id+'_monto').val(a.precio);
            var total = parseFloat($('#total').val());
            $("#total").val(total + parseFloat(a.precio));
            sumar();
          
          
         }
      });
    });

    $(document).on('change','.selectSalud',function(){
      var labId = $(this).attr('id');
      var labArr = labId.split('_');
      var id = labArr[1];

      $.ajax({
         type: "GET",
         url:  "atenciones/getServicio/"+$(this).val(),
         success: function(a) {
           
            $('#salud_'+id+'_montoHidden').val(a.precio);
            $('#salud_'+id+'_monto').val(a.precio);
            var total = parseFloat($('#total').val());
            $("#total").val(total + parseFloat(a.precio));
            sumar();
          
          
         }
      });
    });

    $(document).on('change','.selectLab',function(){
      var labId = $(this).attr('id');
      var labArr = labId.split('_');
      var id = labArr[1];

      $.ajax({
         type: "GET",
         url:  "atenciones/getAnalisis/"+$(this).val(),
         success: function(a) {
           
            $('#analisis_'+id+'_montoHidden').val(a.precio);
            $('#analisis_'+id+'_monto').val(a.precio);
            var total = parseFloat($('#total').val());
            $("#total").val(total + parseFloat(a.precio));
            sumar();
          
          
         }
      });
    });

    $(document).on('change','.selectPaq',function(){
      var labId = $(this).attr('id');
      var labArr = labId.split('_');
      var id = labArr[1];

      $.ajax({
         type: "GET",
         url:  "atenciones/getPaquetes/"+$(this).val(),
         success: function(a) {
           
            $('#paquetes_'+id+'_montoHidden').val(a.precio);
            $('#paquetes_'+id+'_monto').val(a.precio);
            var total = parseFloat($('#total').val());
            $("#total").val(total + parseFloat(a.precio));
            sumar();
          
          
         }
      });
    });

function sumar()
{
  const $total = document.getElementById('total');
  let subtotal = 0;
  [ ...document.getElementsByClassName( "monto" ) ].forEach( function ( element ) {
    if(element.value !== '') {
      subtotal += parseFloat(element.value);
    }
  });
  $total.value = subtotal;
}




function sumar_ab()
{
  const $abono = document.getElementById('abono');
  const $resta = document.getElementById('resta');
  let subtotal = 0;
  
  [ ...document.getElementsByClassName( "abono" ) ].forEach( function ( element ) {
    if(element.value !== '') {
      subtotal += parseFloat(element.value);
    }
  });
  $abono.value = subtotal;
  $resta.value = total.value - subtotal;
}






var botonDisabled = true;

    // Main sheepIt form
    var phonesForm = $("#servicios").sheepIt({
        separator: '',
        allowRemoveCurrent: true,
        allowAdd: true,
        allowRemoveAll: true,
        allowRemoveLast: true,

        // Limits
        maxFormsCount: 10,
        minFormsCount: 1,
        iniFormsCount: 0,

        removeAllConfirmationMsg: 'Seguro que quieres eliminar todos?',
        afterRemoveCurrent: function(source, event){
          const $abono = document.getElementById('abono');
          sumar();
          restar();
         // alert(abono.value);
        /*  let subtotal = 0;
          let subtotall = 0;
          const $resta = document.getElementById('resta');
          [ ...document.getElementsByClassName( "abono" ) ].forEach( function ( element ) {
            if(element.value !== '') {
              subtotal += parseFloat(element.value);
            }
          });
          [ ...document.getElementsByClassName( "monto" ) ].forEach( function ( element ) {
            if(element.value !== '') {
              subtotall += parseFloat(element.value);
            }
          });

         alert(subtotall);*/

          //alert(subtotal - resta.value);
         /* const $resta = document.getElementById('resta');
        //  console.log(subtotal);
          $resta.value = total.value - 0;
         // sumar_ab();*/

        }
    });

    var phonesForm = $("#ecografias").sheepIt({
        separator: '',
        allowRemoveCurrent: true,
        allowAdd: true,
        allowRemoveAll: true,
        allowRemoveLast: true,

        // Limits
        maxFormsCount: 10,
        minFormsCount: 1,
        iniFormsCount: 0,

        removeAllConfirmationMsg: 'Seguro que quieres eliminar todos?',
        afterRemoveCurrent: function(source, event){
          sumar();
          restar();
        }
    });

    var phonesForm = $("#rayos").sheepIt({
        separator: '',
        allowRemoveCurrent: true,
        allowAdd: true,
        allowRemoveAll: true,
        allowRemoveLast: true,

        // Limits
        maxFormsCount: 10,
        minFormsCount: 1,
        iniFormsCount: 0,

        removeAllConfirmationMsg: 'Seguro que quieres eliminar todos?',
        afterRemoveCurrent: function(source, event){
          sumar();
          restar();
        }
    });

    var phonesForm = $("#salud").sheepIt({
        separator: '',
        allowRemoveCurrent: true,
        allowAdd: true,
        allowRemoveAll: true,
        allowRemoveLast: true,

        // Limits
        maxFormsCount: 10,
        minFormsCount: 1,
        iniFormsCount: 0,

        removeAllConfirmationMsg: 'Seguro que quieres eliminar todos?',
        afterRemoveCurrent: function(source, event){
         sumar();
         restar();

        }
    });

    
    var phonesForm = $("#analisis").sheepIt({
        separator: '',
        allowRemoveCurrent: true,
        allowAdd: true,
        allowRemoveAll: true,
        allowRemoveLast: true,

        // Limits
        maxFormsCount: 10,
        minFormsCount: 1,
        iniFormsCount: 0,

        removeAllConfirmationMsg: 'Seguro que quieres eliminar todos?',
        afterRemoveCurrent: function(source, event){
          sumar();
          restar();
        }
    });

    var phonesForm = $("#paquetes").sheepIt({
        separator: '',
        allowRemoveCurrent: true,
        allowAdd: true,
        allowRemoveAll: true,
        allowRemoveLast: true,

        // Limits
        maxFormsCount: 10,
        minFormsCount: 1,
        iniFormsCount: 0,

        removeAllConfirmationMsg: 'Seguro que quieres eliminar todos?',
        afterRemoveCurrent: function(source, event){
         sumar();
         restar();

        }
    });

  });





</script>

<script type="text/javascript">

function sumar_ab()
{
  const $abono = document.getElementById('abono');
  const $resta = document.getElementById('resta');
  let subtotal = 0;
  
  [ ...document.getElementsByClassName( "abono" ) ].forEach( function ( element ) {
    if(element.value !== '') {
      subtotal += parseFloat(element.value);
    }
  });
  $abono.value = subtotal;
  console.log(subtotal);
  $resta.value = total.value - subtotal;
  console.log(resta);

}



</script>

<script type="text/javascript">

function restar()
{
  const $abono = document.getElementById('abono');
  const $resta = document.getElementById('resta');
  let subtotal = 0;
  
  [ ...document.getElementsByClassName( "abono" ) ].forEach( function ( element ) {
    if(element.value !== '') {
      subtotal += parseFloat(element.value);
    }
  });

 // $abono.value = subtotal;
 //console.log(subtotal);
  $abono.value = subtotal;
  $resta.value = total.value - subtotal;

}



</script>


</body>
</html>