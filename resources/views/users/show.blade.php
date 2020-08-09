@extends('default.admin_template')

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
                <div class="modal-body">
                    <center>
                        <img src="{{ asset('images'.'/'.$user->photo) }}" name="aboutme" width="240" height="240"
                            border="0" class="img-circle"></a>
                        <h3 class="media-heading">{{ $user->name }}</h3>
                        <hr>
                        <p class="text-left"><strong>Información</strong></p>
                    </center>
                    <div class="ml-5">
                        <span><strong>Email:</strong></span>
                        <span class="label btn-secondary">{{$user->email}}</span>
                    </div>
                    <hr>
                    <p class="text-left"><strong>Biografía: </strong></p><br>
                    <div class="ml-5">
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sem dui, tempor sit amet commodo
                        a, vulputate vel tellus.
                    </div>
                    <div class="card-footer float-right">
                        <a href="{{route('users.index')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection