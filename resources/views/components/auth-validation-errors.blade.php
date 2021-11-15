{{-- @props(['errors'])

@if($errors->any())
    <div {{ $attributes }}>
<div class="text-red">
    {{ __('Whoops! Something went wrong.') }}
</div>

<ul class="mt-3 text-red">
    @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
    @endforeach
</ul>
</div>
@endif--}}

@props(['error'])

@error($error)
    <div class="text-danger">{{ $message }}</div>
@enderror
