<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\Medico;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class MedicoController extends Controller
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
        $medicos = Medico::all();
        
        return view('medicos.index', compact('medicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form_route = route('medicos.store');
        $tittle_action = "Crear";
        $form_method = "POST";
        $array_especialidades = Especialidad::all();
        $array_users = User::all();
        foreach ($array_users as $value) {
            $value->nombre = $value->name;
        }
        return view('medicos.create',compact('form_route','form_method','tittle_action','array_especialidades','array_users'));
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

        $medico = Medico::create([
            'nombre'=>$request->all()['nombre'],
            'descripcion'=>$request->all()['descripcion'],
        ]);

        $medico->especialidades()->attach($request->especialidades);
        if($request->has('user')){
            $medico->user()->associate(User::find($request->user));
            $medico->save();
        }
        return redirect(route('medicos.index'))->with('success',trans('customs/medicos.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medico = Medico::find($id);
        $tittle_action = "Detalle";
        return view('medicos.show', compact('medico','tittle_action'));
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
        $medico = Medico::find($id);
        $form_route = route('medicos.update',$medico);
        $array_especialidades = Especialidad::all();
        $array_users = User::all();
        foreach($array_especialidades as $especialidad){
            if($medico->tieneEspecialidad($especialidad->id))
                $especialidad['selected'] = 'selected';
            else
                $especialidad['selected'] = ''; 
        }
        foreach($array_users as $user){
            $user->nombre = $user->name;
            if($medico->user && $medico->user->id == $user->id)
                $user['selected'] = 'selected';
            else
                $user['selected'] = ''; 
        }
        return view('medicos.create',compact('form_route','form_method','tittle_action','array_especialidades','array_users'))->with('medico',$medico);
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
            'nombre' => ['required', 'string', 'max:255']
        ])->validate();
        
        $medico = Medico::find($id);
        if(!$medico){
            return redirect(route('medicos.index'))->with('Error',trans('customs/medicos.error_not_found'));
        }
        DB::table('medico_especialidad')->where('id_medico','=',$id)->delete();
        $medico->nombre = $request->all()['nombre'];
        $medico->descripcion = $request->all()['descripcion'];
        if($request->has('user')){
            $medico->user()->associate(User::find($request->user));
        }
        $medico->save();
        $medico->especialidades()->attach($request->especialidades);
        return redirect(route('medicos.index'))->with('success',trans('customs/medicos.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\Illuminate\Http\Request $req, $id)
    {
        if(Medico::find($id)==null)
            return response()->json(['status'=>'error','message'=>trans('customs/medicos.error_not_found')]);
        Medico::destroy($id);
        return response()->json(['status'=>'success','message'=>trans('customs/medicos.deleted')]);
    }
}
