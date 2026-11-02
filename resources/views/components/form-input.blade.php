@props(['label', 'name', 'type' => 'text', 'value' => ''])

{{--Nama file   : form-input.blade.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha   --}}

<label for="{{ $name }}" class="form-label">{{ $label }}</label>

<input
    type="{{ $type }}" id="{{ $name }}" name="{{ $name }}"
    @if ($type !== 'password') value="{{ old($name, $value) }}" @endif
    {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}>

@error($name)
    <div class="invalid-feedback">{{ $message }}</div>
@enderror
