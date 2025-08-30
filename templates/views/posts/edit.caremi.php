@extends('layouts.app')

@section('main')

@while($id > 0)
    <p>While loop ID: {{ $id }}</p>
    @php $id--; @endphp
@endwhile

@endsection