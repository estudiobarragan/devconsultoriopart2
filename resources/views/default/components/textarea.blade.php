<div class="form-group">
    <div class="card-body pad">
        <div class="mb-3">
            <textarea class="textarea" placeholder="{{ $placeholder }}" id="{{ $name }}" name="{{ $name }}" {{ $required?? '' }} {{ $autofocus?? '' }}
                >{{ $old?? '' }}</textarea>
        </div>
    </div>
</div>