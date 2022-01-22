<?php

namespace App\Http\Controllers;
use App\Equipos;
use App\Requerimientos;
use App\ActivosRequerimientos;
use App\Clientes;
use App\Creditos;
use App\Debitos;
use App\Pedidos;
use App\Ventas;
use App\VentasDetalle;
use App\Pacientes;
use App\Solicitudes;
use App\Analisis;
use App\User;
use App\Productos;
use Auth;
use Illuminate\Http\Request;
use DB;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if($request->inicio){

        $f1 = $request->inicio;
        $f2 = $request->fin;

        $ventas = DB::table('ventas as a')
        ->select('a.id','b.id_producto','b.cantidad','b.cliente','b.tipop','b.monto',DB::raw(' SUM(b.total) as total'),'a.created_at','an.nombre as producto')
        ->join('ventas_detalle as b','b.id_venta','a.id')
        ->join('productos as an','an.id','b.id_producto')
        ->whereBetween('a.created_at', [$f1, $f2])
        ->groupBy('b.id_venta')
        ->get(); 


        $total = VentasDetalle::whereBetween('created_at', [$f1, $f2])
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();

        
        $total_ef = VentasDetalle::whereBetween('created_at', [$f1, $f2])
        ->where('tipop', '=', 'EF')
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();

        
        $total_tj = VentasDetalle::whereBetween('created_at', [$f1, $f2])
        ->where('tipop', '=', 'TJ')
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();

        
        $total_dp = VentasDetalle::whereBetween('created_at', [$f1, $f2])
        ->where('tipop', '=', 'DP')
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();

        $total_pl = VentasDetalle::whereBetween('created_at', [$f1, $f2])
        ->where('tipop', '=', 'PL')
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();

        
        $total_yp = VentasDetalle::whereBetween('created_at',  [$f1, $f2])
        ->where('tipop', '=', 'YP')
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();


 
    }else {
        $ventas = DB::table('ventas as a')
        ->select('a.id','b.id_producto','b.cantidad','b.cliente','b.tipop','b.monto',DB::raw(' SUM(b.total) as total'),'a.created_at','an.nombre as producto')
        ->join('ventas_detalle as b','b.id_venta','a.id')
        ->join('productos as an','an.id','b.id_producto')
        ->where('a.created_at', '=', date('Y-m-d'))
        ->groupBy('b.id_venta')
        ->get(); 

        $f1 =date('Y-m-d');
        $f2 =date('Y-m-d');

        $total = VentasDetalle::where('created_at', '=', date('Y-m-d'))
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();

        
        $total_ef = VentasDetalle::where('created_at', '=', date('Y-m-d'))
        ->where('tipop', '=', 'EF')
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();

        
        $total_tj = VentasDetalle::where('created_at', '=', date('Y-m-d'))
        ->where('tipop', '=', 'TJ')
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();

        
        $total_dp = VentasDetalle::where('created_at', '=', date('Y-m-d'))
        ->where('tipop', '=', 'DP')
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();

          
        $total_pl = VentasDetalle::where('created_at', '=', date('Y-m-d'))
        ->where('tipop', '=', 'PL')
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();

        
        $total_yp = VentasDetalle::where('created_at', '=', date('Y-m-d'))
        ->where('tipop', '=', 'YP')
        ->select(DB::raw('COUNT(*) as cantidad, SUM(total) as monto'))
        ->first();



          
      

    }

    $ventass = new Ventas();


    

        return view('ventas.index', compact('ventas','f1','f2','ventass','total','total_pl','total_ef','total_tj','total_dp','total_yp'));
        //
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       
        $productos = Productos::where('estatus','=',1)->get();

        return view('ventas.create', compact('productos'));

    }

   

    public function store(Request $request)
    {

        $venta = new Ventas();
        $venta->save();


        if (isset($request->id_laboratorio)) {
             foreach ($request->id_laboratorio['laboratorios'] as $key => $lab) {
               if (!is_null($lab['laboratorio'])) {

                $pedidos = new VentasDetalle();
                $pedidos->id_venta =$venta->id;
                $pedidos->id_producto =$lab['laboratorio'];
                $pedidos->monto =$request->monto_l['laboratorios'][$key]['monto'];
                $pedidos->cantidad =$request->monto_abol['laboratorios'][$key]['abono'];
                $pedidos->total =$request->monto_abol['laboratorios'][$key]['abono'] * $request->monto_l['laboratorios'][$key]['monto'];
                $pedidos->cliente =$request->cliente;
                $pedidos->tipop =$request->tipop;
                $pedidos->usuario =Auth::user()->id;
                $pedidos->save();

                   $produc = Productos::where('id','=',$lab['laboratorio'])->first();

                    $p = Productos::find($produc->id);
                    $p->cantidad =$produc->cantidad - $request->monto_abol['laboratorios'][$key]['abono'];
                    $res = $p->update();

       
               } else {
       
               }
             }
           }

       
        


        return redirect()->action('VentasController@index')
        ->with('success','Registrado Exitosamente!');


    }

   

    public function ticket($id)
    {
        $pedido = Equipos::find($id);

        $pedidos = DB::table('pedidos as a')
        ->select('a.id','a.solicitud','a.descripcion','a.monto','a.created_at','a.estatus','b.huesped','b.habitacion','an.nombre as habita','h.nombre as nompac','h.responsable as apepac')
        ->join('solicitudes as b','b.id','a.solicitud')
        ->join('analisis as an','an.id','b.habitacion')
        ->join('clientes as h','h.id','b.huesped')
        ->where('a.solicitud','=',$id)
        ->get(); 



                                    $ped = DB::table('pedidos as a')
                                    ->select('a.id','a.solicitud','a.descripcion','a.monto','a.created_at','a.estatus','b.huesped','b.habitacion','an.nombre as habita','h.nombre as nompac','h.responsable as apepac')
                                    ->join('solicitudes as b','b.id','a.solicitud')
                                    ->join('analisis as an','an.id','b.habitacion')
                                    ->join('clientes as h','h.id','b.huesped')
                                    ->where('a.solicitud','=',$id)
                                    ->first(); 

        $productos = Productos::where('estatus','=',1)->get();
        $cli = Clientes::where('id','=',$ped->huesped)->first();



        $view = \View::make('pedidos.ticket', compact('pedidos','ped','cli'));
        $customPaper = array(0,0,500.00,190.00);

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view)->setPaper($customPaper, 'landscape');
     
       
        return $pdf->stream('ticket-pedido'.'.pdf');    }

   

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $sesio = VentasDetalle::where('id_venta','=',$id)->get();
        if ($sesio != null) {
            foreach ($sesio as $rs) {
                $id_rs = $rs->id;
                if (!is_null($id_rs)) {

                    $rsfp = VentasDetalle::where('id', '=', $id_rs)->first();
                    $produc = VentasDetalle::where('id', '=', $rsfp->id_producto)->first();

                    $p = Productos::find($rsfp->id_producto);
                    $p->cantidad =$produc->cantidad + $rsfp->cantidad;
                    $res = $p->update();

                    $rsf = VentasDetalle::where('id', '=', $id_rs)->first();
                    $rsf->delete();
                }
            }
        }
       

        $creditos = Ventas::where('id','=',$id)->first();
        $creditos->delete();

        return redirect()->action('VentasController@index');

        //
    }


    public function guardar_archivo(Request $request){



        $usuario = DB::table('users')
        ->select('*')
        ->where('id','=', Auth::user()->id)
        ->first();  
  
  
        $rs = Atenciones::where('id','=',$request->id)->first();
        $img = $request->file('informe');
        $nombre_imagen=$img->getClientOriginalName();
        $rs->usuario_archivo=Auth::user()->id;
        $rs->archivo=$nombre_imagen;
        if ($rs->save()) {
            \Storage::disk('public')->put($nombre_imagen, \File::get($img));
        }
        \DB::commit();
  
  
        return redirect()->route('atenciones.index')
        ->with('success','Creado Exitosamente!');
           
      }
  
      public function guardar_archivo_get($id){
  
        return view('ventas.archivo', compact('id'));
  
      }
  
  




}

