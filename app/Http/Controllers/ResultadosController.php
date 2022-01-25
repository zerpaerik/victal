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
use App\ResultadosServicios;
use App\ResultadosLaboratorio;
use App\ResultadosLabTemplate;
use App\Templates;
use Auth;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\Style\Font;
use HTMLtoOpenXML;
use Carbon\Carbon;
use File;
use DB;


class ResultadosController extends Controller
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
  

            $resultados = DB::table('resultados_servicios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_servicio', 'a.informe','b.usuario', 'a.created_at', 'a.estatus','b.resta','b.monto','b.abono', 'b.id_paciente','b.estatus','b.sede', 'b.id_origen', 's.nombre as servicio', 'pa.nombres', 'pa.apellidos', 'c.name', 'c.lastname')
        ->join('atenciones as b', 'b.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'b.id_origen')
        ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
        ->join('servicios as s', 's.id', 'a.id_servicio')
        ->where('b.estatus', '=', 1)
       // ->where('b.resta', '=', 0)
        ->where('a.estatus', '=', 1)
        ->where('b.sede', '=', $request->session()->get('sede'))
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderBy('a.id','DESC')
        //->where('a.monto', '!=', '0')
        ->get();
        } else {

            $f1 = date('Y-m-d');
            $f2 = date('Y-m-d');


            $resultados = DB::table('resultados_servicios as a')
            ->select('a.id', 'a.id_atencion', 'a.id_servicio','a.informe', 'b.usuario','b.resta', 'a.created_at', 'a.estatus', 'b.estatus','b.monto','b.abono','b.sede','b.id_paciente', 'b.id_origen', 's.nombre as servicio', 'pa.nombres', 'pa.apellidos', 'c.name', 'c.lastname')
            ->join('atenciones as b', 'b.id', 'a.id_atencion')
            ->join('users as c', 'c.id', 'b.id_origen')
            ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
            ->join('servicios as s', 's.id', 'a.id_servicio')
            ->where('b.estatus', '=', 1)
            ->where('a.estatus', '=', 1)
            //->where('b.resta', '=', 0)
            ->where('b.sede', '=', $request->session()->get('sede'))
            ->where('a.created_at', '=', date('Y-m-d'))
            ->orderBy('a.id','DESC')
            ->get();

            //->where('

        }


        return view('resultados.index', compact('resultados','f1','f2'));
        //
    }

    public function index1(Request $request)
    {

        if ($request->inicio) {
            $f1 = $request->inicio;
            $f2 = $request->fin;
  

            $resultados = DB::table('resultados_laboratorio as a')
        ->select('a.id', 'a.id_atencion', 'a.id_laboratorio', 'a.informe','b.usuario','b.resta', 'a.created_at', 'a.estatus','b.sede','b.monto','b.abono', 'b.estatus','b.id_paciente', 'b.id_origen', 's.nombre as laboratorio', 'pa.nombres', 'pa.apellidos', 'c.name', 'c.lastname')
        ->join('atenciones as b', 'b.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'b.id_origen')
        ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
        ->join('analisis as s', 's.id', 'a.id_laboratorio')
        ->where('b.estatus', '=', 1)
        ->where('a.estatus', '=', 1)
       // ->where('b.resta', '=', 0)
        ->where('b.sede', '=', $request->session()->get('sede'))
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderBy('a.id','DESC')
        ->get();
        } else {

            $f1 = date('Y-m-d');
            $f2 = date('Y-m-d');


            $resultados = DB::table('resultados_laboratorio as a')
            ->select('a.id', 'a.id_atencion', 'a.id_laboratorio','a.informe','b.resta', 'b.usuario', 'a.created_at', 'a.estatus','b.sede','b.monto','b.abono','b.estatus', 'b.id_paciente', 'b.id_origen', 's.nombre as laboratorio', 'pa.nombres', 'pa.apellidos', 'c.name', 'c.lastname')
            ->join('atenciones as b', 'b.id', 'a.id_atencion')
            ->join('users as c', 'c.id', 'b.id_origen')
            ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
            ->join('analisis as s', 's.id', 'a.id_laboratorio')
            ->where('b.estatus', '=', 1)
            ->where('a.estatus', '=', 1)
           // ->where('b.resta', '=', 0)
            ->where('b.sede', '=', $request->session()->get('sede'))
            ->where('a.created_at', '=', date('Y-m-d'))
            ->orderBy('a.id','DESC')
            ->get();

            //->where('

        }


        return view('resultados.index1', compact('resultados','f1','f2'));
        //
    }

    public function indexg(Request $request)
    {

      

        if ($request->id_paciente != null) {
            $resultados = DB::table('resultados_servicios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_servicio', 'a.informe', 'a.informe_guarda', 'b.estatus', 'b.usuario', 'a.created_at', 'a.estatus', 'b.sede','b.id_paciente', 'b.id_origen', 's.nombre as servicio', 'pa.nombres', 'pa.apellidos', 'c.name', 'c.lastname')
        ->join('atenciones as b', 'b.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'b.id_origen')
        ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
        ->join('servicios as s', 's.id', 'a.id_servicio')
        ->where('b.estatus', '=', 1)
        ->where('a.estatus', '=', 3)
        ->where('b.sede', '=', $request->session()->get('sede'))
        ->where('b.id_paciente', '=', $request->id_paciente)
        ->get();
        } else {
          $resultados = DB::table('resultados_servicios as a')
          ->select('a.id', 'a.id_atencion', 'a.id_servicio', 'a.informe', 'a.informe_guarda', 'b.estatus', 'b.usuario', 'a.created_at', 'a.estatus','b.sede', 'b.id_paciente', 'b.id_origen', 's.nombre as servicio', 'pa.nombres', 'pa.apellidos', 'c.name', 'c.lastname')
          ->join('atenciones as b', 'b.id', 'a.id_atencion')
          ->join('users as c', 'c.id', 'b.id_origen')
          ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
          ->join('servicios as s', 's.id', 'a.id_servicio')
          ->where('b.estatus', '=', 1)
          ->where('a.estatus', '=', 999)
          ->where('b.sede', '=', $request->session()->get('sede'))
          ->where('a.created_at', '=', date('Y-m-d'))
          ->get();

        }


        
    if(!is_null($request->filtro)){
      $pacientes =Pacientes::where("estatus", '=', 1)->where('apellidos','like','%'.$request->filtro.'%')->orderby('apellidos','asc')->get();
      }else{
      $pacientes =Pacientes::where("estatus", '=', 9)->orderby('nombres','asc')->get();
      }


        return view('resultados.indexg', compact('resultados','pacientes'));
        //
    }

    public function indexg1(Request $request)
    {

        if ($request->id_paciente) {
          

            $resultados = DB::table('resultados_laboratorio as a')
        ->select('a.id', 'a.id_atencion', 'a.id_laboratorio', 'a.informe','a.informe_guarda','b.estatus as sta_ate','b.sede','b.usuario', 'a.created_at', 'a.estatus', 'b.id_paciente', 'b.id_origen', 's.nombre as laboratorio', 'pa.nombres', 'pa.apellidos', 'c.name', 'c.lastname')
        ->join('atenciones as b', 'b.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'b.id_origen')
        ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
        ->join('analisis as s', 's.id', 'a.id_laboratorio')
        ->where('a.estatus', '=', 3)
        ->where('b.sede', '=', $request->session()->get('sede'))
        ->where('b.id_paciente', '=', $request->id_paciente)
        ->get();
        } else {

       

            $resultados = DB::table('resultados_laboratorio as a')
            ->select('a.id', 'a.id_atencion', 'a.id_laboratorio','a.informe', 'a.informe_guarda','b.estatus as sta_ate','b.sede','b.usuario', 'a.created_at', 'a.estatus', 'b.id_paciente', 'b.id_origen', 's.nombre as laboratorio', 'pa.nombres', 'pa.apellidos', 'c.name', 'c.lastname')
            ->join('atenciones as b', 'b.id', 'a.id_atencion')
            ->join('users as c', 'c.id', 'b.id_origen')
            ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
            ->join('analisis as s', 's.id', 'a.id_laboratorio')
            ->where('a.estatus', '=', 999)
            ->where('b.sede', '=', $request->session()->get('sede'))
            ->where('a.created_at', '=', date('Y-m-d'))
            ->get();

            //->where('

        }

        if(!is_null($request->filtro)){
          $pacientes =Pacientes::where("estatus", '=', 1)->where('apellidos','like','%'.$request->filtro.'%')->orderby('apellidos','asc')->get();
          }else{
          $pacientes =Pacientes::where("estatus", '=', 9)->orderby('nombres','asc')->get();
          }
    


        return view('resultados.indexgl', compact('resultados','pacientes'));
        //
    }







    public function asociar(Request $request){




      $rs = ResultadosServicios::where('id','=',$request->id)->first();
      $rs->informe = $request->informe;
      $rs->save();

       

    return back();


    }

    public function reversarg(Request $request){




      $rs = ResultadosServicios::where('id','=',$request->id)->first();
      $rs->estatus = 1;
      $rs->usuario_informe = null;
      $rs->informe_guarda = '';
      $rs->save();

       

    return back();


    }

    public function reversargl(Request $request){



      $rl = ResultadosLaboratorio::where('id','=',$request->id)->first();
      $rl->estatus = 1;
      $rl->usuario_informe = null;
      $rl->informe_guarda = '';
      $rl->save();


    return back();


    }

    public function asociarl(Request $request){



      $rl = ResultadosLaboratorio::where('id','=',$request->id)->first();
      $rl->informe = $request->informe;
      $rl->save();


    return back();


    }

    
    public function desoc(Request $request){




      $rs = ResultadosServicios::where('id','=',$request->id)->first();
      $rs->informe = '';
      $rs->save();

       

    return back();


    }

    public function desocl(Request $request){




      $rs = ResultadosLaboratorio::where('id','=',$request->id)->first();
      $rs->informe = '';
      $rs->save();

       

    return back();


    }

    public function asociar1(Request $request){

      //dd($request->all());

      $rs = ResultadosLaboratorio::where('id','=',$request->$id)->first();
      $rs->informe = $request->informe;
      $rs->save();

       
    return back();


    }

    
    public function guardar_informe($id)
    {

        $resultados = DB::table('resultados_servicios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_servicio', 'a.informe','b.usuario', 'a.created_at', 'a.estatus', 'b.id_paciente', 'b.id_origen', 's.nombre as servicio', 'pa.fechanac','pa.nombres', 'pa.apellidos','pa.dni', 'c.name', 'c.lastname')
        ->join('atenciones as b', 'b.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'b.id_origen')
        ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
        ->join('servicios as s', 's.id', 'a.id_servicio')
        //->where('a.estatus', '=', 1)
        ->where('a.id',  '=', $id)
        //->where('a.monto', '!=', '0')
        ->first();


        return view('resultados.guardar', compact('resultados'));

      
    }

    
    public function guardar_informel($id)
    {

        $resultados = DB::table('resultados_laboratorio as a')
        ->select('a.id', 'a.id_atencion', 'a.id_laboratorio', 'a.informe','b.usuario', 'a.created_at', 'a.estatus', 'b.id_paciente', 'b.id_origen', 's.nombre as servicio', 'pa.fechanac','pa.nombres', 'pa.apellidos','pa.dni', 'c.name', 'c.lastname')
        ->join('atenciones as b', 'b.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'b.id_origen')
        ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
        ->join('analisis as s', 's.id', 'a.id_laboratorio')
        //->where('a.estatus', '=', 1)
        ->where('a.id',  '=', $id)
        //->where('a.monto', '!=', '0')
        ->first();


        return view('resultados.guardarl', compact('resultados'));

      
    }




    public function guardar(Request $request){

      
      $usuario = DB::table('users')
      ->select('*')
      ->where('id','=', Auth::user()->id)
      ->first();  

      $res = ResultadosServicios::where('id','=',$request->id)->first();


      $servicio = Servicios::where('id','=',$res->id_servicio)->first();


      $atenc = Atenciones::where('id','=',$res->id_atencion)->first();


      if($usuario->tipo_personal == 'Tecnólogo' && $servicio->porcentaje2 > 0){



        $com = new Comisiones();
        $com->id_atencion =  $res->id_atencion;
        $com->detalle =  $servicio->nombre;
        $com->porcentaje = $servicio->porcentaje2;
        $com->id_responsable = Auth::user()->id;
        $com->monto = $atenc->monto * $servicio->porcentaje2 / 100;
        $com->id_origen = 1;
        $com->estatus = 1;
        $com->tecnologo = 1;
        $com->usuario = Auth::user()->id;
        $com->save();


      }

        $at = Atenciones::where('id','=',$res->id_atencion)->first();
        $img = $request->file('informe');
        $nombre_imagen=$img->getClientOriginalName();
        $at->informe =  $nombre_imagen;
        $at->atendido =  2;
        $at->atendido_por =  $usuario->lastname.' '.$usuario->name;
        $at->save();





        $rs = ResultadosServicios::where('id','=',$request->id)->first();
        $img = $request->file('informe');
        $nombre_imagen=$img->getClientOriginalName();
        $rs->estatus=3;
        $rs->usuario_informe=Auth::user()->id;
        $rs->informe_guarda=$nombre_imagen;
        if ($rs->save()) {
            \Storage::disk('public')->put($nombre_imagen, \File::get($img));
        }
        \DB::commit();


        return redirect()->route('resultados.index')
        ->with('success','Creado Exitosamente!');
           
      }

      public function guardarl(Request $request){

        $res = ResultadosLaboratorio::where('id','=',$request->id)->first();

        $atenc = Atenciones::where('id','=',$res->id_atencion)->first();

        $usuario = DB::table('users')
        ->select('*')
        ->where('id','=', Auth::user()->id)
        ->first();  

        
        $at = Atenciones::where('id','=',$res->id_atencion)->first();
        $img = $request->file('informe');
        $nombre_imagen=$img->getClientOriginalName();
        $at->informe =  $nombre_imagen;
        $at->atendido =  2;
        $at->atendido_por =  $usuario->lastname.' '.$usuario->name;
        $at->save();


        $rs = ResultadosLaboratorio::where('id','=',$request->id)->first();
        $img = $request->file('informe');
        $nombre_imagen=$img->getClientOriginalName();
        $rs->estatus=3;
        $rs->usuario_informe=Auth::user()->id;
        $rs->informe_guarda=$nombre_imagen;
        if ($rs->save()) {
            \Storage::disk('public')->put($nombre_imagen, \File::get($img));
        }
        \DB::commit();


        return redirect()->route('resultados.index1')
        ->with('success','Creado Exitosamente!');
           
      }




    public function modelo_informe($id,$informe)
    {

        File::delete(File::glob('*.docx'));
        $informe = $templateProcessor = new TemplateProcessor(public_path('modelos_informes/'.$informe));
      /*  $resultados = ReportesController::elasticSearch($id);
        $resultados1 = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.informe','a.abono','a.resultado','b.nombres as nombrePaciente','b.apellidos as apellidoPaciente','b.fechanac','c.detalle as servicio','e.name','e.dni as dniprof','e.lastname','d.name as laboratorio','b.dni')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->whereNotIn('a.monto',[0,0.00])
        ->where('a.resultado','=', NULL)
        ->where('a.id','=',$id)
        ->first();*/

        $resultados = DB::table('resultados_servicios as a')
        ->select('a.id', 'a.id_atencion', 'a.id_servicio', 'a.informe','b.usuario', 'a.created_at', 'a.estatus','b.tipo_origen', 'b.id_paciente', 'b.id_origen', 's.nombre as servicio', 'pa.fechanac','pa.nombres', 'pa.apellidos','pa.dni', 'c.name', 'c.lastname')
        ->join('atenciones as b', 'b.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'b.id_origen')
        ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
        ->join('servicios as s', 's.id', 'a.id_servicio')
        //->where('a.estatus', '=', 1)
        ->where('a.id',  '=', $id)
        //->where('a.monto', '!=', '0')
        ->first();


        if ($resultados->fechanac != null) {
            $edad = Carbon::parse($resultados->fechanac)->age;
        } else {
          $edad = "X";

        }

  
        $informe->setValue('name', $resultados->apellidos. ' '.$resultados->nombres. ' Edad: '.$edad);
        $informe->setValue('descripcion',$resultados->servicio);
        $informe->setValue('date',date('d-m-Y'));  
        if($resultados->tipo_origen == 2){
        $informe->setValue('indicacion',$resultados->id_origen);
        } else {
        $informe->setValue('indicacion','VICTAL');
        } 
        $informe->saveAs($resultados->id.'-'.$resultados->apellidos.'-'.$resultados->nombres.'-'.$resultados->dni.'.docx');
        return response()->download($resultados->id.'-'.$resultados->apellidos.'-'.$resultados->nombres.'-'.$resultados->dni.'.docx');

    }

    public function modelo_informel($id,$informe)
    {

        File::delete(File::glob('*.docx'));
        $informe = $templateProcessor = new TemplateProcessor(public_path('modelos_informes/'.$informe));
      /*  $resultados = ReportesController::elasticSearch($id);
        $resultados1 = DB::table('atenciones as a')
        ->select('a.id','a.id_paciente','a.origen_usuario','a.es_servicio','a.es_laboratorio','a.created_at','a.origen','a.id_servicio','a.pendiente','a.id_laboratorio','a.monto','a.porcentaje','a.informe','a.abono','a.resultado','b.nombres as nombrePaciente','b.apellidos as apellidoPaciente','b.fechanac','c.detalle as servicio','e.name','e.dni as dniprof','e.lastname','d.name as laboratorio','b.dni')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('servicios as c','c.id','a.id_servicio')
        ->join('analises as d','d.id','a.id_laboratorio')
        ->join('users as e','e.id','a.origen_usuario')
        ->whereNotIn('a.monto',[0,0.00])
        ->where('a.resultado','=', NULL)
        ->where('a.id','=',$id)
        ->first();*/

        $resultados = DB::table('resultados_laboratorio as a')
        ->select('a.id', 'a.id_atencion', 'a.id_laboratorio', 'a.informe','b.usuario', 'a.created_at', 'a.estatus','b.tipo_origen', 'b.id_paciente', 'b.id_origen', 's.nombre as servicio', 'pa.fechanac','pa.nombres', 'pa.apellidos','pa.dni', 'c.name', 'c.lastname')
        ->join('atenciones as b', 'b.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'b.id_origen')
        ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
        ->join('analisis as s', 's.id', 'a.id_laboratorio')
        //->where('a.estatus', '=', 1)
        ->where('a.id',  '=', $id)
        //->where('a.monto', '!=', '0')
        ->first();


        if ($resultados->fechanac != null) {
            $edad = Carbon::parse($resultados->fechanac)->age;
        } else {
          $edad = "X";

        }

  
        $informe->setValue('name', $resultados->apellidos. ' '.$resultados->nombres. ' Edad: '.$edad);
        $informe->setValue('descripcion',$resultados->servicio);
        $informe->setValue('date',date('d-m-Y'));    
        if($resultados->tipo_origen == 2){
          $informe->setValue('indicacion',$resultados->id_origen);
          } else {
          $informe->setValue('indicacion','VICTAL');
        }     
        $informe->saveAs($resultados->id.'-'.$resultados->apellidos.'-'.$resultados->nombres.'-'.$resultados->dni.'.docx');
        return response()->download($resultados->id.'-'.$resultados->apellidos.'-'.$resultados->nombres.'-'.$resultados->dni.'.docx');

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

    public function ver($id)
    {

      $res_i = DB::table('resultados_laboratorio as a')
      ->select('a.*','b.*','at.id_paciente','an.nombre as detalle','t.nombre as nom_val','t.referencia','pac.apellidos','pac.nombres','pac.dni')
      ->join('resultados_lab_template as b','b.id_resultado','a.id')
      ->join('analisis as an','an.id','a.id_laboratorio')
      ->join('templates as t','t.id','b.id_plantilla')
      ->join('atenciones as at','at.id','a.id_atencion')
      ->join('pacientes as pac','pac.id','at.id_paciente')
      ->where('a.id', '=', $id)
      ->first(); 

	  
        $res = DB::table('resultados_laboratorio as a')
        ->select('a.*','b.*','an.nombre as detalle','t.nombre as nom_val','t.referencia','t.medida')
        ->join('resultados_lab_template as b','b.id_resultado','a.id')
        ->join('analisis as an','an.id','a.id_laboratorio')
        ->join('templates as t','t.id','b.id_plantilla')
        ->where('a.id', '=', $id)
        ->get(); 




        $view = \View::make('resultados.pdf', compact('res_i','res'));
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
    
        return $pdf->stream('resultados-ver'.'.pdf');  


      
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

    public function redactar($id)
    {

        $resultados = DB::table('resultados_laboratorio as a')
        ->select('a.id', 'a.id_atencion', 'a.id_laboratorio', 'a.informe','b.usuario', 'a.created_at', 'a.estatus','b.tipo_origen', 'b.id_paciente', 'b.id_origen', 's.nombre as servicio', 'pa.fechanac','pa.nombres', 'pa.apellidos','pa.dni', 'c.name', 'c.lastname')
        ->join('atenciones as b', 'b.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'b.id_origen')
        ->join('pacientes as pa', 'pa.id', 'b.id_paciente')
        ->join('analisis as s', 's.id', 'a.id_laboratorio')
        //->where('a.estatus', '=', 1)
        ->where('a.id',  '=', $id)
        //->where('a.monto', '!=', '0')
        ->first();

        $plantilla = Templates::where('id_laboratorio','=',$resultados->id_laboratorio)->get();


        return view('resultados.redactar', compact('resultados','plantilla'));

      
    }

    public function redactarPost(Request $request){

      $rl = ResultadosLaboratorio::where('id','=',$request->id_resultado)->first();

      $usuario = DB::table('users')
      ->select('*')
      ->where('id','=', Auth::user()->id)
      ->first();  

      $at = Atenciones::where('id','=',$rl->id_atencion)->first();
      $at->informe =  'PLANTILLA';
      $at->atendido =  2;
      $at->atendido_por =  $usuario->lastname.' '.$usuario->name;
      $at->save();

      $rs = ResultadosLaboratorio::where('id','=',$request->id_resultado)->first();
      $rs->estatus=3;
      $rs->usuario_informe=Auth::user()->id;
      $rs->informe_guarda='PLANTILLA';
      $rs->save();



      foreach($request->valor as $key => $val){
               // dd($key);
                $lab = new ResultadosLabTemplate();
                $lab->id_resultado =  $request->id_resultado;
                $lab->id_plantilla = $key;
                $lab->valor =  $val;
                $lab->id_laboratorio = $request->id_laboratorio;
                $lab->usuario = Auth::user()->id;
                $lab->save();
      }
      
      return redirect()->route('resultados.index1')
      ->with('success','Creado Exitosamente!');

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


       

      $p = Atenciones::find($request->id);
      $p->monto =$request->monto;
      $p->abono =$request->abono;
      $p->tipo_pago =$request->tipo_pago;
    
      $res = $p->update();
    
    
    return redirect()->action('AtencionesController@index')
    ->with('success','Modificado Exitosamente!');

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

        return redirect()->action('AtencionesController@index')
        ->with('success','Eliminado Exitosamente!');
        //
    }
}