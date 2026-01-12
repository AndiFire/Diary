<nav class="mb-4 bg-bgSecColor dark:bg-bgSecColor-dark flex-wrap mx-auto rounded-b-2xl">
    <div class=" flex flex-wrap items-center justify-between mx-auto p-4">

        <div class="flex">
            @auth
                <div class="flex relative md:order-6 pr-4">
                    <burger-menu></burger-menu>
                </div>
            @endauth
            <a {{Route::is('diary') ? 'active': ''}} href="{{ route('diary')}}" class="flex items-center space-x-3 rtl:space-x-reverse md:order-7">
                <img src="https://flowbite.com/docs/images/logo.svg" class="h-8" alt="Flowbite Logo">
                <span class="self-center text-2xl font-semibold whitespace-nowrap text-textColor dark:text-textColor-dark hover:text-hoverColor dark:hover:text-hoverColor-dark">
                    Diary
                </span>
            </a>

        </div>

        <div class="flex md:order-9 space-x-3 md:space-x-0 rtl:space-x-reverse">
            <ul class="flex row font-bold">
                <div class="flex flex-col sm:flex-row ">
                    @guest
                        @if (Route::has('login'))
                            <li class="mr-2 {{ request()->is('login') ? 'text-activeColor dark:text-activeColor-dark font-bold' : 'text-textColor dark:text-textColor-dark hover:text-hoverColor dark:hover:text-hoverColor-dark' }}" >
                                <a class=" {{Route::is('login') ? 'active': ''}} " href="{{route('login')}}">{{__('Login')}}</a>
                            </li>
                            <span class="relative inline-flex items-center mr-2 text-textColor dark:text-textColor-dark">
                                <span class="mx-1 hidden sm:inline">•</span>
                            </span>
                        @endif

                        @if (Route::has('register'))
                            <li class="{{ request()->is('register') ? 'text-activeColor dark:text-activeColor-dark font-bold' : 'text-textColor dark:text-textColor-dark hover:text-hoverColor dark:hover:text-hoverColor-dark' }}">
                                <a class=" {{Route::is('register') ? 'active': ''}}  " href="{{route('register')}}">{{__('Register')}}</a>
                            </li>
                        @endif
                    @endguest
                </div>

                @auth
                    <user-menu :user="{{ json_encode(['id' => Auth::user()->id, 'name' => Auth::user()->name, 'email' => Auth::user()->email, 'avatar_url' => Auth::user()->avatar_url]) }}"></user-menu>
                @endauth

            </ul>
        </div>

        @auth

         <div class="relative order-1 md:ml-10 ">
            <input type="text" placeholder="Search..."
               class=" bg-zinc-500/20 rounded-xl py-1 pr-40 block ">
            <div class="absolute inset-y-0 right-0 pr-3 flex items-center">
               <img class="w-5 h-5" src="{{ asset('/icons/search-normal.svg') }}" alt="search">
            </div>
         </div>   
        @endauth

    </div>
</nav>
