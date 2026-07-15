@extends('layouts.backend')

@section('title', 'Create User')

@section('content')
    <form action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('users._form')
    </form>
@endsection