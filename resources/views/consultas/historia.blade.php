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
                     <div class="col-md-12">
                    <label for="exampleInputEmail1">Examen Auxiliar</label>
                    <textarea class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" rows="3"  name="ex_aux" placeholder="Examen Auxiliar"></textarea>
                  </div>
                    </div>
                   <br>
                   <div class="row">
                     <div class="col-md-12">
                    <label for="exampleInputEmail1">Plan de Tratamiento</label>
                    <textarea class="form-control" onkeyup="javascript:this.value=this.value.toUpperCase();" rows="3"  name="plan" placeholder="Plan de Tratamiento"></textarea>

                  </div>
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
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
    //Money Euro
    $('[data-mask]').inputmask()

    //Date range picker
    $('#reservationdate').datetimepicker({
        format: 'L'
    });
    //Date range picker
    $('#reservation').daterangepicker()
    //Date range picker with time picker
    $('#reservationtime').daterangepicker({
      timePicker: true,
      timePickerIncrement: 30,
      locale: {
        format: 'MM/DD/YYYY hh:mm A'
      }
    })
    //Date range as a button
    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    )

    //Timepicker
    $('#timepicker').datetimepicker({
      format: 'LT'
    })
    
    //Bootstrap Duallistbox
    $('.duallistbox').bootstrapDualListbox()

    //Colorpicker
    $('.my-colorpicker1').colorpicker()
    //color picker with addon
    $('.my-colorpicker2').colorpicker()

    $('.my-colorpicker2').on('colorpickerChange', function(event) {
      $('.my-colorpicker2 .fa-square').css('color', event.color.toString());
    });

    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });

  })
</script>
<!-- page script -->

</body>
</html>