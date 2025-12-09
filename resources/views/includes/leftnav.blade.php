<div id="left-nav-container" class="mr-4 w-52 hidden md:flex">
   <nav id="left-nav-sidebar" class="flex-wrap flex justify-center rounded-2xl bg-bgColor dark:bg-bgColor-dark md:min-w-52 p-6 font-bold h-full w-full">

        @auth

            <div class="justify-between w-full flex-col md:order-8 " id="navbar-sticky">
               <div class="flex justify-center items-center pb-2 h-10 w-full">
                  <a id="create" href="{{route('user.notes.create')}}" class="rounded-xl w-full h-full justify-center items-center flex font-bold hover:scale-105 text-textColor-dark dark:text-textColor-dark bg-buttonColor dark:bg-buttonColor-dark transition-all duration-200 ease-in-out ">
                     {{__('Create')}}
                  </a>
               </div>
               <ul class="flex flex-col text-lg font-medium rounded-lg rtl:space-x-reverse w-full">

                     <li class="{{ request()->is('home') ? 'text-activeColor dark:text-activeColor-dark font-bold bg-black/20 ' 
                     : 'text-textColor dark:text-textColor-dark hover:text-hoverColor dark:hover:text-hoverColor-dark hover:bg-black/10 cursor-pointer' }}
                     items-center justify-center flex h-10 w-full rounded-lg" >

                           <a {{Route::is('home') ? 'active ': ''}} href="{{ route('home')}}"
                              class="block py-2 px-3 md:p-0 " aria-current="page">
                                 Home
                           </a>
                     </li>

                    <li class="{{ request()->is('profile/show') ? 'text-activeColor dark:text-activeColor-dark font-bold bg-black/20 ' 
                    : 'text-textColor dark:text-textColor-dark hover:text-hoverColor dark:hover:text-hoverColor-dark hover:bg-black/10 cursor-pointer' }}
                     items-center justify-center flex h-10 w-full rounded-lg" >

                        <a {{Route::is('profile.show') ? 'active ': ''}} href="{{ route('profile.show')}}"
                            class="block py-2 px-3 md:p-0">
                                Profile
                        </a>
                    </li>
                    <li class="{{ request()->is('diary') ? 'text-activeColor dark:text-activeColor-dark font-bold bg-black/20 ' 
                    : 'text-textColor dark:text-textColor-dark hover:text-hoverColor dark:hover:text-hoverColor-dark hover:bg-black/10 cursor-pointer' }}
                     items-center justify-center flex h-10 w-full rounded-lg " >

                        <a {{Route::is('diary') ? 'active': ''}} href="{{ route('diary')}}"
                            class="block py-2 px-3 md:p-0 ">
                                Diary
                        </a>
                    </li>


                </ul>
            </div>
        @endauth
   </nav>
</div>