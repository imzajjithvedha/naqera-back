@extends('layouts.backend')

@section('title', 'Edit Category')

@section('content')
    <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('categories._form')
    </form>
@endsection
