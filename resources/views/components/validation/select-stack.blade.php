@props(['messages', 'items', 'old'])

@php
  $errorStr = $messages ? 'is-invalid' : '';
@endphp

<!--begin::Group-->
<div class="form-group">
  <label>{!! $slot !!}</label>
  <select {{ $attributes->merge(['class' => 'form-control ' . $errorStr]) }}>
    @foreach ($items as $item)
      @if ($old && $old == $item['id'])
        <option value="{{ $item['id'] }}" selected>{{ $item['name'] }}</option>
      @elseif (isset($current) && $current == $item['id'])
        <option value="{{ $item['id'] }}" selected>{{ $item['name'] }}</option>
      @else
        <option value="{{ $item['id'] }}">{{ $item['name'] }}</option>
      @endif
    @endforeach
  </select>

  <x-validation.input-error :messages="$messages" />
</div>
<!--end::Group-->
