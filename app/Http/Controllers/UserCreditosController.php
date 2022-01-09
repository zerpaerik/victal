<?php

namespace App\Http\Controllers;

use App\Roles;
use App\User;
use App\Especialidades;
use App\Centros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;


class UserCreditosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $prof = User::where('estatus','=',1)->where('tipo','=',2)->get();

        $prof = DB::table('users as a')
        ->select('a.id','a.name','a.lastname','a.cmp','a.telefono','a.especialidad','a.estatus','a.tipo','a.centro','a.email')
        ->where('a.estatus','=',1)
        ->where('a.tipo','=',10)
        ->distinct('a.id')
        ->get(); 
        return view('creditos.index', compact('prof'));
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $especialidades = Especialidades::all();
        $centros = Centros::where('estatus','=',1)->get();

        return view('creditos.create', compact('especialidades','centros'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


      
        $personal = new User();
        $personal->name =$request->nombres;
        $personal->cmp =$request->cmp;
        $personal->telefono =$request->telefono;
        $personal->tipo =10;
        $personal->save();

        return redirect()->action('UserCreditosController@index', ["created" => true, "personal" => User::all()]);
    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function show(Roles $roles)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $prof = DB::table('users as a')
        ->select('a.id','a.name','a.lastname','a.telefono','a.cmp','a.nacimiento','a.cargo','a.cuenta','a.especialidad','a.estatus','a.tipo','a.centro','a.email')
        ->where('a.estatus','=',1)
        ->where('a.tipo','=',10)
        ->where('a.id','=',$id)
        ->first(); 
        return view('creditos.edit', compact('prof')); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $personal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $personal)
    {


    
      $personal = User::find($request->id);
      $personal->name =$request->nombres;
      $personal->cmp =$request->cmp;
      $personal->telefono =$request->telefono;
      $res = $personal->update();

    
      return redirect()->action('UserCreditosController@index');

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $personal = User::find($id);
        $personal->estatus = 0;
        $personal->save();

        return redirect()->action('UserCreditosController@index');

        //
    }
}
