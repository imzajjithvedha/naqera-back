@extends('layouts.backend')

@section('title', 'Create Category')

@section('content')
    <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('categories._form')
    </form>
@endsection