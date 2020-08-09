<div class="form-group">
    <label>{{ $title }}</label>
    <select class="form-control select2"
    id="{{ $name }}" name="{{ $name }}">
        <option></option>
        @foreach ($data as $elemento)
            <option value="{{ $elemento->id }}" {{ $elemento->selected }}>{{ $elemento->nombre }}</option>
        @endforeach
    </select>
  </div>