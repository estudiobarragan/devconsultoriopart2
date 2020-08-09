<div class="form-group">
    <label>Selección múltiple</label>
    <select class="duallistbox" multiple="multiple"
    id="{{ $name }}" name="{{ $name }}[]">
        @foreach ($data as $elemento)
            <option value="{{ $elemento->id }}" {{ $elemento->selected }}>{{ $elemento->nombre }}</option>
        @endforeach
    </select>
</div>