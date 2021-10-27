<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Debitos;
use App\Creditos;
use App\Cajas;
use Auth;
use PDF;
use Carbon\Carbon;



class CajaController extends Controller
{
    public function index(Request $request)
    {

       if(! is_null($request->fecha)) {

    $f1 = $request->fecha;
    $f2 = $request->fecha2;  

     // $caja = DB::table('cajas')->select('*')->where('sede','=',$request->session()->get('sede'))->whereBetween('fecha', [date('Y-m-d', strtotime($f1)), date('Y-m-d', strtotime($f2))])->get();

      $caja = DB::table('cajas as  a')
        ->select('a.id','a.primer_turno','a.segundo_turno','a.sede','a.estatus','a.total','a.usuario_primer','a.fecha','b.name','a.created_at')
        ->join('users as b','b.id','a.usuario_primer')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->whereBetween('a.fecha', [date('Y-m-d', strtotime($f1)), date('Y-m-d', strtotime($f2))])
        ->get();


        //dd($caja);

        $aten = Creditos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
              ->where('sede','=',$request->session()->get('sede'))
              ->select(DB::raw('SUM(monto) as monto'))
                            ->first();

                            $deb = Debitos::whereBetween('created_at', [date('Y-m-d 00:00:00', strtotime($f1)), date('Y-m-d 23:59:59', strtotime($f2))])
                            ->where('sede','=',$request->session()->get('sede'))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
      

        $mensaje;                      

        if (count($caja) == 0) {
            $mensaje = 'Primer';
        }

        if(count($caja) >= 1)
        {
            $mensaje = 'Segundo';
        } 
        
        $total = $aten->monto - $deb->monto;




} else {



        $caja = DB::table('cajas as  a')
        ->select('a.id','a.primer_turno','a.segundo_turno','a.sede','a.estatus','a.total','a.usuario_primer','a.fecha','b.name','a.created_at')
        ->join('users as b','b.id','a.usuario_primer')
        ->where('a.sede','=',$request->session()->get('sede'))
        ->where('a.fecha','=',date('Y-m-d'))
        ->get();


  
        $cajaa = DB::table('cajas')
        ->where('sede','=',$request->session()->get('sede'))
                       ->select('*')->get()->last();


        if($cajaa != null){
            
        $aten = Creditos::where('fecha','>',$cajaa->created_at)
        ->where('sede','=',$request->session()->get('sede'))
        ->select(DB::raw('SUM(monto) as monto'))
        ->first();

        $deb = Debitos::where('fecha','>',$cajaa->created_at)
        ->where('sede','=',$request->session()->get('sede'))
        ->select(DB::raw('SUM(monto) as monto'))
        ->first();

        $total = $aten->monto - $deb->monto;


        } else {

        $aten = Creditos::select(DB::raw('SUM(monto) as monto'))
        ->where('sede','=',$request->session()->get('sede'))
        ->first();

        $deb = Debitos::select(DB::raw('SUM(monto) as monto'))
        ->where('sede','=',$request->session()->get('sede'))
        ->first();

        $total = $aten->monto - $deb->monto;

            
        }
      

		$mensaje;	



          $f1 = date('Y-m-d');
         $f2 = date('Y-m-d'); 
    	
    	
    	if (count($caja) == 0) {
    		$mensaje = 'Primer';
    	}

    	if(count($caja) >= 1)
    	{
    		$mensaje = 'Segundo';
    	}

        }
		  $hoy =date('Y-m-d H:i:s');


	    return view('caja.index',[
	    	'total' => $total,
	    	'mensaje' => $mensaje,
	    	'caja' => $caja,
	    	'fecha' => date('Y-m-d'),
            'fecha1' => $f1,
            'fecha2' => $f2,
            'hoy' => $hoy
	    ]);    	
    }

    public function ticket(Request $request,$id){

        $cajas = DB::table('cajas')
        ->select('*')->get()->last();

        //1ER TURNO 08:00 - 19:59
        //2do TURNO 20:00 - 07-59
        $caja=Cajas::where('id','=',$id)->first();


        $turno1start = date('Y-m-d 08:00:00');
        $turno1end = date('Y-m-d 19:59:00');

        $turno2start = date('Y-m-d 20:00:00');
        $turno2end = date('Y-m-d 07:59:00');



            $ingresos = Creditos::where('origen', 'INGRESO')
            ->whereRaw("fecha > ? AND fecha <= ?", 
              array($caja->fecha_init, $caja->fecha_fin))
            ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
            ->first();

    
            if ($ingresos->cantidad == 0) {
            $ingresos->monto = 0;
            }
    
            $otros = Creditos::where('origen', 'OTROS INGRESOS')
            ->whereRaw("fecha > ? AND fecha <= ?", 
              array($caja->fecha_init, $caja->fecha_fin))
            ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
            ->first();
    
            if ($otros->cantidad == 0) {
            $otros->monto = 0;
            }
    
            $pedido = Creditos::where('origen', 'PEDIDO')
            ->whereRaw("fecha > ? AND fecha <= ?", 
            array($caja->fecha_init, $caja->fecha_fin))
            ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
            ->first();
    
            if ($pedido->cantidad == 0) {
            $pedido->monto = 0;
            }
    
            $totalIngresos = $ingresos->monto + $otros->monto + $pedido->monto;
    
            $egresos = Debitos::whereRaw("fecha > ? AND fecha <= ?", 
            array($caja->fecha_init, $caja->fecha_fin))
            ->select(DB::raw('origen, descripcion, monto,nombre'))
            ->get();
    
    
            $efectivo = Creditos::where('tipopago', 'EF')
            ->whereRaw("fecha > ? AND fecha <= ?", 
            array($caja->fecha_init, $caja->fecha_fin))
            ->select(DB::raw('SUM(monto) as monto'))
            ->first();

            if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
            }
    
            $tarjeta = Creditos::where('tipopago', 'TJ')
            ->whereRaw("fecha > ? AND fecha <= ?", 
              array($caja->fecha_init, $caja->fecha_fin))
                    ->select(DB::raw('SUM(monto) as monto'))
                    ->first();
    
            if (is_null($tarjeta->monto)) {
            $tarjeta->monto = 0;
            }
    
            $totalEgresos = 0;
    
            foreach ($egresos as $egreso) {
                $totalEgresos += $egreso->monto;
            }
    
       




        $view = \View::make('caja.ticket', compact('ingresos','otros','totalIngresos','egresos','efectivo','tarjeta','totalEgresos','pedido','caja'));

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
     
       
        return $pdf->stream('report-cierre'.'.pdf');
    }




        public function create(Request $request)

    {

      $caja = DB::table('cajas')
      ->select('*')
      ->where('fecha','=',Carbon::now()->toDateString())
      ->where('sede','=', $request->session()->get('sede'))
      ->first();

    

      if ($caja == null) {
          Cajas::create([
              'primer_turno' => $request->total,
              'segundo_turno' => 0,
              'fecha' => Carbon::now()->toDateString(),
              'total' => $request->total,
              'sede' =>  $request->session()->get('sede'),
              'usuario_primer' => Auth::user()->id,
              'usuario_segundo' => Auth::user()->id,


          ]);
      } else {

        Cajas::create([
              'primer_turno' => 0,
              'segundo_turno' => $request->total - $caja->primer_turno,
              'fecha' => Carbon::now()->toDateString(),
              'total' => $request->total,
              'sede' =>  $request->session()->get('sede'),
              'usuario_segundo' => Auth::user()->id,
              'usuario_primer' => Auth::user()->id,
          ]);

      }

     /* if(count($caja) == 1)
      {

        $rsf = Cajas::where('id','=',$caja->id)->first();
        $rsf->id_servicio = $request->id_tipo;
        $rsf->save();
       /* Cajas::create([
              'primer_turno' => 0,
              'segundo_turno' => $request->total - $caja[0]->primer_turno,
              'fecha' => Carbon::now()->toDateString(),
              'total' => $request->total,
              'sede' =>  $request->session()->get('sede'),
              'usuario_primer' => Auth::user()->id
          ]);*/
      
      


        return redirect()->action('CajaController@index')
        ->with('success','Turno Cerrado Exitosamente!');
    }

    public function cerrar($id){

        $caja =Cajas::where('id','=',$id)->first();


        $aten = Creditos::where('fecha','>',$caja->fecha_init)
        ->select(DB::raw('SUM(monto) as monto'))
        ->first();

        $deb = Debitos::where('fecha','>',$caja->fecha_init)
        ->select(DB::raw('SUM(monto) as monto'))
        ->first();

        $total = $aten->monto - $deb->monto;

        $c = Cajas::find($id);
        $c->monto_fin =$total;
        $c->fecha_fin =date('Y-m-d H:i:s');
        $c->usuario_fin =Auth::user()->id;
        $c->estatus =2;
        $res = $c->update();
    
    
        return redirect()->action('CajaController@index')
        ->with('success','Turno Cerrado Exitosamente!');    
        
      }


      public function consolidado(Request $request,$id){


        $caja = DB::table('cajas as  a')
        ->select('a.id','a.primer_turno','a.segundo_turno','a.created_at','a.fecha','a.total','a.usuario_primer','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario_primer')
        ->where('a.id','=',$id)
        ->first();


        $fecha=$caja->created_at;
        $fechainic=date('Y-m-d H:i:s', strtotime($caja->fecha));
        $fechafin=$caja->fecha." 23:59:59";
   
        

         $consultas = Creditos::where('origen', 'CONSULTAS')
                                    ->where('sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($consultas->cantidad == 0) {
            $consultas->monto = 0;
        }

        $metodos = Creditos::where('origen', 'METODO')
        ->where('sede','=', $request->session()->get('sede'))
        ->whereRaw("created_at >= ? AND created_at <= ?", 
         array($fechainic, $fecha))
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();
          if ($metodos->cantidad == 0) {
          $metodos->monto = 0;
          }


        $servicios = Creditos::where('origen', 'SERVICIO')
                                    ->where('sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($servicios->cantidad == 0) {
            $servicios->monto = 0;
        }

        
        $eco = Creditos::where('origen', 'ECOGRAFIA')
                                    ->where('sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($eco->cantidad == 0) {
            $eco->monto = 0;
        }

        
        $rayos = Creditos::where('origen', 'RAYOSX')
                                    ->where('sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($rayos->cantidad == 0) {
            $rayos->monto = 0;
        }

        $paq = Creditos::where('origen', 'PAQUETES')
        ->where('sede','=', $request->session()->get('sede'))
        ->whereRaw("created_at >= ? AND created_at <= ?", 
         array($fechainic, $fecha))
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();
          if ($paq->cantidad == 0) {
          $paq->monto = 0;
          }

          $lab = Creditos::where('origen', 'ANALISIS')
        ->where('sede','=', $request->session()->get('sede'))
        ->whereRaw("created_at >= ? AND created_at <= ?", 
         array($fechainic, $fecha))
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();
          if ($lab->cantidad == 0) {
          $lab->monto = 0;
          }


        $cuentasXcobrar = Creditos::where('origen', 'COBRO')
                                    ->where('sede','=', $request->session()->get('sede'))
                                    ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                                    ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                    ->first();
        if ($cuentasXcobrar->cantidad == 0) {
            $cuentasXcobrar->monto = 0;
        }

        $ingresos = Creditos::where('origen', 'INGRESOS')
        ->where('sede','=', $request->session()->get('sede'))
        ->whereRaw("created_at >= ? AND created_at <= ?", 
         array($fechainic, $fecha))
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();
        if ($ingresos->cantidad == 0) {
        $ingresos->monto = 0;
        }


       

        $egresos = Debitos::whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                            ->where('sede','=', $request->session()->get('sede'))
                            ->whereNotIn('tipo',['EXTERNO'])
                            ->select(DB::raw('origen, descripcion, monto, recibido,tipo'))
                            ->get();

        $efectivo = Creditos::where('tipopago', 'EF')
                            ->where('sede','=', $request->session()->get('sede'))
                            ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();
        if (is_null($efectivo->monto)) {
            $efectivo->monto = 0;
        }

        $deposito = Creditos::where('tipopago', 'DP')
        ->where('sede','=', $request->session()->get('sede'))
        ->whereRaw("created_at >= ? AND created_at <= ?", 
                 array($fechainic, $fecha))
        ->select(DB::raw('SUM(monto) as monto'))
        ->first();
        if (is_null($deposito->monto)) {
        $deposito->monto = 0;
        }

      $yape = Creditos::where('tipopago', 'YP')
      ->where('sede','=', $request->session()->get('sede'))
      ->whereRaw("created_at >= ? AND created_at <= ?", 
              array($fechainic, $fecha))
      ->select(DB::raw('SUM(monto) as monto'))
      ->first();
      if (is_null($yape->monto)) {
      $yape->monto = 0;
      }

        $tarjeta = Creditos::where('tipopago', 'TJ')
                            ->where('sede','=', $request->session()->get('sede'))
                            ->whereRaw("created_at >= ? AND created_at <= ?", 
                                     array($fechainic, $fecha))
                            ->select(DB::raw('SUM(monto) as monto'))
                            ->first();

        if (is_null($tarjeta->monto)) {
            $tarjeta->monto = 0;
        }

         $totalEgresos = 0;

        foreach ($egresos as $egreso) {
            $totalEgresos += $egreso->monto;
        }
    
         $totalIngresos = $servicios->monto + $consultas->monto + $eco->monto + $rayos->monto + $cuentasXcobrar->monto + $metodos->monto + $paq->monto  + $lab->monto + $ingresos->monto;

        
 
       
       $view = \View::make('caja.consolidado', compact('servicios', 'consultas','eco','rayos', 'cuentasXcobrar','metodos','serv','lab','paq','caja','egresos','ingresos','efectivo','tarjeta','deposito','yape','totalEgresos','totalIngresos'));
      
       //$view = \View::make('reportes.cierre_caja_ver')->with('caja', $caja);
       $pdf = \App::make('dompdf.wrapper');
       //$pdf->setPaper('A4', 'landscape');
       $pdf->loadHTML($view);
       return $pdf->stream('recibo_cierre_caja_ver');

     

    }

    public function consolidado2(Request $request,$id,$fecha1=NULL,$fecha2=NULL){

      if(!is_null($request->fecha1)){



        $cajamañana=DB::table('cajas as  a')
        ->select('a.id','a.primer_turno','a.segundo_turno','a.created_at','a.sede','a.fecha','a.total','a.usuario_primer','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario_primer')
          ->where('a.sede','=',$request->session()->get('sede'))
          ->whereDate('fecha','=',$request->fecha1)
          ->first();  
  
        $fechamañana=$cajamañana->created_at; 
  
         
  
      } else {
  
          $cajamañana=DB::table('cajas as  a')
          ->select('a.id','a.primer_turno','a.segundo_turno','a.created_at','a.sede','a.fecha','a.total','a.usuario_primer','b.name','b.lastname')
          ->join('users as b','b.id','a.usuario_primer')
          ->where('a.sede','=',$request->session()->get('sede'))
          ->whereDate('fecha','=',Carbon::today()->toDateString())
          ->first();  
  
        $fechamañana=$cajamañana->created_at;   
  
  
      }
        
        $caja = DB::table('cajas as  a')
        ->select('a.id','a.primer_turno','a.segundo_turno','a.created_at','a.sede','a.fecha','a.total','a.usuario_primer','b.name','b.lastname')
        ->join('users as b','b.id','a.usuario_primer')
          ->where('a.id','=',$id)
          ->first();
  
          $fecha=$caja->created_at;
  
 
      

       $consultas = Creditos::where('origen', 'CONSULTAS')
                                  ->where('sede','=', $request->session()->get('sede'))
                                  ->whereRaw("created_at >= ? AND created_at <= ?", 
                                   array($fechamañana, $fecha))
                                  ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                  ->first();
      if ($consultas->cantidad == 0) {
          $consultas->monto = 0;
      }

      $metodos = Creditos::where('origen', 'METODO')
      ->where('sede','=', $request->session()->get('sede'))
      ->whereRaw("created_at >= ? AND created_at <= ?", 
       array($fechamañana, $fecha))
      ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
      ->first();
        if ($metodos->cantidad == 0) {
        $metodos->monto = 0;
        }


      $servicios = Creditos::where('origen', 'SERVICIO')
                                  ->where('sede','=', $request->session()->get('sede'))
                                  ->whereRaw("created_at >= ? AND created_at <= ?", 
                                   array($fechamañana, $fecha))
                                  ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                  ->first();
      if ($servicios->cantidad == 0) {
          $servicios->monto = 0;
      }

      
      $eco = Creditos::where('origen', 'ECOGRAFIA')
                                  ->where('sede','=', $request->session()->get('sede'))
                                  ->whereRaw("created_at >= ? AND created_at <= ?", 
                                   array($fechamañana, $fecha))
                                  ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                  ->first();
      if ($eco->cantidad == 0) {
          $eco->monto = 0;
      }

      
      $rayos = Creditos::where('origen', 'RAYOSX')
                                  ->where('sede','=', $request->session()->get('sede'))
                                  ->whereRaw("created_at >= ? AND created_at <= ?", 
                                   array($fechamañana, $fecha))
                                  ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                  ->first();
      if ($rayos->cantidad == 0) {
          $rayos->monto = 0;
      }

      $paq = Creditos::where('origen', 'PAQUETES')
      ->where('sede','=', $request->session()->get('sede'))
      ->whereRaw("created_at >= ? AND created_at <= ?", 
       array($fechamañana, $fecha))
      ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
      ->first();
        if ($paq->cantidad == 0) {
        $paq->monto = 0;
        }

        $lab = Creditos::where('origen', 'ANALISIS')
      ->where('sede','=', $request->session()->get('sede'))
      ->whereRaw("created_at >= ? AND created_at <= ?", 
       array($fechamañana, $fecha))
      ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
      ->first();
        if ($lab->cantidad == 0) {
        $lab->monto = 0;
        }

        $ingresos = Creditos::where('origen', 'INGRESOS')
        ->where('sede','=', $request->session()->get('sede'))
        ->whereRaw("created_at >= ? AND created_at <= ?", 
         array($fechamañana, $fecha))
        ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
        ->first();
        if ($ingresos->cantidad == 0) {
        $ingresos->monto = 0;
        }



      $cuentasXcobrar = Creditos::where('origen', 'COBRO')
                                  ->where('sede','=', $request->session()->get('sede'))
                                  ->whereRaw("created_at >= ? AND created_at <= ?", 
                                   array($fechamañana, $fecha))
                                  ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
                                  ->first();
      if ($cuentasXcobrar->cantidad == 0) {
          $cuentasXcobrar->monto = 0;
      }

     

      $egresos = Debitos::whereRaw("created_at >= ? AND created_at <= ?", 
                                   array($fechamañana, $fecha))
                          ->where('sede','=', $request->session()->get('sede'))
                          ->whereNotIn('tipo',['EXTERNO'])
                          ->select(DB::raw('origen, descripcion, monto, recibido,tipo'))
                          ->get();

      $efectivo = Creditos::where('tipopago', 'EF')
                          ->where('sede','=', $request->session()->get('sede'))
                          ->whereRaw("created_at >= ? AND created_at <= ?", 
                                   array($fechamañana, $fecha))
                          ->select(DB::raw('SUM(monto) as monto'))
                          ->first();
      if (is_null($efectivo->monto)) {
          $efectivo->monto = 0;
      }

      $deposito = Creditos::where('tipopago', 'DP')
      ->where('sede','=', $request->session()->get('sede'))
      ->whereRaw("created_at >= ? AND created_at <= ?", 
               array($fechamañana, $fecha))
      ->select(DB::raw('SUM(monto) as monto'))
      ->first();
      if (is_null($deposito->monto)) {
      $deposito->monto = 0;
      }

    $yape = Creditos::where('tipopago', 'YP')
    ->where('sede','=', $request->session()->get('sede'))
    ->whereRaw("created_at >= ? AND created_at <= ?", 
            array($fechamañana, $fecha))
    ->select(DB::raw('SUM(monto) as monto'))
    ->first();
    if (is_null($yape->monto)) {
    $yape->monto = 0;
    }

      $tarjeta = Creditos::where('tipopago', 'TJ')
                          ->where('sede','=', $request->session()->get('sede'))
                          ->whereRaw("created_at >= ? AND created_at <= ?", 
                                   array($fechamañana, $fecha))
                          ->select(DB::raw('SUM(monto) as monto'))
                          ->first();

      if (is_null($tarjeta->monto)) {
          $tarjeta->monto = 0;
      }

       $totalEgresos = 0;

      foreach ($egresos as $egreso) {
          $totalEgresos += $egreso->monto;
      }
  
       $totalIngresos = $servicios->monto + $consultas->monto + $eco->monto + $rayos->monto + $cuentasXcobrar->monto + $metodos->monto + $paq->monto  + $lab->monto + $ingresos->monto;

      

     
     $view = \View::make('caja.consolidado', compact('servicios', 'consultas','eco','rayos', 'cuentasXcobrar','metodos','serv','lab','paq','caja','egresos','ingresos','efectivo','tarjeta','deposito','yape','totalEgresos','totalIngresos'));
    
     //$view = \View::make('reportes.cierre_caja_ver')->with('caja', $caja);
     $pdf = \App::make('dompdf.wrapper');
     //$pdf->setPaper('A4', 'landscape');
     $pdf->loadHTML($view);
     return $pdf->stream('recibo_cierre_caja_ver');

   

  }


  

    public function delete($id){

    $caja = Cajas::where('id','=',$id)->first();
    $caja->delete();


    return redirect()->action('CajaController@index')
    ->with('success','Turno Reversado Exitosamente!');    
    
  }

   
    
}
