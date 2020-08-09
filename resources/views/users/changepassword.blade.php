@extends('default.admin_template')
@include('default.default_create')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Perfil <i class="fa fa-sign-out-alt ml-2 mr-1"></i> {{ $tittle_action }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('users.profile') }}">Perfil</a></li>
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
                        @include('default/components/input',array('name'=>'password','type'=>'password','placeholder'=>'Contraseña','icon'=>'key','required'=>'required', 'min'=>'6', 'autofocus'=>'autofocus'))
                        @include('default/components/input',array('name'=>'password_confirmation','type'=>'password','placeholder'=>'Confirmar contraseña','icon'=>'key','required'=>'required', 'min'=>'6'))
                        <div class="card-footer float-right">
                            <a href="{{route('users.profile')}}" class="btn btn-secondary">Volver</a>
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