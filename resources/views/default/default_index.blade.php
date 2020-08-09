@section('styles_default')
    <link rel="stylesheet" href="{{ asset('assets/adminlte3/plugins/datatables-bs4/css/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/adminlte3/plugins/sweetalert2/sweetalert2.min.css')}}">
    <style>
        td img {
            width: 100px;
            height: 100px;
            object-fit: cover;
        }
    
        td {
            vertical-align: middle !important;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('javascripts_default')
    <script src="{{ asset('assets/adminlte3/plugins/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{ asset('assets/adminlte3/plugins/datatables-bs4/js/dataTables.bootstrap4.js')}}"></script>
    <script src="{{ asset('assets/adminlte3/plugins/sweetalert2/sweetalert2.all.min.js')}}"></script>
    <script>
        $(function () {
          $('#table-datatable').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
          });
        });
    </script>
@stop