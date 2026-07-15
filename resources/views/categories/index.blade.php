@extends('layouts.backend')

@section('title', 'Categories')

@section('content')
    <div class="page">
        <div class="back-top">
            <div>
                <p class="back-title">Categories</p>
                <p class="back-description">Manage categories and their details.</p>
            </div>
            <a href="{{ route('categories.create') }}" class="back-add-button">
                <i class="bi bi-plus-lg"></i>
                <span>Add New Category</span>
            </a>
        </div>

        <form method="GET" action="{{ route('categories.index') }}" id="filter-form" class="filter-form">
            <input type="text" name="name" value="{{ $filter['name'] ?? '' }}" placeholder="Name" class="input filter-input">

            <select name="status" class="input filter-select filter-input">
                <option value="">- All Status -</option>
                <option value="active" {{ ($filter['status'] ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ ($filter['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="suspended" {{ ($filter['status'] ?? '') === 'suspended' ? 'selected' : '' }}>Suspended
                </option>
            </select>

            <a href="{{ route('categories.index') }}" class="clear-filter-button">
                <i class="bi bi-x-circle"></i>
                <span>Clear</span>
            </a>
        </form>

        <div class="relative data-table-container custom-scrollbar">
            <x-table-loader />

            <table class="data-table">
                <thead>
                    <tr>
                        <th>NAME</th>
                        <th>SLUG</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @include('categories._table')
                </tbody>
            </table>
        </div>

        <div class="mt-3 sm:mt-5">
            {{ $items->links() }}
        </div>

        <x-delete-data data="category" />
    </div>
@endsection

@push('after-scripts')
    @vite(['resources/js/index.js'])
@endpush