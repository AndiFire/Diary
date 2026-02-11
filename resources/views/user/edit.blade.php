@extends ('layouts.main')
@section ('main.content')






   <div class="flex w-full g-bgSecColor dark:bg-bgSecColor-dark rounded-2xl">

      <div
         class="p-12 bg-skinColor rounded-2xl flex justify-center items-center w-full h-full text-textColor dark:text-textColor-dark mx-auto">
         <div class="flex-col flex p-10 w-1/2 bg-bgColor dark:bg-bgColor-dark rounded-2xl mr-8 h-full">
            {{--------------AVATAR----------------}}
            <change-avatar
               :user='@json(["avatar_url" => $user->avatar_url ?? asset("images/default-avatar.jpg")])'>
            </change-avatar>

            {{---------------Profile info----------------}}

            <h1 class="flex justify-center text-xl font-bold mb-6 text-textColor dark:text-textColor-dark">My profile</h1>

            {{---------------Name----------------}}
            <div class="flex-col mb-6">
               <label for="name" class="text-sm text-textSecColor dark:text-textSecColor-dark">Nickname</label>
               <div class="flex">
                  <input type="text" name="name" placeholder="name" value="{{ $user->name }}"
                     class="{{$errors->has('name') ? 'border-b-red-600 placeholder-red-600' : ''}} p-0 w-full bg-bgColor dark:bg-bgColor-dark border-0 border-b "
                     readonly>

                  <change-name :user='@json($user)' @name-changed="updateUserName"></change-name>

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
                     class="{{$errors->has('email') ? 'border-red-600 placeholder-red-600' : ''}} p-0 w-full bg-bgColor dark:bg-bgColor-dark border-0 border-b"
                     readonly>

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
                  <input type="password" name="password" placeholder="Password" value="{{$user->password}}"
                     class="{{$errors->has('password') ? 'border-red-600 placeholder-red-600' : ''}} p-0 w-full bg-bgColor dark:bg-bgColor-dark border-0 border-b"
                     readonly>

                  <change-password :user='@json($user)' @password-changed="updateUserPassword"></change-password>

               </div>

               @error('password')
                  <p class="pt-1 text-red-600 text-xs">{{$message}}</p>
               @enderror
            </div>

         </div>
         <div class="flex flex-col h-full w-1/2 rounded-2xl ">
            <div class="rounded-2xl h-1/2 bg-bgColor dark:bg-bgColor-dark mb-2">
               <note-search :user='@json(["id" => $user->id])' title="My notes" type="all"></note-search>
            </div>
            <div class="rounded-2xl h-1/2 bg-bgColor dark:bg-bgColor-dark mt-2">
               <note-search :user='@json(["id" => $user->id])' title="My liked notes" type="liked"></note-search>
            </div>
         </div>

      </div>
   </div>

@endsection