<?php

namespace App\Http\Controllers;
use App\Equipos;
use App\Analisis;
use App\Clientes;
use App\Tiempo;
use App\Material;
use App\Pacientes;
use App\Servicios;
use App\User;
use App\Atenciones;
use App\Comisiones;
use Auth;
use Illuminate\Http\Request;
use DB;


class ComisionesPagarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->inicio) {
            $f1 = $request->inicio;
            $f2 = $request->fin;



         
        if ($request->origen != null) {
            $comisiones = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.id_responsable','a.id_origen', 'a.created_at', 'a.detalle', 'a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.resta', 'at.tipo_atencion', 'at.sede', 'at.atendido', 'at.tipo_origen', 'at.id_origen', 'at.abono', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 1)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->where('a.id_responsable', '=', $request->origen)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderBy('a.created_at', 'ASC')
        ->get();


        $origen = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.id_origen', 'a.id_responsable', 'a.created_at', 'a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.atendido', 'at.sede', 'at.resta', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'c.name as nameo', 'c.lastname as lasto', 'c.id as idorigen')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 1)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->whereBetween('a.created_at', [$f1, $f2])
        //->where('at.id_origen', '=', $request->origen)
        ->groupBy('a.id_responsable')
        ->get();

        } else {
          $comisiones = DB::table('comisiones as a')
          ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.id_origen', 'a.created_at', 'a.detalle', 'a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.resta', 'at.tipo_atencion', 'at.sede', 'at.atendido', 'at.tipo_origen', 'at.id_origen', 'at.abono', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
          ->join('atenciones as at', 'at.id', 'a.id_atencion')
          ->join('pacientes as b', 'b.id', 'at.id_paciente')
          ->join('users as c', 'c.id', 'a.id_responsable')
          ->join('users as d', 'd.id', 'a.usuario')
          ->where('a.estatus', '=', 1)
          ->where('a.id_origen', '=', 1)
          ->where('at.atendido', '=', 2)
          ->where('at.resta', '=', 0)
          ->where('at.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [$f1, $f2])
          ->orderBy('a.created_at', 'ASC')
          ->get();
  
  
  
              $origen = DB::table('comisiones as a')
          ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.id_origen', 'a.id_responsable', 'a.created_at', 'a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.atendido', 'at.sede', 'at.resta', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'c.name as nameo', 'c.lastname as lasto', 'c.id as idorigen')
          ->join('atenciones as at', 'at.id', 'a.id_atencion')
          ->join('users as c', 'c.id', 'a.id_responsable')
          ->where('a.estatus', '=', 1)
          ->where('a.id_origen', '=', 1)
          ->where('at.atendido', '=', 2)
          ->where('at.resta', '=', 0)
          ->where('at.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [$f1, $f2])
          ->groupBy('a.id_responsable')
          ->get();

        }


        } else {

            $f1 = date('Y-m-d');
            $f2 = date('Y-m-d');

      

        $comisiones = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion','a.id_origen','a.id_responsable','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente','at.resta', 'at.tipo_atencion', 'at.sede', 'at.atendido','at.tipo_origen','at.abono', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 1)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
       // ->where('at.monto', 'at.abono')
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderBy('a.created_at','ASC')
        ->get();



        
       /* $origen = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion','a.id_origen','a.id_responsable', 'a.created_at','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente','at.resta', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen','at.atendido', 'at.abono','at.id_origen', 'at.monto as total',  'c.name as nameo', 'c.lastname as lasto','c.id as idorigen')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 1)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
        ->where('at.monto','at.abono')
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->where('a.created_at','=',date('Y-m-d'))
        ->groupBy('at.id_origen')
        ->get();*/

        $origen = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion','a.id_origen', 'a.id_responsable','a.created_at','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.atendido','at.sede', 'at.resta','at.tipo_origen', 'at.id_origen', 'at.monto as total',  'c.name as nameo', 'c.lastname as lasto','c.id as idorigen')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 1)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->where('a.created_at', '=',date('Y-m-d'))
        ->groupBy('a.id_responsable')
        ->get();






        }
        //->where('a.monto', '!=', '0')
        //->get(); 

        


        return view('compagar.index', compact('comisiones','f1','f2','origen'));
        //
    }

    public function index1(Request $request)
    {

        if ($request->inicio) {
            $f1 = $request->inicio;
            $f2 = $request->fin;


         
      

        if ($request->origen != null) {
            $comisiones = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.id_origen', 'a.id_responsable', 'a.created_at', 'a.detalle', 'a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.resta', 'at.tipo_atencion', 'at.sede', 'at.atendido', 'at.tipo_origen', 'at.abono', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 2)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->where('a.id_responsable', '=', $request->origen)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderBy('a.created_at', 'ASC')
        ->get();

            $origen = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.id_origen', 'a.id_responsable', 'a.created_at', 'a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.atendido', 'at.sede', 'at.resta', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'c.name as nameo', 'c.lastname as lasto', 'c.id as idorigen')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 2)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->whereBetween('a.created_at', [$f1, $f2])
        //->where('at.id_origen', '=', $request->origen)
        ->groupBy('a.id_responsable')
        ->get();
        } else {

          $comisiones = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.id_origen', 'a.id_responsable', 'a.created_at', 'a.detalle', 'a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.resta', 'at.tipo_atencion', 'at.sede', 'at.atendido', 'at.tipo_origen', 'at.abono', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 2)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderBy('a.created_at', 'ASC')
        ->get();

            $origen = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.id_origen', 'a.id_responsable', 'a.created_at', 'a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.atendido', 'at.sede', 'at.resta', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'c.name as nameo', 'c.lastname as lasto', 'c.id as idorigen')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 2)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->whereBetween('a.created_at', [$f1, $f2])
        ->groupBy('a.id_responsable')
        ->get();



        }


        } else {

            $f1 = date('Y-m-d');
            $f2 = date('Y-m-d');

      

      

        $comisiones = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion','a.id_origen','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus','a.id_responsable', 'at.id_paciente', 'at.atendido','at.tipo_atencion','at.resta', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 2)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderBy('a.created_at','ASC')
        ->get();

        $origen = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion','a.id_origen', 'a.created_at','a.usuario','a.id_responsable', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion','at.atendido', 'at.sede','at.resta', 'at.tipo_origen', 'at.id_origen', 'at.monto as total',  'c.name as nameo', 'c.lastname as lasto','c.id as idorigen')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 2)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->where('a.created_at','=',date('Y-m-d'))
        ->groupBy('at.id_origen')
        ->get();


      



        }

        return view('compagar.index1', compact('comisiones','f1','f2','origen'));
        //
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ecografias = Servicios::where('estatus','=',1)->where('tipo','=','ECOGRAFIA')->get();
        $rayos = Servicios::where('estatus','=',1)->where('tipo','=','RAYOS')->get();
        $otros = Servicios::where('estatus','=',1)->where('tipo','=','OTROS')->get();
        $analisis = Analisis::where('estatus','=',1)->get();

        if(!is_null($request->pac)){
            $paciente = Pacientes::where('dni','=',$request->pac)->first();
            $res = 'SI';
            } else {
            $paciente = Pacientes::where('dni','=','LABORATORIO')->first();
            $res = 'NO';
            }

        return view('atenciones.create', compact('ecografias','rayos','otros','analisis','paciente','res'));
    }

    public function pagarmultiple(Request $request)
    {


      if(isset($request->com)){
        $last = Comisiones::select('recibo')->where('estatus','=',2)->orderby('recibo', 'desc')->max('recibo');
        if ($last != NULL) {
          $last1 = $last;
          //$last = array_pop($last);
        } else {
          $last1 = 0;
        }
  
        $recibo = $last1 + 1;
        
        foreach ($request->com as $atencion) {

          $com = Comisiones::where('id','=',$atencion)->first();

          $a = Atenciones::where('id','=',$com->id_atencion)->first();
          $a->pagado =2;
          $resa = $a->update();
         

          Comisiones::where('id', $atencion)
                    ->update([
                        'fecha_pago' => date('Y-m-d'),
                        'estatus' => 2,
                        'recibo' => $recibo
                    ]);
        }
  
      } 
  
      return back();
    }




    public function getServicio($id)
    {
        return Servicios::where('id','=',$id)->first();

    }

    public function getAnalisis($id)
    {
        return Analisis::where('id','=',$id)->first();

    }

    public function personal(){
     
        $personal = User::where('estatus','=',1)->where('tipo','=',1)->get();

 
     return view('atenciones.personal', compact('personal'));
   }

   public function profesionales(){
     
    $profesionales = User::where('estatus','=',1)->where('tipo','=',2)->get();


 return view('atenciones.profesionales', compact('profesionales'));
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

        $searchUsuarioID = DB::table('users')
        ->select('*')
        ->where('id','=', $request->origen_usuario)
        ->first();  

       // dd($request->precio_con);

        //GUARDANDO CONSULTAS
        
        if(!is_null($request->precio_con)){
            $lab = new Atenciones();
            $lab->tipo_origen =  $request->origen;
            $lab->id_origen = $searchUsuarioID->id;
            $lab->id_paciente =  $request->paciente;
            $lab->tipo_atencion = 5;
            $lab->id_tipo = $request->esp_con;
            $lab->monto = $request->precio_con;
            $lab->abono = $request->precio_con;
            $lab->tipo_pago = $request->tipop_con;
            $lab->usuario = Auth::user()->id;
            $lab->save();

        }

        
        //GUARDANDO METODOS
        
        if(!is_null($request->precio_met)){
            $lab = new Atenciones();
            $lab->tipo_origen =  $request->origen;
            $lab->id_origen = $searchUsuarioID->id;
            $lab->id_paciente =  $request->paciente;
            $lab->tipo_atencion = 6;
           // $lab->id_tipo = $request->esp_con;
            $lab->monto = $request->precio_met;
            $lab->abono = $request->precio_met;
            $lab->tipo_pago = $request->tipop_met;
            $lab->usuario = Auth::user()->id;
            $lab->save();

        }

        //GUARDANDO SERVICIOS
        
        if (isset($request->id_servicio)) {
            foreach ($request->id_servicio['servicios'] as $key => $serv) {
              if (!is_null($serv['servicio'])) {

                //TIPO ATENCION SERVICIOS= 1
                $lab = new Atenciones();
                $lab->tipo_origen =  $request->origen;
                $lab->id_origen = $searchUsuarioID->id;
                $lab->id_paciente =  $request->paciente;
                $lab->tipo_atencion = 1;
                $lab->id_tipo = $serv['servicio'];
                $lab->monto = (float)$request->monto_s['servicios'][$key]['monto'];
                $lab->abono = (float)$request->monto_abol['servicios'][$key]['abono'];
                $lab->tipo_pago = $request->id_pago['servicios'][$key]['tipop'];
                $lab->usuario = Auth::user()->id;
                $lab->save();
              } 
            }
          }





        //GUARDANDO ANALISIS


        if (isset($request->id_analisi)) {
            foreach ($request->id_analisi['analisis'] as $key => $laboratorio) {
              if (!is_null($laboratorio['analisi'])) {

                //TIPO ATENCION LABORATORIO= 4
                $lab = new Atenciones();
                $lab->tipo_origen =  $request->origen;
                $lab->id_origen = $searchUsuarioID->id;
                $lab->id_paciente =  $request->paciente;
                $lab->tipo_atencion = 4;
                $lab->id_tipo = $laboratorio['analisi'];
                $lab->monto = (float)$request->monto_s['analisis'][$key]['monto'];
                $lab->abono = (float)$request->monto_abol['analisis'][$key]['abono'];
                $lab->tipo_pago = $request->id_pago['analisis'][$key]['tipop'];
                $lab->usuario = Auth::user()->id;
                $lab->save();
              } 
            }
          }

          //GUARDANDO ECOGRAFIAS

          if (isset($request->id_ecografia)) {
            foreach ($request->id_ecografia['ecografias'] as $key => $eco) {
              if (!is_null($eco['ecografia'])) {

                //TIPO ATENCION ECOGRAFIA= 2
                $lab = new Atenciones();
                $lab->tipo_origen =  $request->origen;
                $lab->id_origen = $searchUsuarioID->id;
                $lab->id_paciente =  $request->paciente;
                $lab->tipo_atencion = 2;
                $lab->id_tipo = $eco['ecografia'];
                $lab->monto = (float)$request->monto_s['ecografias'][$key]['monto'];
                $lab->abono = (float)$request->monto_abol['ecografias'][$key]['abono'];
                $lab->tipo_pago = $request->id_pago['ecografias'][$key]['tipop'];
                $lab->usuario = Auth::user()->id;
                $lab->save();
              } 
            }
          }

          //GUARDANDO RAYOS X

          if (isset($request->id_rayo)) {
            foreach ($request->id_rayo['rayos'] as $key => $ray) {
              if (!is_null($ray['rayo'])) {

                //TIPO ATENCION RAYOS= 3
                $lab = new Atenciones();
                $lab->tipo_origen =  $request->origen;
                $lab->id_origen = $searchUsuarioID->id;
                $lab->id_paciente =  $request->paciente;
                $lab->tipo_atencion = 3;
                $lab->id_tipo = $ray['rayo'];
                $lab->monto = (float)$request->monto_s['rayos'][$key]['monto'];
                $lab->abono = (float)$request->monto_abol['rayos'][$key]['abono'];
                $lab->tipo_pago = $request->id_pago['rayos'][$key]['tipop'];
                $lab->usuario = Auth::user()->id;
                $lab->save();
              } 
            }
          }



        
    

        return redirect()->action('AtencionesController@index')
        ->with('success','Creado Exitosamente!');

        //return redirect()->action('AnalisisController@index', ["created" => true, "analisis" => Analisis::all()]);

    }

    public function reporte_compagar(Request $request)
    {
        if ($request->inicio) {
            $f1 = $request->inicio;
            $f2 = $request->fin;

         
        if($request->origen == 9){

          $comisiones = DB::table('comisiones as a')
          ->select('a.id', 'a.estatus', 'a.id_atencion','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente','at.resta', 'at.tipo_atencion', 'at.sede','at.atendido', 'at.tipo_origen', 'at.id_origen','at.abono', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
          ->join('atenciones as at', 'at.id', 'a.id_atencion')
          ->join('pacientes as b', 'b.id', 'at.id_paciente')
          ->join('users as c', 'c.id', 'at.id_origen')
          ->join('users as d', 'd.id', 'a.usuario')
          ->where('at.tipo_origen', '=', 1)
          //->where('at.atendido', '=', 2)
          //->where('at.resta', '=', 0)
          ->where('at.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [$f1, $f2])
          ->orderBy('a.created_at','ASC')
          ->get();
  
          $origen = DB::table('comisiones as a')
          ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.created_at','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion','at.resta', 'at.sede', 'at.tipo_origen','at.atendido', 'at.id_origen','at.abono', 'at.monto as total',  'c.name as nameo', 'c.lastname as lasto','c.id as idorigen')
          ->join('atenciones as at', 'at.id', 'a.id_atencion')
          ->join('users as c', 'c.id', 'at.id_origen')
          ->where('at.tipo_origen', '=', 1)
          //->where('at.atendido', '=', 2)
          //->where('at.resta', '=', 0)
          ->where('at.sede', '=', $request->session()->get('sede'))
          ->groupBy('at.id_origen')
          //->where('at.id_origen','=',$request->origen)
          ->get();
  
          $total = DB::table('comisiones')
          ->join('atenciones', 'atenciones.id', '=', 'comisiones.id_atencion')
         // ->join('orders', 'users.id', '=', 'orders.user_id')
          ->where('atenciones.sede','=',$request->session()->get('sede'))
          ->where('atenciones.tipo_origen','=',1)
          ->where('atenciones.atendido','=',2)
          ->where('atenciones.resta','=',0)
          ->whereBetween('comisiones.created_at', [$f1, $f2])
          ->select(DB::raw('COUNT(*) as cantidad, SUM(comisiones.monto) as monto'))
          ->first();

        } else {

          $comisiones = DB::table('comisiones as a')
          ->select('a.id', 'a.estatus', 'a.id_atencion','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente','at.resta', 'at.tipo_atencion', 'at.sede','at.atendido', 'at.tipo_origen', 'at.id_origen','at.abono', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
          ->join('atenciones as at', 'at.id', 'a.id_atencion')
          ->join('pacientes as b', 'b.id', 'at.id_paciente')
          ->join('users as c', 'c.id', 'at.id_origen')
          ->join('users as d', 'd.id', 'a.usuario')
          ->where('at.tipo_origen', '=', 1)
          //->where('at.atendido', '=', 2)
          //->where('at.resta', '=', 0)
          ->where('at.sede', '=', $request->session()->get('sede'))
          ->where('at.id_origen','=',$request->origen)
          ->whereBetween('a.created_at', [$f1, $f2])
          ->orderBy('a.created_at','ASC')
          ->get();
  
          
         
  
  
           
          $origen = DB::table('comisiones as a')
          ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.created_at','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion','at.resta', 'at.sede', 'at.tipo_origen','at.atendido', 'at.id_origen','at.abono', 'at.monto as total',  'c.name as nameo', 'c.lastname as lasto','c.id as idorigen')
          ->join('atenciones as at', 'at.id', 'a.id_atencion')
          ->join('users as c', 'c.id', 'at.id_origen')
          ->where('at.tipo_origen', '=', 1)
          //->where('at.atendido', '=', 2)
          //->where('at.resta', '=', 0)
          ->where('at.sede', '=', $request->session()->get('sede'))
          ->groupBy('at.id_origen')
          //->where('at.id_origen','=',$request->origen)
          ->get();
  
          $total = DB::table('comisiones')
          ->join('atenciones', 'atenciones.id', '=', 'comisiones.id_atencion')
         // ->join('orders', 'users.id', '=', 'orders.user_id')
          ->where('atenciones.sede','=',$request->session()->get('sede'))
          ->where('atenciones.tipo_origen','=',1)
          ->where('atenciones.atendido','=',2)
          ->where('atenciones.resta','=',0)
          ->where('atenciones.id_origen','=',$request->origen)
          ->whereBetween('comisiones.created_at', [$f1, $f2])
          ->select(DB::raw('COUNT(*) as cantidad, SUM(comisiones.monto) as monto'))
          ->groupBy('atenciones.id_origen')
          ->first();

        }
      


        } else {

            $f1 = date('Y-m-d');
            $f2 = date('Y-m-d');

      

        $comisiones = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente','at.resta', 'at.tipo_atencion', 'at.sede', 'at.atendido','at.tipo_origen','at.abono', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('at.tipo_origen', '=', 1)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderBy('a.created_at','ASC')
        ->get();




        
       /* $origen = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.created_at','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente','at.resta', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen','at.atendido', 'at.abono','at.id_origen', 'at.monto as total',  'c.name as nameo', 'c.lastname as lasto','c.id as idorigen')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->where('a.estatus', '=', 1)
        ->where('at.tipo_origen', '=', 1)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
        ->where('at.monto','at.abono')
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->where('a.created_at','=',date('Y-m-d'))
        ->groupBy('at.id_origen')
        ->get();*/
        $origen = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.created_at','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion','at.resta', 'at.sede', 'at.tipo_origen','at.atendido', 'at.id_origen','at.abono', 'at.monto as total',  'c.name as nameo', 'c.lastname as lasto','c.id as idorigen')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->where('at.tipo_origen', '=', 1)
        //->where('at.atendido', '=', 2)
        //->where('at.resta', '=', 0)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->groupBy('at.id_origen')
        ->get();

        /*$total = Comisiones::whereBetween('created_at', [$f1, $f2])
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->where('estatus', '=', 1)
        ->where('sede','=',$request->session()->get('sede'))
        ->first();*/

        $total = DB::table('comisiones')
            ->join('atenciones', 'atenciones.id', '=', 'comisiones.id_atencion')
           // ->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('atenciones.sede','=',$request->session()->get('sede'))
            ->where('atenciones.tipo_origen','=',1)
            //->where('atenciones.atendido','=',2)
            //->where('atenciones.resta','=',0)
            ->whereBetween('comisiones.created_at', [$f1, $f2])
            ->select(DB::raw('COUNT(*) as cantidad, SUM(comisiones.monto) as monto'))
           //->groupBy('atenciones.id_origen')
            ->first();










        }
        //->where('a.monto', '!=', '0')
        //->get(); 

        


        return view('compagar.reporte', compact('comisiones','f1','f2','origen','total'));
        //
    }

    public function reporte_compagar1(Request $request)
    {
        if ($request->inicio) {
            $f1 = $request->inicio;
            $f2 = $request->fin;


        if($request->origen == 9){

          $comisiones = DB::table('comisiones as a')
          ->select('a.id', 'a.estatus', 'a.id_atencion','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente','at.resta', 'at.tipo_atencion', 'at.sede','at.atendido', 'at.tipo_origen', 'at.id_origen','at.abono', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
          ->join('atenciones as at', 'at.id', 'a.id_atencion')
          ->join('pacientes as b', 'b.id', 'at.id_paciente')
          ->join('users as c', 'c.id', 'at.id_origen')
          ->join('users as d', 'd.id', 'a.usuario')
          ->where('at.tipo_origen', '=', 2)
          ->where('at.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [$f1, $f2])
          ->orderBy('a.created_at','ASC')
          ->get();
  
          
         
  
  
           
          $origen = DB::table('comisiones as a')
          ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.created_at','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion','at.resta', 'at.sede', 'at.tipo_origen','at.atendido', 'at.id_origen','at.abono', 'at.monto as total',  'c.name as nameo', 'c.lastname as lasto','c.id as idorigen')
          ->join('atenciones as at', 'at.id', 'a.id_atencion')
          ->join('users as c', 'c.id', 'at.id_origen')
          ->where('at.tipo_origen', '=', 2)
          ->where('at.sede', '=', $request->session()->get('sede'))
          //->where('at.id_origen','=',$request->origen)
          ->groupBy('at.id_origen')
          ->get();
  
          $total = DB::table('comisiones')
          ->join('atenciones', 'atenciones.id', '=', 'comisiones.id_atencion')
         // ->join('orders', 'users.id', '=', 'orders.user_id')
          ->where('atenciones.sede','=',$request->session()->get('sede'))
          ->where('atenciones.tipo_origen','=',2)
          ->whereBetween('comisiones.created_at', [$f1, $f2])
          ->select(DB::raw('COUNT(*) as cantidad, SUM(comisiones.monto) as monto'))
          ->first();

        } else {

          $comisiones = DB::table('comisiones as a')
          ->select('a.id', 'a.estatus', 'a.id_atencion','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente','at.resta', 'at.tipo_atencion', 'at.sede','at.atendido', 'at.tipo_origen', 'at.id_origen','at.abono', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
          ->join('atenciones as at', 'at.id', 'a.id_atencion')
          ->join('pacientes as b', 'b.id', 'at.id_paciente')
          ->join('users as c', 'c.id', 'at.id_origen')
          ->join('users as d', 'd.id', 'a.usuario')
          ->where('at.tipo_origen', '=', 2)
          ->where('at.sede', '=', $request->session()->get('sede'))
          ->where('at.id_origen','=',$request->origen)
          ->whereBetween('a.created_at', [$f1, $f2])
          ->orderBy('a.created_at','ASC')
          ->get();
  
          
         
  
  
           
          $origen = DB::table('comisiones as a')
          ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.created_at','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion','at.resta', 'at.sede', 'at.tipo_origen','at.atendido', 'at.id_origen','at.abono', 'at.monto as total',  'c.name as nameo', 'c.lastname as lasto','c.id as idorigen')
          ->join('atenciones as at', 'at.id', 'a.id_atencion')
          ->join('users as c', 'c.id', 'at.id_origen')
          ->where('at.tipo_origen', '=', 2)
          ->where('at.sede', '=', $request->session()->get('sede'))
          //->where('at.id_origen','=',$request->origen)
          ->groupBy('at.id_origen')
          ->get();
  
          $total = DB::table('comisiones')
          ->join('atenciones', 'atenciones.id', '=', 'comisiones.id_atencion')
         // ->join('orders', 'users.id', '=', 'orders.user_id')
          ->where('atenciones.sede','=',$request->session()->get('sede'))
          ->where('atenciones.tipo_origen','=',2)
          ->where('atenciones.id_origen','=',$request->origen)
          ->whereBetween('comisiones.created_at', [$f1, $f2])
          ->select(DB::raw('COUNT(*) as cantidad, SUM(comisiones.monto) as monto'))
          ->groupBy('atenciones.id_origen')
          ->first();

        }

         
        
   


        } else {

            $f1 = date('Y-m-d');
            $f2 = date('Y-m-d');

      

        $comisiones = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente','at.resta', 'at.tipo_atencion', 'at.sede', 'at.atendido','at.tipo_origen','at.abono', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('at.tipo_origen', '=', 2)
       // ->where('at.monto', 'at.abono')
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderBy('a.created_at','ASC')
        ->get();



        
       /* $origen = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.created_at','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente','at.resta', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen','at.atendido', 'at.abono','at.id_origen', 'at.monto as total',  'c.name as nameo', 'c.lastname as lasto','c.id as idorigen')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->where('a.estatus', '=', 1)
        ->where('at.tipo_origen', '=', 1)
        ->where('at.atendido', '=', 2)
        ->where('at.resta', '=', 0)
        ->where('at.monto','at.abono')
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->where('a.created_at','=',date('Y-m-d'))
        ->groupBy('at.id_origen')
        ->get();*/
        $origen = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.created_at','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion','at.resta', 'at.sede', 'at.tipo_origen','at.atendido', 'at.id_origen','at.abono', 'at.monto as total',  'c.name as nameo', 'c.lastname as lasto','c.id as idorigen')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->where('at.tipo_origen', '=', 2)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->groupBy('at.id_origen')
        ->get();

        /*$total = Comisiones::whereBetween('created_at', [$f1, $f2])
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->where('estatus', '=', 1)
        ->where('sede','=',$request->session()->get('sede'))
        ->first();*/

        $total = DB::table('comisiones')
            ->join('atenciones', 'atenciones.id', '=', 'comisiones.id_atencion')
           // ->join('orders', 'users.id', '=', 'orders.user_id')
            ->where('atenciones.sede','=',$request->session()->get('sede'))
            ->where('atenciones.tipo_origen','=',2)
            ->whereBetween('comisiones.created_at', [$f1, $f2])
            ->select(DB::raw('COUNT(*) as cantidad, SUM(comisiones.monto) as monto'))
            //->groupBy('atenciones.id_origen')
            ->first();










        }
        //->where('a.monto', '!=', '0')
        //->get(); 

        


        return view('compagar.reporte1', compact('comisiones','f1','f2','origen','total'));
        //
    }

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Analisis  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $atencion = Atenciones::where('id','=',1)->first();

        return view('atenciones.edit', compact('atencion')); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function pagar($id)
    {

      $com = Comisiones::where('id','=',$id)->first();

      $last = Comisiones::select('recibo')->where('estatus','=',2)->orderby('recibo', 'desc')->max('recibo');
      if ($last != NULL) {
        $last1 = $last;
        //$last = array_pop($last);
      } else {
        $last1 = 0;
      }

      $recibo = $last1 + 1;


      $a = Atenciones::where('id','=',$com->id_atencion)->first();
      $a->pagado =2;
      $resa = $a->update();
     

      $p = Comisiones::find($id);
      $p->estatus =2;
      $p->recibo = $recibo;
      $p->fecha_pago = date('Y-m-d');
      $res = $p->update();
    
      return back();

        //
    }

 
    public function delete($id)
    {

        $searchUsuarioID = DB::table('users')
        ->select('*')
        ->where('id','=', Auth::user()->id)
        ->first();  

        $atencion = Atenciones::find($id);
        $atencion->estatus = 0;
        $atencion->eliminado_por= $searchUsuarioID->name.' '.$searchUsuarioID->lastname;
        $atencion->save();

        $com = Comisiones::where('id_atencion','=',$id)->first();
        $com->estatus = 0;
        $com->save();

        return redirect()->action('AtencionesController@index')
        ->with('success','Eliminado Exitosamente!');
        //
    }
}