<?php

namespace App\Http\Controllers;
use App\Equipos;
use App\Analisis;
use App\Servicios;
use App\Clientes;
use App\Tiempo;
use App\Material;
use App\Paquetes;
use App\PaqueteCon;
use App\PaqueteCont;
use App\PaqueteServ;
use App\PaqueteLab;
use App\User;
use Auth;
use Illuminate\Http\Request;
use DB;


class PaquetesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $paquetes = DB::table('paquetes as a')
        ->select('a.id','a.nombre','a.precio','a.porcentaje1','a.porcentaje2','a.porcentaje','a.estatus')
       // ->where('a.empresa', '=', Auth::user()->empresa)
        ->where('a.estatus', '=', 1)
        ->get(); 

        return view('paquetes.index', compact('paquetes'));
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $servicios = Servicios::where('estatus','=',1)->get();
        $analisis = Analisis::where('estatus','=',1)->get();
        return view('paquetes.create', compact('servicios','analisis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


         
      $paquete = new Paquetes;
      $paquete->nombre    = $request->nombre;
      $paquete->precio     = $request->precio;
      $paquete->porcentaje = $request->porcentaje;
	  $paquete->usuario = 	Auth::user()->id;

            if ($paquete->save()) {
                if (isset($request->id_servicio)) {
                foreach ($request->id_servicio['servicios'] as $servicio) {
                    $serv = New PaqueteServ;
                    $serv->paquete  = $paquete->id;
                    $serv->servicio = $servicio['servicio'];
                    $serv->save();
                }
                }
            
                if (isset($request->id_laboratorio)) {
                foreach ($request->id_laboratorio['laboratorios'] as $laboratorio) {
                    $lab = new PaqueteLab;
                    $lab->paquete     = $paquete->id;
                    $lab->laboratorio = $laboratorio['laboratorio'];
                    $lab->save();
                }
                }

                if (isset($request->consultas)) {
                    $consultas = new PaqueteCon;
                    $consultas->paquete     = $paquete->id;
                    $consultas->cantidad = $request->consultas;
                    $consultas->save();
                }

                if (isset($request->controles)) {
                    $controles = new PaqueteCont;
                    $controles->paquete     = $paquete->id;
                    $controles->cantidad = $request->controles;
                    $controles->save();
                }
                
            
            }



        
        return redirect()->action('PaquetesController@index')
        ->with('success','Creado Exitosamente!');

        //return redirect()->action('AnalisisController@index', ["created" => true, "analisis" => Analisis::all()]);

    }

    public function ver($id)
    {
      $paquete = Paquetes::where('id','=',$id)->first();
     // $servicios = PaqueteServ::where('paquete', $paquete->id)->with('servicio')->get();

      $servicios = DB::table('paquetes_s as a')
      ->select('a.id','a.paquete','a.servicio', 'b.nombre as nombre')
      ->join('servicios as b','b.id','a.servicio')
      ->where('a.paquete', $paquete->id)
      ->get(); 
      
      $laboratorios = DB::table('paquetes_l as a')
      ->select('a.id','a.paquete','a.laboratorio', 'b.nombre as nombre')
      ->join('analisis as b','b.id','a.laboratorio')
      ->where('a.paquete', $paquete->id)
      ->get(); 
     // $laboratorios = PaqueteLab::where('paquete', $paquete->id)->with('laboratorio')->get();
      $consultas = PaqueteCon::where('paquete', $paquete->id)->get();
      $controles = PaqueteCont::where('paquete', $paquete->id)->get();

      
      return view('paquetes.ver', compact('paquete', 'servicios', 'laboratorios','consultas','controles'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Analisis  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $paquete = Paquetes::findOrFail($id);
      $serviciosP = PaqueteServ::where('paquete',$id)->with('servicio')->get();
      $laboratoriosP = PaqueteLab::where('paquete',$id)->with('laboratorio')->get();
      $servicios = Servicios::all();
      $laboratorios = Analisis::all();

      $consultasP = PaqueteCon::where('paquete',$id)->first();
      $controlesP = PaqueteCont::where('paquete',$id)->first();
     
      return view('paquetes.edit', compact('paquete','serviciosP','laboratoriosP','servicios','laboratorios','consultasP','controlesP'));  
    }

    public function update(Request $request, $id)
    {

      


      $paquete = Paquetes::where('id',$id)
                          ->update([
                              'precio' => $request->precio,
                              'porcentaje' => $request->porcentaje
                          ]);

        if (isset($request->id_servicio)) {
            foreach ($request->id_servicio['servicios'] as $servicio) {
              PaqueteServ::where('id', $servicio['id'])
                          ->update([
                              'servicio' => $servicio['servicio']
                          ]);
          }
        }
       
        if (isset($request->id_laboratorio)) {
          foreach ($request->id_laboratorio['laboratorios'] as $laboratorio) {
            PaqueteLab::where('id', $laboratorio['id'])
                          ->update([
                              'laboratorio' => $laboratorio['laboratorio']
                          ]);
          }
        }




        if (isset($request->consultas)) {

             $consul=PaqueteCon::where('paquete','=',$id)->first();

             if($consul){
          
                PaqueteCon::where('paquete','=',$id)
                          ->update([
                              'cantidad' => $request->consultas
                          ]);
              } else {

              $consultas = new PaqueteCon;
              $consultas->paquete     = $id;
              $consultas->cantidad = $request->consultas;
              $consultas->save();


              }
         
        }

           if (isset($request->controles)) {

             $cont=PaqueteCont::where('paquete','=',$id)->first();

             if($cont){
            PaqueteCont::where('paquete','=',$id)
                          ->update([
                              'cantidad' => $request->controles
                          ]);
            }else{

              $control = new PaqueteCont;
              $control->paquete     = $id;
              $control->cantidad = $request->controles;
              $control->save();

            }
         
        }
 

      return redirect()->route('paquetes.index');
    }

    

  
   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $analisis = Paquetes::find($id);
        $analisis->estatus = 0;
        $analisis->save();

        return redirect()->action('PaquetesController@index');

        //
    }
}

