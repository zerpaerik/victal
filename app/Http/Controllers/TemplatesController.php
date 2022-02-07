<?php

namespace App\Http\Controllers;
use App\Equipos;
use App\Analisis;
use App\Servicios;
use App\Clientes;
use App\Tiempo;
use App\Material;
use App\Solicitudes;
use App\Templates;
use App\TemplatesS;
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
        ->select('a.id','a.id_laboratorio','a.estatus','a.medida','a.metodo','a.referencia','an.nombre as detalle','a.nombre','a.referencia')
        ->join('analisis as an', 'an.id', 'a.id_laboratorio')
        ->where('a.estatus','=',1)
        ->groupBy('a.id_laboratorio')
        ->get(); 

        return view('templates.index', compact('templates'));
        //
    }

    public function index1()
    {

        $templates = DB::table('templates_s as a')
        ->select('a.id','a.estatus','a.id_servicio','an.nombre as detalle')
        ->join('servicios as an', 'an.id', 'a.id_servicio')
        ->where('a.estatus','=',1)
        ->groupBy('a.id_servicio')
        ->get(); 

        return view('templates.index1', compact('templates'));
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

    public function creates()
    {

        $servicios = Servicios::where('estatus','=',1)->get();
        return view('templates.creates', compact('servicios'));
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

    public function stores(Request $request)
    {


        if (isset($request->monto_l)) {
            foreach ($request->monto_l['laboratorios'] as $key => $lab) {


               $pedidos = new TemplatesS();
               $pedidos->id_servicio =$request->servicio;
               $pedidos->subtitulo =$request->monto_l['laboratorios'][$key]['monto'];
               $pedidos->save();
            
            }
          }
               

        return redirect()->action('TemplatesController@index1')
        ->with('success','Creado Exitosamente!');

        //return redirect()->action('AnalisisController@index', ["created" => true, "analisis" => Analisis::all()]);

    }

    public function ver($id)
    {
      $analisis = Analisis::where('id','=',$id)->first();
     // $servicios = PaqueteServ::where('paquete', $paquete->id)->with('servicio')->get();

      $templates_detalle = DB::table('templates as a')
      ->select('a.*','an.nombre')
      ->join('analisis as an', 'an.id', 'a.id_laboratorio')
      ->where('a.id_laboratorio',$id)
      ->get(); 
      
    
      
      return view('templates.ver', compact('templates_detalle','analisis'));
    }

    public function vers($id)
    {
      $servicio = Servicios::where('id','=',$id)->first();
     // $servicios = PaqueteServ::where('paquete', $paquete->id)->with('servicio')->get();

      $templates_detalle = DB::table('templates_s as a')
      ->select('a.*')
      ->where('a.id_servicio','=',$id)
      ->get(); 
      
    
      
      return view('templates.vers', compact('templates_detalle','servicio'));
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

        $templates = Templates::where('id_laboratorio','=',$id)->get();

        foreach ($templates as $key => $value) {

            $analisis = Templates::find($value->id);
            $analisis->estatus = 0;
            $analisis->save();

        }


        return redirect()->action('TemplatesController@index');

        //
    }

    public function deletes($id)
    {

        $templates = TemplatesS::where('id_servicio','=',$id)->get();


        foreach ($templates as $key => $value) {

            $analisis = TemplatesS::find($value->id);
            $analisis->estatus = 0;
            $analisis->save();

        }


        return redirect()->action('TemplatesController@index1');

        //
    }



}

