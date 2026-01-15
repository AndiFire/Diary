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

