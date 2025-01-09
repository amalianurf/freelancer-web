<!-- Desktop sidebar -->
<aside class="z-20 flex-shrink-0 hidden w-64 overflow-y-auto bg-white md:block" aria-label="aside">
    <div class="text-serv-bg">
        <a href="{{ route('member.dashboard.index') }}">
            <img src="{{ asset('/assets/images/logo.svg') }}" alt="logo" class="object-center mx-auto my-8 ">
        </a>
        <div class="flex items-center pt-8 pl-5 space-x-2 border-t border-gray-100">
            <!--Author's profile photo-->
            @if (auth()->user()->detail_user()->first()->photo != '')
                <img class="object-cover object-center mr-1 rounded-full w-14 h-14" src="{{ url(Storage::url(auth()->user()->detail_user->photo)) }}" alt="user photo" />
            @else    
                <span class="inline-block overflow-hidden bg-gray-100 object-cover object-center mr-1 rounded-full w-14 h-14">
                    <svg class="w-full h-full text-gray-300" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 20.993V24H0v-2.996A14.977 14.977 0 0112.004 15c4.904 0 9.26 2.354 11.996 5.993zM16.002 8.999a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </span>
            @endif

            <div>
                <!--Author name-->
                <p class="font-semibold text-gray-900 text-md">{{ Auth::user()->name; }}</p>
                <p class="text-sm font-light text-serv-text">
                    {{ auth()->user()->detail_user->role }}
                </p>
            </div>
        </div>
        <ul class="mt-6">
            <li class="relative px-6 py-3">
                @if (
                    request()->is('member/dashboard') || 
                    request()->is('member/dashboard/*') || 
                    request()->is('member/*/dashboard') || 
                    request()->is('member/*/dashboard/*')
                )
                    <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-gray-800 font-medium text-gray-800" href="{{ route('member.dashboard.index') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.14373 20.7821V17.7152C9.14372 16.9381 9.77567 16.3067 10.5584 16.3018H13.4326C14.2189 16.3018 14.8563 16.9346 14.8563 17.7152V20.7732C14.8563 21.4473 15.404 21.9951 16.0829 22H18.0438C18.9596 22.0023 19.8388 21.6428 20.4872 21.0007C21.1356 20.3586 21.5 19.4868 21.5 18.5775V9.86585C21.5 9.13139 21.1721 8.43471 20.6046 7.9635L13.943 2.67427C12.7785 1.74912 11.1154 1.77901 9.98539 2.74538L3.46701 7.9635C2.87274 8.42082 2.51755 9.11956 2.5 9.86585V18.5686C2.5 20.4637 4.04738 22 5.95617 22H7.87229C8.19917 22.0023 8.51349 21.8751 8.74547 21.6464C8.97746 21.4178 9.10793 21.1067 9.10792 20.7821H9.14373Z" fill="#082431"/>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                @else
                    <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-gray-800 font-light" href="{{ route('member.dashboard.index') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.15722 20.7714V17.7047C9.1572 16.9246 9.79312 16.2908 10.581 16.2856H13.4671C14.2587 16.2856 14.9005 16.9209 14.9005 17.7047V20.7809C14.9003 21.4432 15.4343 21.9845 16.103 22H18.0271C19.9451 22 21.5 20.4607 21.5 18.5618V9.83784C21.4898 9.09083 21.1355 8.38935 20.538 7.93303L13.9577 2.6853C12.8049 1.77157 11.1662 1.77157 10.0134 2.6853L3.46203 7.94256C2.86226 8.39702 2.50739 9.09967 2.5 9.84736V18.5618C2.5 20.4607 4.05488 22 5.97291 22H7.89696C8.58235 22 9.13797 21.4499 9.13797 20.7714" stroke="#082431" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="ml-4">Dashboard</span>
                    </a>
                @endif
            </li>
        </ul>
        <ul>
            <li class="relative px-6 py-3">
                @if (
                    request()->is('member/service') || 
                    request()->is('member/service/*') || 
                    request()->is('member/*/service') || 
                    request()->is('member/*/service/*')
                )
                    <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-gray-800 font-medium text-gray-800" href="{{ route('member.service.index') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="7" height="7" rx="2" fill="#082431" />
                            <rect x="3" y="14" width="7" height="7" rx="2" fill="#082431" />
                            <rect x="14" y="3" width="7" height="7" rx="2" fill="#082431" />
                            <rect x="14" y="14" width="7" height="7" rx="2" fill="#082431" />
                        </svg>
                        <span class="ml-4">My Services</span>
                    </a>
                @else
                    <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-gray-800 font-light" href="{{ route('member.service.index') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="3" width="7" height="7" rx="2" stroke="#082431" stroke-width="1.5" />
                            <rect x="3" y="14" width="7" height="7" rx="2" stroke="#082431" stroke-width="1.5" />
                            <rect x="14" y="3" width="7" height="7" rx="2" stroke="#082431" stroke-width="1.5" />
                            <rect x="14" y="14" width="7" height="7" rx="2" stroke="#082431" stroke-width="1.5" />
                        </svg>
                        <span class="ml-4">My Services</span>
                    </a>
                @endif
            </li>
            <li class="relative px-6 py-3">
                @if (
                    request()->is('member/request') || 
                    request()->is('member/request/*') || 
                    request()->is('member/*/request') || 
                    request()->is('member/*/request/*')
                )
                    <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-gray-800 font-medium text-gray-800" href="{{ route('member.request.index') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2.25" y="1.25" width="19.5" height="21.5" rx="4.75" fill="#082431" stroke="#082431" stroke-width="1.5" />
                            <rect x="11" y="7" width="2" height="10" rx="1" fill="white" />
                            <rect x="17" y="11" width="2" height="10" rx="1" transform="rotate(90 17 11)" fill="white" />
                        </svg>
                        <span class="ml-4">My Request</span>
                    </a>
                @else
                    <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-gray-800 font-light" href="{{ route('member.request.index') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="2.25" y="1.25" width="19.5" height="21.5" rx="4.75" stroke="#082431" stroke-width="1.5" />
                            <rect x="11.3" y="7" width="1.4" height="10" rx="0.7" fill="#082431" />
                            <rect x="17" y="11" width="1.4" height="10" rx="0.7" transform="rotate(90 17 11)" fill="#082431" />
                        </svg>
                        <span class="ml-4">My Request</span>
                    </a>
                @endif
            </li>
            <li class="relative px-6 py-3">
                @if (
                    request()->is('member/order') || 
                    request()->is('member/order/*') || 
                    request()->is('member/*/order') || 
                    request()->is('member/*/order/*')
                )
                    <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-gray-800 font-medium text-gray-800" href="{{ route('member.order.index') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3" y="2" width="18" height="20" rx="4" fill="#082431" />
                            <line x1="7.75" y1="7.25" x2="10.25" y2="7.25" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                            <line x1="7.75" y1="11.25" x2="16.25" y2="11.25" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                            <line x1="7.75" y1="15.25" x2="16.25" y2="15.25" stroke="white" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <span class="ml-4">My Orders</span>
                    </a>
                @else
                    <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-gray-800 font-light" href="{{ route('member.order.index') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="3.25" y="2.25" width="17.5" height="19.5" rx="4.75" stroke="#082431" stroke-width="1.5" />
                            <line x1="7.75" y1="7.25" x2="10.25" y2="7.25" stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                            <line x1="7.75" y1="11.25" x2="16.25" y2="11.25" stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                            <line x1="7.75" y1="15.25" x2="16.25" y2="15.25" stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                        </svg>
                        <span class="ml-4">My Orders</span>
                    </a>
                @endif
            </li>
            <li class="relative px-6 py-3">
                @if (
                    request()->is('member/profile') || 
                    request()->is('member/profile/*') || 
                    request()->is('member/*/profile') || 
                    request()->is('member/*/profile/*')
                )
                    <span class="absolute inset-y-0 left-0 w-1 rounded-tr-lg rounded-br-lg bg-serv-bg" aria-hidden="true"></span>
                    <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-gray-800 font-medium text-gray-800" href="{{ route('member.profile.index') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.84846 15.5498C11.2881 15.4338 12.7344 15.4338 14.1741 15.5498C14.9581 15.5955 15.7383 15.6936 16.5099 15.8434C18.1796 16.1815 19.2697 16.7331 19.7368 17.6228C20.0877 18.3171 20.0877 19.1437 19.7368 19.8381C19.2697 20.7278 18.2229 21.3149 16.4926 21.6174C15.7216 21.7729 14.9412 21.874 14.1568 21.9199C13.4301 22 12.7034 22 11.968 22H10.6444C10.3675 21.9644 10.0994 21.9466 9.83981 21.9466C9.05538 21.9063 8.27477 21.8082 7.50397 21.653C5.83428 21.3327 4.74422 20.7633 4.27705 19.8737C4.09671 19.529 4.00163 19.144 4.0001 18.7527C3.99646 18.3589 4.08866 17.9705 4.2684 17.6228C4.72692 16.7331 5.81698 16.1548 7.50397 15.8434C8.27816 15.6915 9.06144 15.5934 9.84846 15.5498ZM12.0026 2C14.9028 2 17.2539 4.41782 17.2539 7.40036C17.2539 10.3829 14.9028 12.8007 12.0026 12.8007C9.10241 12.8007 6.75131 10.3829 6.75131 7.40036C6.75131 4.41782 9.10241 2 12.0026 2Z" fill="#082431"/>
                        </svg>
                        <span class="ml-4">Edit Profile</span>
                    </a>
                @else
                    <a class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-gray-800 font-light" href="{{ route('member.profile.index') }}">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M11.579 12.056C14.2178 12.056 16.357 9.91682 16.357 7.278C16.357 4.63918 14.2178 2.5 11.579 2.5C8.94018 2.5 6.801 4.63918 6.801 7.278C6.801 9.91682 8.94018 12.056 11.579 12.056Z" stroke="#082431" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M4 18.7014C3.99873 18.3655 4.07385 18.0337 4.2197 17.7311C4.67736 16.8158 5.96798 16.3307 7.03892 16.111C7.81128 15.9462 8.59431 15.836 9.38217 15.7815C10.8408 15.6533 12.3079 15.6533 13.7666 15.7815C14.5544 15.8367 15.3374 15.9468 16.1099 16.111C17.1808 16.3307 18.4714 16.77 18.9291 17.7311C19.2224 18.3479 19.2224 19.064 18.9291 19.6808C18.4714 20.6419 17.1808 21.0812 16.1099 21.2918C15.3384 21.4634 14.5551 21.5766 13.7666 21.6304C12.5794 21.7311 11.3866 21.7494 10.1968 21.6854C9.92221 21.6854 9.65677 21.6854 9.38217 21.6304C8.59663 21.5773 7.81632 21.4641 7.04807 21.2918C5.96798 21.0812 4.68652 20.6419 4.2197 19.6808C4.0746 19.3747 3.99955 19.0401 4 18.7014Z" stroke="#082431" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="ml-4">Edit Profile</span>
                    </a>
                @endif
            </li>
            <li class="relative px-6 py-3">
                <button class="inline-flex items-center w-full text-sm transition-colors duration-150 hover:text-gray-800 font-light focus:outline-none" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <rect width="24" height="24" fill="white" />
                        <path d="M15 7.5V7C15 4.79086 13.2091 3 11 3H7C4.79086 3 3 4.79086 3 7V17C3 19.2091 4.79086 21 7 21H11C13.2091 21 15 19.2091 15 17V16.5" stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M18.5 9.5L20.8586 11.8586C20.9367 11.9367 20.9367 12.0633 20.8586 12.1414L18.5 14.5" stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                        <path d="M9.5 12L20 12" stroke="#082431" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    <span class="ml-4">Logout</span>
                    <form action="{{ route('logout') }}" id="logout-form" method="POST" style="display: none;">
                        @csrf
                    </form>
                </button>
            </li>
        </ul>
    </div>
</aside>