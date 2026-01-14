

<nav id="nav-auth" class="flex w-full bg-white border-b border-obito-grey">
    @php $user = Auth::user(); @endphp
            <div class="flex w-[1280px] px-[75px] py-5 items-center justify-between mx-auto">
                <div class="flex items-center gap-[30px]">
                    <a href="index.html" class="flex shrink-0">
                        <img src="{{ asset('assets/images/logos/logo.svg') }}" class="flex shrink-0" alt="logo">
                    </a>
                </div>
                <div class="flex items-center gap-5 justify-end">
                    <a href="#" class="flex shrink-0">
                        <img src="{{ asset('assets/images/icons/device-message.svg') }}" class="flex shrink-0" alt="icon">
                    </a>
                    <a href="catalog-v2.html" class="flex shrink-0">
                        <img src="{{ asset('assets/images/icons/category.svg') }}" class="flex shrink-0" alt="icon">
                    </a>
                    <a href="#" class="flex shrink-0">
                        <img src="{{ asset('assets/images/icons/notification.svg') }}" class="flex shrink-0" alt="icon">
                    </a>
                    <div class="h-[50px] flex shrink-0 bg-obito-grey w-px"></div>
                    <div id="profile-dropdown" class="relative flex items-center gap-[14px]">
                        <div class="flex shrink-0 w-[50px] h-[50px] rounded-full overflow-hidden bg-obito-grey">
                            <img src="{{ Storage::url($user->photo) }}" class="w-full h-full object-cover" alt="photo">
                        </div>
                        <div>

                            <p class="font-semibold text-lg">{{ $user->name }}</p>
                            <p class="text-sm text-obito-text-secondary">{{ $user->occupation }}</p>
                        </div>
                        <button id="dropdown-opener" class="flex shrink-0 w-6 h-6">
                            <img src="{{ asset('assets/images/icons/arrow-circle-down.svg') }}" class="w-6 h-6" alt="icon">
                        </button>
                        <div id="dropdown" class="absolute top-full right-0 mt-[7px] w-[170px] h-fit bg-white rounded-xl border border-obito-grey py-4 px-5 shadow-[0px_10px_30px_0px_#B8B8B840] z-10 hidden">
                            <ul class="flex flex-col gap-[14px]">
                                <li class="hover:text-obito-green transition-all duration-300">
                                    <a href="#">My Courses</a>
                                </li>
                                <li class="hover:text-obito-green transition-all duration-300">
                                    <a href="#">Certificates</a>
                                </li>
                                <li class="hover:text-obito-green transition-all duration-300">
                                    <a href="my-subscriptions.html">Subscriptions</a>
                                </li>
                                <li class="hover:text-obito-green transition-all duration-300">
                                    <a href="#">Settings</a>
                                </li>
                                <li class="hover:text-obito-green transition-all duration-300">
                                    <a href="index.html">Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>