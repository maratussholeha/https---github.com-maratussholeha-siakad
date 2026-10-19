@props(['label', 'name', 'type' => 'text', 'value' => ''])

{{--Nama file   : form-input.blade.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha   --}}

<label for="{{ $name }}" class="form-label">{{ $label }}</label>

<input type="{{ $type }}"
       id="{{ $name }}"
       name="{{ $name }}"
       value="{{ old($name, $value) }}"
       {{ $attributes->merge(['class' => 'form-control']) }}>