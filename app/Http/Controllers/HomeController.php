<?php

namespace App\Http\Controllers;

use App\Especialidad;
use App\Medico;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();
        $especialidades = Especialidad::all();
        $medicos = Medico::all();
        return view('home')->with('count_users',count($users))
                            ->with('count_especialidades',count($especialidades))
                            ->with('count_medicos',count($medicos))
                            ;
    }
}
