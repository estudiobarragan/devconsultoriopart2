<div class="form-group">
    <div class="input-with-icon">
        <input id="{{ $name }}" type="file" class="form-control @error($name) is-invalid @enderror"
            name="{{ $name }}" value="{{ $old?? '' }}" placeholder="{{ $placeholder }}" />
        <label class="custom-file-label" for="{{ $name }}">{{ $placeholder }}</label>
        <i class="fa fa-image fa-lg fa-fw" aria-hidden="true"></i>
    </div>
    @error($name)
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
    @enderror
</div>