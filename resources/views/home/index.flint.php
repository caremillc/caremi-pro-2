@extends('layouts.app')

@section('content')
<h1>caremi.tech</h1>
   <h1>{{ $title }}</h1>
    <p>{{ $message }}</p>
<p>Welcomes to caremi.tech. I hope you're learning lots of cool stuff!</p>
@endsection

@push('scripts')
@verbatim
<script>
    // console.log("Home page loaded!");
</script>
@endverbatim
@endpush
