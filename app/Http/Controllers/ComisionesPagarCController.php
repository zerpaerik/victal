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
use App\ComisionesC;
use Auth;
use Illuminate\Http\Request;
use DB;


class ComisionesPagarCController extends Controller
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



         
        if ($request->origen != null) {
            $comisiones = DB::table('creditosc as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.id_responsable','a.id_origen', 'a.created_at', 'a.detalle', 'a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.resta', 'at.tipo_atencion', 'at.sede', 'at.atendido', 'at.tipo_origen', 'at.id_origen', 'at.abono', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 10)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->where('a.id_responsable', '=', $request->origen)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderBy('a.created_at', 'ASC')
        ->get();


        $origen = DB::table('creditosc as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.id_origen', 'a.id_responsable', 'a.created_at', 'a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.atendido', 'at.sede', 'at.resta', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'c.name as nameo', 'c.lastname as lasto', 'c.id as idorigen')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 10)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->whereBetween('a.created_at', [$f1, $f2])
        //->where('at.id_origen', '=', $request->origen)
        ->groupBy('a.id_responsable')
        ->get();

        } else {
          $comisiones = DB::table('creditosc as a')
          ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.id_origen', 'a.created_at', 'a.detalle', 'a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.resta', 'at.tipo_atencion', 'at.sede', 'at.atendido', 'at.tipo_origen', 'at.id_origen', 'at.abono', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
          ->join('atenciones as at', 'at.id', 'a.id_atencion')
          ->join('pacientes as b', 'b.id', 'at.id_paciente')
          ->join('users as c', 'c.id', 'a.id_responsable')
          ->join('users as d', 'd.id', 'a.usuario')
          ->where('a.estatus', '=', 1)
          ->where('a.id_origen', '=', 10)
          ->where('at.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [$f1, $f2])
          ->orderBy('a.created_at', 'ASC')
          ->get();
  
  
  
              $origen = DB::table('creditosc as a')
          ->select('a.id', 'a.estatus', 'a.id_atencion', 'a.id_origen', 'a.id_responsable', 'a.created_at', 'a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.atendido', 'at.sede', 'at.resta', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'c.name as nameo', 'c.lastname as lasto', 'c.id as idorigen')
          ->join('atenciones as at', 'at.id', 'a.id_atencion')
          ->join('users as c', 'c.id', 'a.id_responsable')
          ->where('a.estatus', '=', 1)
          ->where('a.id_origen', '=', 10)
          ->where('at.sede', '=', $request->session()->get('sede'))
          ->whereBetween('a.created_at', [$f1, $f2])
          ->groupBy('a.id_responsable')
          ->get();

        }


        } else {

            $f1 = date('Y-m-d');
            $f2 = date('Y-m-d');

      

        $comisiones = DB::table('creditosc as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion','a.id_origen','a.id_responsable','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente','at.resta', 'at.tipo_atencion', 'at.sede', 'at.atendido','at.tipo_origen','at.abono', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 10)
       // ->where('at.monto', 'at.abono')
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.created_at', [$f1, $f2])
        ->orderBy('a.created_at','ASC')
        ->get();



    

        $origen = DB::table('creditosc as a')
        ->select('a.id', 'a.estatus', 'a.id_atencion','a.id_origen', 'a.id_responsable','a.created_at','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.atendido','at.sede', 'at.resta','at.tipo_origen', 'at.id_origen', 'at.monto as total',  'c.name as nameo', 'c.lastname as lasto','c.id as idorigen')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->where('a.estatus', '=', 1)
        ->where('a.id_origen', '=', 10)
        ->where('at.sede', '=', $request->session()->get('sede'))
        ->where('a.created_at', '=',date('Y-m-d'))
        ->groupBy('a.id_responsable')
        ->get();






        }
        //->where('a.monto', '!=', '0')
        //->get(); 

        


        return view('creditosc.index', compact('comisiones','f1','f2','origen'));
        //
    }

    public function index1(Request $request)
    {

        if ($request->inicio) {
            $f1 = $request->inicio;
            $f2 = $request->fin;

        
        $comisiones = DB::table('creditosc as a')
        ->select('a.id', 'a.estatus','a.recibo','a.id_origen','a.tipop','a.id_responsable', 'a.id_atencion','a.fecha_pago','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu',DB::raw('SUM(a.monto) as totalrecibo'))
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 2)
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.fecha_pago', [$f1, $f2])
        ->groupBy('a.recibo')      
        ->get();

      //  $comisiones = self::unique_multidim_array(json_decode($comisionest, true), "recibo");



        } else {

            $f1 = date('Y-m-d');
            $f2 = date('Y-m-d');

      

        $comisiones = DB::table('creditosc as a')
        ->select('a.id', 'a.estatus','a.recibo','a.id_origen','a.tipop','a.id_responsable', 'a.fecha_pago', 'a.id_atencion','a.created_at','a.detalle','a.usuario', 'a.porcentaje', 'a.monto', 'a.estatus', 'at.id_paciente', 'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto', 'd.name as nameu', 'd.lastname as lastu',DB::raw('SUM(a.monto) as totalrecibo'))
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'a.id_responsable')
        ->join('users as d', 'd.id', 'a.usuario')
        ->where('a.estatus', '=', 2)
        ->where('at.sede', '=', $request->session()->get('sede'))
       // ->where('at.id_origen','=',$request->origen)
        ->whereBetween('a.fecha_pago', [$f1, $f2])
        ->groupBy('a.recibo')      
        ->get();









        }


       

        


        return view('creditosc.index1', compact('comisiones','f1','f2'));
        //
    }

  


    public function pagarmultiple(Request $request)
    {


      if(isset($request->com)){
        $last = ComisionesC::select('recibo')->where('estatus','=',2)->orderby('recibo', 'desc')->max('recibo');
        if ($last != NULL) {
          $last1 = $last;
          //$last = array_pop($last);
        } else {
          $last1 = 0;
        }
  
        $recibo = $last1 + 1;
        
        foreach ($request->com as $atencion) {

          $com = ComisionesC::where('id','=',$atencion)->first();

          $a = Atenciones::where('id','=',$com->id_atencion)->first();
          $a->pagado =2;
          $resa = $a->update();
         

          ComisionesC::where('id', $atencion)
                    ->update([
                        'fecha_pago' => date('Y-m-d'),
                        'estatus' => 2,
                        'tipop' => $request->tipop,
                        'recibo' => $recibo
                    ]);
        }
  
      } 
  
      return back();
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function pagar(Request $request)
    {

      $com = ComisionesC::where('id','=',$request->id)->first();

      $last = ComisionesC::select('recibo')->where('estatus','=',2)->orderby('recibo', 'desc')->max('recibo');
      if ($last != NULL) {
        $last1 = $last;
        //$last = array_pop($last);
      } else {
        $last1 = 0;
      }

      $recibo = $last1 + 1;


      $a = Atenciones::where('id','=',$com->id_atencion)->first();
      $a->pagado =2;
      $resa = $a->update();
     

      $p = ComisionesC::find($request->id);
      $p->estatus =2;
      $p->recibo = $recibo;
      $p->tipop = $request->tipop;
      $p->fecha_pago = date('Y-m-d');
      $res = $p->update();
    
      return back();

        //
    }


    public function ticket($id)
    {

      $compagada = Comisiones::where('recibo','=',$id)->get();



        $ticket = DB::table('creditosc as a')
        ->select('a.id', 'a.id_atencion','a.recibo','a.porcentaje','a.detalle','a.monto','a.created_at','at.id_paciente','at.usuario',  'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto','c.cuenta', 'd.name as nameu', 'd.lastname as lastu', 'se.nombre as sedename')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'at.usuario')
        ->join('sedes as se', 'se.id', 'at.sede')
        ->where('a.recibo','=', $id)
        ->get();

        $ticketu = DB::table('creditosc as a')
        ->select('a.id', 'a.id_atencion','a.recibo','a.tipop','a.porcentaje','a.fecha_pago','a.detalle','a.monto','a.created_at','at.id_paciente','at.usuario',  'at.tipo_atencion', 'at.sede', 'at.tipo_origen', 'at.id_origen', 'at.monto as total', 'b.nombres', 'b.apellidos', 'c.name as nameo', 'c.lastname as lasto','c.cuenta', 'd.name as nameu', 'd.lastname as lastu', 'se.nombre as sedename')
        ->join('atenciones as at', 'at.id', 'a.id_atencion')
        ->join('pacientes as b', 'b.id', 'at.id_paciente')
        ->join('users as c', 'c.id', 'at.id_origen')
        ->join('users as d', 'd.id', 'at.usuario')
        ->join('sedes as se', 'se.id', 'at.sede')
        ->where('a.recibo','=', $id)
        ->first();

        $total = ComisionesC::where('recibo', $id)
                            ->select(DB::raw('SUM(monto) as totalrecibo'))
                            ->get();
     


        $view = \View::make('creditosc.ticket', compact('ticket','ticketu','total'));
        $pdf = \App::make('dompdf.wrapper');
        //$pdf->setPaper('A5', 'landscape');
        //$pdf->setPaper(array(0,0,600.00,360.00));
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('ticket-factura-cobrada'.'.pdf'); 
       }

       public function reversar($id)
    {

      $com = ComisionesC::where('recibo','=',$id)->first();


     
     /* $a = Atenciones::where('id','=',$com->id_atencion)->first();
      $a->pagado =1;
      $resa = $a->update();*/
     
      $sesio = ComisionesC::where('recibo','=',$id)->get();
      if ($sesio != null) {
          foreach ($sesio as $rs) {
              $id_rs = $rs->id;
              if (!is_null($id_rs)) {
                  $rsf = ComisionesC::where('id','=',$id_rs)->first();
                  $rsf->estatus =1;
                  $rsf->recibo = '';
                  $rsf->tipop = '';
                  $rsf->fecha_pago = NULL;
                  $rsf->save();

              }
          }
      }




    
      return back();

        //
    }





 
}