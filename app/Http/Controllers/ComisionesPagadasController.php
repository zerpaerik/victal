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


class ComisionesPagadasController extends Controller
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

        
        $comisiones = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus','a.recibo','a.id_origen','a.id_responsable', 'a.id_atencion','a.fecha_pago','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu',DB::raw('SUM(a.monto) as totalrecibo'))
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 2)
        ->where('a.id_origen', '=', 1)
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.fecha_pago', [$f1, $f2])
        ->groupBy('a.recibo')      
        ->get();

      //  $comisiones = self::unique_multidim_array(json_decode($comisionest, true), "recibo");



        } else {

            $f1 = date('Y-m-d');
            $f2 = date('Y-m-d');

      

        $comisiones = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus','a.recibo','a.id_origen','a.id_responsable', 'a.fecha_pago', 'a.id_atencion','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu',DB::raw('SUM(a.monto) as totalrecibo'))
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 2)
        ->where('a.id_origen', '=', 1)
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.fecha_pago', [$f1, $f2])
        ->groupBy('a.recibo')      
        ->get();



        //$comisiones = self::unique_multidim_array(json_decode($comisionest, true), "recibo");

        //dd($comisiones);






        }
       


        return view('compagadas.index', compact('comisiones','f1','f2'));
        //
    }

    public function index1(Request $request)
    {

        if ($request->inicio) {
            $f1 = $request->inicio;
            $f2 = $request->fin;

            

        $comisiones = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus','a.recibo','a.id_origen','a.fecha_pago', 'a.id_atencion','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu',DB::raw('SUM(a.monto) as totalrecibo'))
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 2)
        ->where('a.id_origen', '=', 2)
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.fecha_pago', [$f1, $f2])
        ->groupBy('a.recibo')      
        ->get();


      

        } else {

            $f1 = date('Y-m-d');
            $f2 = date('Y-m-d');

      

         

        $comisiones = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus','a.recibo', 'a.id_origen','a.id_atencion','a.fecha_pago','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu',DB::raw('SUM(a.monto) as totalrecibo'))
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 2)
        ->where('a.id_origen', '=', 2)
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.fecha_pago', [$f1, $f2])
        ->groupBy('a.recibo')      
        ->get();



        }

        return view('compagadas.index1', compact('comisiones','f1','f2'));
        //
    }


    public function ticket($id)
    {

      $compagada = Comisiones::where('recibo','=',$id)->get();



        $ticket = DB::table('comisiones as a')
        ->select('a.id', 'a.id_atencion','a.recibo','a.porcentaje','a.detalle','a.monto','a.created_at','at.id_paciente','at.usuario',  'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto','c.cuenta', 'd.name as nameu', 'd.lastname as lastu', 'se.nombre as sedename')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'at.usuario')
        ->join('sedes as se', 'se.id', 'at.sede')
        ->where('a.recibo','=', $id)
        ->get();

        $ticketu = DB::table('comisiones as a')
        ->select('a.id', 'a.id_atencion','a.recibo','a.porcentaje','a.fecha_pago','a.detalle','a.monto','a.created_at','at.id_paciente','at.usuario',  'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto','c.cuenta', 'd.name as nameu', 'd.lastname as lastu', 'se.nombre as sedename')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'at.usuario')
        ->join('sedes as se', 'se.id', 'at.sede')
        ->where('a.recibo','=', $id)
        ->first();

        $total = Comisiones::where('recibo', $id)
                            ->select(DB::raw('SUM(monto) as totalrecibo'))
                            ->get();
     


        $view = \View::make('compagadas.ticket', compact('ticket','ticketu','total'));
        $pdf = \App::make('dompdf.wrapper');
        //$pdf->setPaper('A5', 'landscape');
        //$pdf->setPaper(array(0,0,600.00,360.00));
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('ticket-compagadas'.'.pdf'); 
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function pagar($id)
    {


      $p = Comisiones::find($id);
      $p->estatus =2;
      $res = $p->update();
    
      return back();

        //
    }

    public function reversar($id)
    {

      $com = Comisiones::where('id','=',$id)->first();

     
      $a = Atenciones::where('id','=',$com->id_atencion)->first();
      $a->pagado =1;
      $resa = $a->update();
     

      $p = Comisiones::find($id);
      $p->estatus =1;
      $p->recibo = '';
      $p->fecha_pago = NULL;
      $res = $p->update();
    
      return back();

        //
    }



    public function reporte_pagadas(Request $request){

        $pagadas = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus','a.recibo', 'a.id_atencion','a.fecha_pago','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu',DB::raw('SUM(a.monto) as totalrecibo'), DB::raw('COUNT(DISTINCT a.recibo) as total'))
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 2)
        ->where('at.tipo_origen', '=', 1)
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.fecha_pago', [$request->f1, $request->f2])
        ->groupBy('a.recibo')      
        ->get();

        $total_sobres = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus','a.recibo', 'a.id_atencion','a.fecha_pago','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu',DB::raw('SUM(a.monto) as totalrecibo'), DB::raw('COUNT(DISTINCT a.recibo) as total'))
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 2)
        ->where('at.tipo_origen', '=', 1)
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.fecha_pago', [$request->f1, $request->f2])
        //->groupBy('a.recibo')      
        ->first();

    
   
   
      /*$aten = Comisiones::where('id_sede','=', $request->session()->get('sede'))
                                      ->whereBetween('fecha_pago', [date('Y-m-d', strtotime($request->f1)), date('Y-m-d', strtotime($request->f2))])
                                        ->where('origen','=',1)
                                        ->select(DB::raw('SUM(monto) as monto'))
                                       ->first();
           if ($aten->monto == 0) {
           }*/
   
       /* $sobres = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                                       ->whereBetween('fecha_pago_comision', [date('Y-m-d 00:00:00', strtotime($request->f1)), date('Y-m-d 23:59:59', strtotime($request->f2))])
                                        ->where('origen','=',1)
                                       ->select(DB::raw('COUNT(DISTINCT recibo) as total'))
                                       ->first();
           if ($sobres->total == 0) {
           }*/
   
           $view = \View::make('compagadas.reporte')->with('pagadas', $pagadas)->with('sobres', $total_sobres);
           $pdf = \App::make('dompdf.wrapper');
           $pdf->loadHTML($view);
           return $pdf->stream('comisiones_pagadas');
   
     }

     public function reporte_pagadas1(Request $request){

        $pagadas = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus','a.recibo', 'a.id_atencion','a.fecha_pago','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu',DB::raw('SUM(a.monto) as totalrecibo'), DB::raw('COUNT(DISTINCT a.recibo) as total'))
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 2)
        ->where('at.tipo_origen', '=', 2)
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.fecha_pago', [$request->f1, $request->f2])
        ->groupBy('a.recibo')      
        ->get();

        $total_sobres = DB::table('comisiones as a')
        ->select('a.id', 'a.estatus','a.recibo', 'a.id_atencion','a.fecha_pago','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu',DB::raw('SUM(a.monto) as totalrecibo'), DB::raw('COUNT(DISTINCT a.recibo) as total'))
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 2)
        ->where('at.tipo_origen', '=', 2)
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.fecha_pago', [$request->f1, $request->f2])
        ->first();
    
   
   
      /*$aten = Comisiones::where('id_sede','=', $request->session()->get('sede'))
                                      ->whereBetween('fecha_pago', [date('Y-m-d', strtotime($request->f1)), date('Y-m-d', strtotime($request->f2))])
                                        ->where('origen','=',1)
                                        ->select(DB::raw('SUM(monto) as monto'))
                                       ->first();
           if ($aten->monto == 0) {
           }*/
   
       /* $sobres = Atenciones::where('id_sede','=', $request->session()->get('sede'))
                                       ->whereBetween('fecha_pago_comision', [date('Y-m-d 00:00:00', strtotime($request->f1)), date('Y-m-d 23:59:59', strtotime($request->f2))])
                                        ->where('origen','=',1)
                                       ->select(DB::raw('COUNT(DISTINCT recibo) as total'))
                                       ->first();
           if ($sobres->total == 0) {
           }*/
   
           $view = \View::make('compagadas.reporte1')->with('pagadas', $pagadas)->with('sobres', $total_sobres);
           $pdf = \App::make('dompdf.wrapper');
           $pdf->loadHTML($view);
           return $pdf->stream('comisiones_pagadas');
   
     }






    static function unique_multidim_array($array, $key) {
        $temp_array = array();
        $i = 0;
        $key_array = array();
       
        foreach($array as $val) {
            if (!in_array($val[$key], $key_array)) {
                $key_array[$i] = $val[$key];
                $temp_array[$i] = $val;
            }
            $i++;
        }
        return $temp_array;
      }    

 
   
}