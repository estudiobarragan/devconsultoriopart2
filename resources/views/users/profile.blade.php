@extends('default.admin_template')

@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if(session('Error'))
<div class="alert alert-danger">
    {{ session('Error') }}
</div>
@endif
<section class="content ml-4 mr-4 mt-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col mt-1">
                            <h3><strong>Perfil</strong></h3>
                        </div>
                    </div>
                </div>
                <div class="modal-body">
                    <center>
                        <img src="{{ asset('images'.'/'.Auth::user()->photo) }}" name="aboutme" width="240" height="240"
                            border="0" class="img-circle"></a>
                        <h3 class="media-heading">{{ Auth::user()->name }}</h3>
                        <hr>
                        <p class="text-left"><strong>Información</strong></p>
                    </center>
                    <div class="ml-5">
                        <span><strong>Email:</strong></span>
                        <span class="label btn-secondary">{{Auth::user()->email}}</span>
                    </div>
                    <hr>
                    
                    @if(Auth::user()->medico)
                    <div class="card p-3">
                    <center>
                        <h3><strong>Información Profesional</strong></h3>
                        <hr>
                    </center>
                    <div>
                        <span><strong>Nombre de público: {{ Auth::user()->medico->nombre}}</strong></span>
                    </div>
                    <hr>
                    @if(count(Auth::user()->medico->especialidades)>0)
                    <div>
                        <span><strong>Especialidades</strong></span>
                        <div class="ml-5">
                            @foreach (Auth::user()->medico->especialidades as $especialidad)
                                {{ $especialidad->nombre }} <br>
                            @endforeach
                        </div>
                    </div>
                    <hr>
                    @endif
                    <p class="text-left"><strong>Descripción: </strong></p><br>
                    <div class="ml-5">
                        {{Auth::user()->medico->descripcion}}
                    </div>
                </div>
                    @endif
                    <div class="card-footer float-right row">
                        @if(Auth::user()->medico)
                        <a href="{{route('users.changeinfomedic')}}" class="btn btn-success ml-1">Editar información de medico</a>
                        @endif
                        <a href="{{route('users.changeprofile')}}" class="btn btn-warning ml-1">Editar información de usuario</a>
                        <a href="{{route('users.changepassword')}}" class="btn btn-info ml-1">Cambiar contraseña</a>
                        <form action="{{route('logout')}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger ml-1">Cerrar la sesión</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection