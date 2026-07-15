@extends('layouts.backend')

@section('title', 'Create Property')

@section('content')
    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('properties._form')
    </form>
@endsection