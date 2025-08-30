@extends('layouts.app')

@yield('title','Welcome')

@section('main')
<h1>caremi.tech</h1>
<p>Welcomes to caremi.tech. I hope you're learning lots of cool stuff!</p>
@endsection

@push('scripts')
@verbatim
<script>
    // console.log("Home page loaded!");
</script>
@endverbatim
@endpush
