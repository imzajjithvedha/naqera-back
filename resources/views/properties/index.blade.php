@extends('layouts.backend')

@section('title', 'Properties')

@section('content')
    <div class="page">
        <div class="back-top">
            <div>
                <p class="back-title">Properties</p>
                <p class="back-description">Manage properties and their details.</p>
            </div>
            <a href="{{ route('properties.create') }}" class="back-add-button">
                <i class="bi bi-plus-lg"></i>
                <span>Add New Property</span>
            </a>
        </div>

        <form method="GET" action="{{ route('properties.index') }}" id="filter-form" class="filter-form">
            <select name="user_id" class="se-select input filter-select filter-input" required>
                <option value="">- All Hosts -</option>
                @foreach ($hosts as $host)
                    <option value="{{ $host->id }}" {{ ($filter['user_id'] ?? '') == $host->id ? 'selected' : '' }}>{{ $host->name }}</option>
                @endforeach
            </select>

            <select name="category_id" class="se-select input filter-select filter-input" required>
                <option value="">- All Categories -</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ ($filter['category_id'] ?? '') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>

            <input type="text" name="title" value="{{ $filter['title'] ?? '' }}" placeholder="Title" class="input filter-input">

            <select name="status" class="input filter-select filter-input">
                <option value="">- All Status -</option>
                <option value="active" {{ ($filter['status'] ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ ($filter['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="suspended" {{ ($filter['status'] ?? '') === 'suspended' ? 'selected' : '' }}>Suspended
                </option>
            </select>

            <a href="{{ route('properties.index') }}" class="clear-filter-button">
                <i class="bi bi-x-circle"></i>
                <span>Clear</span>
            </a>
        </form>

        <div class="relative data-table-container custom-scrollbar">
            <x-table-loader />

            <table class="data-table">
                <thead>
                    <tr>
                        <th>THUMBNAIL</th>
                        <th>NAME</th>
                        <th>SLUG</th>
                        <th>CATEGORY</th>
                        <th>PRICE</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @include('properties._table')
                </tbody>
            </table>
        </div>

        <div class="mt-3 sm:mt-5">
            {{ $items->links() }}
        </div>

        <x-delete-data data="property" />
    </div>
@endsection

@push('after-scripts')
    @vite(['resources/js/index.js', 'resources/js/tom.js'])
@endpush