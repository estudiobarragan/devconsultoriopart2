@extends('default.admin_template')
@include('default.default_create')
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/adminlte3/plugins/summernote/summernote-bs4.min.css') }}">
@endsection
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
                <!-- /.card-header -->
                <div class="card-body">
                    <form method="{{ $form_method=='PUT'? 'POST': 'POST' }}" action="{{ $form_route }}"  enctype="multipart/form-data">
                        @csrf
                        @if($form_method=='PUT')
                        @method('PUT')
                        @endif
                        @include('default/components/input',array('name'=>'nombre','type'=>'text','placeholder'=>'Nombre','icon'=>'user','required'=>'required','autofocus'=>'autofocus','old'=>isset($especialidad)? $especialidad->nombre : old('nombre')))                        
                        @include('default/components/textarea',array('name'=>'descripcion','placeholder'=>'Escriba su texto aqui','old'=>isset($especialidad)? $especialidad->descripcion : old('descripcion')))
                        <div class="card-footer float-right">
                            <a href="{{route('especialidades.index')}}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('assets/adminlte3/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $('.textarea').summernote({
        height: 300,
    });
</script>    
@endsection