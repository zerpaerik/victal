<?php

namespace App\Http\Controllers;
use App\Equipos;
use App\Analisis;
use App\Clientes;
use App\Tiempo;
use App\Paquetes;
use App\Pacientes;
use App\Servicios;
use App\User;
use App\Atenciones;
use App\Atec;
use App\Consultas;
use App\Metodos;
use App\MetoPro;
use App\Comisiones;
use App\Cobrar;
use App\HistorialCobros;
use App\Creditos;
use App\Sesiones;
use App\ResultadosServicios;
use App\ResultadosLaboratorio;
use App\PagosPersonal;


use Auth;
use Illuminate\Http\Request;
use DB;


class PagosPersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

        public function index(Request $request)
        {
    
          if($request->inicio){
            $f1 = $request->inicio;
            $f2 = $request->fin;
    
          
    
        
    
            $pagosp = DB::table('pagos_personal as a')
            ->select('a.id','a.id_personal','a.monto','a.usuario','a.created_at','a.sede','a.fecha','c.name','c.lastname','d.name as nameu','d.lastname as lastu')
            ->join('users as c','c.id','a.id_personal')
            ->join('users as d','d.id','a.usuario')
            ->where('a.sede', '=', $request->session()->get('sede'))
            ->whereBetween('a.created_at', [$f1,$f2])
            ->orderBy('a.id','DESC')
            ->get(); 
    
    
    
          } else {
    
            $f1 = date('Y-m-d');
            $f2 = date('Y-m-d');
    
    
            //->get(); 
    
         
            $pagosp = DB::table('pagos_personal as a')
            ->select('a.id','a.id_personal','a.monto','a.usuario','a.created_at','a.sede','a.fecha','c.name','c.lastname','d.name as nameu','d.lastname as lastu')
            ->join('users as c','c.id','a.id_personal')
            ->join('users as d','d.id','a.usuario')
            ->where('a.sede', '=', $request->session()->get('sede'))
            ->whereBetween('a.created_at', [$f1,$f2])
            ->orderBy('a.id','DESC')
            ->get(); 
    
     
    
    
    
    
    
          }
    
            
            
    
            return view('pagosp.index', compact('pagosp','f1','f2'));
            //
        }

     
        

      







    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
     



        $personal = User::where('estatus','=',1)->where('tipo','=',1)->orderBy('lastname','ASC')->get();


       
        return view('pagosp.create', compact('personal'));
    }

    public function getServicio($id)
    {
        return Servicios::where('id','=',$id)->first();

    }

    public function getPaquetes($id)
    {
        return Paquetes::where('id','=',$id)->first();

    }

    public function getAnalisis($id)
    {
        return Analisis::where('id','=',$id)->first();

    }

    public function personal(){
     
        $personal = User::where('estatus','=',1)->where('tipo','=',1)->where('tipo_personal','=','ProfSalud')->orderBy('lastname','ASC')->get();

 
     return view('atenciones.personal', compact('personal'));
   }

   public function profesionales(){
     
    $profesionales = User::where('estatus','=',1)->where('tipo','=',2)->orderBy('lastname','ASC')->get();


 return view('atenciones.profesionales', compact('profesionales'));
}

public function particular(){

return view('atenciones.particular');
}

    public function datapac($id){

       

        $pacientes = DB::table('pacientes as a')
       ->select('a.id','a.dni','a.nombres','a.apellidos','a.direccion','a.telefono','a.fechanac')
       ->where('a.dni','=',$id)
       ->first();

       dd($pacientes);

          // $edad = Carbon::parse($pacientes->fechanac)->age;

       //return $pacientes;

           return view('solicitudes.pacientes',compact('pacientes'));


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if (isset($request->id_laboratorio)) {
            foreach ($request->id_laboratorio['laboratorios'] as $key => $laboratorio) {
              if (!is_null($laboratorio['laboratorio'])) {


    
                $req = new PagosPersonal();
                $req->id_personal =  $laboratorio['laboratorio'];
                $req->monto =  $request->monto_abol['laboratorios'][$key]['abono'];
                $req->usuario =  Auth::user()->id;
                $req->fecha =  date('Y-m-d');
                $req->sede =  $request->session()->get('sede');
                $req->save();

              } 
            }
          }

        


        return redirect()->route('pagosp.index')
        ->with('success','Creado Exitosamente!');


    }

    public function ver($id)
    {
	  
        $req = DB::table('requerimientos as a')
        ->select('a.id','a.asunto','a.prioridad','a.categoria','a.descripcion','a.estatus','a.estado','a.empresa','b.nombre as empresa')
        ->join('clientes as b','b.id','a.empresa')
        ->where('a.empresa', '=', Auth::user()->empresa)
        ->where('a.estatus', '=', 1)
        ->where('a.id', '=', $id)
        ->first(); 

        //$equipos = ActivosRequerimientos::

        $equipos = DB::table('activos_requerimientos as a')
        ->select('a.id','a.activo','a.ticket','b.nombre','b.modelo','b.serial')
        ->join('equipos as b','b.id','a.activo')
        ->where('ticket','=',$id)
        ->get();


	  
      return view('requerimientos.ver', compact('req','equipos'));
    }	  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Analisis  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $pagosp = DB::table('pagos_personal as a')
        ->select('a.id','a.id_personal','a.monto','a.usuario','a.created_at','a.sede','a.fecha','c.name','c.lastname','d.name as nameu','d.lastname as lastu')
        ->join('users as c','c.id','a.id_personal')
        ->join('users as d','d.id','a.usuario')
        ->where('a.id', '=', $id)
        ->first(); 

        return view('pagosp.edit', compact('pagosp')); //
    }

    public function edits($id)
    {
        $atencion = Atenciones::where('id','=',$id)->first();

     
        if($atencion->tipo_atencion == 1){
          $servicio = Servicios::where('estatus','=',1)->where('tipo','=','OTROS')->get();
        } else if($atencion->tipo_atencion == 2) {
          $servicio = Servicios::where('estatus','=',1)->where('tipo','=','ECOGRAFIA')->get();
        } else {
          $servicio = Servicios::where('estatus','=',1)->where('tipo','=','RAYOS')->get();
        }

        if ($atencion->tipo_origen == 1) {
          $usuario = User::where('estatus', '=', 1)->where('tipo', '=', 1)->where('tipo_personal', '=', 'ProfSalud')->get();
        } else {
          $usuario = User::where('estatus', '=', 1)->where('tipo', '=', 2)->get();
        }




        return view('atenciones.edits', compact('atencion','servicio','usuario')); //
    }

    public function editsa($id)
    {
        $atencion = Atenciones::where('id','=',$id)->first();

     
        if($atencion->tipo_atencion == 1){
          $servicio = Servicios::where('estatus','=',1)->where('tipo','=','OTROS')->get();
        } else if($atencion->tipo_atencion == 2) {
          $servicio = Servicios::where('estatus','=',1)->where('tipo','=','ECOGRAFIA')->get();
        } else {
          $servicio = Servicios::where('estatus','=',1)->where('tipo','=','RAYOS')->get();
        }

        if ($atencion->tipo_origen == 1) {
          $usuario = User::where('estatus', '=', 1)->where('tipo', '=', 1)->where('tipo_personal', '=', 'ProfSalud')->get();
        } else {
          $usuario = User::where('estatus', '=', 1)->where('tipo', '=', 2)->get();
        }




        return view('atenciones.editsa', compact('atencion','servicio','usuario')); //
    }


    public function editl($id)
    {
          $atencion = Atenciones::where('id','=',$id)->first();

          $analisis = Analisis::where('estatus','=',1)->get();
     
        if ($atencion->tipo_origen == 1) {
          $usuario = User::where('estatus', '=', 1)->where('tipo', '=', 1)->where('tipo_personal', '=', 'ProfSalud')->get();
        } else {
          $usuario = User::where('estatus', '=', 1)->where('tipo', '=', 2)->get();
        }




        return view('atenciones.editl', compact('atencion','analisis','usuario')); //
    }

    
    public function editp($id)
    {
          $atencion = Atenciones::where('id','=',$id)->first();

     
        if ($atencion->tipo_origen == 1) {
          $usuario = User::where('estatus', '=', 1)->where('tipo', '=', 1)->where('tipo_personal', '=', 'ProfSalud')->get();
        } else {
          $usuario = User::where('estatus', '=', 1)->where('tipo', '=', 2)->get();
        }




        return view('atenciones.editp', compact('atencion','usuario')); //
    }

    public function editc($id)
    {
          $atencion = Atenciones::where('id','=',$id)->first();

          $consulta = Consultas::where('id_atencion','=',$id)->first();

          
       // $met = MetoPro::where('estatus','=',1)->get();

        $personal = User::where('estatus','=',1)->where('tipo','=',1)->where('tipo_personal','=','Especialista')->get();


        return view('atenciones.editc', compact('atencion','personal','consulta')); //
    }

    public function editm($id)
    {
          $atencion = Atenciones::where('id','=',$id)->first();

          $met = Metodos::where('id_atencion','=',$id)->first();


          
        $metodos = MetoPro::where('estatus','=',1)->get();

       // $personal = User::where('estatus','=',1)->where('tipo','=',1)->where('tipo_personal','=','Especialista')->get();


        return view('atenciones.editm', compact('atencion','metodos','met')); //
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


       

      $p = PagosPersonal::find($request->id);
      $p->monto =$request->monto;
      $res = $p->update();
    
    
    return back();

        //
    }

    public function updates(Request $request)
    {


      $serv = Servicios::where('id','=',$request->id_tipo)->first();
      $rsfd = ResultadosServicios::where('id_atencion','=',$request->id)->first();
      $atenciod = Atenciones::where('id','=',$request->id)->first();


      $sesio = Sesiones::where('id_atencion','=',$request->id)->get();
      if ($sesio != null) {
          foreach ($sesio as $rs) {
              $id_rs = $rs->id;
              if (!is_null($id_rs)) {
                  $rsf = Sesiones::where('id', '=', $id_rs)->first();
                  $rsf->delete();
              }
          }
      }

      
      $contador=0;
                      
      if ($serv->sesiones != 0) {
          while ($contador < $serv->sesiones) {
              $ses = new Sesiones();
              $ses->id_paciente =   $atenciod->id_paciente;
              $ses->id_atencion =  $atenciod->id;
              $ses->save();

              $contador++;
          }
      }

      if ($rsfd != null) {
          $rsf = ResultadosServicios::where('id_atencion', '=', $request->id)->first();
          $rsf->id_servicio = $request->id_tipo;
          $rsf->save();
      }

      $cob = Cobrar::where('id_atencion','=',$request->id)->first();
      if($cob != null){
        $hcob = HistorialCobros::where('id_cobro', '=', $request->id)->first();
        if ($hcob != null) {
            $hcobf = HistorialCobros::where('id_cobro', '=', $request->id)->first();
            $hcobf->delete();
        }
          $cobf = Cobrar::where('id_atencion', '=', $request->id)->first();
          $cobf->delete();
      }


      $creditos = Creditos::where('id_atencion','=',$request->id)->first();
      $creditos->monto = $request->abono;
      $creditos->tipopago =$request->tipo_pago;
      $creditos->save();

   
      
      $csf1 = Comisiones::where('id_atencion','=',$request->id)->first();
      if ($csf1 != null) {
          $csf = Comisiones::where('id_atencion', '=', $request->id)->first();
          $csf->delete();
      }

      $sesio = Sesiones::where('id_atencion','=',$request->id)->first();
      if ($sesio != null) {
          $ses = Sesiones::where('id_atencion', '=', $request->id)->first();
          $ses->delete();
      }

      if($request->tipo_origen == 1 && $serv->porcentaje > 0){

        $com = new Comisiones();
        $com->id_atencion = $request->id;
        $com->porcentaje =$serv->porcentaje;
        $com->id_responsable = $request->origen_usuario != null ? $request->origen_usuario : $request->origen_usuario2;
        $com->id_origen = $request->tipo_origen;
        $com->detalle =  $serv->nombre;
        $com->monto = $request->monto * $serv->porcentaje / 100;
        $com->estatus = 1;
        $com->usuario = Auth::user()->id;
        $com->save();

       /* $csf = Comisiones::where('id_atencion','=',$request->id)->first();
        $csf->detalle = $serv->nombre;
        $csf->porcentaje = $serv->porcentaje;
        $csf->monto = $request->monto * $serv->porcentaje / 100;
        $csf->save();*/

      } else if($request->tipo_origen == 2 && $serv->porcentaje1 > 0){

        $com = new Comisiones();
        $com->id_atencion = $request->id;
        $com->porcentaje =$serv->porcentaje1;
        $com->detalle =  $serv->nombre;
        $com->id_responsable = $request->origen_usuario != null ? $request->origen_usuario : $request->origen_usuario2;
        $com->id_origen = $request->tipo_origen;
        $com->monto = $request->monto * $serv->porcentaje1 / 100;
        $com->estatus = 1;
        $com->usuario = Auth::user()->id;
        $com->save();

       /* $csf = Comisiones::where('id_atencion','=',$request->id)->first();
        $csf->porcentaje = $serv->nombre;
        $csf->monto =  $request->monto * $serv->porcentaje1 / 100;
        $csf->detalle = $serv->porcentaje1;
        $csf->save();*/

      } else {

      }

      
      if($request->monto > $request->abono){

        $cb = new Cobrar();
        $cb->id_atencion =  $request->id;
        $cb->detalle =  $serv->nombre;
        $cb->resta =$request->monto - $request->abono;
        $cb->save();
    
      }




      $p = Atenciones::find($request->id);
      $p->monto =$request->monto;
      $p->abono =$request->abono;
      $p->tipo_pago =$request->tipo_pago;
      $p->tipo_origen =$request->tipo_origen;
      if($request->tipo_origen == 3){
        $p->id_origen =99;
      }else{
        $p->id_origen = $request->origen_usuario != null ? $request->origen_usuario : $request->origen_usuario2;
      }  
      $p->id_tipo =$request->id_tipo;
      $res = $p->update();
    
        return redirect()->action('AtencionesController@index')
        ->with('success','Modificado Exitosamente!');

        //
    }

    public function updatel(Request $request)
    {


      $serv = Analisis::where('id','=',$request->id_tipo)->first();

      $rsf = ResultadosLaboratorio::where('id_atencion','=',$request->id)->first();
      $rsf->id_laboratorio = $request->id_tipo;
      $rsf->save();

      $creditos = Creditos::where('id_atencion','=',$request->id)->first();
      $creditos->monto = $request->abono;
      $creditos->tipopago =$request->tipo_pago;
      $creditos->save();

      $csf1 = Comisiones::where('id_atencion','=',$request->id)->first();

      if($csf1 != null){
        $csf = Comisiones::where('id_atencion','=',$request->id)->first();
        $csf->delete();

      }
     

      if($request->tipo_origen == 2 && $serv->porcentaje > 0){

        $com = new Comisiones();
        $com->id_atencion = $request->id;
        $com->porcentaje =$serv->porcentaje;
        $com->detalle =  $serv->nombre;
        $com->id_origen = $request->tipo_origen;
        $com->id_responsable = $request->origen_usuario != null ? $request->origen_usuario : $request->origen_usuario2;
        $com->monto = $request->monto * $serv->porcentaje / 100;
        $com->estatus = 1;
        $com->usuario = Auth::user()->id;
        $com->save();

      } 

      $cob = Cobrar::where('id_atencion','=',$request->id)->first();
      if($cob != null){
        $hcob = HistorialCobros::where('id_cobro', '=', $request->id)->first();
        if ($hcob != null) {
            $hcobf = HistorialCobros::where('id_cobro', '=', $request->id)->first();
            $hcobf->delete();
        }
          $cobf = Cobrar::where('id_atencion', '=', $request->id)->first();
          $cobf->delete();
      }

      if($request->monto > $request->abono){

        $cb = new Cobrar();
        $cb->id_atencion =  $request->id;
        $cb->detalle =  $serv->nombre;
        $cb->resta =$request->monto - $request->abono;
        $cb->save();
    
      }


      $p = Atenciones::find($request->id);
      $p->monto =$request->monto;
      $p->abono =$request->abono;
      $p->tipo_pago =$request->tipo_pago;
      $p->tipo_origen =$request->tipo_origen;
      if($request->tipo_origen == 3){
        $p->id_origen =99;
      }else{
        $p->id_origen = $request->origen_usuario != null ? $request->origen_usuario : $request->origen_usuario2;
      }         
      $p->id_tipo =$request->id_tipo;
      $res = $p->update();
    
        return redirect()->action('AtencionesController@index')
        ->with('success','Modificado Exitosamente!');

        //
    }

    public function updatep(Request $request)
    {

      $com = Comisiones::where('id_atencion','=',$request->id)->first();
      $serv = Paquetes::where('id','=',$request->id_tipo)->first();


      $creditos = Creditos::where('id_atencion','=',$request->id)->first();
      $creditos->monto = $request->abono;
      $creditos->tipopago =$request->tipo_pago;
      $creditos->save();


      if($request->tipo_origen == 1){

        $csf = Comisiones::where('id_atencion','=',$request->id)->first();
        $csf->monto = $request->monto * $com->porcentaje / 100;
        $csf->id_responsable = $request->origen_usuario != null ? $request->origen_usuario : $request->origen_usuario2;
        $csf->id_origen = $request->tipo_origen;
        $csf->save();

      } else if($request->tipo_origen == 2){

        $csf = Comisiones::where('id_atencion','=',$request->id)->first();
        $csf->monto =  $request->monto * $com->porcentaje / 100;
        $csf->id_origen = $request->tipo_origen;
        $csf->id_responsable = $request->origen_usuario != null ? $request->origen_usuario : $request->origen_usuario2;
        $csf->save();

      } else {

      }

      $cob = Cobrar::where('id_atencion','=',$request->id)->first();
      if($cob != null){
        $hcob = HistorialCobros::where('id_cobro', '=', $request->id)->first();
        if ($hcob != null) {
            $hcobf = HistorialCobros::where('id_cobro', '=', $request->id)->first();
            $hcobf->delete();
        }
          $cobf = Cobrar::where('id_atencion', '=', $request->id)->first();
          $cobf->delete();
      }

      if($request->monto > $request->abono){

        $cb = new Cobrar();
        $cb->id_atencion =  $request->id;
        $cb->detalle =  $serv->nombre;
        $cb->resta =$request->monto - $request->abono;
        $cb->save();
    
      }



      $p = Atenciones::find($request->id);
      $p->monto =$request->monto;
      $p->abono =$request->abono;
      $p->tipo_pago =$request->tipo_pago;
      $p->tipo_origen =$request->tipo_origen;
      if($request->tipo_origen == 3){
        $p->id_origen =99;
      }else{
        $p->id_origen = $request->origen_usuario != null ? $request->origen_usuario : $request->origen_usuario2;
      }        
      $res = $p->update();
    
        return redirect()->action('AtencionesController@index')
        ->with('success','Modificado Exitosamente!');

        //
    }

    public function updatec(Request $request)
    {



      
      $p = Consultas::where('id_atencion','=',$request->id)->first();
      $p->id_especialista =$request->especialista;
      $p->monto =$request->monto;
      $p->tipo =$request->tipo;
      $res = $p->update();

      $creditos = Creditos::where('id_atencion','=',$request->id)->first();
      $creditos->monto = $request->abono;
      $creditos->tipopago =$request->tipo_pago;
      $creditos->save();


      $p = Atenciones::find($request->id);
      $p->monto =$request->monto;
      $p->abono =$request->abono;
      $p->tipo_pago =$request->tipo_pago;
      $p->id_tipo =$request->tipo;
      $res = $p->update();
    
        return redirect()->action('AtencionesController@index')
        ->with('success','Modificado Exitosamente!');

        //
    }

    public function updatem(Request $request)
    {



      
      $m = Metodos::where('id_atencion','=',$request->id)->first();
      $m->id_producto =$request->metodo;
      $m->monto =$request->monto;
      $resm = $m->update();

      $creditos = Creditos::where('id_atencion','=',$request->id)->first();
      $creditos->monto = $request->monto;
      $creditos->tipopago =$request->tipo_pago;
      $creditos->save();


      $p = Atenciones::find($request->id);
      $p->monto =$request->monto;
      $p->abono =$request->abono;
      $p->tipo_pago =$request->tipo_pago;
      $p->id_tipo = $request->metodo;
      $res = $p->update();
    
        return redirect()->action('AtencionesController@index')
        ->with('success','Modificado Exitosamente!');

        //
    }

    public function sesiones1(Request $request)
    {

      if ($request->id_paciente != null) {
      

        $sesiones = DB::table('sesiones as a')
        ->select('a.id', 'a.id_atencion','a.created_at', 'a.estatus','at.id_tipo','at.id_paciente','b.nombres','b.apellidos','b.dni','s.nombre as servicio')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('servicios as s', 's.id', 'at.id_tipo')
        ->where('a.estatus', '=',0)
        ->where('a.id_paciente','=', $request->id_paciente)
        ->get();


    } else {

        $f1 = date('Y-m-d');
        $f2 = date('Y-m-d');


        $sesiones = DB::table('sesiones as a')
        ->select('a.id', 'a.id_atencion','a.created_at', 'a.estatus','at.id_tipo','at.id_paciente','b.nombres','b.apellidos','b.dni','s.nombre as servicio')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('servicios as s', 's.id', 'at.id_tipo')
        ->where('a.estatus', '=',0)
        ->where('a.id_paciente','=', 'CCCCCCC')
       // ->whereBetween('a.created_at', [$f1, $f2])
        ->get();


    }

    if(!is_null($request->filtro)){
      $pacientes =Pacientes::where("estatus", '=', 1)->where('apellidos','like','%'.$request->filtro.'%')->orderby('apellidos','asc')->get();
      }else{
      $pacientes =Pacientes::where("estatus", '=', 9)->orderby('nombres','asc')->get();
      }

      $personal = User::where('estatus','=',1)->where('tipo','=',1)->where('tipo_personal','=','ProfSalud')->orderBy('lastname','ASC')->get();





    

      return view('sesiones.index', compact('sesiones','pacientes','personal'));
       
    }

    public function sesiones2(Request $request)
    {

      if ($request->id_paciente != null) {
      

        $sesiones = DB::table('sesiones as a')
        ->select('a.id', 'a.id_atencion','a.created_at', 'a.id_personal','a.estatus','at.id_tipo','at.id_paciente','b.nombres','b.apellidos','b.dni','s.nombre as servicio','u.name','u.lastname')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('servicios as s', 's.id', 'at.id_tipo')
        ->join('users as u', 'u.id', 'a.id_personal')
        ->where('a.estatus', '=',1)
        ->where('a.id_paciente','=', $request->id_paciente)
        ->get();


    } else {

        $f1 = date('Y-m-d');
        $f2 = date('Y-m-d');


        $sesiones = DB::table('sesiones as a')
        ->select('a.id', 'a.id_atencion','a.created_at', 'a.id_personal','a.estatus','at.id_tipo','at.id_paciente','b.nombres','b.apellidos','b.dni','s.nombre as servicio','u.name','u.lastname')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('servicios as s', 's.id', 'at.id_tipo')
        ->join('users as u', 'u.id', 'a.id_personal')
        ->where('a.estatus', '=',1)
        ->where('a.id_paciente','=', 'CCCCCCC')
       // ->whereBetween('a.created_at', [$f1, $f2])
        ->get();


    }

    if(!is_null($request->filtro)){
      $pacientes =Pacientes::where("estatus", '=', 1)->where('apellidos','like','%'.$request->filtro.'%')->orderby('apellidos','asc')->get();
      }else{
      $pacientes =Pacientes::where("estatus", '=', 9)->orderby('nombres','asc')->get();
      }

      $personal = User::where('estatus','=',1)->where('tipo','=',1)->where('tipo_personal','=','ProfSalud')->orderBy('lastname','ASC')->get();





      return view('sesiones.index1', compact('sesiones','pacientes','personal'));
       
    }

    public function atender_sesion(Request $request)
    {


       

      $p = Sesiones::find($request->id);
      $p->estatus =1;
      $p->id_personal =$request->personal;
    
      $res = $p->update();
    
    
    return back();

        //
    }


 
    public function delete($id)
    {


        $pagosp = PagosPersonal::where('id','=',$id)->first();
        $pagosp->delete();

     

        return redirect()->action('PagosPersonalController@index')
        ->with('success','Eliminado Exitosamente!');
        //
    }
}

