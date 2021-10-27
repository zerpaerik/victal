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
            <h1 class="m-0 text-dark">Resultados Por Hacer Laboratorio</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Resultados Por Hacer Laboratorio</li>
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
              <form method="get" action="resultadosl">					
                  <label for="exampleInputEmail1">Filtros de Busqueda</label>

                    <div class="row">
                  <div class="col-md-3">
                    <label for="exampleInputEmail1">Fecha Inicio</label>
                    <input type="date" class="form-control" value="{{$f1}}" name="inicio">
                  </div>

                  <div class="col-md-3">
                    <label for="exampleInputEmail1">Fecha Fin</label>
                    <input type="date" class="form-control" value="{{$f2}}" name="fin">
                  </div>
                  
                
                 
                  <div class="col-md-2" style="margin-top: 30px;">
                  <button type="submit" class="btn btn-primary">Buscar</button>

                  </div>
                  </form>
              
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  <th>id</th>
                    <th>Fecha</th>
                    <th>Pac.</th>
                    <th>Origen</th>
                    <th>Det.</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>

                  @foreach($resultados as $an)
                  <tr>
                  <td>{{$an->id}}</td>
                   <td>{{$an->created_at}}</td>
                   @if($an->monto > $an->abono)
                    <td style="background: yellow;" title="ESTE PACIENTE TIENE DEUDA PENDIENTE">{{$an->apellidos}} {{$an->nombres}}</td>
                    @else
                    <td>{{$an->apellidos}} {{$an->nombres}}</td>
                    @endif                    
                     <td>{{$an->lastname}} {{$an->name}}</td>
                    <td>{{$an->laboratorio}}</td>

                    <td>
                    @if($an->informe) 

                      <a href="resultados-desocl-{{$an->id}}" class="btn btn-danger">Reversar</a>

                      <a href="/modelo-informel-{{$an->id}}-{{$an->informe}}" class="btn btn-primary" target="_blank">Descargar Modelo</a>

                      <a href="resultados-guardarl-{{$an->id}}" class="btn btn-success">Adjuntar Informe</a>


                      @else



                        <form action="{{'resultados-asocl-' .$an->id}}" method="get">
                                    <select class="form-control" name="informe">
                                    <option value="">Seleccione</option>
                                    <option value="ACIDO URICO.docx">ACIDO URICO</option>
                                    <option value="AGLUTINACIONES.docx">AGLUTINACIONES</option>
                                    <option value="ALFA FETOPROTEINAS.docx">ALFA FETOPROTEINASsss</option>
                                    <option value="AMILASA SERICA.docx">AMILASA SERICA</option>
									                  <option value="ANTIGENO SARS CoV 2.docx">ANTIGENO SARS CoV 2</option>
                                    <option value="ASO.docx">ASO</option>
                                    <option value="BETA HCG(cuantitativo).docx">BETA HCG(cuantitativo)</option>
                                    <option value="BK-SERIADO.docx">BK-SERIADO</option>
                                    <option value="CAMPAÑA.docx">CAMPAÑA</option>
                                    <option value="COLESTEROL TOTAL.docx">COLESTEROL TOTAL</option>
                                    <option value="COPROFUNCIONAL.docx">COPROFUNCIONAL</option>
                                    <option value="CPK-MB.docx">CPK-MB</option>
                                    <option value="CREATININA.docx">CREATININA</option>
                                    <option value="CULTIVO SECRECION.docx">CULTIVO SECRECION</option>
                                    <option value="CONSTANTES CORPUSCULARES.docx">CONSTANTES CORPUSCULARES</option>
                                    <option value="CULTIVO DE SECRECION VAGINAL POSITIVO.docx">CULTIVO DE SECRECION VAGINAL POSITIVO</option>
                                    <option value="CULTIVO DE SEMEN  NEGATIVO.docx">CULTIVO DE SEMEN  NEGATIVO</option>
                                    <option value="DOSAJE DE POTASIO.docx">DOSAJE DE POTASIO</option>
                                    <option value="ESPERMATOGRAMA.docx">ESPERMATOGRAMA</option>
                                    <option value="EX. COMPLETO DE ORINA.docx">EX. COMPLETO DE ORINA</option>
                                    <option value="EXTRADIOL.docx">EXTRADIOL</option>
                                    <option value="FTA.docx">FTA</option>
                                    <option value="GLOCOSA POST PANDRIAL.docx">GLOCOSA POST PANDRIAL</option>
                                    <option value="GLOCOSA.docx">GLOCOSA</option>
                                    <option value="GLU - COLT - TRIG.docx">GLU - COLT - TRIG</option>
                                    <option value="GRUPO SANGUINEO.docx">GRUPO SANGUINEO</option>
                                    <option value="HEMOGLOBINA.docx">HEMOGLOBINA</option>
                                    <option value="HEMOGRAMA COMPLETA.docx">HEMOGRAMA COMPLETA</option>
                                    <option value="HEMOGLOBINA GLUCOSILADA.docx">HEMOGLOBINA GLUCOSILADA</option>
                                    <option value="HEMOGLOBINA -HEMATOCRITO.docx">HEMOGLOBINA -HEMATOCRITO</option>
                                    <option value="HEPATITIS B.docx">HEPATITIS B</option>
                                    <option value="HIV.docx">HIV</option>
                                    <option value="LIPASA.docx">LIPASA</option>
                                    <option value="PARASITO SERIADO.docx">PARASITO SERIADO</option>
                                    <option value="PARASITOLOGICO SIMPLE.docx">PARASITOLOGICO SIMPLE</option>
                                    <option value="PCR.docx">PCR</option>
                                    <option value="PERFIL DE COAGULACION.docx">PERFIL DE COAGULACION</option>
                                    <option value="PERFIL HEPATICO.docx">PERFIL HEPATICO</option>
                                    <option value="PERFIL LIPIDICO.docx">PERFIL LIPIDICOs</option>
                                    <option value="PERFIL OBSTETRICO.docx">PERFIL OBSTETRICO</option>
                                    <option value="PERFIL TIROIDEO.docx">PERFIL TIROIDEO</option>
                                    <option value="PROTENURIA.docx">PROTENURIA</option>
                                    <option value="PSA TOTAL.docx">PSA TOTAL</option>
								                  	<option value="PRUEBA RAPIDA.docx">PRUEBA RAPIDA</option>
									                  <option value="PRUEBA RAPIDA PDF.docx">PRUEBA RAPIDA PDF</option>
                                    <option value="RECUENTO DE PLAQUETAS.docx">RECUENTO DE PLAQUETAS</option>
                                    <option value="RPR.docx">RPR</option>
                                    <option value="RASPADO DE PIEL.docx">RASPADO DE PIEL</option>
								                  	<option value="ROXANA_LAB.docx">ROXANA LAB</option>
                                    <option value="RX.INFLAMATORIO.docx">RX.INFLAMATORIO</option>
                                    <option value="SECRECION VAGINAL.docx">SECRECION VAGINAL</option>
                                    <option value="SECRECION FARINGEA.docx">SECRECION FARINGEA</option>
                                    <option value="SECRECION URETRAL.docx">SECRECION URETRAL</option>
                                    <option value="SUB UNIDAD NEGATIVO.docx">SUB UNIDAD NEGATIVO</option>
                                    <option value="SUB UNIDAD POSITIVO.docx">SUB UNIDAD POSITIVO</option>
                                    <option value="TEST DE GRAHAM.docx">TEST DE GRAHAM</option>
                                    <option value="THEVENON.docx">THEVENON</option>
                                    <option value="TIEMPO DE COAGULACION - TIEMPO DE SANGRIA.docx">TIEMPO DE COAGULACION - TIEMPO DE SANGRIA</option>
                                    <option value="TRIGLICERIDOS.docx">TRIGLICERIDOS</option>
                                    <option value="TSH.docx">TSH</option>
                                    <option value="UREA.docx">UREA</option>
                                    <option value="UROCULTIVO NEGATIVO.docx">UROCULTIVO NEGATIVO</option>
                                    <option value="UROCULTIVO POSITIVO.docx">UROCULTIVO POSITIVO</option>
                                    <option value="VOLUMEN CORPUSCULARES.docx">VOLUMEN CORPUSCULARES</option>
                                    <option value="VSG.docx">VSG</option>

                                   
                                    
                                    </select>

                                </td>
                                <td>

                                <input type="hidden" name="id" value="{{$an->id}}">


                                <input type="submit" class="btn btn-success" value="Asociar">
                                </td>


                              </tr>
                              </form>
                              @endif

                                        

                                              

                                              
                         </td>
                  </tr>
                  @endforeach
                 
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>id</th>
                    <th>Fecha</th>
                    <th>Pac.</th>
                    <th>Origen</th>
                    <th>Det.</th>
                    <th>

                    </th>
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
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
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
