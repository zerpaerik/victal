<?php

namespace App\Http\Controllers;
use App\Equipos;
use App\Analisis;
use App\Servicios;
use App\Clientes;
use App\Tiempo;
use App\Material;
use App\Solicitudes;
use App\User;
use Auth;
use Illuminate\Http\Request;
use DB;


class ServiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $servicios = DB::table('servicios as a')
        ->select('a.id','a.nombre','a.tipo','a.precio','a.porcentaje1','a.porcentaje2','a.porcentaje','a.estatus')
       // ->where('a.empresa', '=', Auth::user()->empresa)
        ->where('a.estatus', '=', 1)
        ->get(); 

        return view('servicios.index', compact('servicios'));
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $material = Material::where('estatus','=',1)->get();
        $tiempo = Tiempo::where('estatus','=',1)->get();
        return view('servicios.create', compact('tiempo','material'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        
            $analisis = new Servicios();
            $analisis->nombre =$request->nombre;
            $analisis->tipo =$request->tipo;
            $analisis->precio =$request->precio;
            $analisis->porcentaje1 =$request->porcentaje1;
            $analisis->porcentaje =$request->porcentaje;
            $analisis->porcentaje2 =$request->porcentaje2;
            $analisis->sesiones =$request->sesiones;
            $analisis->usuario =Auth::user()->id;
            $analisis->save();
               

        return redirect()->action('ServiciosController@index')
        ->with('success','Creado Exitosamente!');

        //return redirect()->action('AnalisisController@index', ["created" => true, "analisis" => Analisis::all()]);

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
        $material = Material::where('estatus','=',1)->get();
        $tiempo = Tiempo::where('estatus','=',1)->get();
        $servicio = Servicios::where('id','=',$id)->first();

        return view('servicios.edit', compact('material','tiempo','servicio')); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Analisis $analisis)
    {


       

      $p = Servicios::find($request->id);
      $p->nombre =$request->nombre;
      $p->tipo =$request->tipo;
      $p->precio =$request->precio;
      $p->porcentaje1 =$request->porcentaje1;
      $p->porcentaje2 =$request->porcentaje2;
      $p->porcentaje =$request->porcentaje;
      $res = $p->update();
    
    
    return redirect()->action('ServiciosController@index')
    ->with('success','Modificado Exitosamente!');

        //
    }

    public function sesiones()
    {
     

        return view('servicios.sesiones'); //
    }

    public function nada()
    {
     

        return view('servicios.nada'); //
    }

  
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $analisis = Servicios::find($id);
        $analisis->estatus = 0;
        $analisis->save();

        return redirect()->action('ServiciosController@index');

        //
    }
}

