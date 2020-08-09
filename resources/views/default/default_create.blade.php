@section('styles_default')
<style>
    .input-with-icon input[type=text],
    .input-with-icon input[type=email],
    .input-with-icon input[type=password],
    .custom-file-label {
        padding-left: 40px;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon i {
        position: absolute;
        z-index: 1;
        left: 0;
        top: 4px;
        padding: 9px 8px;
        color: #aaa;
        transition: .3s;
    }

    .input-with-icon input[type=text]:focus+i,
    .input-with-icon input[type=email]:focus+i,
    .input-with-icon input[type=password]:focus+i {
        color: dodgerBlue;
    }

    .custom-file-label::after {
        content: "";
        background-color: #fff;
        border-left: none;
    }
    .invalid-feedback{
        display: block;
    }
</style>
@endsection
@section('javascripts_default')
<script>
    $(".input-with-icon input[type=file]").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".input-with-icon label").addClass("selected").html(fileName);
    });
</script>
@endsection