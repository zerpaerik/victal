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

  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">

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
            <h1 class="m-0 text-dark">Reporte Total</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Reporte Total</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">   
    @include('flash-message')
      <div class="container-fluid">
      <div class="card">
              <div class="card-header">
              <form method="get" action="reporte_total">					
              <div class="row" style="margin-left: 10px;">
              <div class="col-md-4">
                    <label for="exampleInputEmail1">Mes</label>
                    <select class="form-control" name="mes">
                    @if($mes == '01')
                    <option value="01" selected>Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03" >Marzo</option>
                    <option value="04" >Abril</option>
                    <option value="05" >Mayo</option>
                    <option value="06" >Junio</option>
                    <option value="07" >Julio</option>
                    <option value="08" >Agosto</option>
                    <option value="09" >Septiembre</option>
                    <option value="10" >Octubre</option>
                    <option value="11" >Noviembre</option>
                    <option value="12" >Diciembre</option>
                    @elseif($mes == '02')
                    <option value="01" >Enero</option>
                    <option value="02" selected>Febrero</option>
                    <option value="03" >Marzo</option>
                    <option value="04" >Abril</option>
                    <option value="05" >Mayo</option>
                    <option value="06" >Junio</option>
                    <option value="07" >Julio</option>
                    <option value="08" >Agosto</option>
                    <option value="09" >Septiembre</option>
                    <option value="10" >Octubre</option>
                    <option value="11" >Noviembre</option>
                    <option value="12" >Diciembre</option>                   
                     @elseif($mes == '03')
                     <option value="01" >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03" selected >Marzo</option>
                    <option value="04" >Abril</option>
                    <option value="05" >Mayo</option>
                    <option value="06" >Junio</option>
                    <option value="07" >Julio</option>
                    <option value="08" >Agosto</option>
                    <option value="09" >Septiembre</option>
                    <option value="10" >Octubre</option>
                    <option value="11" >Noviembre</option>
                    <option value="12" >Diciembre</option>  
                    @elseif($mes == '04')
                    <option value="01" >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03"  >Marzo</option>
                    <option value="04" selected>Abril</option>
                    <option value="05" >Mayo</option>
                    <option value="06" >Junio</option>
                    <option value="07" >Julio</option>
                    <option value="08" >Agosto</option>
                    <option value="09" >Septiembre</option>
                    <option value="10" >Octubre</option>
                    <option value="11" >Noviembre</option>
                    <option value="12" >Diciembre</option>  
                    @elseif($mes == '05')
                    <option value="01" >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03"  >Marzo</option>
                    <option value="04" >Abril</option>
                    <option value="05" selected>Mayo</option>
                    <option value="06" >Junio</option>
                    <option value="07" >Julio</option>
                    <option value="08" >Agosto</option>
                    <option value="09" >Septiembre</option>
                    <option value="10" >Octubre</option>
                    <option value="11" >Noviembre</option>
                    <option value="12" >Diciembre</option>  
                    @elseif($mes == '06')
                    <option value="01" >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03"  >Marzo</option>
                    <option value="04" >Abril</option>
                    <option value="05" >Mayo</option>
                    <option value="06" selected>Junio</option>
                    <option value="07" >Julio</option>
                    <option value="08" >Agosto</option>
                    <option value="09" >Septiembre</option>
                    <option value="10" >Octubre</option>
                    <option value="11" >Noviembre</option>
                    <option value="12" >Diciembre</option>  
                    @elseif($mes == '07')
                    <option value="01" >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03"  >Marzo</option>
                    <option value="04" >Abril</option>
                    <option value="05" >Mayo</option>
                    <option value="06" >Junio</option>
                    <option value="07" selected>Julio</option>
                    <option value="08" >Agosto</option>
                    <option value="09" >Septiembre</option>
                    <option value="10" >Octubre</option>
                    <option value="11" >Noviembre</option>
                    <option value="12" >Diciembre</option>  
                    @elseif($mes == '08')
                    <option value="01" >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03"  >Marzo</option>
                    <option value="04" >Abril</option>
                    <option value="05" >Mayo</option>
                    <option value="06" >Junio</option>
                    <option value="07" >Julio</option>
                    <option value="08" selected>Agosto</option>
                    <option value="09" >Septiembre</option>
                    <option value="10" >Octubre</option>
                    <option value="11" >Noviembre</option>
                    <option value="12" >Diciembre</option>  
                    @elseif($mes == '09')
                    <option value="01" >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03"  >Marzo</option>
                    <option value="04" >Abril</option>
                    <option value="05" >Mayo</option>
                    <option value="06" >Junio</option>
                    <option value="07" >Julio</option>
                    <option value="08" >Agosto</option>
                    <option value="09" selected>Septiembre</option>
                    <option value="10" >Octubre</option>
                    <option value="11" >Noviembre</option>
                    <option value="12" >Diciembre</option>  
                    @elseif($mes == '10')
                    <option value="01" >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03"  >Marzo</option>
                    <option value="04" >Abril</option>
                    <option value="05" >Mayo</option>
                    <option value="06" >Junio</option>
                    <option value="07" >Julio</option>
                    <option value="08" >Agosto</option>
                    <option value="09" >Septiembre</option>
                    <option value="10" selected>Octubre</option>
                    <option value="11" >Noviembre</option>
                    <option value="12" >Diciembre</option>  
                    @elseif($mes == '11')
                    <option value="01" >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03"  >Marzo</option>
                    <option value="04" >Abril</option>
                    <option value="05" >Mayo</option>
                    <option value="06" >Junio</option>
                    <option value="07" >Julio</option>
                    <option value="08" >Agosto</option>
                    <option value="09" >Septiembre</option>
                    <option value="10" >Octubre</option>
                    <option value="11" selected>Noviembre</option>
                    <option value="12" >Diciembre</option> 
                     @elseif($mes == '12')
                     <option value="01" >Enero</option>
                    <option value="02" >Febrero</option>
                    <option value="03"  >Marzo</option>
                    <option value="04" >Abril</option>
                    <option value="05" >Mayo</option>
                    <option value="06" >Junio</option>
                    <option value="07" >Julio</option>
                    <option value="08" >Agosto</option>
                    <option value="09" >Septiembre</option>
                    <option value="10" >Octubre</option>
                    <option value="11" >Noviembre</option>
                    <option value="12" selected>Diciembre</option> 
                    @else
                    @endif
                    </select>                  
                    </div>
                    <div class="col-md-2">
                    <label for="exampleInputEmail1">Año</label>
                    <select class="form-control" name="anio">
                    <option value="2021" selected>2021</option> 
                   
                    </select>                  
                    </div>
                  
                
                 
                  <div class="col-md-2" style="margin-top: 30px;">
                  <button type="submit" class="btn btn-primary">Buscar</button>
                 
              

                  </div>
                  </form>

           
                     
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Ingresos</th>
                    <th>Pagos a Personal</th>
                    <th>Gastos Externos</th>
                    <th>Comisiones Personal</th>
                    <th>Comisiones Profesional</th>
                    <th>Gastos Diarios</th>
                    <th>Saldo Total</th>
                  </tr>
                  </thead>
                  <tbody>


                  <tr>
                    <td><span class="badge bg-success">{{$total->monto}}</span></td>
                    <td>{{round($pagosp->monto,2)}}</td>
                    <td>{{round($gastose->monto,2)}}</td>
                    <td>{{round($comisionesp->monto,2)}}</td>
                    <td>{{round($comisionespp->monto,2)}}</td>
                    <td>{{round($gastosd->monto,2)}}</td>
                    <td>{{round($total->monto - $pagosp->monto - $gastose->monto - $comisionesp->monto - $comisionespp->monto - $gastosd->monto,2)}}</td>
                  
                  </tr>
                 
                 
               
                 
                 
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Ingresos</th>
                    <th>Pagos a Personal</th>
                    <th>Gastos Externos</th>
                    <th>Comisiones Personal</th>
                    <th>Comisiones Profesional</th>
                    <th>Gastos Diarios</th>
                    <th>Saldo Total</th>
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

  <div class="modal fade" id="viewTicket">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            </div>
           
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
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

<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

<script type="text/javascript">
		function view(e){
		    var id = $(e).attr('id');
		    
		    $.ajax({
		        type: "GET",
		        url: "/productos/descargar/"+id,
		        success: function (data) {
		            $("#viewTicket .modal-body").html(data);
		            $('#viewTicket').modal('show');
		        },
		        error: function (data) {
		            console.log('Error:', data);
		        }
		    });
		}

	
	</script>

<script type="text/javascript">
		function view1(e){
		    var id = $(e).attr('id');
		    
		    $.ajax({
		        type: "GET",
		        url: "/productos/editc/"+id,
		        success: function (data) {
		            $("#viewTicket .modal-body").html(data);
		            $('#viewTicket').modal('show');
		        },
		        error: function (data) {
		            console.log('Error:', data);
		        }
		    });
		}

	
	</script>

<script type="text/javascript">
		function viewr(e){
		    var id = $(e).attr('id');

		    
		    $.ajax({
		        type: "GET",
		        url: "/productos/requerimiento/"+id,
		        success: function (data) {
		            $("#viewTicket .modal-body").html(data);
		            $('#viewTicket').modal('show');
		        },
		        error: function (data) {
		            console.log('Error:', data);
		        }
		    });
		}

	
	</script>

<script type="text/javascript">
		function viewh(e){
		    var id = $(e).attr('id');

		    
		    $.ajax({
		        type: "GET",
		        url: "/productos/historial/"+id,
		        success: function (data) {
		            $("#viewTicket .modal-body").html(data);
		            $('#viewTicket').modal('show');
		        },
		        error: function (data) {
		            console.log('Error:', data);
		        }
		    });
		}

	
	</script>
<!-- page script -->
<script>

$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excel', 'pdf', 'print'
        ]
    } );
} );
</script>

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
