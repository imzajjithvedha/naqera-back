@extends('layouts.backend')

@section('title', 'Users')

@section('content')
    <div class="page">
        <div class="back-top">
            <div>
                <p class="back-title">Users</p>
                <p class="back-description">Manage user accounts, roles, and activity.</p>
            </div>
            <a href="{{ route('users.create') }}" class="back-add-button">
                <i class="bi bi-plus-lg"></i>
                <span>Add New User</span>
            </a>
        </div>

        <form method="GET" action="{{ route('users.index') }}" id="filter-form" class="filter-form">
            <input type="text" name="name" value="{{ $filter['name'] ?? '' }}" placeholder="Name" class="input filter-input">

            <input type="text" name="email" value="{{ $filter['email'] ?? '' }}" placeholder="Email" class="input filter-input">

            <select name="role" class="input filter-select filter-input">
                <option value="">- All Roles -</option>
                <option value="admin" {{ ($filter['role'] ?? '') === 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="host" {{ ($filter['role'] ?? '') === 'host' ? 'selected' : '' }}>Host</option>
                <option value="agent" {{ ($filter['role'] ?? '') === 'agent' ? 'selected' : '' }}>Agent</option>
                <option value="estate-host" {{ ($filter['role'] ?? '') === 'estate-host' ? 'selected' : '' }}>Estate Host</option>
                <option value="customer" {{ ($filter['role'] ?? '') === 'customer' ? 'selected' : '' }}>Customer</option>
            </select>

            <select name="status" class="input filter-select filter-input">
                <option value="">- All Status -</option>
                <option value="active" {{ ($filter['status'] ?? '') === 'active' ? 'selected' : '' }}>Active</option>
                <option value="inactive" {{ ($filter['status'] ?? '') === 'inactive' ? 'selected' : '' }}>Inactive</option>
                <option value="suspended" {{ ($filter['status'] ?? '') === 'suspended' ? 'selected' : '' }}>Suspended
                </option>
            </select>

            <a href="{{ route('users.index') }}" class="clear-filter-button">
                <i class="bi bi-x-circle"></i>
                <span>Clear</span>
            </a>
        </form>

        <div class="relative data-table-container custom-scrollbar">
            <x-table-loader />

            <table class="data-table">
                <thead>
                    <tr>
                        <th>IMAGE</th>
                        <th>NAME</th>
                        <th>EMAIL</th>
                        <th>ROLE</th>
                        <th>STATUS</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @include('users._table')
                </tbody>
            </table>
        </div>

        <div class="mt-3 sm:mt-5">
            {{ $items->links() }}
        </div>

        <x-delete-data data="user" />
    </div>
@endsection

@push('after-scripts')
    @vite(['resources/js/index.js'])
@endpush