@extends ('layouts.main')
@section ('main.content')
   @include('modals.ChangePasswordPopup')
   @include('modals.ChangeNamePopup')

   <script src="{{ asset('js/main.js') }}"></script>
   <script src="{{ asset('js/Auth/ModalPopup.js') }}"></script>

   <div class="flex w-full g-bgSecColor dark:bg-bgSecColor-dark rounded-2xl">

      <div class="p-12 bg-skinColor rounded-2xl flex justify-center items-center  w-full h-full text-textColor dark:text-textColor-dark mx-auto">
         <div class="flex-col flex p-10 w-1/2 bg-bgColor dark:bg-bgColor-dark rounded-2xl mr-8  ">
            {{--------------AVATAR----------------}}
            <change-avatar :user='@json(["avatar_url" => $user->avatar_url ?? asset("images/default-avatar.jpg")])' ></change-avatar>

            {{---------------Profile info----------------}}

            <h1 class="flex justify-center text-xl font-bold mb-6 text-textColor dark:text-textColor-dark">My profile</h1>

            {{---------------Name----------------}}
            <div class="flex-col mb-6">
               <label for="name" class="text-sm text-textSecColor dark:text-textSecColor-dark">Nickname</label>
               <div class="flex">
                  <input type="text" name="name" placeholder="name" value="{{ $user->name }}"
                           class="{{$errors->has('name') ? 'border-b-red-600 placeholder-red-600' : ''}} p-0 w-full bg-bgColor dark:bg-bgColor-dark border-0 border-b " readonly>

                  <button data-modal-target="name-modal" data-modal-toggle="name-modal"
                           class="rounded-xl text-textColor-dark dark:text-textColor-dark text-sm py-1 px-4 hover:scale-105 duration-300 bg-buttonColor dark:bg-buttonColor-dark"
                           type="button">
                        {{ __('Change') }}
                  </button>
               </div>
               @error('name')
               <p class="pt-1 text-red-600 text-xs">{{$message}}</p>
               @enderror
            </div>
            {{---------------Email----------------}}
            <div class="mb-6 flex-col">
               <label for="email" class="text-sm text-textSecColor dark:text-textSecColor-dark">Email</label>
               <div class="flex">
                  <input type="text" name="email" placeholder="Email" value="{{ $user->email }}"
                           class="{{$errors->has('email') ? 'border-red-600 placeholder-red-600' : ''}} p-0 w-full bg-bgColor dark:bg-bgColor-dark border-0 border-b" readonly>
                  
                  @if(auth()->check() && auth()->user()->hasVerifiedEmail())
                        <button 
                        class=" rounded-xl text-textColor-dark dark:text-textColor-dark text-sm py-1 px-4 hover:scale-105 duration-300 bg-activeColor dark:bg-activeColor-dark">
                        <a href="{{ route('verification.notice')}}">
                           Confirmed
                        </a>
                        </button>
                  @else
                        <button 
                           class=" rounded-xl text-textColor-dark dark:text-textColor-dark text-sm py-1 px-4 hover:scale-105 duration-300 bg-buttonColor dark:bg-buttonColor-dark">
                           <a href="{{ route('verification.notice')}}">
                              Confirm
                           </a>
                        </button>
                  @endif
               </div>

               @error('email')
               <p class="pt-1 text-red-600 text-xs">{{$message}}</p>
               @enderror
            </div>

            {{---------------Password----------------}}
            <div class="mb-6 flex-col">
               <label for="password" class="text-sm text-textSecColor dark:text-textSecColor-dark">Password</label>
               <div class="flex">
                  <input type="password" name="password" placeholder="Password"
                           value="{{$user->password}}"
                           class="{{$errors->has('password') ? 'border-red-600 placeholder-red-600' : ''}} p-0 w-full bg-bgColor dark:bg-bgColor-dark border-0 border-b" readonly>

                  <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"
                           class="rounded-xl text-textColor-dark dark:text-textColor-dark text-sm py-1 px-4 hover:scale-105 duration-300 bg-buttonColor dark:bg-buttonColor-dark"
                           type="button">
                        {{ __('Change') }}
                  </button>

               </div>

               @error('password')
               <p class="pt-1 text-red-600 text-xs">{{$message}}</p>
               @enderror
            </div>

         </div>
         <div class="flex flex-col h-full w-1/2 rounded-2xl ">

            <note-search :user='@json(["id" => $user->id])'></note-search>

            <div class="rounded-2xl h-1/2 w-full bg-bgColor dark:bg-bgColor-dark">
               <div class="flex row justify-center items-center border-b border-slate-600 w-full pb-4 py-6 px-7">
                  <h2 class="font-bold text-lg w-1/2 text-textColor dark:text-textColor-dark">{{__('My diary likes')}}</h2>
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
               @include('user.notes.likes')
            </div>
         </div>
      </div>
   </div>

@endsection

