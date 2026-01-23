@extends ('layouts.main')
@section ('main.content')
   @include('modals.ChangePasswordPopup')
   @include('modals.ChangeNamePopup')

   <script src="{{ asset('js/main.js') }}"></script>
   <script src="{{ asset('js/Auth/ModalPopup.js') }}"></script>

   <div class="flex h-full w-full g-bgSecColor dark:bg-bgSecColor-dark rounded-2xl ">

      <div class="m-10 bg-bgColor dark:bg-bgColor-dark rounded-2xl flex flex-col justify-center items-center w-full  text-textColor dark:text-textColor-dark ">
         <div class="flex p-10 w-full rounded-2xl mr-8 justify-center items-center space-x-8">
            {{--------------AVATAR----------------}}

            <div class="block h-40 w-40 rounded-full overflow-hidden ">
               <img class="h-full w-full object-cover" src="{{ $user->avatar_url }}" alt="Avatar ">
            </div>

            {{---------------Profile----------------}}
            <div class="flex flex-col ">
               <h1 class=" bg-bgColor dark:bg-bgColor-dark text-2xl font-bold">{{ $user->name }}</h1>
               <p class="flex ">{{ $user->notes->count() }} notes</p>
            </div>

         </div>

         <profile-tabs :user='@json(["id" => $user->id])'></profile-tabs>

      </div>
   </div>

@endsection

