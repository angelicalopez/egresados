<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Egresado;
use App\Pais;
use App\Rol;
use App\Http\Requests\EgresadoRequest;

class EgresadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $egresados = Egresado::all();
        return view('admin.egresado_list')->with('egresados', $egresados);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paises = Pais::all();
        return view('admin.egresado_create')->with('paises', $paises);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EgresadoRequest $request)
    {
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->rol_id = Rol::where('nombre', 'Egresado')->first()->id;
        $user->estado = 'A';
        $user->save();

        $egresado = new Egresado;
        $egresado->apellidos = $request->apellidos;
        $egresado->dni = $request->dni;
        $egresado->user_id = $user->id;
        $egresado->pais_id = $request->pais_id;
        $egresado->edad = $request->edad;
        $egresado->manejo_datos = true;
        $egresado->genero = $request->genero;
        $egresado->save();

        $mensaje = "Egresado " . $user->name . " " . $egresado->apellidos . " creado con exito";
        return redirect()->route('admin.egresado.create')->with('success', $mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}