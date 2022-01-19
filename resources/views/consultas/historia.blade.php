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
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
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
              <div class="row">
                     <div class="col-md-3">
                    <label for="exampleInputEmail1">PACIENTE</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" value="{{$paciente->apellidos.' '.$paciente->nombres}} " name="gestas" placeholder="">
                   </div>
                  
                    </div>

              @if($hist)
              <div class="card-body">
              
                    
                   <label for="exampleInputEmail1">HISTORIAL BASE</label>
                   <div class="row">
                     <div class="col-md-4">
                    <label for="exampleInputEmail1">Alergias</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled name="alerg" value="{{$hist->alergias}}">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Antecedentes Personales</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled name="per" value="{{$hist->ant_per}}">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Antecedentes Familiares</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled name="fam" value="{{$hist->ant_fam}}">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Antecedentes Patológicos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled name="pat" value="{{$hist->ant_pat}}">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Edad de 1era Rel Sexual</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$hist->sex}}">
                   </div>
                    </div>
                  
                   
              @else

              <div class="row" style = "margin-bottom: -20px;">

                     <div class="col-md-12" style="margin-left: 20px; color: red;">
                     <label for="exampleInputEmail1">NO TIENE HISTORIAL BASE, DEBE PROCEDER A CREARLO</label>
                   </div>
                   
                    </div>

              <form role="form" method="post" action="historiab/guardar">
					{{ csrf_field() }}                
                    <div class="card-body">
                    
                   <div class="row">
                     <div class="col-md-4">
                    <label for="exampleInputEmail1">Alergias</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="alerg" placeholder="">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Antecedentes Personales</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="per" placeholder="">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Antecedentes Familiares</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fam" placeholder="">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Antecedentes Patológicos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="pat" placeholder="">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Edad de 1era Rel Sexual</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="sexo" placeholder="">
                   </div>
                    </div>
                  

                        <input type="hidden" name="consulta" value="{{$consulta->id}}">

                 
                                                      

                  <br>
                  <input type="hidden" name="control" value="">

               

                
                 
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
              @endif

              @foreach($historias as $hist)

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
                     <div class="col-md-6">
                    <label for="exampleInputEmail1">Examen Auxiliar Servicios</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$hist->ex_aux_s}}">
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputEmail1">Examen Auxiliar Laboratorios</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$hist->ex_aux_l}}">
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
                    <label for="exampleInputEmail1">Observacionesss</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  name="sexo" value="{{$hist->obser}}">
                   </div>
                    </div>
                   <div class="row">
                     <div class="col-md-3">
                    <label for="exampleInputEmail1">Próxima Consulta</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="prox" placeholder="Observaciones" value="{{$hist->prox}}">
                   </div>
                    </div>

                    <br>


                </div>
                <!-- /.card-body -->

            </div>
            @endforeach



             
              

              <form role="form" method="post" action="historia/guardar">
					{{ csrf_field() }}                
                    <div class="card-body">
                    <div class="row">
                     <div class="col-md-12">
                    <label for="exampleInputEmail1">Motivo de Consulta</label>
                    <textarea class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" rows="3"  name="motivo" placeholder="Motivo de Consulta"></textarea>

                   </div>
                    </div>
                   <br>
                   <label for="exampleInputEmail1">Funciones Vitales</label>
                   <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">P/A</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="pa" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Pulso</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="pulso" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Temp</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="temp" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Peso</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="peso" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Talla</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="talla" placeholder="">
                   </div>
    
                    </div>
                    <br>
                   <label for="exampleInputEmail1">Funciones Biológicas</label>
                   <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">Apetito</label>
                    <select class="form-control" name="apetito">
                    <option value="AUMENTADO">AUMENTADO</option>
                    <option value="NORMAL">NORMAL</option>
                    <option value="DISMINUIDO">DISMINUIDO</option>
                    </select>
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Sed</label>
                    <select class="form-control" name="sed">
                    <option value="AUMENTADO">AUMENTADO</option>
                    <option value="NORMAL">NORMAL</option>
                    <option value="DISMINUIDO">DISMINUIDO</option>
                        </select>                   
                        </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Animo</label>
                    <select class="form-control" name="animo">
                    <option value="NORMAL">NORMAL</option>
                    <option value="DEPRIMIDO">DEPRIMIDO</option>
                    <option value="EUFÓRICO">EUFÓRICO</option>
                    <option value="FREC LLANTO">FREC LLANTO</option>
                   </select>
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Frec.Mic</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="mic" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">R/C</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="rc" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Frec.Dep</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="dep" placeholder="">
                   </div>

                    </div>
                    <br>
                   <label for="exampleInputEmail1">Antecedentes</label>
                   <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">FUR</label>
                    <input type="date"  class="form-control" id="nombre" name="fur" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">PAP</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="pap" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">MAC</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="mac" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Andria</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="andria" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">G</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="g" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">P</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="p" placeholder="">
                   </div>
    
                    </div>
                    <br>
                    <label for="exampleInputEmail1">Examen Físico y Regional</label>
                   <div class="row">
                     <div class="col-md-4">
                    <label for="exampleInputEmail1">Piel/Mucosas</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"  class="form-control" id="nombre" name="piel" placeholder="">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Mamas</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="mamas" placeholder="">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Abdomen</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="abdomen" placeholder="">
                   </div>
                 
    
                    </div>
                    <div class="row">
                     <div class="col-md-4">
                    <label for="exampleInputEmail1">Genitales Externos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();"  class="form-control" id="nombre" name="gen_ext" placeholder="">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Genitales Internos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="gen_int" placeholder="">
                   </div>
                   <div class="col-md-4">
                    <label for="exampleInputEmail1">Miembros Inferiores</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="miem_inf" placeholder="">
                   </div>
    
                    </div>
                    <br>
                    <div class="row">
                     <div class="col-md-6">
                    <label for="exampleInputEmail1">Evolución de Enfermedad</label>
                    <select class="form-control" name="evo_enf">
                    <option value="INSIDIOSO">INSIDIOSO</option>
                    <option value="PROGRESIVO">PROGRESIVO</option>
                   </select>
                   </div>
                   <div class="col-md-6">
                    <label for="exampleInputEmail1">Tipo de Enfermedad</label>
                    <select class="form-control" name="tipo_enf">
                    <option value="AGUDO">AGUDO</option>
                    <option value="CRÓNICO">CRÓNICO</option>
                   </select>           
                         </div>
                
                    </div>
                    <br>
                    <div class="row">
                     <div class="col-md-6">
                    <label for="exampleInputEmail1">Presunción Diagnóstica</label>
                    <textarea class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" rows="2"  name="pre_diag" placeholder="Presunción Diagnóstica"></textarea>

                   </div>
                   <div class="col-md-6">
                    <label for="exampleInputEmail1">CIE X</label>
                    <select class="form-control select2" name="cie_pd">
                    @foreach($cie as $c)
                    <option value="{{$c->codigo}} {{$c->nombre}}">{{$c->codigo}} {{$c->nombre}}</option>
                    @endforeach
                   </select>           
                    </div>
                
                    </div>
                    <br>
                    <div class="row">
                     <div class="col-md-6">
                    <label for="exampleInputEmail1">Diagnóstico Final</label>
                    <textarea class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" rows="2"  name="diag_fin" placeholder="Diagnóstico Final"></textarea>

                   </div>
                   <div class="col-md-6">
                    <label for="exampleInputEmail1">CIE X</label>
                    <select class="form-control select2" name="cie_df">
                    @foreach($cie1 as $c1)
                    <option value="{{$c1->codigo}} {{$c1->nombre}}">{{$c1->codigo}} {{$c1->nombre}}</option>
                    @endforeach
                   </select>           
                    </div>
                    
                
                    </div>
                    <br>
                    <div class="row">
                     <div class="col-md-6">
                    <label for="exampleInputEmail1">Examen Auxiliar(Servicios)</label>
                    <select class="form-control select2" name="ex_aux_s[]" multiple>
                    @foreach($servicios as $s)
                    <option value="{{$s->id}}">{{$s->nombre}}</option>
                    @endforeach
                   </select>    
                  </div>
                  <div class="col-md-6">
                    <label for="exampleInputEmail1">Examen Auxiliar(Laboratorios)</label>
                    <select class="form-control select2" name="ex_aux_l[]" multiple>
                    @foreach($analisis as $s)
                    <option value="{{$s->id}}">{{$s->nombre}}</option>
                    @endforeach
                   </select> 
                  </div>
                    </div>
                   <br>
                 

                    <label for="exampleInputEmail1">Plan de Tratamiento</label>
            <!-- sheepIt Form -->
            <div id="laboratorios" class="embed ">
            
                <!-- Form template-->
                <div id="laboratorios_template" class="template row">

                    <label for="laboratorios_#index#_laboratorio" class="col-sm-1 control-label">Productos</label>
                    <div class="col-sm-4">
                      <select id="laboratorios_#index#_laboratorio" name="id_laboratorio[laboratorios][#index#][laboratorio]" class="selectLab form-control select22">
                        <option value="1">Seleccionar Producto</option>
                        @foreach($productos as $pac)
                          <option value="{{$pac->id}}">
                            {{$pac->nombre}} {{$pac->activo}}
                          </option>
                        @endforeach
                      </select>
                    </div>

            
              
                    <label for="laboratorios_#index#_abonoL" class="col-sm-1 control-label">Indicación</label>
                    <div class="col-sm-6">

                      <input id="laboratorios_#index#_abonoL" name="monto_abol[laboratorios][#index#][abono] type="text" class="number form-control abonoL" placeholder="Indicación" data-toggle="tooltip" data-placement="bottom" title="Abono">
                    </div>

                    <a id="laboratorios_remove_current" style="cursor: pointer;"><i class="fa fa-times-circle" aria-hidden="true"></i></a>
                </div>
                <!-- /Form template-->
                
                <!-- No forms template -->
                <div id="laboratorios_noforms_template" class="noItems col-sm-12 text-center">Ningún Producto</div>
                <!-- /No forms template-->
                
                <!-- Controls -->
                <div id="laboratorios_controls" class="controls col-sm-11 col-sm-offset-1">
                    <div id="laboratorios_add" class="btn btn-default form add"><a><span><i class="fa fa-plus-circle"></i> Agregar Producto</span></a></div>
                    <div id="laboratorios_remove_last" class="btn form removeLast"><a><span><i class="fa fa-close-circle"></i> Eliminar ultimo</span></a></div>
                    <div id="laboratorios_remove_all" class="btn form removeAll"><a><span><i class="fa fa-close-circle"></i> Eliminar todos</span></a></div>
                </div>
                <!-- /Controls -->
                
            </div>


                    <br>
                   <div class="row">
                     <div class="col-md-12">
                    <label for="exampleInputEmail1">Observaciones</label>
                    <textarea class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" rows="3"  name="observaciones" placeholder="Observaciones"></textarea>
                   </div>
                    </div>
                    <br>
                   <div class="row">
                     <div class="col-md-3">
                    <label for="exampleInputEmail1">Próxima Consulta</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="prox" placeholder="Observaciones">
                   </div>
                    </div>


                 
                                                      

                  <br>
                  <input type="hidden" name="consulta" value="{{$consulta->id}}">


               

                
                 
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

<script src="plugins/select2/js/select2.full.min.js"></script>

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
<script src="../../plugins/sheepit/jquery.sheepItPlugin.min.js"></script>


<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>

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

<script type="text/javascript">
		function viewh(e){
		    var id = $(e).attr('id');
		    
		    $.ajax({
		        type: "GET",
		        url: "/historia/reevaluar/"+id,
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


<script>

$(document).ready(function() {

$(".monto").keyup(function(event) {
  var montoId = $(this).attr('id');
  var montoArr = montoId.split('_');
  var id = montoArr[1];
  var montoH = parseFloat($('#servicios_'+id+'_montoHidden').val());
  var monto = parseFloat($(this).val());
  $('#servicios_'+id+'_montoHidden').val(monto);
  calcular();
  calculo_general();
});

$(".montol").keyup(function(event) {
  var montoId = $(this).attr('id');
  var montoArr = montoId.split('_');
  var id = montoArr[1];
  var montoH = parseFloat($('#laboratorios_'+id+'_montoHidden').val());
  var monto = parseFloat($(this).val());
  $('#laboratorios_'+id+'_montoHidden').val(monto);
  calcular();
  calculo_general();
});

$(".abonoL, .abonoS").keyup(function(){
  var total = 0;
  var selectId = $(this).attr('id');
  var selectArr = selectId.split('_');
  
  if(selectArr[0] == 'servicios'){
      if(parseFloat($(this).val()) == parseFloat($("#servicios_"+selectArr[1]+"_monto").val())){
          alert('La cantidad insertada en abono es mayor al monto.');
          $(this).val('0.00');
          calculo_general();
      } else {
          calculo_general();
      }
  } else {
    if(parseFloat($(this).val()) == 999999){
          alert('Debe verificar la cantidad.');
          $(this).val('0.00');
          calculo_general();
      } else {
          calculo_general();
      }
  }
});

var botonDisabled = true;

// Main sheepIt form
var phonesForm = $("#laboratorios").sheepIt({
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
      calcular();
      calculo_general();
    }
});


$(document).on('change', '.selectLab', function(){
  var labId = $(this).attr('id');
  var labArr = labId.split('_');
  var id = labArr[1];

  $.ajax({
     type: "GET",
     url:  "productos/getProducto/"+$(this).val(),
     success: function(a) {
        $('#laboratorios_'+id+'_montoHidden').val(a.precio);
        $('#laboratorios_'+id+'_monto').val(a.precio);
        var total = parseFloat($('#total').val());
        $("#total").val(total + parseFloat(a.precio));
        calcular();
        calculo_general();
     }
  });
})
});


function calcular() {
  var total = 0;
      $(".monto").each(function(){
        total += parseFloat($(this).val());
      })

      $(".montol").each(function(i){
        total += parseFloat($(this).val() * $("#laboratorios_"+i+"_abonoL").val());
      })

      $(".montop").each(function(){
        total += parseFloat($(this).val());
      })

      $("#total").val(total);
}

function calculo_general() {
  var total = 0;
  $(".abonoL").each(function(){
    total += parseFloat($(this).val());
  })

  $(".abonoS").each(function(){
    total += parseFloat($(this).val());
  })

  $("#total_a").val(total);
  $("#total_g").val(parseFloat($("#total").val()) - parseFloat(total));
}



</script>

<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()
    $('.select22').select2()
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    

  })
</script>


<!-- page script -->

</body>
</html>