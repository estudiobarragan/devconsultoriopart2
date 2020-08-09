@extends('default.admin_template')
@include('default.default_create')
@section('styles')
<link rel="stylesheet" href="{{ asset('assets/adminlte3/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/adminlte3/plugins/summernote/summernote-bs4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/adminlte3/plugins/select2/css/select2.min.css') }}">
<style>
    .select2-selection__rendered {
    line-height: 31px !important;
}
.select2-container .select2-selection--single {
    height: 35px !important;
}
.select2-selection__arrow {
    height: 34px !important;
}
</style>
@endsection
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Médicos <i class="fa fa-sign-out-alt ml-2 mr-1"></i> {{ $tittle_action }}</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('medicos.index') }}">Médicos</a></li>
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
                        @include('default/components/input',array('name'=>'nombre','type'=>'text','placeholder'=>'Nombre','icon'=>'user','required'=>'required','autofocus'=>'autofocus','old'=>isset($medico)? $medico->nombre : old('nombre')))                        
                        @include('default/components/dual-list-box',array('name'=>'especialidades','data'=>$array_especialidades))
                        @include('default/components/select2',array('name'=>'user','data'=>$array_users,'title'=>'Usuarios'))
                        @include('default/components/textarea',array('name'=>'descripcion','placeholder'=>'Escriba su texto aqui','old'=>isset($medico)? $medico->descripcion : old('descripcion')))
                        <div class="card-footer float-right">
                            <a href="{{route('medicos.index')}}" class="btn btn-secondary">Volver</a>
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
<script src="{{ asset('assets/adminlte3/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3/plugins/select2/js/select2.full.min.js') }}"></script>
<script src="{{ asset('assets/adminlte3/plugins/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $('.textarea').summernote({
        height: 300,
    });
    $('.duallistbox').bootstrapDualListbox();
    $('.select2').select2({
        placeholder: 'Seleccione un usuario',
    });
</script>    
@endsection