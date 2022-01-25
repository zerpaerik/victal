<?php

namespace App\Http\Controllers;
use App\Equipos;
use App\Analisis;
use App\Clientes;
use App\Tiempo;
use App\Material;
use App\Solicitudes;
use App\Templates;
use App\TemplatesReferencia;
use App\Referencias;
use App\User;
use Auth;
use Illuminate\Http\Request;
use DB;


class TemplatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $templates = DB::table('templates as a')
        ->select('a.id','a.id_laboratorio','an.nombre as detalle','a.nombre','a.referencia')
        ->join('analisis as an', 'an.id', 'a.id_laboratorio')
        ->groupBy('a.id_laboratorio')
        ->get(); 

        return view('templates.index', compact('templates'));
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $analisis = Analisis::where('estatus','=',1)->get();
        return view('templates.create', compact('analisis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        if (isset($request->monto_l)) {
            foreach ($request->monto_l['laboratorios'] as $key => $lab) {


               $pedidos = new Templates();
               $pedidos->id_laboratorio =$request->analisis;
               $pedidos->nombre =$request->monto_l['laboratorios'][$key]['monto'];
               $pedidos->medida =$request->monto_abol['laboratorios'][$key]['abono'];
               $pedidos->referencia =$request->monto_abos['laboratorios'][$key]['abonos'];
               $pedidos->save();

            
            }
          }
               

        return redirect()->action('TemplatesController@index')
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
        $analisis = Analisis::where('id','=',$id)->first();

        return view('analisis.edit', compact('material','tiempo','analisis')); //
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


       

      $p = Analisis::find($request->id);
      $p->nombre =$request->nombre;
      $p->costo =$request->costo;
      $p->precio =$request->precio;
      $p->material =$request->material;
      $p->tiempo =$request->tiempo;
      $p->porcentaje =$request->porcentaje;
      $res = $p->update();
    
    
    return redirect()->action('AnalisisController@index')
    ->with('success','Modificado Exitosamente!');

        //
    }

    public function dispon($id)
    {

        $analisis = Analisis::find($id);
        $analisis->disponible = 0;
        $analisis->cliente = '';
        $analisis->ult_ingreso = null;
        $analisis->save();

        return redirect()->action('AnalisisController@index')
        ->with('success','Desocupada Exitosamente!');

        //
    }

    public function dispon1($id,$id2)
    {

      $analisis = Analisis::find($id);
      $analisis->disponible = 0;
      $analisis->cliente = '';
      $analisis->ult_ingreso = null;
      $analisis->save();

      $chk = Solicitudes::where('id','=',$id2)->first();
      $chk->estatus =2;
      $res = $chk->update();

     
      return redirect()->action('HomeController@index')
      ->with('success','Desocupada Exitosamente!');        
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $analisis = Analisis::find($id);
        $analisis->estatus = 0;
        $analisis->save();

        return redirect()->action('AnalisisController@index');

        //
    }
}

