@extends('default.admin_template')
@include('default.default_create')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Usuarios <i class="fa fa-sign-out-alt ml-2 mr-1"></i> {{ $tittle_action }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
                    <li class="breadcrumb-item active">{{ $tittle_action }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<section class="content ml-4 mr-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col mt-1">
                            <h3><strong>{{ $tittle_action }}</strong></h3>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="{{ $form_method=='PUT'? 'POST': 'POST' }}" action="{{ $form_route }}"  enctype="multipart/form-data">
                        @csrf
                        @if($form_method=='PUT')
                        @method('PUT')
                        @endif
                        @include('default/components/input',array('name'=>'name','type'=>'text','placeholder'=>'Nombre','icon'=>'user','required'=>'required','autofocus'=>'autofocus','old'=>isset($user)? $user->name : old('name')))
                        @if(!isset($user))
                        @include('default/components/input',array('name'=>'email','type'=>'email','placeholder'=>'Email','icon'=>'envelope','required'=>'required'))
                        @include('default/components/input',array('name'=>'password','type'=>'password','placeholder'=>'Contraseña','icon'=>'key','required'=>'required', 'min'=>'6'))
                        @include('default/components/input',array('name'=>'password_confirmation','type'=>'password','placeholder'=>'Confirmar contraseña','icon'=>'key','required'=>'required', 'min'=>'6'))
                        @endif
                        
                        <div class="form-group">
                            <img class="border changeshowperfil" width="100px" src="{{isset($user) && $user->photo? asset('images/'.$user->photo) : asset('assets/adminlte3/img/avatar.png')}}" alt="Foto de perfil">
                        </div>
                        
                        @include('default/components/input-file',array('name'=>'photo','type'=>'file','placeholder'=>'Seleccione una foto de perfil','icon'=>'image','old'=>isset($user)? $user->photo : old('photo')))
                        <div class="card-footer float-right">
                            <a href="{{route('users.index')}}" class="btn btn-secondary">Volver</a>
                            <button type="submit" class="btn btn-primary">{{ $tittle_action }}</button>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<!-- /.content -->
@endsection

@section('javascripts')
<script>
    @if(isset($user) && $user->photo)
        $(".input-with-icon .custom-file-label").html('{{ $user->photo }}');
    @endif
</script>
@endsection