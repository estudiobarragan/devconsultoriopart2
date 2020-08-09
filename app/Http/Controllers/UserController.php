<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
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
        $users = User::all();
        
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form_route = route('users.store');
        $tittle_action = "Crear";
        $form_method = "POST";
        return view('users.create',compact('form_route','form_method','tittle_action'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'photo' => ['nullable','image','mimes:jpeg,jpg,png,gif|max:100000']
        ],[
            'image' => 'El campo de la foto de perfil debe ser una imagen.',
            
        ])->validate();
        if($request->has('photo')){
            $image = $request->file('photo');
            $new_name = rand() . '-' . $request->all()['email'] . '-' . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$new_name);
        }
        else{
            $new_name = rand() . '-' . $request->all()['email'] . '-' . rand() . '.png';
            copy(public_path('assets/adminlte3/img').'/avatar.png',public_path('images').'/'.$new_name);
            
        }
        User::create([
            'name' => $request->all()['name'],
            'email' => $request->all()['email'],
            'password' => Hash::make($request->all()['password']),
            'photo' => $new_name
        ]);

        return redirect(route('users.index'))->with('success',trans('customs/users.created'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $tittle_action = "Detalle";
        return view('users.show', compact('user','tittle_action'));
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
        $user = User::find($id);
        $form_route = route('users.update',['user'=>$user]);
        return view('users.create',compact('form_route','form_method','tittle_action'))->with('user',$user);
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
        $user = User::find($id);
        if(!$user){
            return redirect(route('users.index'))->with('Error',trans('customs/users.error_not_found'));
        }
        $user->name = $request->all()['name'];
        if($request->has('photo')){
            $image_old = public_path('images').'/'.$user->photo;
            if(File::exists($image_old)){
                File::delete($image_old);
            }
            $image = $request->file('photo');
            $new_name = rand() . '-' . $user->email . '-' . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$new_name);
            $user->photo = $new_name;
        }
        else if(!$user->photo){
            $new_name = rand() . '-' . $user->email . '-' . rand() . '.png';
            copy(public_path('assets/adminlte3/img').'/avatar.png',public_path('images').'/'.$new_name);
            $user->photo = $new_name;
        }
        else if($user->photo){
            $image_old = public_path('images').'/'.$user->photo;
            if(!File::exists($image_old)){
                $new_name = rand() . '-' . $user->email . '-' . rand() . '.png';
                copy(public_path('assets/adminlte3/img').'/avatar.png',public_path('images').'/'.$new_name);
                $user->photo = $new_name;
            }
        }
        $user->save();
        return redirect(route('users.index'))->with('success',trans('customs/users.edited'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\Illuminate\Http\Request $req, $id)
    {
        if(User::find($id)==null)
            return response()->json(['status'=>'error','message'=>trans('customs/users.error_not_found')]);
        User::destroy($id);
        return response()->json(['status'=>'success','message'=>trans('customs/users.deleted')]);
    }

    public function getProfile(){
        return view('users.profile');
    }

    public function getChangePassword(){
        $form_route = route('users.postchangepassword');
        $tittle_action = "Cambiar contraseña";
        $form_method = "PUT";
        return view('users.changepassword',compact('tittle_action','form_route','form_method'));
    }

    public function postChangePassword(Request $request){
        Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            ])->validate();
            $user = Auth::user();
        if(!$user){
            return redirect(route('users.profile'))->with('Error',trans('customs/users.error_not_found'));
        }
        $user->password = Hash::make($request->all()['password']);
        $user->save();
        return redirect(route('users.profile'))->with('success',trans('customs/users.changedpassword'));
    }

    public function getChangeProfile(){
        $form_route = route('users.postchangeprofile');
        $tittle_action = "Actualizar el perfil";
        $form_method = "PUT";
        $user = Auth::user();
        return view('users.changeprofile',compact('tittle_action','form_route','form_method','user'));
    }

    public function postChangeProfile(Request $request){
        Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'photo' => ['nullable','image','mimes:jpeg,jpg,png,gif|max:100000']
        ],[
            'image' => 'El campo de la foto de perfil debe ser una imagen.',
        ])->validate();
        $user = Auth::user();
        if(!$user){
            return redirect(route('users.profile'))->with('Error',trans('customs/users.error_not_found'));
        }
        $user->name = $request->all()['name'];
        if($request->has('photo')){
            $image_old = public_path('images').'/'.$user->photo;
            if(File::exists($image_old)){
                File::delete($image_old);
            }
            $image = $request->file('photo');
            $new_name = rand() . '-' . $user->email . '-' . rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'),$new_name);
            $user->photo = $new_name;
        }
        else if(!$user->photo){
            $new_name = rand() . '-' . $user->email . '-' . rand() . '.png';
            copy(public_path('assets/adminlte3/img').'/avatar.png',public_path('images').'/'.$new_name);
            $user->photo = $new_name;
        }
        else if($user->photo){
            $image_old = public_path('images').'/'.$user->photo;
            if(!File::exists($image_old)){
                $new_name = rand() . '-' . $user->email . '-' . rand() . '.png';
                copy(public_path('assets/adminlte3/img').'/avatar.png',public_path('images').'/'.$new_name);
                $user->photo = $new_name;
            }
        }
        $user->save();
        return redirect(route('users.profile'))->with('success',trans('customs/users.changedprofile'));
    }

    public function getChangeInfoMedic(){
        $form_route = route('users.postchangeinfomedic');
        $tittle_action = "Actualizar la información de médico";
        $form_method = "PUT";
        $medico = Auth::user()->medico;
        if(!$medico){
            return redirect(route('users.profile'))->with('Error',trans('customs/medicos.error_not_found'));
        }
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
        return view('users.changeinfomedic',compact('tittle_action','form_route','form_method','medico','array_especialidades','array_users'));
    }
    public function postChangeInfoMedic(Request $request){
        Validator::make($request->all(), [
            'nombre' => ['required', 'string', 'max:255']
        ])->validate();
        $medico = Auth::user()->medico;
        if(!$medico){
            return redirect(route('users.profile'))->with('Error',trans('customs/medicos.error_not_found'));
        }
        DB::table('medico_especialidad')->where('id_medico','=',$medico->id)->delete();
        $medico->nombre = $request->all()['nombre'];
        $medico->descripcion = $request->all()['descripcion'];
        $medico->save();
        $medico->especialidades()->attach($request->especialidades);
        return redirect(route('users.profile'))->with('success',trans('customs/medicos.edited'));
    }
}
