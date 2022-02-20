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
<link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css"> 


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
            <h1 class="m-0 text-dark">Atenciones</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Atenciones</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
    <!-- @include('flash-message') -->
      <div class="container-fluid">
      <div class="card">
              <div class="card-header">
              
                <form method="get" action="reporte_servicios">					
                  <label for="exampleInputEmail1">Filtros de Busqueda</label>

                    <div class="row" style="margin-left:10px;">
                    <div class="col-md-3">
                    <label for="exampleInputEmail1">Fecha Inicio</label>
                    <input type="date" class="form-control" value="{{$f1}}" name="inicio">
                  </div>

                  <div class="col-md-3">
                    <label for="exampleInputEmail1">Fecha Fin</label>
                    <input type="date" class="form-control" value="{{$f2}}" name="fin">
                  </div>
                  <div class="col-md-3">
                    <label for="exampleInputEmail1">Tipo</label>
                    <select class="form-control" name="tipo">
                    @if($tipo == '1')
                    <option value="1" selected>Procedimiento</option>
                    <option value="2">Ecografia</option>
                    <option value="3">Rayos X</option>
                    <option value="8">Salud Mental</option>
                    <option value="4">Laboratorios</option>
                    <option value="7">Paquetes</option>
                    <option value="5">Consultas/Controles</option>
                    <option value="6">Métodos</option>
                    <option value="12">Estética</option>
                    <option value="13">MTC</option>
                    @elseif($tipo == '2')
                    <option value="1" >Procedimiento</option>
                    <option value="2" selected>Ecografia</option>
                    <option value="3">Rayos X</option>
                    <option value="8">Salud Mental</option>
                    <option value="4">Laboratorios</option>
                    <option value="7">Paquetes</option>
                    <option value="5">Consultas/Controles</option>
                    <option value="6">Métodos</option>
                    <option value="12">Estética</option>
                    <option value="13">MTC</option>
                    @elseif($tipo == '3')
                    <option value="1" >Procedimiento</option>
                    <option value="2" >Ecografia</option>
                    <option value="3" selected>Rayos X</option>
                    <option value="8">Salud Mental</option>
                    <option value="4">Laboratorios</option>
                    <option value="7">Paquetes</option>
                    <option value="5">Consultas/Controles</option>
                    <option value="6">Métodos</option>
                    <option value="12">Estética</option>
                    <option value="13">MTC</option>
                    @elseif($tipo == '4')
                    <option value="1" >Procedimiento</option>
                    <option value="2" >Ecografia</option>
                    <option value="3" >Rayos X</option>
                    <option value="8">Salud Mental</option>
                    <option value="4" selected>Laboratorios</option>
                    <option value="7">Paquetes</option>
                    <option value="5">Consultas/Controles</option>
                    <option value="6">Métodos</option>
                    <option value="12">Estética</option>
                    <option value="13">MTC</option>
                    @elseif($tipo == '5')
                    <option value="1" >Procedimiento</option>
                    <option value="2" >Ecografia</option>
                    <option value="3" >Rayos X</option>
                    <option value="8">Salud Mental</option>
                    <option value="4" >Laboratorios</option>
                    <option value="7">Paquetes</option>
                    <option value="5" selected>Consultas/Controles</option>
                    <option value="6">Métodos</option>
                    <option value="12">Estética</option>
                    <option value="13">MTC</option>
                    @elseif($tipo == '6')
                    <option value="1" >Procedimiento</option>
                    <option value="2" >Ecografia</option>
                    <option value="3" >Rayos X</option>
                    <option value="8">Salud Mental</option>
                    <option value="4" >Laboratorios</option>
                    <option value="7">Paquetes</option>
                    <option value="5" >Consultas/Controles</option>
                    <option value="6" selected>Métodos</option>
                    <option value="12">Estética</option>
                    <option value="13">MTC</option>
                    @elseif($tipo == '7')
                    <option value="1" >Procedimiento</option>
                    <option value="2" >Ecografia</option>
                    <option value="3" >Rayos X</option>
                    <option value="8">Salud Mental</option>
                    <option value="4" >Laboratorios</option>
                    <option value="7" selected>Paquetes</option>
                    <option value="5" >Consultas/Controles</option>
                    <option value="6" >Métodos</option>
                    <option value="12">Estética</option>
                    <option value="13">MTC</option>
                    @elseif($tipo == '12')
                    <option value="1" >Procedimiento</option>
                    <option value="2" >Ecografia</option>
                    <option value="3" >Rayos X</option>
                    <option value="8">Salud Mental</option>
                    <option value="4" >Laboratorios</option>
                    <option value="7" >Paquetes</option>
                    <option value="5" >Consultas/Controles</option>
                    <option value="6" >Métodos</option>
                    <option value="12" selected>Estética</option>
                    <option value="13">MTC</option>
                    @elseif($tipo == '12')
                    <option value="1" >Procedimiento</option>
                    <option value="2" >Ecografia</option>
                    <option value="3" >Rayos X</option>
                    <option value="8">Salud Mental</option>
                    <option value="4" >Laboratorios</option>
                    <option value="7" >Paquetes</option>
                    <option value="5" >Consultas/Controles</option>
                    <option value="6" >Métodos</option>
                    <option value="12" >Estética</option>
                    <option value="13" selected>MTC</option>
                    @else
                    <option value="1" >Procedimiento</option>
                    <option value="2" >Ecografia</option>
                    <option value="3" >Rayos X</option>
                    <option value="8" selected>Salud Mental</option>
                    <option value="4" >Laboratorios</option>
                    <option value="7" >Paquetes</option>
                    <option value="5" >Consultas/Controles</option>
                    <option value="6" >Métodos</option>
                    @endif


                  
                    </select>                  
                    </div>

               
                  
                
                 
                  <div class="col-md-2" style="margin-top: 30px;">
                  <button type="submit" class="btn btn-primary">Buscar</button>

                  </div>
                  </form>

                  @if($totales)
                  <div class="row" style="margin-left: 5px;">
                    <div class="col-md-2">
                    <label for="exampleInputEmail1">Total</label>
                    <input type="text" disabled class="form-control" value="{{$totales->monto}}">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Items</label>
                    <input type="text" disabled class="form-control" value="{{$totales->cantidad}}" >
                  </div>
                  </div>
                  @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Fecha</th>
                    <th>Paciente</th>
                    <th>Origen</th>
                    <th>Detalle</th>
                    <th>Mto</th>
                    <th>Abo</th>
                    <th>Tp</th>
                    <th>PG</th>
                    <th>AT</th>
                    <th>RP</th>
                  </tr>
                  </thead>
                  <tbody>


                  @foreach($atenciones as $an)
                  <tr>
                  <td>{{$an->id}}</td>
                    <td>{{date('d-M-y H:i', strtotime($an->created_at))}}</td>
                    <td>{{$an->apellidos}} {{$an->nombres}}</td>
                    <td>{{$an->lasto}} {{$an->nameo}}</td>
                    <td>{{$an->detalle}}</td>
                    <td>{{round($an->monto,2)}}</td>
                    <td>{{round($an->abono,2)}}</td>
                    <td >{{$an->tipo_pago}}</td>
                    @if($an->pagado == 1)
                    <td><span class="badge bg-danger">NO</span></td>
                    @else
                    <td><span class="badge bg-success">SI</span></td>
                    @endif
                    @if($an->atendido == 1)
                    <td><span class="badge bg-danger">NO</span></td>
                    @else
                    <td><span class="badge bg-success">SI</span></td>
                    @endif
                    <td>{{substr($an->lastu,0,5)}} {{substr($an->nameu,0,5)}}</td>

                  
                  </tr>
                  @endforeach
                 
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Id</th>
                    <th>Fecha</th>
                    <th>Paciente</th>
                    <th>Origen</th>
                    <th>Detalle</th>
                    <th>Mto</th>
                    <th>Abo</th>
                    <th>Tp</th>
                    <th>PG</th>
                    <th>AT</th>
                    <th>RP</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  </div>
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

<script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
<script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>


<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('success'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('success') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      dom: 'Bfrtip',
      buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
