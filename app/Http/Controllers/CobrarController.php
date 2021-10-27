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
use App\Cobrar;
use App\HistorialCobros;
use App\Creditos;
use Auth;
use Illuminate\Http\Request;
use DB;


class CobrarController extends Controller
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

        $cobrar = DB::table('cuentas_cobrar as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion','a.detalle','a.created_at','a.resta', 'at.id_paciente','at.usuario',  'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu', 'se.nombre as sedename')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'at.usuario')
        ->join('sedes as se', 'se.id', 'at.sede')
        ->whereBetween('a.created_at', [$f1, $f2])
        ->where('a.estatus', '=', 1)
        ->where('a.resta', '!=', 0)
        ->get();


    } else {

        $f1 = date('Y-m-d');
        $f2 = date('Y-m-d');



        $cobrar = DB::table('cuentas_cobrar as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion','a.detalle','a.created_at','a.resta', 'at.id_paciente','at.usuario',  'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu', 'se.nombre as sedename')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'at.usuario')
        ->join('sedes as se', 'se.id', 'at.sede')
        ->where('a.estatus', '=', 1)
        ->where('a.resta', '!=', 0)
        ->get();

    }

      return view('cuentascobrar.index', compact('cobrar','f1','f2'));
       
    }


    public function historial(Request $request)
    {

      if ($request->inicio) {
        $f1 = $request->inicio;
        $f2 = $request->fin;

        $historial = DB::table('historial_cobros as a')
        ->select('a.id', 'a.id_cobro', 'a.tipopago','a.monto','a.created_at','a.sede', 'co.id_atencion','co.resta','at.id_paciente','at.usuario',  'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu', 'se.nombre as sedename','sec.nombre as sedec')
        ->join('cuentas_cobrar as co', 'co.id', 'a.id_cobro')
        ->join('atenciones as at', 'at.id', 'co.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'at.usuario')
        ->join('sedes as se', 'se.id', 'at.sede')
        ->join('sedes as sec', 'sec.id', 'a.sede')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->get();


    } else {

        $f1 = date('Y-m-d');
        $f2 = date('Y-m-d');


        $historial = DB::table('historial_cobros as a')
        ->select('a.id', 'a.id_cobro', 'a.tipopago','a.monto','a.created_at','a.sede', 'co.id_atencion','co.resta','at.id_paciente','at.usuario',  'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu', 'se.nombre as sedename','sec.nombre as sedec')
        ->join('cuentas_cobrar as co', 'co.id', 'a.id_cobro')
        ->join('atenciones as at', 'at.id', 'co.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'at.usuario')
        ->join('sedes as se', 'se.id', 'at.sede')
        ->join('sedes as sec', 'sec.id', 'a.sede')
        ->whereBetween('a.created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
        ->get();


    }
    

      return view('cuentascobrar.historial', compact('historial','f1','f2'));
       
    }

    public function ticket($id)
    {


        $ticket = DB::table('historial_cobros as a')
        ->select('a.id', 'a.id_cobro', 'a.tipopago','a.monto','a.created_at','a.sede', 'co.id_atencion','co.resta','at.id_paciente','at.usuario',  'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos','b.dni', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu', 'se.nombre as sedename')
        ->join('cuentas_cobrar as co', 'co.id', 'a.id_cobro')
        ->join('atenciones as at', 'at.id', 'co.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'at.usuario')
        ->join('sedes as se', 'se.id', 'at.sede')
        ->where('a.id','=', $id)
        ->first();

      



        $view = \View::make('cuentascobrar.ticket', compact('ticket'));
      
        //$view = \View::make('reportes.cierre_caja_ver')->with('caja', $caja);
        $customPaper = array(0,0,900.00,200.00);
 
         $pdf = \App::make('dompdf.wrapper');
         $pdf->loadHTML($view)->setPaper($customPaper, 'landscape');
        return $pdf->stream('cobro');




       }



    


    public function cobrar($id)
    {

        
        $cobrar = DB::table('cuentas_cobrar as a')
        ->select('a.id','a.id_atencion','a.resta','u.monto')
        ->join('atenciones as u','u.id','a.id_atencion')
        ->where('a.id','=',$id)
        ->first(); 


        return view('cuentascobrar.cobrar', compact('cobrar'));
    }

    public function procesar(Request $request)
    {

      $conh = Cobrar::where('id','=',$request->id)->first();
      $atencio = Atenciones::where('id','=',$conh->id_atencion)->first();

      $at = Atenciones::where('id','=',$conh->id_atencion)->first();
      $at->abono = $atencio->abono + $request->pagar;
      $at->resta = $atencio->resta - $request->pagar;
      $at->save();

      $con = Cobrar::where('id','=',$request->id)->first();
      $con->resta = $conh->resta - $request->pagar;
      $con->save();

      $cb = new HistorialCobros();
      $cb->id_cobro =  $request->id;
      $cb->monto = $request->pagar;
      $cb->tipopago = $request->tipopago;
      $cb->sede = $request->session()->get('sede');
      $cb->save();

      
      $cre = new Creditos();
      $cre->origen = 'COBRO';
      $cre->descripcion = 'CUENTAS POR COBRAR';
      $cre->id_cobro =  $cb->id;
      $cre->tipopago =  $request->tipopago;
      $cre->monto = $request->pagar;
      if ($request->tipopago == 'EF') {
        $cre->efectivo = $request->pagar;
      } elseif($request->tipopago == 'TJ') {
        $cre->tarjeta =$request->pagar;
      } elseif($request->tipopago == 'DP') {
        $cre->dep = $request->pagar;
      } else {
        $cre->yap =$request->pagar;
      }
      $cre->fecha = date('Y-m-d');
      $cre->usuario = Auth::user()->id;
      $cre->sede = $request->session()->get('sede');
      $cre->save();

      return back();

      
    }

    public function reversar($id,$id2)
    {

      $conh = Cobrar::where('id','=',$id)->first();
      $atencio = Atenciones::where('id','=',$conh->id_atencion)->first();
      $hisco = HistorialCobros::where('id','=',$id2)->first();


      $at = Atenciones::where('id','=',$conh->id_atencion)->first();
      $at->abono = $atencio->abono - $hisco->monto;
      $at->resta = $atencio->resta + $hisco->monto;
      $at->save();

      $con = Cobrar::where('id','=',$id)->first();
      $con->resta = $conh->resta + $hisco->monto;
      $con->save();

      $hisc = HistorialCobros::where('id','=',$id2)->first();
      $hisc->delete();

      $cred = Creditos::where('id_cobro','=',$id2)->first();
      $cred->delete();

     

      return back();

      
    }


   


}