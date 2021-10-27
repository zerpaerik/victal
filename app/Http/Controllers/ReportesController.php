<?php

namespace App\Http\Controllers;
use App\Equipos;
use App\Requerimientos;
use App\ActivosRequerimientos;
use App\Clientes;
use App\Creditos;
use App\Comisiones;
use App\PagosPersonal;
use App\Debitos;
use App\Pacientes;
use App\Solicitudes;
use App\Analisis;
use App\Atenciones;
use App\User;
use Auth;
use Illuminate\Http\Request;
use DB;
use PDF;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function consolidado(Request $request)
    {

        if($request->inicio && $request->fin){


        $solicitudes = DB::table('solicitudes as a')
        ->select('a.id','a.huesped','a.cliente','a.habitacion','a.es_pagado','a.hora','a.precio','a.created_at','a.estatus','a.estado','a.observacion','b.nombres as nompac','b.apellidos as apepac','an.nombre as laboratorio')
        ->join('pacientes as b','b.id','a.huesped')
        ->join('analisis as an','an.id','a.habitacion')
        ->whereBetween('a.created_at', [$request->inicio, $request->fin])
        ->where('a.estatus', '=', 1)
        ->where('a.es_pagado', '=', 0)
        ->get(); 
        $f1 = $request->inicio;
        $f2 = $request->fin;
    } else {
        $solicitudes = DB::table('solicitudes as a')
        ->select('a.id','a.huesped','a.cliente','a.habitacion','a.es_pagado','a.hora','a.precio','a.created_at','a.estatus','a.estado','a.observacion','b.nombres as nompac','b.apellidos as apepac','an.nombre as laboratorio')
        ->join('pacientes as b','b.id','a.huesped')
        ->join('analisis as an','an.id','a.habitacion')
        ->where('a.estatus', '=', 1)
        ->where('a.es_pagado', '=', 0)
        ->where('a.created_at', '=', date('Y-m-d'))
        ->get(); 

        $f1 =date('Y-m-d');
        $f2 = date('Y-m-d');

    }
        

        return view('reportes.consolidado', compact('solicitudes','f1','f2'));
        //
    }

    public function detallado(Request $request)
    {

        
        $f1 =date('Y-m-d');
        $f2 = date('Y-m-d');


        

        return view('reportes.detallado', compact('f1','f2'));

    }


    public function general(Request $request)
    {

        
        $f1 =date('Y-m-d');
        $f2 = date('Y-m-d');


    

        return view('reportes.general', compact('f1','f2'));

    }

    public function home()
    {

        
        $f1 =date('Y-m-d');
        $f2 = date('Y-m-d');

        $ingresos = Creditos::where('origen', 'INGRESO')
        ->whereBetween('created_at', [$request->inicio,$request->fin])
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();


        

        return view('home', compact('f1','f2','ingresos'));

    }

    public function reportc(Request $request){

        $f1 = $request->inicio;
        $f2 = $request->fin;

        $ingresos = Creditos::where('origen', 'INGRESO')
        ->where('created_at','=', $request->inicio)
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();

        if ($ingresos->cantidad == 0) {
        $ingresos->monto = 0;
        }

        $otros = Creditos::where('origen', 'OTROS INGRESOS')
        ->where('created_at','=', $request->inicio)
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();

        if ($otros->cantidad == 0) {
        $otros->monto = 0;
        }

        $pedido = Creditos::where('origen', 'PEDIDO')
        ->where('created_at','=', $request->inicio)
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();

        if ($pedido->cantidad == 0) {
        $pedido->monto = 0;
        }

        $totalIngresos = $ingresos->monto + $otros->monto + $pedido->monto;

        $egresos = Debitos::where('created_at','=', $request->inicio)
        ->select(DB::raw('origen, descripcion, monto,nombre'))
        ->get();


        $efectivo = Creditos::where('created_at','=', $request->inicio)
                ->select(DB::raw('SUM(monto) as monto'),DB::raw('SUM(efectivo) as efectivo'),DB::raw('SUM(tarjeta) as tarjeta'),DB::raw('SUM(dep) as deposito'),DB::raw('SUM(yap) as yape'))
                ->first();
        if (is_null($efectivo->monto)) {
        $efectivo->monto = 0;
        }

        $tarjeta = Creditos::where('tipopago', 'TJ')
        ->where('created_at','=', $request->inicio)
                ->select(DB::raw('SUM(monto) as monto'))
                ->first();

        if (is_null($tarjeta->monto)) {
        $tarjeta->monto = 0;
        }

        $totalEgresos = 0;

        foreach ($egresos as $egreso) {
            $totalEgresos += $egreso->monto;
        }



        



         $view = \View::make('reportes.viewc', compact('f1','f2','ingresos','otros','totalIngresos','egresos','efectivo','tarjeta','totalEgresos','pedido'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('report-consolidado'.'.pdf');

       
        //return $pdf->stream('movimientos'.'.pdf');

    }

    public function reportd(Request $request){

        
        $f1= $request->inicio;
        $f2= $request->fin;






        $efectivo = DB::table('creditos as a')
        ->select('a.id','a.created_at','a.fecha','a.tipopago','a.sede',DB::raw('SUM(monto) as monto'),DB::raw('SUM(efectivo) as efectivo'),DB::raw('SUM(tarjeta) as tarjeta'),DB::raw('SUM(dep) as deposito'),DB::raw('SUM(yap) as yape'),DB::raw('SUM(egreso) as egre'))
        ->where('a.sede','=',  $request->sede)
       // ->where('a.tipopago','=',  'EF')
        ->whereBetween('a.fecha', [$f1,$f2])
        ->groupBy('a.fecha')
        ->get();
        
        $totales = DB::table('creditos as a')
        ->select('a.id','a.created_at','a.fecha','a.tipopago','a.sede',DB::raw('SUM(monto) as monto'),DB::raw('SUM(efectivo) as efectivo'),DB::raw('SUM(tarjeta) as tarjeta'),DB::raw('SUM(dep) as deposito'),DB::raw('SUM(yap) as yape'),DB::raw('SUM(egreso) as egre'))
        ->where('a.sede','=',  $request->sede)
       // ->where('a.tipopago','=',  'EF')
        ->whereBetween('a.fecha', [$f1,$f2])
        //->groupBy('a.fecha')
        ->first(); 

        if($request->sede == 1){
            $sede = 'PROCERES';
        } else if($request->sede == 2){
            $sede = 'CANTO REY';
        } else if($request->sede == 3){
            $sede = 'VIDA FELIZ';
        } else if($request->sede == 4){
            $sede = 'ZARATE';
        } else if($request->sede == 5){
            $sede = 'INDEPENDENCIA';
        } else {
            $sede = 'LOS OLIVOS';
        }

       



         $view = \View::make('reportes.viewd', compact('f1','f2','efectivo','sede','totales'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('report-detallado'.'.pdf');





    }

    public function reportg(Request $request){

        $f1 = $request->inicio;
        $f2 = $request->fin;




          $ingresos = DB::table('creditos as a')
                ->select('a.id','a.created_at',DB::raw('SUM(monto) as monto'),DB::raw('SUM(efectivo) as efectivo'),DB::raw('SUM(tarjeta) as tarjeta'))
                ->whereBetween('a.created_at', [$f1,$f2])
                ->groupBy('a.created_at')
                ->get();  




        $total= Creditos::whereBetween('created_at', [$f1,$f2])
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();
         $egresos=Debitos::whereBetween('created_at', [$f1,$f2])
                                    ->select(DB::raw('SUM(monto) as egreso'),'created_at')
                                    ->groupBy('created_at')
                                    ->get();
                       
                                    
        $debitos=Debitos::whereBetween('created_at', [$f1,$f2])
                                    ->select(DB::raw('SUM(monto) as monto'))
                                    ->first();

         $saldo= $total->monto - $debitos->monto;

       


         $view = \View::make('reportes.viewg', compact('f1','f2','ingresos','total','egresos','debitos','saldo'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('report-general'.'.pdf');

       
        //return $pdf->stream('movimientos'.'.pdf');

    }

    public function historial_pacientes(Request $request){


      if($request->id_paciente != null){

        $serv = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.sede','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('servicios as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 1)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.id_paciente', '=', $request->id_paciente);
       // ->get(); 

        $eco = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.sede','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('servicios as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 2)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.id_paciente', '=', $request->id_paciente);

        $cons = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.sede','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('servicios as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 5)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.id_paciente', '=', $request->id_paciente);

        $meto = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.sede','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('servicios as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 6)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.id_paciente', '=', $request->id_paciente);

        
        $salud = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.sede','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('servicios as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 8)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.id_paciente', '=', $request->id_paciente);

        $ana = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.sede','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('analisis as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 4)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.id_paciente', '=', $request->id_paciente);

        $paq = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.sede','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('paquetes as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 7)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.id_paciente', '=', $request->id_paciente);


        $metodos = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.sede','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('meto_pro as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 6)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.id_paciente', '=', $request->id_paciente);

        $consultas = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.sede','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('tipo_con as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 5)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.id_paciente', '=', $request->id_paciente);
        //->get(); 

     

        $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.sede','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('servicios as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 3)
        ->where('a.monto', '!=', '0')
        ->where('a.id_paciente', '=', $request->id_paciente)
        ->orderBy('a.id','DESC')
        ->union($serv)
        ->union($eco)
        ->union($ana)
        ->union($metodos)
        ->union($paq)
        ->union($consultas)
        ->union($salud)
        ->get(); 


    } else {

        $serv = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.sede','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('servicios as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 1)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.sede', '=',99999999);
       // ->get(); 

        $eco = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.sede','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('servicios as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 2)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.sede', '=', 99999999);

        $cons = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.sede','a.informe','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('servicios as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 5)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.sede', '=', 9999999);

        $meto = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.sede','a.informe','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('servicios as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 6)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.sede', '=', 9999999);

        $salud = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.sede','a.informe','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('servicios as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 8)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.sede', '=', 9999999);

        $ana = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.sede','a.informe','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('analisis as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 4)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.sede', '=', 9999999);

        $paq = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.sede','a.informe','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('paquetes as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 7)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.sede', '=', 99999999);


        $metodos = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.sede','a.informe','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('meto_pro as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 6)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.sede', '=', 999999999);

        $consultas = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.sede','a.informe','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('tipo_con as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 5)
        ->where('a.monto', '!=', '0')
        ->orderBy('a.id','DESC')
        ->where('a.sede', '=', 99999999);
        //->get(); 

     

        $atenciones = DB::table('atenciones as a')
        ->select('a.id','a.tipo_origen','a.id_origen','a.sede','a.informe','a.atendido_por','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
        ->join('pacientes as b','b.id','a.id_paciente')
        ->join('users as c','c.id','a.id_origen')
        ->join('users as d','d.id','a.usuario')
        ->join('servicios as s','s.id','a.id_tipo')
        ->where('a.estatus', '=', 1)
        ->where('a.tipo_atencion', '=', 3)
        ->where('a.monto', '!=', '0')
        ->where('a.sede', '=', 99999999)
        ->orderBy('a.id','DESC')
        ->union($serv)
        ->union($eco)
        ->union($ana)
        ->union($metodos)
        ->union($paq)
        ->union($consultas)
        ->union($salud)
        ->get(); 

    }







        
        if(!is_null($request->filtro)){
            $pacientes =Pacientes::where("estatus", '=', 1)->where('apellidos','like','%'.$request->filtro.'%')->orderby('apellidos','asc')->get();
            }else{
            $pacientes =Pacientes::where("estatus", '=', 9)->orderby('nombres','asc')->get();
            }
      

       

     
     
       
        return view('reportes.historialp', compact('pacientes','atenciones'));

       

    }

    public function ingresos(Request $request){


        if ($request->inicio) {
            $f1 = $request->inicio;
            $f2 = $request->fin;
  
          $serv = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('servicios as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 1)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
          // ->get(); 
  
          $eco = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('servicios as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 2)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
  
          $cons = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('servicios as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 5)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
  
          $meto = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('servicios as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 6)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
  
          $ana = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('analisis as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 4)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
  
          $paq = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('paquetes as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 7)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
  
  
          $metodos = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('meto_pro as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 6)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
  
          $consultas = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('tipo_con as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 5)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
          //->get(); 
  
       
  
          $atenciones = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('servicios as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 3)
          ->where('a.monto', '!=', '0')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->orderBy('a.id','DESC')
          ->union($serv)
          ->union($eco)
          ->union($ana)
          ->union($metodos)
          ->union($paq)
          ->union($consultas)
          ->get(); 

          $historial = DB::table('historial_cobros as a')
          ->select('a.id', 'a.id_cobro', 'a.tipopago','a.monto','a.created_at','a.sede', 'co.id_atencion','co.resta','at.id_paciente','at.usuario',  'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu', 'se.nombre as sedename','sec.nombre as sedec')
          ->join('cuentas_cobrar as co', 'co.id', 'a.id_cobro')
          ->join('atenciones as at', 'at.id', 'co.id_atencion')
          ->join('pacientes as b', 'b.id', 'at.id_paciente')
          ->join('users as c', 'c.id', 'at.id_origen')
          ->join('users as d', 'd.id', 'at.usuario')
          ->join('sedes as se', 'se.id', 'at.sede')
          ->join('sedes as sec', 'sec.id', 'a.sede')
          ->whereBetween('a.created_at', [$f1, $f2])
          ->get();

          $ingresos = DB::table('creditos as a')
          ->select('a.id', 'a.origen', 'a.descripcion', 'a.monto', 'a.nombre', 'a.usuario', 'a.created_at', 'b.name')
          ->join('users as b', 'b.id', 'a.usuario')
          ->where('a.origen', '=', 'INGRESOS')
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->get();
  

          $total = Creditos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('sede','=',$request->session()->get('sede'))
          ->first();
  
    
  
          $efec = Creditos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('tipopago','=','EF')
          ->where('sede','=',$request->session()->get('sede'))
          ->first();
  
  
          $tarj = Creditos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('tipopago','=','TJ')
          ->where('sede','=',$request->session()->get('sede'))
          ->first();
  
          $dep = Creditos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('tipopago','=','DP')
          ->where('sede','=',$request->session()->get('sede'))
          ->first();
  
          $yap = Creditos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('tipopago','=','YP')
          ->where('sede','=',$request->session()->get('sede'))
          ->first();


  
  
      } else {

        $f1 = date('Y-m-d');
        $f2 = date('Y-m-d');

  
          $serv = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('servicios as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 1)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
         // ->get(); 
  
          $eco = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('servicios as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 2)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
  
          $cons = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('servicios as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 5)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
  
          $meto = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('servicios as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 6)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
  
          $ana = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('analisis as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 4)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
  
          $paq = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('paquetes as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 7)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
  
  
          $metodos = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('meto_pro as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 6)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
  
          $consultas = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('tipo_con as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 5)
          ->where('a.monto', '!=', '0')
          ->orderBy('a.id','DESC')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))]);
          //->get(); 
  
       
  
          $atenciones = DB::table('atenciones as a')
          ->select('a.id','a.tipo_origen','a.id_origen','a.informe','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','cre.monto as ingreso','cre.tipopago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
          ->join('creditos as cre','cre.id_atencion','a.id')
          ->join('pacientes as b','b.id','a.id_paciente')
          ->join('users as c','c.id','a.id_origen')
          ->join('users as d','d.id','a.usuario')
          ->join('servicios as s','s.id','a.id_tipo')
          ->where('a.estatus', '=', 1)
          ->where('a.tipo_atencion', '=', 3)
          ->where('a.monto', '!=', '0')
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->orderBy('a.id','DESC')
          ->union($serv)
          ->union($eco)
          ->union($ana)
          ->union($metodos)
          ->union($paq)
          ->union($consultas)
          ->get(); 

          $historial = DB::table('historial_cobros as a')
          ->select('a.id', 'a.id_cobro', 'a.tipopago','a.monto','a.created_at','a.sede', 'co.id_atencion','co.resta','at.id_paciente','at.usuario',  'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu', 'se.nombre as sedename','sec.nombre as sedec')
          ->join('cuentas_cobrar as co', 'co.id', 'a.id_cobro')
          ->join('atenciones as at', 'at.id', 'co.id_atencion')
          ->join('pacientes as b', 'b.id', 'at.id_paciente')
          ->join('users as c', 'c.id', 'at.id_origen')
          ->join('users as d', 'd.id', 'at.usuario')
          ->join('sedes as se', 'se.id', 'at.sede')
          ->join('sedes as sec', 'sec.id', 'a.sede')
          ->whereBetween('a.created_at', [$f1, $f2])
          ->get();

          $ingresos = DB::table('creditos as a')
          ->select('a.id', 'a.origen', 'a.descripcion', 'a.monto',  'a.usuario', 'a.created_at', 'b.name')
          ->join('users as b', 'b.id', 'a.usuario')
          ->where('a.origen', '=', 'INGRESOS')
          ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->get();
  

          $total = Creditos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('sede','=',$request->session()->get('sede'))
          ->first();
  
      
  
          $efec = Creditos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('tipopago','=','EF')
          ->where('sede','=',$request->session()->get('sede'))
          ->first();
  
  
          $tarj = Creditos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('tipopago','=','TJ')
          ->where('sede','=',$request->session()->get('sede'))
          ->first();
  
          $dep = Creditos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('tipopago','=','DP')
          ->where('sede','=',$request->session()->get('sede'))
          ->first();
  
          $yap = Creditos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f1))])
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('tipopago','=','YP')
          ->where('sede','=',$request->session()->get('sede'))
          ->first();

  
      }
  

          return view('reportes.ingresos', compact('f1','f2','atenciones','total','efec','dep','tarj','yap','historial','ingresos'));
  
         
  
      }

      public function total(Request $request){


        if ($request->mes) {
           
  

          $total = Creditos::whereMonth('created_at','=',$request->mes)
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('sede','=',$request->session()->get('sede'))
          ->first();

          $pagosp = PagosPersonal::whereMonth('created_at','=',$request->mes)
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('sede','=',$request->session()->get('sede'))
          ->first();

          $gastosd = Debitos::whereMonth('created_at','=',$request->mes)
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('sede','=',$request->session()->get('sede'))
          ->where('tipo','!=','EXTERNO')
          ->first();

          
          $gastose = Debitos::whereMonth('created_at','=',$request->mes)
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('sede','=',$request->session()->get('sede'))
          ->where('tipo','=','EXTERNO')
          ->first();

          $comisionesp = Comisiones::whereMonth('created_at','=',$request->mes)
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('sede','=',$request->session()->get('sede'))
          ->where('id_origen','=',1)
          ->first();

          $comisionespp = Comisiones::whereMonth('created_at','=',$request->mes)
          ->select(DB::raw('SUM(monto) as monto'))
          ->where('sede','=',$request->session()->get('sede'))
          ->where('id_origen','=',2)
          ->first();

          $mes = $request->mes;
  
  
      
  
         

  
      } else {

        $mes = date('m');

          
        $total = Creditos::whereMonth('created_at','=',$mes)
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('sede','=',$request->session()->get('sede'))
        ->first();

        $pagosp = PagosPersonal::whereMonth('created_at','=',$mes)
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('sede','=',$request->session()->get('sede'))
        ->first();

        $gastosd = Debitos::whereMonth('created_at','=',$mes)
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('sede','=',$request->session()->get('sede'))
        ->where('tipo','!=','EXTERNO')
        ->first();

        
        $gastose = Debitos::whereMonth('created_at','=',$mes)
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('sede','=',$request->session()->get('sede'))
        ->where('tipo','=','EXTERNO')
        ->first();

        
        $comisionesp = Comisiones::whereMonth('created_at','=',$mes)
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('sede','=',$request->session()->get('sede'))
        ->where('id_origen','=',1)
        ->first();

        $comisionespp = Comisiones::whereMonth('created_at','=',$mes)
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('sede','=',$request->session()->get('sede'))
        ->where('id_origen','=',2)
        ->first();






      }
  

          return view('reportes.total', compact('total','gastosd','gastose','pagosp','comisionesp','comisionespp','mes'));
  
         
  
      }

      public function total_servicios(Request $request){

        if($request->inicio){
            $f1 = $request->inicio;
            $f2 = $request->fin;
            $tipo = $request->tipo;


            if($request->tipo == '1'){
                $atenciones = DB::table('atenciones as a')
            ->select('a.id','a.tipo_origen','a.id_origen','a.eliminado_por','a.id_atec','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
            ->join('pacientes as b','b.id','a.id_paciente')
            ->join('users as c','c.id','a.id_origen')
            ->join('users as d','d.id','a.usuario')
            ->join('servicios as s','s.id','a.id_tipo')
            ->where('a.tipo_atencion', '=', 1)
            ->where('a.estatus', '!=', 0)
            ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->orderBy('a.id','DESC')
            ->where('a.sede', '=', $request->session()->get('sede'))
            ->get(); 

            $totales = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->select(DB::raw('SUM(abono) as monto,COUNT(*) as cantidad'))
            ->where('sede','=',$request->session()->get('sede'))
            ->where('estatus', '!=', 0)
            ->where('tipo_atencion','=',1)
            ->first();


            } else if($request->tipo == '2'){
                $atenciones = DB::table('atenciones as a')
                ->select('a.id','a.tipo_origen','a.id_origen','a.eliminado_por','a.id_atec','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
                ->join('pacientes as b','b.id','a.id_paciente')
                ->join('users as c','c.id','a.id_origen')
                ->join('users as d','d.id','a.usuario')
                ->join('servicios as s','s.id','a.id_tipo')
                ->where('a.tipo_atencion', '=', 2)
                ->where('a.estatus', '!=', 0)
                ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                ->orderBy('a.id','DESC')
                ->where('a.sede', '=', $request->session()->get('sede'))
                ->get(); 

                
            $totales = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->select(DB::raw('SUM(abono) as monto,COUNT(*) as cantidad'))
            ->where('sede','=',$request->session()->get('sede'))
            ->where('estatus', '!=', 0)
            ->where('tipo_atencion','=',2)
            ->first();

            } else if($request->tipo == '3'){
                $atenciones = DB::table('atenciones as a')
                ->select('a.id','a.tipo_origen','a.id_origen','a.eliminado_por','a.id_atec','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
                ->join('pacientes as b','b.id','a.id_paciente')
                ->join('users as c','c.id','a.id_origen')
                ->join('users as d','d.id','a.usuario')
                ->join('servicios as s','s.id','a.id_tipo')
                ->where('a.tipo_atencion', '=', 3)
                ->where('a.estatus', '!=', 0)
                ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                ->orderBy('a.id','DESC')
                ->where('a.sede', '=', $request->session()->get('sede'))
                ->get(); 

                
            $totales = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->select(DB::raw('SUM(abono) as monto,COUNT(*) as cantidad'))
            ->where('sede','=',$request->session()->get('sede'))
            ->where('estatus', '!=', 0)
            ->where('tipo_atencion','=',3)
            ->first();
                
            } else if($request->tipo == '4'){
                $atenciones = DB::table('atenciones as a')
                ->select('a.id','a.tipo_origen','a.id_origen','a.eliminado_por','a.id_atec','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
                ->join('pacientes as b','b.id','a.id_paciente')
                ->join('users as c','c.id','a.id_origen')
                ->join('users as d','d.id','a.usuario')
                ->join('analisis as s','s.id','a.id_tipo')
                ->where('a.tipo_atencion', '=', 4)
                ->where('a.estatus', '!=', 0)
                ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                ->orderBy('a.id','DESC')
                ->where('a.sede', '=', $request->session()->get('sede'))
                ->get();
                
                
            $totales = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->select(DB::raw('SUM(abono) as monto,COUNT(*) as cantidad'))
            ->where('sede','=',$request->session()->get('sede'))
            ->where('estatus', '!=', 0)
            ->where('tipo_atencion','=',4)
            ->first();

                
            } else if($request->tipo == '5'){
                $atenciones = DB::table('atenciones as a')
                ->select('a.id','a.tipo_origen','a.id_origen','a.eliminado_por','a.id_atec','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
                ->join('pacientes as b','b.id','a.id_paciente')
                ->join('users as c','c.id','a.id_origen')
                ->join('users as d','d.id','a.usuario')
                ->join('servicios as s','s.id','a.id_tipo')
                ->where('a.tipo_atencion', '=', 5)
                ->where('a.estatus', '!=', 0)
                ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                ->orderBy('a.id','DESC')
                ->where('a.sede', '=', $request->session()->get('sede'))
                ->get(); 

                
            $totales = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->select(DB::raw('SUM(abono) as monto,COUNT(*) as cantidad'))
            ->where('sede','=',$request->session()->get('sede'))
            ->where('estatus', '!=', 0)
            ->where('tipo_atencion','=',5)
            ->first();

                
            } else if($request->tipo == '6'){
                $atenciones = DB::table('atenciones as a')
                ->select('a.id','a.tipo_origen','a.id_origen','a.eliminado_por','a.id_atec','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
                ->join('pacientes as b','b.id','a.id_paciente')
                ->join('users as c','c.id','a.id_origen')
                ->join('users as d','d.id','a.usuario')
                ->join('meto_pro as s','s.id','a.id_tipo')
                ->where('a.tipo_atencion', '=', 6)
                ->where('a.estatus', '!=', 0)
                ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                ->orderBy('a.id','DESC')
                ->where('a.sede', '=', $request->session()->get('sede'))
                ->get(); 

                
            $totales = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->select(DB::raw('SUM(abono) as monto,COUNT(*) as cantidad'))
            ->where('sede','=',$request->session()->get('sede'))
            ->where('estatus', '!=', 0)
            ->where('tipo_atencion','=',6)
            ->first();

                
            } else if($request->tipo == '7'){
                $atenciones = DB::table('atenciones as a')
                ->select('a.id','a.tipo_origen','a.id_origen','a.eliminado_por','a.id_atec','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
                ->join('pacientes as b','b.id','a.id_paciente')
                ->join('users as c','c.id','a.id_origen')
                ->join('users as d','d.id','a.usuario')
                ->join('paquetes as s','s.id','a.id_tipo')
                ->where('a.tipo_atencion', '=', 7)
                ->where('a.estatus', '!=', 0)
                ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                ->orderBy('a.id','DESC')
                ->where('a.sede', '=', $request->session()->get('sede'))
                ->get(); 

                
            $totales = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->select(DB::raw('SUM(abono) as monto,COUNT(*) as cantidad'))
            ->where('sede','=',$request->session()->get('sede'))
            ->where('estatus', '!=', 0)
            ->where('tipo_atencion','=',7)
            ->first();
                
            } else{
                $atenciones = DB::table('atenciones as a')
                ->select('a.id','a.tipo_origen','a.id_origen','a.eliminado_por','a.id_atec','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
                ->join('pacientes as b','b.id','a.id_paciente')
                ->join('users as c','c.id','a.id_origen')
                ->join('users as d','d.id','a.usuario')
                ->join('servicios as s','s.id','a.id_tipo')
                ->where('a.tipo_atencion', '=', 8)
                ->where('a.estatus', '!=', 0)
                ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                ->orderBy('a.id','DESC')
                ->where('a.sede', '=', $request->session()->get('sede'))
                ->get(); 

                
            $totales = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->select(DB::raw('SUM(abono) as monto,COUNT(*) as cantidad'))
            ->where('sede','=',$request->session()->get('sede'))
            ->where('estatus', '!=', 0)
            ->where('tipo_atencion','=',8)
            ->first();
                
            }

    
          
    
          
    
    
           
    
    
          } else {
    
            $f1 = date('Y-m-d');
            $f2 = date('Y-m-d');
            $tipo = '1';
    
         
    
            $atenciones = DB::table('atenciones as a')
            ->select('a.id','a.tipo_origen','a.id_origen','a.eliminado_por','a.id_atec','a.id_tipo','a.pagado','a.atendido','a.sede','a.usuario','a.created_at','a.estatus','a.id_paciente','a.tipo_atencion','a.monto','a.abono','a.tipo_pago','b.nombres','b.apellidos','b.dni','c.name as nameo','c.lastname as lasto','d.name as nameu','d.lastname as lastu','s.nombre as detalle')
            ->join('pacientes as b','b.id','a.id_paciente')
            ->join('users as c','c.id','a.id_origen')
            ->join('users as d','d.id','a.usuario')
            ->join('servicios as s','s.id','a.id_tipo')
            ->where('a.tipo_atencion', '=', 232323)
            ->where('a.monto', '!=', '0')
            ->where('a.sede', '=', $request->session()->get('sede'))
            ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->get(); 


            
            $totales = Atenciones::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
            ->select(DB::raw('SUM(abono) as monto,COUNT(*) as cantidad'))
            ->where('sede','=',$request->session()->get('sede'))
            ->where('estatus', '!=', 0)
            ->where('tipo_atencion','=',676767)
            ->first();
    
     
    
    
    
    
    
          }


       
  

          return view('reportes.total_servicios', compact('f1','f2','atenciones','tipo','totales'));
         
  
      }
  


   

   
}

