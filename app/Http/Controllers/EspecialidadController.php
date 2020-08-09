<?php

namespace App\Http\Controllers;

use App\Especialidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EspecialidadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $especialidades = Especialidad::all();
        
        return view('especialidades.index', compact('especialidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form_route = route('especialidades.store');
        $tittle_action = "Crear";
        $form_method = "POST";
        return view('especialidades.create',compact('form_route','form_method','tittle_action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255'],
        ])->validate();

        Especialidad::create([
            'nombre' => $request->all()['nombre'],
            'descripcion' => $request->all()['descripcion']
        ]);

        return redirect(route('especialidades.index'))->with('success',trans('customs/especialidades.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especialidad = Especialidad::find($id);
        $tittle_action = "Detalle";
        return view('especialidades.show', compact('especialidad','tittle_action'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tittle_action = "Editar";
        $form_method = "PUT";
        $especialidad = Especialidad::find($id);
        $form_route = route('especialidades.update',$especialidad);
        return view('especialidades.create',compact('form_route','form_method','tittle_action'))->with('especialidad',$especialidad);
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
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable','image','mimes:jpeg,jpg,png,gif|max:100000']
        ],[
            'image' => 'El campo de la foto de perfil debe ser una imagen.',
        ])->validate();
        $especialidad = Especialidad::find($id);
        if(!$especialidad){
            return redirect(route('especialidades.index'))->with('Error',trans('customs/especialidades.error_not_found'));
        }
        $especialidad->name = $request->all()['name'];
        $especialidad->descripcion = $request->all()['descripcion'];
        $especialidad->save();
        return redirect(route('especialidades.index'))->with('success',trans('customs/especialidades.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\Illuminate\Http\Request $req, $id)
    {
        if(Especialidad::find($id)==null)
            return response()->json(['status'=>'error','message'=>trans('customs/especialidades.error_not_found')]);
        Especialidad::destroy($id);
        return response()->json(['status'=>'success','message'=>trans('customs/especialidades.deleted')]);
    }
}
