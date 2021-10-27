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
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
<!-- DataTables -->
<link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="../../plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
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
            <h1 class="m-0 text-dark">Empresas</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Empresas</li>
            </ol>
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
                <h3 class="card-title">Editar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" method="post" action="pacientes/edit">
					{{ csrf_field() }}                
                    <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
                    <label for="exampleInputEmail1">Apellidos</label>
                    <input type="text" class="form-control" id="nombre" name="apellidos" value="{{$pacientes->apellidos}}" placeholder="Apellidos">
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Nombres</label>
                    <input type="text" class="form-control" id="nombre" name="nombres" value="{{$pacientes->nombres}}" placeholder="Nombres">
                  </div>

                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Tipo de Documento</label>
                    <select class="form-control" name="tipo_doc">
                    @if($pacientes->tipo_doc == 'DNI')
                    <option value="DNI" selected>DNI</option>
                    <option value="CE">CE</option>
                    <option value="PTP">PTP</option>
                    <option value="PASAPORTE">PASAPORTE</option>
                    <option value="CPP">CPP</option>
                    <option value="OTRO">OTRO</option>
                    <option value="SIN DOC">SIN DOC</option> 
                    @elseif($pacientes->tipo_doc == 'CE')
                    <option value="DNI">DNI</option>
                    <option value="CE" selected>CE</option>
                    <option value="PTP">PTP</option>
                    <option value="PASAPORTE">PASAPORTE</option>
                    <option value="CPP">CPP</option>
                    <option value="OTRO">OTRO</option> 
                    <option value="SIN DOC">SIN DOC</option> 
                    @elseif($pacientes->tipo_doc == 'PTP')
                    <option value="DNI" >DNI</option>
                    <option value="CE" >CE</option>
                    <option value="PTP" selected>PTP</option>
                    <option value="PASAPORTE">PASAPORTE</option>
                    <option value="CPP">CPP</option>
                    <option value="OTRO">OTRO</option> 
                    <option value="SIN DOC">SIN DOC</option>                   
                    @elseif($pacientes->tipo_doc == 'PASAPORTE')
                    <option value="DNI" >DNI</option>
                    <option value="CE" >CE</option>
                    <option value="PTP" >PTP</option>
                    <option value="PASAPORTE" selected>PASAPORTE</option>
                    <option value="CPP">CPP</option>
                    <option value="OTRO">OTRO</option>  
                    <option value="SIN DOC">SIN DOC</option> 
                    @elseif($pacientes->tipo_doc == 'CPP')
                    <option value="DNI" >DNI</option>
                    <option value="CE" >CE</option>
                    <option value="PTP" >PTP</option>
                    <option value="PASAPORTE" >PASAPORTE</option>
                    <option value="CPP" selected>CPP</option>
                    <option value="OTRO">OTRO</option> 
                    <option value="SIN DOC">SIN DOC</option>  
                    @elseif($pacientes->tipo_doc == 'OTRO')
                    <option value="DNI" >DNI</option>
                    <option value="CE" >CE</option>
                    <option value="PTP" >PTP</option>
                    <option value="PASAPORTE" >PASAPORTE</option>
                    <option value="CPP" >CPP</option>
                    <option value="OTRO" selected>OTRO</option> 
                    <option value="SIN DOC">SIN DOC</option> 
                    @else
                    <option value="DNI" >DNI</option>
                    <option value="CE" >CE</option>
                    <option value="PTP" >PTP</option>
                    <option value="PASAPORTE" >PASAPORTE</option>
                    <option value="CPP" >CPP</option>
                    <option value="OTRO">OTRO</option> 
                    <option value="SIN DOC" selected>SIN DOC</option> 
                     @endif


                        </select>
                  </div>
                
              
                  </div>
                  <br>
                  <div class="row">
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Número de Documento</label>
                    <input type="text" class="form-control" id="nombre" name="dni" value="{{$pacientes->dni}}" placeholder="DNI">
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Direccion</label>
                    <input type="text" class="form-control" id="nombre" name="direccion" value="{{$pacientes->direccion}}" placeholder="Dirección de contacto">
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Teléfono</label>
                    <input type="text" class="form-control" id="nombre" name="telefono" value="{{$pacientes->telefono}}" placeholder="Telefono de contacto">
                  </div>
              
                  
                  </div>
                  <br>
                  <div class="row">
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control" id="nombre" name="email" value="{{$pacientes->email}}" placeholder="Email de contacto">
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Ocupación</label>
                    <input type="text" class="form-control" id="nombre" name="ocupacion" value="{{$pacientes->ocupacion}}" placeholder="Ocupación">
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Fecha de Nac</label>
                    <input type="date" class="form-control" id="nombre" name="fechanac" value="{{$pacientes->fechanac}}" placeholder="Nacimiento">
                  </div>
                  <div class="col-md-4">
                    <label for="exampleInputEmail1">Edo Civil</label>
                    <select class="form-control" name="edocivil">
                    <option value="Soltero">Soltero</option>
                    <option value="Casado">Casado</option>
                    <option value="Divorciado">Divorciado</option>
                    <option value="Concubinato">Concubinato</option>
                        </select>
                  </div>
                
                  
                  </div>

                  <input type="hidden" name="id" value="{{$pacientes->id}}">


        
                 
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

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->

</body>
</html>