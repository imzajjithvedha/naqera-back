@extends('layouts.backend')

@section('title', 'Edit Property')

@section('content')
    <form action="{{ route('properties.update', $property) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('properties._form')
    </form>
@endsection
