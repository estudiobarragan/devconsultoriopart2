@extends('default.admin_template')

@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Especialidades <i class="fa fa-sign-out-alt ml-2 mr-1"></i> {{ $tittle_action }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('especialidades.index') }}">Especialidades</a></li>
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
                    <div class="ml-5">
                        <span><strong>Especialidad: {{ $especialidad->nombre}}</strong></span>
                    </div>
                    <hr>
                    <p class="text-left"><strong>Descripción: </strong></p><br>
                    <div class="ml-5">
                        {{$especialidad->descripcion}}
                    </div>
                    <div class="card-footer float-right">
                        <a href="{{route('especialidades.index')}}" class="btn btn-secondary">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection