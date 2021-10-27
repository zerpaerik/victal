<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Control Prenatal | Admin</title>
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
            <h1 class="m-0 text-dark">Control Prenatal</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Controles</li>
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
                  
              @if($ant)
              <div class="card-body">
              
                    
                   <label for="exampleInputEmail1">ANTECEDENTES OBSTÉTRICOS</label>
                   <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">Gestas</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" value="{{$ant->gestas}}" name="gestas" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Abortos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" value="{{$ant->abortos}}" id="nombre" name="aborto" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Vaginales</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" value="{{$ant->vaginales}}" id="nombre" name="vaginales" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Nac.Vivos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled id="nombre" value="{{$ant->nac_vivos}}" name="vivos" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Viven</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled id="nombre" value="{{$ant->viven}}" name="viven" placeholder="">
                   </div>
                    </div>
                    <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">Partos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled id="nombre" value="{{$ant->parto}}" name="partos" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Cesarea</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled id="nombre" value="{{$ant->cesarea}}" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Nac.Muertos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->nac_muertos}}" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Desp.1SEM</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->peso}}" name="peso" placeholder="">
                   </div>
                    </div>
                   <div class="row">
                     <div class="col-md-6">
                    <label for="exampleInputEmail1">Antecedementes Familiares</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="ant_fam" disabled  value="{{$ant->ant_fam}}" name="ant_fam" placeholder="">

                   </div>
                   <div class="col-md-6">
                    <label for="exampleInputEmail1">Antecedementes Personales</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="ant_per" disabled  value="{{$ant->ant_pers}}" name="ant_per" placeholder="">
                    </div>
                    </div>
                    <label for="exampleInputEmail1">Fin de Gestación Anterior</label>
                   <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">Terminación</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="ant_per" disabled  value="{{$ant->gest_ant}}" name="ant_per" placeholder="">
                
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Fecha</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fecha_gest"  disabled  value="{{$ant->fecha_ant}}"  placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Tipo de Aborto</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="ant_per" disabled  value="{{$ant->tipo_aborto}}" name="ant_per" placeholder="">
                    
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">RN Peso</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->mayor_peso}}" name="mayor_peso" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Peso</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->peso}}" name="peso" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Talla</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->talla}}" name="talla" placeholder="">
                   </div>
                   </div>

                   <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">Tipo Sangre</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->tipo_sangre}}" name="talla" placeholder="">
                                       
                    </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Grupo</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->sangre}}" name="talla" placeholder="">
                 
                      </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">FUM</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->fum}}"  name="fum" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">FPP</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->fpp}}"  name="fpp" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">ECOEG</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->ecoeg}}"  name="ecoeg" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">P</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->p}}"  name="p" placeholder="">
                   </div>
    
                    </div>

                        <div class="row">
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Orina</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->orina}}"  name="p" placeholder="">
                   
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha Orina</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->fec_orina}}"  name="fec_orina" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Urea</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->urea}}" name="urea" placeholder="">
                
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha Urea</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->fec_urea}}" name="fec_urea" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Creatinina</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->creatinina}}" name="creatinina" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha Creatinina</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->fec_creati}}" name="fec_creati" placeholder="">
                        </div>
                       

                        </div>
                   

                    <div class="row">
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">BK</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->bk}}" name="bk" placeholder="">
                   
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha BK</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->fec_bk}}" name="fec_bk" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Torch</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->torch}}"  name="torch" placeholder="">
                        </div>

                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha Torch</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" disabled  value="{{$ant->fec_torch}}"  name="fec_torch" placeholder="">
                        </div>
                       
                       

                        </div>
              @else
              <label for="exampleInputEmail1">NO TIENE ANTECEDENTES OBSTÉTRICOS CARGADOS</label>

              <form role="form" method="post" action="controlh/guardar">
					{{ csrf_field() }}                
                    <div class="card-body">
                    
                   <label for="exampleInputEmail1">Antecedentes Obstétricos</label>
                   <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">Gestas</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="gestas" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Abortos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="aborto" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Vaginales</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="vaginales" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Nac.Vivos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="vivos" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Viven</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="viven" placeholder="">
                   </div>
                    </div>
                    <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">Partos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="partos" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Cesarea</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="cesa" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Nac.Muertos</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="nac_muertos" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Desp.1SEM</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="peso" placeholder="">
                   </div>
                    </div>
                    <br>
                   <div class="row">
                     <div class="col-md-6">
                    <label for="exampleInputEmail1">Antecedementes Familiares</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="ant_fam" name="ant_fam" placeholder="">

                   </div>
                   <div class="col-md-6">
                    <label for="exampleInputEmail1">Antecedementes Personales</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="ant_per" name="ant_per" placeholder="">
                    </div>
                    </div>
                    <br>
                    <label for="exampleInputEmail1">Fin de Gestación Anterior</label>
                   <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">Terminación</label>
                    <select class="form-control" name="term_gest">
                    <option value="PARTO">PARTO</option>
                    <option value="ABORTO">ABORTO</option>
                    <option value="EPTÓPICO">EPTÓPICO</option>
                    <option value="MOLAR">MOLAR</option>
                    <option value="OTRO">OTRO</option>
                    <option value="NO APLICA">NO APLICA</option>

                   </select>                   
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Fecha</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fecha_gest" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Tipo de Aborto</label>
                    <select class="form-control" name="tipo_ab">
                    <option value="NO APLICA">NO APLICA</option>
                    <option value="INCOMPLETO">INCOMPLETO</option>
                    <option value="COMPLETO">COMPLETO</option>
                    <option value="FRUSTRO">FRUSTRO</option>
                    <option value="SÉPTICO">SÉPTICO</option>
                    <option value="OTRO">OTRO</option>

                   </select>                     
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">RN Peso</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="mayor_peso" placeholder="">
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

                   <div class="row">
                     <div class="col-md-2">
                    <label for="exampleInputEmail1">Tipo Sangre</label>
                    <select class="form-control" name="tipo_sangre">
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="AB">AB</option>
                    <option value="O">O</option>

                   </select>                    
                    </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">Grupo</label>
                    <select class="form-control" name="grupo_sangre">
                    <option value="RH +">RH +</option>
                    <option value="RH SEN DESC">RH SEN DESC</option>
                    <option value="RH NOSEN">RH NOSEN</option>
                    <option value="RH SEN">RH SEN</option>

                   </select>                  
                      </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">FUM</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fum" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">FPP</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fpp" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">ECOEG</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="ecoeg" placeholder="">
                   </div>
                   <div class="col-md-2">
                    <label for="exampleInputEmail1">P</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="p" placeholder="">
                   </div>
    
                    </div>
                    <br>

                        <div class="row">
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Orina</label>
                        <select class="form-control" name="orina">
                        <option value="NORMAL">NORMAL</option>
                        <option value="ANORMAL">ANORMAL</option>
                        <option value="NO SE HIZO">NO SE HIZO</option>
                        </select>                    
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha Orina</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fec_orina" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Urea</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="urea" placeholder="">
                
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha Urea</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fec_urea" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Creatinina</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="creatinina" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha Creatinina</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fec_creati" placeholder="">
                        </div>
                       

                        </div>
                   
                    <br>

                    <div class="row">
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">BK</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="bk" placeholder="">
                   
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha BK</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fec_bk" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Torch</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="torch" placeholder="">
                        </div>

                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha Torch</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fec_torch" placeholder="">
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

              @foreach($controles as $control)
              <br>
              <label for="exampleInputEmail1">FECHA DE CONTROL: {{$control->created_at}}</label>
                        <div class="row">
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Piel/Mucosas</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled name="piel" value="{{$control->piel}}">
                   
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Mamas</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="mamas" placeholder="" value="{{$control->mamas}}">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Abdomen</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="abdomen" placeholder="" value="{{$control->abdomen}}">
                
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Gen.Int</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="gen_int" placeholder="" value="{{$control->gen_int}}">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Gen.Ext</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="gen_ext" placeholder="" value="{{$control->gen_ext}}">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Miemb.Infer</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="miem_inf" placeholder="" value="{{$control->miem}}">
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Diag.Pres</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="diag_pres" placeholder="" value="{{$control->diag}}">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Ex.Aux</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="ex_aux" placeholder="" value="{{$control->ex}}">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Diag.Def</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="diag_def" placeholder="" value="{{$control->diag_def}}">
                
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Plan.Trat</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="plan" placeholder="" value="{{$control->plan}}">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Prox Cita</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="prox" placeholder="" value="{{$control->prox}}">
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Serologia</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="diag_pres" placeholder="" value="{{$control->sero}}">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="ex_aux" placeholder="" value="{{$control->fec_sero}}">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Glucosa</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="diag_def" placeholder="" value="{{$control->gluco}}">
                
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="plan" placeholder="" value="{{$control->fec_gluco}}">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">VIH</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="prox" placeholder="" value="{{$control->vih}}">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Fecha</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" disabled id="nombre" name="prox" placeholder="" value="{{$control->fec_vih}}">
                        </div>
                     
                    
                        </div>

              @endforeach

              <div class="box-content">
   	<div style="background: #eaeaea;">
	<table style="width: 100%;text-align: center;margin: 10px 0;border:1px solid black;">

		<tr>
			<div>

    <th scope="col" style="background: #2E9AFE;">CONTROLES PRENATALES</th>


  


  </tr>

  <tr>
    

    <th style="background: #81BEF7;border: 1px solid black;">Fecha de Control</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->created_at}}</td>
  @endforeach
  </tr>

   <tr>

    <th style="background: #81BEF7;border: 1px solid black;">Edad Gest(Semanas)</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->sem}}</td>
  @endforeach
  </tr>

   <tr>

    <th style="background: #81BEF7;border: 1px solid black;">PesoMadre(Kg)</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->peso}}</td>
  @endforeach
  </tr>

  <tr>

    <th style="background: #81BEF7;border: 1px solid black;">Temperatura(ºC)</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->temp}}</td>
  @endforeach
  </tr>

   <th style="background: #81BEF7;border: 1px solid black;">Tensiòn Arterial(mmHg)</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->ten}}</td>
  @endforeach
  </tr>

   <th style="background: #81BEF7;border: 1px solid black;">Altura Uterina</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->alt}}</td>
  @endforeach
  </tr>

   <th style="background: #81BEF7;border: 1px solid black;">Presentaciòn(C/P/T/NA)</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->pres}}</td>
  @endforeach
  </tr>

     <th style="background: #81BEF7;border: 1px solid black;">FCF</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->fcf}}</td>
  @endforeach
  </tr>

     <th style="background: #81BEF7;border: 1px solid black;">Mov. Fetal</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->mov}}</td>
  @endforeach
  </tr>

   <th style="background: #81BEF7;border: 1px solid black;">Edema</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->edema}}</td>
  @endforeach
  </tr>

   <th style="background: #81BEF7;border: 1px solid black;">Pulso Materno</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->pulso}}</td>
  @endforeach
  </tr>

   <th style="background: #81BEF7;border: 1px solid black;">Consejeria PF</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->conse}}</td>
  @endforeach
  </tr>

   <th style="background: #81BEF7;border: 1px solid black;">Sulfato Ferroso</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->sulfato}}</td>
  @endforeach
  </tr>

     <th style="background: #81BEF7;border: 1px solid black;">Perfìl Biofìsico</th>
 @foreach($controles as $c)
    <td style="border: 1px solid black;">{{$c->perfil}}</td>
  @endforeach
  </tr>

  



      
   </table>


		    </div>


              <form role="form" method="post" action="control/guardar">
              {{ csrf_field() }}                
                    <div class="card-body">
                    <label for="exampleInputEmail1">REGISTRO DE NUEVO CONTROL</label>

                  <div class="row">
                    <div class="col-md-2">
                    <label for="exampleInputEmail1">Semanas</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="sem" placeholder="">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Peso Madre</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="peso" placeholder="">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Temperatura</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="temp" placeholder="">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Tensión</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="ten" placeholder="">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Alt Uterina</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="alt" placeholder="">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Presentación</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="pres" placeholder="">
                  </div>
                 
                    </div>
                    <br>
                    <div class="row">
                   
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">FCF</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fcf" placeholder="">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Movimiento</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="mov" placeholder="">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Edema</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="edema" placeholder="">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Pulso</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="pulso" placeholder="">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Consejeria</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="ant_fam" name="conse" placeholder="">

                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Sulfato Ferroso</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="ant_per" name="sulfa" placeholder="">
                    </div>
                    <div class="col-md-2">
                    <label for="exampleInputEmail1">Perfil Biofísico</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="ant_per" name="perfil" placeholder="">
                    </div>
                    </div>
                    <br>
                
                  <div class="row">
                    <div class="col-md-2">
                    <label for="exampleInputEmail1">Serologia</label>
                    <select class="form-control" name="sero">
                    <option value="NEGATIVO">NEGATIVO</option>
                    <option value="POSITIVO">POSITIVO</option>
                    <option value="NO SE HIZO">NO SE HIZO</option>

                  </select>                   
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Fecha</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fec_sero" placeholder="">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Glucosa</label>
                    <select class="form-control" name="gluco">
                    <option value="NORMAL">NORMAL</option>
                    <option value="ANORMAL">ANORMAL</option>
                    <option value="NO SE HIZO">NO SE HIZO</option>
                  </select>                     
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Fecha</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fec_gluco" placeholder="">
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">VIH</label>
                    <select class="form-control" name="vih">
                    <option value="NEGATIVO">NEGATIVO</option>
                    <option value="POSITIVO">POSITIVO</option>
                    <option value="NO SE HIZO">NO SE HIZO</option>
                  </select>                     
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Fecha</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fec_vih" placeholder="">
                  </div>
                  </div>
                  <br>

                  <div class="row">
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Hemoglobina</label>
                    <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="hemo" placeholder="">
                  
                  </div>
                  <div class="col-md-2">
                    <label for="exampleInputEmail1">Fecha</label>
                    <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="fec_hemo" placeholder="">
                  </div>
                 

                    </div>
                    <br>
                        <label for="exampleInputEmail1">Examen Físico y Regional</label>
                        <div class="row">
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Piel/Mucosas</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="piel" placeholder="">
                   
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Mamas</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="mamas" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Abdomen</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="abdomen" placeholder="">
                
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Gen.Int</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="gen_int" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Gen.Ext</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="gen_ext" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Miemb.Infer</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="miem_inf" placeholder="">
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Diag.Pres</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="diag_pres" placeholder="">
                   
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Ex.Aux</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="ex_aux" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Diag.Def</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="diag_def" placeholder="">
                
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Plan.Trat</label>
                        <input type="text" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="plan" placeholder="">
                        </div>
                        <div class="col-md-2">
                        <label for="exampleInputEmail1">Prox Cita</label>
                        <input type="date" onkeyup="javascript:this.value=this.value.toUpperCase();" class="form-control" id="nombre" name="prox" placeholder="">
                        </div>
                     
                    
                        </div>
                  
                    <br>

                   
                    

                        <input type="hidden" name="consulta" value="{{$consulta->id}}">

                
                                                      

                  <br>
                  <input type="hidden" name="control" value="">

              

                
                
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
              </form>
            
            </div>
            <!-- /.card -->

         
            <!-- /.card -->
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
<!-- page script -->

</body>
</html>