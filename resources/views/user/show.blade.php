@extends ('layouts.main')
@section ('main.content')
   @include('modals.ChangePasswordPopup')
   @include('modals.ChangeNamePopup')

   <script src="{{ asset('js/main.js') }}"></script>
   <script src="{{ asset('js/Auth/ModalPopup.js') }}"></script>

   <div class="flex w-full g-bgSecColor dark:bg-bgSecColor-dark rounded-2xl">

      <div class="p-12 bg-skinColor rounded-2xl flex justify-center items-center md:h-[750px] w-full h-full text-textColor dark:text-textColor-dark">
         <div class="flex-col flex p-10 w-1/2 bg-bgColor dark:bg-bgColor-dark rounded-2xl mr-8 h-full">
            {{--------------AVATAR----------------}}

               <div class="block h-64 w-64 rounded-full overflow-hidden mx-auto mb-6">
                  <img class="h-full w-full object-cover" src="{{ $user->avatar_url }}" alt="Avatar ">
               </div>

            {{---------------Profile info----------------}}

            <h1 class="flex justify-center text-xl font-bold mb-6 text-textColor dark:text-textColor-dark">User profile</h1>

            {{---------------Name----------------}}
            <div class="flex mb-6 text-lg">
               <label for="name" class=" text-textSecColor dark:text-textSecColor-dark pr-2">Nickname: </label>

               <div class="flex">
                  <p class="p-0 w-full bg-bgColor dark:bg-bgColor-dark">{{ $user->name }}</p>
               </div>

            </div>

         </div>
         <div class="flex flex-col h-full w-1/2 rounded-2xl ">
            <div class="rounded-2xl h-1/2 mb-8 bg-bgColor dark:bg-bgColor-dark ">
               <div class="flex row justify-center items-center border-b border-slate-600 w-full pb-4 py-6 px-7 ">
                  <h2 class="font-bold text-lg w-1/2 text-textColor dark:text-textColor-dark">{{__($user->name .  ' diary entries')}}</h2>
                  <div class="w-1/2 flex justify-end items-center">
                     <div class="relative ml-12">
                        <input type="text" placeholder="Search..."
                              class="bg-zinc-500/20 rounded-full py-1 pl-10 block w-full ">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                           <img class="w-5 h-5" src="{{ asset('/icons/search-normal.svg') }}" alt="search">
                        </div>
                     </div>

                  </div>
               </div>
                  @include('user.notes.index')
            </div>
            <div class="rounded-2xl h-1/2 w-full bg-bgColor dark:bg-bgColor-dark">
               <div class="flex row justify-center items-center border-b border-slate-600 w-full pb-4 py-6 px-7">
                  <h2 class="font-bold text-lg w-1/2 text-textColor dark:text-textColor-dark">{{__($user->name . ' diary likes')}}</h2>
                  <div class="w-1/2 flex justify-end items-center">
                        <div class="relative ml-12">
                           <input type="text" placeholder="Search..."
                                 class=" bg-zinc-500/20 rounded-full py-1 pl-10 block w-full ">
                           <div class="absolute inset-y-0 left-0 pl-3 flex items-center">
                              <img class="w-5 h-5" src="{{ asset('/icons/search-normal.svg') }}" alt="search">
                           </div>
                        </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

@endsection

