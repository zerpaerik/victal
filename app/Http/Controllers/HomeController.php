<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Creditos;
use App\Debitos;
use App\Analisis;
use App\Atenciones;
use App\Sedes;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $sedes = Sedes::all();


        $caja = DB::table('cajas as  a')
        ->select('a.id','a.primer_turno','a.segundo_turno','a.created_at','a.fecha','a.sede','a.total','a.usuario_primer','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario_primer')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereDate('a.created_at', date('Y-m-d 00:00:00', strtotime(date('Y-m-d'))))
        ->first();



        if ($caja == null) {
            $total = Creditos::whereDate('created_at', date('Y-m-d 00:00:00', strtotime(date('Y-m-d'))))
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('sede', '=', $request->session()->get('sede'))
        ->first();

          

            $efec = Creditos::whereDate('created_at', date('Y-m-d 00:00:00', strtotime(date('Y-m-d'))))
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('tipopago', '=', 'EF')
        ->where('sede', '=', $request->session()->get('sede'))
        ->first();


            $tarj = Creditos::whereDate('created_at', date('Y-m-d 00:00:00', strtotime(date('Y-m-d'))))
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('tipopago', '=', 'TJ')
        ->where('sede', '=', $request->session()->get('sede'))
        ->first();

            $dep = Creditos::whereDate('created_at', date('Y-m-d 00:00:00', strtotime(date('Y-m-d'))))
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('tipopago', '=', 'DP')
        ->where('sede', '=', $request->session()->get('sede'))
        ->first();

            $yap = Creditos::whereDate('created_at', date('Y-m-d 00:00:00', strtotime(date('Y-m-d'))))
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('tipopago', '=', 'YP')
        ->where('sede', '=', $request->session()->get('sede'))
        ->first();

            $egresos = Debitos::whereDate('created_at', date('Y-m-d 00:00:00', strtotime(date('Y-m-d'))))
            ->where('tipo', '!=', 'EXTERNO')
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('sede', '=', $request->session()->get('sede'))
        ->first();
        } else {

            $fecha=$caja->created_at;
            $fechainic=date('Y-m-d H:i:s', strtotime($caja->fecha));
            $fechafin=$caja->fecha." 23:59:59";


            $total = Creditos::whereRaw("created_at >= ? AND created_at <= ?", 
            array($fecha, $fechafin))
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('sede', '=', $request->session()->get('sede'))
        ->first();

          

            $efec = Creditos::whereRaw("created_at >= ? AND created_at <= ?", 
            array($fecha, $fechafin))
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('tipopago', '=', 'EF')
        ->where('sede', '=', $request->session()->get('sede'))
        ->first();


            $tarj = Creditos::whereRaw("created_at >= ? AND created_at <= ?", 
            array($fecha, $fechafin))
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('tipopago', '=', 'TJ')
        ->where('sede', '=', $request->session()->get('sede'))
        ->first();

            $dep = Creditos::whereRaw("created_at >= ? AND created_at <= ?", 
            array($fecha, $fechafin))
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('tipopago', '=', 'DP')
        ->where('sede', '=', $request->session()->get('sede'))
        ->first();

            $yap = Creditos::whereRaw("created_at >= ? AND created_at <= ?", 
            array($fecha, $fechafin))
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('tipopago', '=', 'YP')
        ->where('sede', '=', $request->session()->get('sede'))
        ->first();

            $egresos = Debitos::whereRaw("created_at >= ? AND created_at <= ?", 
            array($fecha, $fechafin))
            ->where('tipo', '!=', 'EXTERNO')
        ->select(DB::raw('SUM(monto) as monto'))
        ->where('sede', '=', $request->session()->get('sede'))
        ->first();



        }

        return view('home',compact('sedes', 'total','efec','tarj','dep','count','yap','egresos'));
    }
}
