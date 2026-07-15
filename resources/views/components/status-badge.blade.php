@props(['status'])

@php
    [$class, $label] = match ($status) {
        'active' => ['status-active', 'Active'],
        'inactive' => ['status-inactive', 'Inactive'],
        'suspended' => ['status-suspended', 'Suspended'],
    };
@endphp

<span class="status-badge {{ $class }}">{{ $label }}</span>
