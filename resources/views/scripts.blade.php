{{-- Configuracion Global --}}
@php
$config = [
    'appName' => config('app.name'),
    'locale' => $locale = app()->getLocale(),
];
@endphp
<script>window.config = {!! json_encode($config); !!};</script>

{{-- Load the application scripts --}}
@if (app()->isLocal())
  <script src="{{ mix('js/app.js') }}"></script>
@else
  <script src="{{ mix('js/manifest.js') }}"></script>
  <script src="{{ mix('js/vendor.js') }}"></script>
  <script src="{{ mix('js/app.js') }}"></script>
@endif
