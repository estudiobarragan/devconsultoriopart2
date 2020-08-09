@extends('default.admin_template')
@include('default.default_index')
@section('content')
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Médicos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item active">Médicos</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
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
<section class="content">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col mt-1">
                            <h3><strong>Listado</strong></h3>
                        </div>
                        <div class="col">
                            <a href="{{route('medicos.create')}}">
                                <span class="float-right btn btn-success"><i class="fa fa-plus-square"></i> Crear</span>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <table id="table-datatable" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Descripcion</th>
                                <th>Especialidades</th>
                                <th>Fecha Alta</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        @if($medicos ?? false)
                        <tbody>
                            @foreach ($medicos as $medico)
                            <tr>
                                <td>{{ $medico->nombre }}</td>
                                <td> @if($medico->user) {{  $medico->user->name }} @endif</td>
                                <td>{{ $medico->descripcion }}</td>
                                @if(count($medico->especialidades)>0)
                                <td>
                                    @foreach ($medico->especialidades as $especialidad)
                                        {{ $especialidad->nombre }} 
                                    @endforeach
                                </td>
                                @else
                                <td></td>
                                @endif
                                <td>{{ $medico->created_at }}</td>
                                <td style="white-space: nowrap;width: 1px"><a class="btn btn-secondary"
                                        href='{{ route('medicos.show',$medico) }}'>
                                        <i class='fa fa-info-circle'></i></a> <a class="btn btn-warning ml-1"
                                        href='{{ route('medicos.edit',$medico) }}'>
                                        <i class='fa fa-edit'></i></a> <a class="btn btn-danger ml-1"
                                        onclick="confirmDelete({{ $medico }})">
                                        <i class='fa fa-trash-alt'></i></a> </td>
                            </tr>
                            @endforeach
                        </tbody>
                        @endif
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Usuario</th>
                                <th>Descripcion</th>
                                <th>Especialidades</th>
                                <th>Fecha Alta</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>

                    </table>
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
    function confirmDelete(medico){
        Swal.fire({
            title: '¿Estás seguro que deseas eliminar?',
            text: "¡No podrás recuperarlo después!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: 'medicos/'+medico.id,
                    type: 'DELETE',
                    data: {
                        "id": medico.id,
                        "_token": $("meta[name='csrf-token']").attr("content"),
                    },
                    success: function(result){
                        if(result.status == "success"){
                            Swal.fire(
                                '¡Eliminado!',
                                result.message,
                                'success',
                            ).then(function(result){
                                if(result.value){
                                    window.location.reload();
                                }
                            });     
                        }
                        else{
                            Swal.fire(
                                '¡Error!',
                                result.message,
                                'danger',
                            );
                        }
                    }
                });
            }
        });
    }
</script>
@endsection