@php
    $segment1 = Request::segment(1);
@endphp

<button id="sidebarToggle" class="text-white rounded min-[1100px]:hidden fixed top-5.5 left-6 z-50">
    <i class="bi bi-layout-sidebar-inset text-xl"></i>
</button>

<div id="sidebar" class="z-50 w-62.5 fixed top-16 hidden bg-(--color-primary) flex-col overflow-hidden h-[calc(100vh-65px)] min-[1100px]:flex min-[1100px]:h-[calc(100vh-80px)] min-[1100px]:top-20">
    <nav class="flex flex-col overflow-y-auto p-5 gap-4">
        <div>
            <p class="sidebar-label">Overview</p>
            <a href="{{ route('dashboard') }}" class="sidebar-item {{ $segment1 == 'dashboard' ? 'active' : '' }}">
                <i class="bi bi-grid-1x2"></i>Dashboard
            </a>
        </div>

        <div>
            <p class="sidebar-label">Platform</p>

            @php
                $newUsers = App\Models\User::where('is_new', 'yes')->count();
            @endphp
            <a href="{{ route('users.index') }}" class="sidebar-item {{ $segment1 == 'users' ? 'active' : '' }}">
                <i class="bi bi-people"></i>Users
                @if ($newUsers > 0)
                    <span class="sidebar-badge">{{ $newUsers }}</span>
                @endif
            </a>
        </div>

        <div>
            <p class="sidebar-label">Core</p>

            <a href="{{ route('categories.index') }}" class="sidebar-item {{ $segment1 == 'categories' ? 'active' : '' }}">
                <i class="bi bi-tags"></i>Categories
            </a>

            @php
                $newProperties = App\Models\Property::where('is_new', 1)->count();
            @endphp
            <a href="{{ route('properties.index') }}" class="sidebar-item {{ $segment1 == 'properties' ? 'active' : '' }}">
                <i class="bi bi-emoji-laughing"></i>Properties
                @if ($newProperties > 0)
                    <span class="sidebar-badge">{{ $newProperties }}</span>
                @endif
            </a>
        </div>
    </nav>

    <div class="border-t border-(--color-light-green) p-5">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="sidebar-item sidebar-logout w-full">
                <i class="bi bi-power"></i>
                Log Out
            </button>
        </form>
    </div>
</div>
