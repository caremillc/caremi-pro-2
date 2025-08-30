@extends('layouts.app')

@section('main')
<h1>All Posts <a href="/posts/create">Create</a></h1>
@endsection

@push('scripts')
@verbatim
<script>
    // console.log("Home page loaded!");
</script>
@endverbatim
@endpush
