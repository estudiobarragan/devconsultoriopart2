<div class="form-group">
    <div class="input-with-icon">
        <input id="{{ $name }}" type="{{ $type }}" class="form-control @error($name) is-invalid @enderror"
            name="{{ $name }}" value="{{ $old?? '' }}" {{ $required?? '' }} {{ $autofocus?? '' }}
            placeholder="{{ $placeholder }}" minlength={{ $min?? '' }} maxlength={{ $max??'' }}>
        <i class="fa fa-{{ $icon }} fa-lg fa-fw" aria-hidden="true"></i>
    </div>
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>