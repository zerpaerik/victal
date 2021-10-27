<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Historia Clínica | Admin</title>
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
            <h1 class="m-0 text-dark">Historia de Paciente</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Historia</li>
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
                <h3 class="card-title">Agregar</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->


              <div class="card-body">
              <label for="exampleInputEmail1">DATOS DE PACIENTE</label>

              <div class="row">
                     <div class="col-md-3">
                    <label for="exampleInputEmail1">NOMBRES Y APELLIDOS</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" value="{{$paciente->apellidos.' '.$paciente->nombres}} " name="gestas" placeholder="">
                   </div>

                   <div class="col-md-3">
                    <label for="exampleInputEmail1">DNI:</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" value="{{$paciente->dni}} " name="gestas" placeholder="">
                   </div>

                   <div class="col-md-3">
                    <label for="exampleInputEmail1">FECHA DE NACIMIENTO:</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" value="{{$paciente->fechanac}} " name="gestas" placeholder="">
                   </div>
                  
                   <div class="col-md-3">
                    <label for="exampleInputEmail1">TELÉFONO:</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" value="{{$paciente->telefono}} " name="gestas" placeholder="">
                   </div>
                  
                  
                  
                    </div>

                    <div class="row">
                   

                   <div class="col-md-3">
                    <label for="exampleInputEmail1">ATENDIDO POR:</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" value="{{$hist->name.' '.$hist->lastname}} " name="gestas" placeholder="">
                   </div>
                  
                  
                    </div>
                  
              
                    
                   <label for="exampleInputEmail1">HISTORIAL BASE</label>
                   <div class="row">
                     <div class="col-md-4">
                    <label for="exampleInputEmail1">Alergias</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled name="alerg" value="{{$historias_base->alergias}}">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Antecedentes Personales</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled name="per" value="{{$historias_base->ant_per}}">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Antecedentes Familiares</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled name="fam" value="{{$historias_base->ant_fam}}">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Antecedentes Patológicos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled name="pat" value="{{$historias_base->ant_pat}}">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Edad de 1era Rel Sexual</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$historias_base->sex}}">
                   </div>
                    </div>
                  
                   
            
                    <div class="card-body">
                    <label for="exampleInputEmail1">Fecha: {{$hist->created_at }}</label>
                    <div class="row">
                     <div class="col-md-12">
                    <label for="exampleInputEmail1">Motivo de Consulta</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$hist->motivo}}">

                   </div>
                    </div>
                   <label for="exampleInputEmail1">Funciones Vitales</label>
                   <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">P/A</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled  id="nombre" name="pa" placeholder="" value="{{$hist->pa}}">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Pulso</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="pulso" placeholder="" value="{{$hist->pulso}}">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Temp</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="temp" placeholder="" value="{{$hist->temp}}">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Peso</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="peso" placeholder="" value="{{$hist->peso}}">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Talla</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="talla" placeholder="" value="{{$hist->talla}}">
                   </div>
    
                    </div>
                   <label for="exampleInputEmail1">Funciones Biológicas</label>
                   <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">Apetito</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="talla" placeholder="" value="{{$hist->apetito}}">

                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Sed</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="talla" placeholder="" value="{{$hist->sed}}">
                 
                        </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Animo</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="talla" placeholder="" value="{{$hist->animo}}">

                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Frec.Mic</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="mic" placeholder="" value="{{$hist->mic}}">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">R/C</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="rc" placeholder="" value="{{$hist->rc}}">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Frec.Dep</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="dep" placeholder="" value="{{$hist->dep}}">
                   </div>

                    </div>
                   <label for="exampleInputEmail1">Antecedentes</label>
                   <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">FUR</label>
                    <input type="date"  class="form-control" id="nombre" name="fur" placeholder="" disabled  value="{{$hist->fur}}">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">PAP</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="pap" placeholder=""  value="{{$hist->pap}}">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">MAC</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="mac" placeholder=""  value="{{$hist->mac}}">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Andria</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="andria" placeholder=""  value="{{$hist->andria}}">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">G</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="g" placeholder=""  value="{{$hist->g}}">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">P</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="p" placeholder=""  value="{{$hist->p}}">
                   </div>
    
                    </div>
                    <label for="exampleInputEmail1">Examen Físico y Regional</label>
                   <div class="row">
                     <div class="col-md-4">
                    <label for="exampleInputEmail1">Piel/Mucosas</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"  class="form-control" disabled id="nombre" name="piel" placeholder=""  value="{{$hist->piel}}">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Mamas</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="mamas" placeholder=""  value="{{$hist->mamas}}">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Abdomen</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="abdomen" placeholder=""  value="{{$hist->abdomen}}">
                   </div>
                 
    
                    </div>
                    <div class="row">
                     <div class="col-md-4">
                    <label for="exampleInputEmail1">Genitales Externos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"  class="form-control" disabled id="nombre" name="gen_ext" placeholder=""  value="{{$hist->ext}}">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Genitales Internos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="gen_int" placeholder=""  value="{{$hist->int}}">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Miembros Inferiores</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="miem_inf" placeholder=""  value="{{$hist->miem}}">
                   </div>
    
                    </div>
                    <div class="row">
                     <div class="col-md-6">
                    <label for="exampleInputEmail1">Evolución de Enfermedad</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="miem_inf" placeholder=""  value="{{$hist->evo}}">

                   </div>
                   <div class="col-md-6">
                    <label for="exampleInputEmail1">Tipo de Enfermedad</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="miem_inf" placeholder=""  value="{{$hist->tipo}}">
      
                         </div>
                
                    </div>
                    <br>
                    <div class="row">
                     <div class="col-md-6">
                    <label for="exampleInputEmail1">Presunción Diagnóstica</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$hist->pd}}">

                   </div>
                   <div class="col-md-6">
                    <label for="exampleInputEmail1">CIE X</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="miem_inf" placeholder=""  value="{{$hist->cie}}">
                   
                   </select>           
                    </div>
                
                    </div>
                    <div class="row">
                     <div class="col-md-6">
                    <label for="exampleInputEmail1">Diagnóstico Final</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$hist->df}}">

                   </div>
                   <div class="col-md-6">
                    <label for="exampleInputEmail1">CIE X</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="miem_inf" placeholder=""  value="{{$hist->cie1}}">
          
                    </div>
                
                    </div>
                    <div class="row">
                     <div class="col-md-12">
                    <label for="exampleInputEmail1">Examen Auxiliar</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$hist->ex_aux}}">
                  </div>
                    </div>
                   <div class="row">
                     <div class="col-md-12">
                    <label for="exampleInputEmail1">Plan de Tratamiento</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$hist->plan}}">

                  </div>
                    </div>
                   <div class="row">
                     <div class="col-md-12">
                    <label for="exampleInputEmail1">Observaciones</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$hist->obser}}">
                   </div>
                    </div>
                   <div class="row">
                     <div class="col-md-3">
                    <label for="exampleInputEmail1">Próxima Consulta</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="prox" placeholder="Observaciones" value="{{$hist->prox}}">
                   </div>
                    </div>
                    <div class="row">
                     <div class="col-md-12">
                    <label for="exampleInputEmail1">Observaciones Reevaluación</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$hist->observacion}}">
                   </div>
                    </div>
                    <div class="row">
                     <div class="col-md-12">
                    <label for="exampleInputEmail1">Reevaluado Por:</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$hist->usuario_reevalua}}">
                   </div>
                    </div>
                    <br>


                </div>
                <!-- /.card-body -->

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