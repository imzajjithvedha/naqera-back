<header>
    <div class="bg-(--color-primary) fixed w-full z-50">
        <div class="hidden min-[1100px]:flex wrapper-fluid justify-between items-center">
            <a href="{{ route('dashboard') }}" class="text-white text-[50px] font-bold tracking-widest leading-16.25">
                naqera
            </a>

            <div class="flex items-center gap-7.5 cursor-pointer relative profile-dropdown">
                <div class="flex items-center gap-2.5">
                    @if(auth()->user()->hasMedia('backend/users'))
                        <img src="{{ auth()->user()->getFirstMediaUrl('backend/users', 'thumb') }}" alt="Image" class="w-12.5 h-12.5 object-cover rounded-full">
                    @else
                        <img src="{{ asset('storage/global/no-image.webp') }}" alt="Image" class="w-12.5 h-12.5 object-cover rounded-full">
                    @endif

                    <p class="text-white text-[15px] font-medium">{{ auth()->user()->name }}</p>
                    <i class="bi bi-chevron-down profile-chevron"></i>
                </div>

                <ul class="profile-dropdown-menu">
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                            <i class="bi bi-person"></i>Dashboard
                        </a>
                    </li>

                    <li>
                        <hr class="border-white/10 mx-4 my-1">
                    </li>

                    <li>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-power"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="min-[1100px]:hidden flex wrapper-fluid justify-between items-center">
            <a href="#" class="text-white text-[35px] font-bold tracking-widest leading-12 ps-12">
                naqera
            </a>
            
            <button id="mobile-menu-toggle" class="text-white text-2xl focus:outline-none" aria-label="Toggle navigation">
                <i id="menu-icon" class="bi bi-list"></i>
            </button>
        </div>

        <div id="mobile-menu" class="hidden min-[1100px]:hidden text-white px-7 pb-5">
            <div class="border-t border-white/10 pt-5">
                <div class="flex items-center gap-3 mb-5">
                    @if(auth()->user()->hasMedia('backend/users'))
                        <img src="{{ auth()->user()->getFirstMediaUrl('backend/users', 'webp') }}" alt="Image" class="w-10 h-10 object-cover rounded-full">
                    @else
                        <img src="{{ asset('storage/global/no-image.webp') }}" alt="Image" class="w-10 h-10 object-cover rounded-full">
                    @endif

                    <div>
                        <p class="text-white text-[15px] font-medium">{{ auth()->user()->name }}</p>
                        <span class="text-xs text-white/60">Logged In</span>
                    </div>
                </div>

                <ul class="flex flex-col">
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard') }}">
                            <i class="bi bi-person"></i> Dashboard
                        </a>
                    </li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="submit" class="dropdown-item">
                                <i class="bi bi-power"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</header>

@push('after-scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const toggleBtn = document.getElementById('mobile-menu-toggle');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');

            toggleBtn.addEventListener('click', function () {
                mobileMenu.classList.toggle('hidden');
                
                if (mobileMenu.classList.contains('hidden')) {
                    menuIcon.classList.replace('bi-x', 'bi-list');
                } else {
                    menuIcon.classList.replace('bi-list', 'bi-x');
                }
            });
        });
    </script>
@endpush