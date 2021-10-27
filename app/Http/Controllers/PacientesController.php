<?php

namespace App\Http\Controllers;
use App\Equipos;
use App\Analisis;
use App\Clientes;
use App\Tiempo;
use App\Material;
use App\Pacientes;
use App\User;
use Auth;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;


class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        
      if(!is_null($request->filtro)){
        $pacientes = DB::table('pacientes as a')
        ->select('a.id','a.nombres','a.dni','a.apellidos','a.usuario','a.fechanac','a.email','a.sexo','a.telefono','a.empresa','a.estatus')
        ->where('a.estatus', '=', 1)
        ->where('a.apellidos','like','%'.$request->filtro.'%')
        ->orderby('a.apellidos','asc')
        ->get(); 

        }else{
        $pacientes = DB::table('pacientes as a')
          ->select('a.id','a.nombres','a.dni','a.apellidos','a.fechanac','a.email','a.sexo','a.telefono','a.empresa','a.estatus')
          ->where('a.estatus', '=', 999999999)
          ->get(); 
        }

      

       
        return view('pacientes.index', compact('pacientes'));
        //
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
        return view('pacientes.create');
    }

    public function create2()
    {
       
        return view('pacientes.create2');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $pac = Pacientes::where('estatus','=',1)->latest()->first();


      if ($request->tipo_doc != 'SIN DOC') {

        $validator = \Validator::make($request->all(), [
        'dni' => 'required|unique:pacientes'
            
          ]);
          if($validator->fails()) {
            $request->session()->flash('error', 'El Paciente ya esta Registrado.');
           // Toastr::error('Error Registrando.', 'Paciente- DNI YA REGISTRADO!', ['progressBar' => true]);
            return redirect()->action('PacientesController@create', ['errors' => $validator->errors()]);
          } else {
              $pacientes = new Pacientes();
              $pacientes->nombres =$request->nombres;
              $pacientes->apellidos =$request->apellidos;
              $pacientes->tipo_doc =$request->tipo_doc;
              $pacientes->dni =$request->dni;
              $pacientes->telefono =$request->telefono;
              $pacientes->email =$request->email;
              $pacientes->direccion =$request->direccion;
              $pacientes->edocivil =$request->edocivil;
              $pacientes->ocupacion =$request->ocupacion;
              $pacientes->fechanac =$request->fechanac;
              $pacientes->sexo =$request->sexo;
              $pacientes->usuario =Auth::user()->id;
              $pacientes->save();

            
          } 

        } else {

          $pacientes = new Pacientes();
          $pacientes->nombres =$request->nombres;
          $pacientes->apellidos =$request->apellidos;
          $pacientes->tipo_doc =$request->tipo_doc;
          $pacientes->dni =$pac->id + 1;
          $pacientes->telefono =$request->telefono;
          $pacientes->email =$request->email;
          $pacientes->direccion =$request->direccion;
          $pacientes->edocivil =$request->edocivil;
          $pacientes->ocupacion =$request->ocupacion;
          $pacientes->fechanac =$request->fechanac;
          $pacientes->sexo =$request->sexo;
          $pacientes->usuario =Auth::user()->id;
          $pacientes->save();

        }




        return redirect()->action('PacientesController@index', ["created" => true, "pacientes" => Pacientes::all()]);
    }

    

    public function store2(Request $request)
    {

      $pac = Pacientes::where('estatus','=',1)->latest()->first();


      if ($request->tipo_doc != 'SIN DOC') {

        $validator = \Validator::make($request->all(), [
        'dni' => 'required|unique:pacientes'
            
          ]);
          if($validator->fails()) {
            $request->session()->flash('error', 'El Paciente ya esta Registrado.');
           // Toastr::error('Error Registrando.', 'Paciente- DNI YA REGISTRADO!', ['progressBar' => true]);
            return redirect()->action('PacientesController@create', ['errors' => $validator->errors()]);
          } else {
              $pacientes = new Pacientes();
              $pacientes->nombres =$request->nombres;
              $pacientes->apellidos =$request->apellidos;
              $pacientes->tipo_doc =$request->tipo_doc;
              $pacientes->dni =$request->dni;
              $pacientes->telefono =$request->telefono;
              $pacientes->email =$request->email;
              $pacientes->direccion =$request->direccion;
              $pacientes->edocivil =$request->edocivil;
              $pacientes->ocupacion =$request->ocupacion;
              $pacientes->fechanac =$request->fechanac;
              $pacientes->sexo =$request->sexo;
              $pacientes->usuario =Auth::user()->id;
              $pacientes->save();

            
          } 

        } else {

          $pacientes = new Pacientes();
          $pacientes->nombres =$request->nombres;
          $pacientes->apellidos =$request->apellidos;
          $pacientes->tipo_doc =$request->tipo_doc;
          $pacientes->dni =$pac->id + 1;
          $pacientes->telefono =$request->telefono;
          $pacientes->email =$request->email;
          $pacientes->direccion =$request->direccion;
          $pacientes->edocivil =$request->edocivil;
          $pacientes->ocupacion =$request->ocupacion;
          $pacientes->fechanac =$request->fechanac;
          $pacientes->sexo =$request->sexo;
          $pacientes->usuario =Auth::user()->id;
          $pacientes->save();

        }

      

        return redirect()->action('AtencionesController@create');
    

    }

    public function ver($id)
    {


      $pacientes = DB::table('pacientes as a')
      ->select('a.id','a.nombres','a.dni','a.apellidos','a.ocupacion','a.tipo_doc','a.usuario','a.fechanac','a.email','a.sexo','a.telefono','a.empresa','a.estatus')
     // ->join('users as u', 'u.id', 'a.usuario')
      ->where('a.id', '=', $id)
      ->first(); 


      $edad = Carbon::parse($pacientes->fechanac)->age;
	  
       


	  
      return view('pacientes.ver', compact('pacientes', 'edad'));
    }	  

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Pacientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pacientes = Pacientes::where('id','=',$id)->first();

        return view('pacientes.edit', compact('pacientes')); //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Pacientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pacientes $pacientes)
    {

      $pacientes = Pacientes::where('id','=',$request->id)->first();
      $pacientes->nombres =$request->nombres;
      $pacientes->apellidos =$request->apellidos;
      $pacientes->tipo_doc =$request->tipo_doc;
      $pacientes->dni =$request->dni;
      $pacientes->telefono =$request->telefono;
      $pacientes->email =$request->email;
      $pacientes->direccion =$request->direccion;
      $pacientes->edocivil =$request->edocivil;
      $pacientes->ocupacion =$request->ocupacion;
      $pacientes->fechanac =$request->fechanac;
      $res = $pacientes->save();
      return redirect()->action('PacientesController@index');

    

        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Pacientes  $Clientes
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {

        $analisis = Pacientes::find($id);
        $analisis->estatus = 0;
        $analisis->save();

        return redirect()->action('PacientesController@index');

        //
    }
}
