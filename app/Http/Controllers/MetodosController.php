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
use App\Consultas;
use App\Metodos;
use App\ApliMetodos;
use Auth;
use Illuminate\Http\Request;
use DB;


class MetodosController extends Controller
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

          $metodos = DB::table('metodos as a')
        ->select('a.id', 'a.id_paciente', 'a.usuario','a.id_atencion','a.id_producto', 'a.sede', 'a.created_at', 'a.estatus', 'a.monto','a.aplicado_por','a.usuario_aplica','b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'mp.nombre as producto','at.created_at as fecha')
        ->join('pacientes as b', 'b.id', 'a.id_paciente')
        ->join('users as c', 'c.id', 'a.usuario')
        ->join('meto_pro as mp', 'mp.id', 'a.id_producto')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->where('a.sede', '=', $request->session()->get('sede'))
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->orderBy('a.id','DESC')
        ->get();
      } else {

        $f1 = date('Y-m-d');
        $f2 = date('Y-m-d');

        $metodos = DB::table('metodos as a')
        ->select('a.id', 'a.id_paciente', 'a.usuario','a.id_atencion','a.id_producto', 'a.sede', 'a.created_at', 'a.estatus', 'a.monto','a.aplicado_por','a.usuario_aplica','b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'mp.nombre as producto','at.created_at as fecha')
        ->join('pacientes as b', 'b.id', 'a.id_paciente')
        ->join('users as c', 'c.id', 'a.usuario')
        ->join('meto_pro as mp', 'mp.id', 'a.id_producto')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->where('a.sede', '=', $request->session()->get('sede'))
        ->orderBy('a.id','DESC')
        ->get();

      }

        return view('metodos.index', compact('metodos','f1','f2'));
        //
    }

    public function llamar(Request $request)
    {

      if ($request->inicio) {
          $f1 = $request->inicio;
          $f2 = $request->fin;

          $metodos = DB::table('metodos as a')
        ->select('a.id', 'a.id_paciente', 'a.usuario','a.usuario_llama', 'a.id_producto','a.prox_aplica', 'a.sede', 'a.created_at', 'a.estatus', 'a.monto','a.aplicado_por','a.usuario_aplica','b.nombres', 'b.apellidos', 'b.telefono','c.name as nameo', 'c.lastname as lasto', 'mp.nombre as producto')
        ->join('pacientes as b', 'b.id', 'a.id_paciente')
        ->join('users as c', 'c.id', 'a.usuario')
        ->join('meto_pro as mp', 'mp.id', 'a.id_producto')
        ->where('a.sede', '=', $request->session()->get('sede'))
        ->whereBetween('a.prox_aplica', [date('Y-m-d', strtotime($f1)), date('Y-m-d', strtotime($f2))])
        ->get();
      } else {

        $f1 = date('Y-m-d');
        $f2 = date('Y-m-d');

        $metodos = DB::table('metodos as a')
        ->select('a.id', 'a.id_paciente', 'a.usuario', 'a.usuario_llama','a.id_producto','a.prox_aplica', 'a.sede', 'a.created_at', 'a.estatus', 'a.monto','a.aplicado_por','a.usuario_aplica', 'b.nombres', 'b.apellidos','b.telefono', 'c.name as nameo', 'c.lastname as lasto', 'mp.nombre as producto')
        ->join('pacientes as b', 'b.id', 'a.id_paciente')
        ->join('users as c', 'c.id', 'a.usuario')
        ->join('meto_pro as mp', 'mp.id', 'a.id_producto')
        ->where('a.prox_aplica','=', date('Y-m-d'))
        ->where('a.sede', '=', $request->session()->get('sede'))
        ->get();

      }

        return view('metodos.llamar', compact('metodos','f1','f2'));
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
        $atencion = Atenciones::where('id','=',1)->first();

        return view('atenciones.edit', compact('atencion')); //
    }

    public function aplicar($id)
    {
       // $metodo = Metodos::where('id','=',$id)->first();

        $metodo = DB::table('metodos as a')
        ->select('a.id', 'a.id_paciente', 'a.usuario', 'a.id_producto', 'a.sede', 'a.created_at', 'a.estatus', 'a.monto','a.aplicado_por','a.usuario_aplica', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'mp.nombre as producto')
        ->join('pacientes as b', 'b.id', 'a.id_paciente')
        ->join('users as c', 'c.id', 'a.usuario')
        ->join('meto_pro as mp', 'mp.id', 'a.id_producto')
        ->where('a.id','=',$id)
        ->first();

        $apli = ApliMetodos::where('paciente','=',$metodo->id_paciente)->get();


        return view('metodos.aplicar', compact('metodo','apli')); //
    }

    public function aplicarPost(Request $request)
    {

      $searchUsuarioID = DB::table('users')
      ->select('*')
      ->where('id','=', Auth::user()->id)
      ->first();  
    
      $user = User::where('id','=',Auth::user()->id)->first();

      $m = Metodos::where('id','=',$request->id)->first();

      $atencion = Atenciones::where('id','=',$m->id_atencion)->first();
      $atencion->atendido = 2;
      $atencion->atendido_por= $searchUsuarioID->name.' '.$searchUsuarioID->lastname;
      $atencion->save();


      //         $proximo=date("Y-m-d",strtotime($request->created_at."+ 30 days"));


      $p = Metodos::find($request->id);
      $p->peso =$request->peso;
      $p->talla =$request->talla;
      $p->observacion =$request->observacion;
      $p->usuario_aplica =$user->lastname.' '.$user->name;
      $p->fecha_aplica = date('Y-m-d');
      $p->prox_aplica = date("Y-m-d",strtotime(date('Y-m-d')."+ 30 days"));
      $p->estatus = 2;
      $res = $p->update();

        $apli = new ApliMetodos();
        $apli->metodo =$request->id;
        $apli->talla =$request->talla;
        $apli->peso =$request->peso;
        $apli->observacion =$request->observacion;
        $apli->paciente =$m->id_paciente;
        $apli->usuario = $user->lastname.' '.$user->name;
        $apli->save();
    
    
    return redirect()->action('MetodosController@index')
    ->with('success','Aplicado Exitosamente!');

        //
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

    public function llamarPost($id)
    {

        $searchUsuarioID = DB::table('users')
        ->select('*')
        ->where('id','=', Auth::user()->id)
        ->first();  

        $atencion = Metodos::find($id);
        $atencion->estatus = 3;
        $atencion->usuario_llama= $searchUsuarioID->lastname.' '.$searchUsuarioID->name;
        $atencion->save();

        return back();
        //
    }


}

