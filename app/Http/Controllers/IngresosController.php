<?php

namespace App\Http\Controllers;
use App\Equipos;
use App\Analisis;
use App\Clientes;
use App\Creditos;
use App\Tiempo;
use App\Material;
use App\Siniestros;
use App\User;
use Auth;
use Illuminate\Http\Request;
use DB;

class IngresosController extends Controller
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
            $ingresos = DB::table('creditos as a')
          ->select('a.id', 'a.origen', 'a.descripcion', 'a.monto','a.sede',  'a.usuario', 'a.created_at', 'b.name')
          ->join('users as b', 'b.id', 'a.usuario')
          ->where('a.origen', '=', 'INGRESOS')
          ->whereDate('a.created_at', date('Y-m-d 00:00:00', strtotime($f1)))
          ->where('a.sede', '=', $request->session()->get('sede'))
          ->get();

           
        /* $ing = Creditos::where('created_at', '=',$request->inicio)
         ->where('origen', '=', 'OTROS INGRESOS')
         ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
         ->first();

         if ($ing->cantidad == 0) {
         $ing->monto = 0;
         }*/
        } else {
            $f1 =date('Y-m-d');

            $ingresos = DB::table('creditos as a')
            ->select('a.id', 'a.origen', 'a.descripcion', 'a.sede','a.monto', 'a.usuario', 'a.created_at', 'b.name')
            ->join('users as b', 'b.id', 'a.usuario')
            ->where('a.origen', '=', 'INGRESOS')
            ->whereDate('a.created_at', date('Y-m-d 00:00:00', strtotime($f1)))
            ->where('a.sede','=', $request->session()->get('sede'))
            ->get();


            
            /*  $ing = Creditos::where('created_at', '=',$f1)
              ->where('origen', '=', 'OTROS INGRESOS')
              ->select(DB::raw('COUNT(*) as cantidad, SUM(monto) as monto'))
              ->first();

              if ($ing->cantidad == 0) {
              $ing->monto = 0;
              }

              }*/

            //
        }
        return view('ingresos.index', compact('ingresos', 'f1', 'ing'));

    }

  



    public function create()
    {
        return view('ingresos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $cre = new Creditos();
        $cre->origen = 'INGRESOS';
        $cre->descripcion = $request->descripcion;
        $cre->monto = $request->monto;
        $cre->usuario = Auth::user()->id;
        $cre->tipopago = $request->tipopago;
        if ($request->tipopago == 'EF') {
            $cre->efectivo = $request->monto;
          } elseif($request->tipopago == 'TJ') {
            $cre->tarjeta = $request->monto;
          } elseif($request->tipopago == 'DP') {
            $cre->dep = $request->monto;
          } else {
            $cre->yap = $request->monto;
          }
        $cre->sede = $request->session()->get('sede');
        $cre->fecha = date('Y-m-d');
        $cre->save();



        return redirect()->action('IngresosController@index', ["created" => true, "ingresos" => Creditos::all()]);

    }

   
    
    
    public function ticket($id)
    {


       
        $ingreso = Creditos::where('id', $id)
         ->select('*')
         ->first();

        $view = \View::make('ingresos.ticket',compact('ingreso'));

        $customPaper = array(0,0,500.00,200.00);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper($customPaper, 'landscape');
     
       
        return $pdf->stream('ticket-ingreso'.'.pdf');
       
    }	 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Analisis  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $ingresos = Creditos::where('id','=',$id)->first();

        return view('ingresos.edit', compact('ingresos')); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Creditos  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

      $p = Creditos::find($request->id);
      $p->descripcion =$request->descripcion;
      $p->tipopago =$request->tipopago;
      if ($request->tipopago == 'EF') {
        $p->efectivo = $request->monto;
        $p->tarjeta = '0';
        $p->dep = '0';
        $p->yap = '0';
      } elseif($request->tipopago == 'TJ') {
        $p->tarjeta = $request->monto;
        $p->efectivo = '0';
        $p->dep = '0';
        $p->yap = '0';
      } elseif($request->tipopago == 'DP') {
        $p->dep = $request->monto;
        $p->efectivo = '0';
        $p->tarjeta = '0';
        $p->yap = '0';
      } else {
        $p->efectivo = '0';
        $p->tarjeta = '0';
        $p->dep = '0';
        $p->yap = $request->monto;
      }
      $p->monto =$request->monto;
      $res = $p->update();
      return redirect()->action('IngresosController@index');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Creditos  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $ingresos = Creditos::where('id','=',$id);
        $ingresos->delete();

        return redirect()->action('IngresosController@index');

        //
    }
}

