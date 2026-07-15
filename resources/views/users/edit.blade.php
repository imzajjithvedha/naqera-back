@extends('layouts.backend')

@section('title', 'Edit User')

@section('content')
    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        @include('users._form')
    </form>
@endsection
