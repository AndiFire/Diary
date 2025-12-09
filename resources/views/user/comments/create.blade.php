@extends('layouts.main')
@section('main.content')
   <div class=" justify-center items-center w-full h-full ">
      <div class="relative  w-full h-full">
         <!-- Modal content -->
         <div class="relative rounded-lg shadow bg-bgSecColor dark:bg-bgSecColor-dark ">

            <!-- Modal body -->
            <div class="p-4 md:p-5">
               <form class="" method="POST" action="{{ route('user.notes.store') }}">
                  @csrf
                  <!-- Current password -->
                  <label for="title"
                     class="block mb-1 text-md font-medium text-textColor dark:text-textColor-dark">{{__('Title')}}</label>
                  <div class="relative mb-5">
                     <input id="title" type="text" name="title" placeholder="My day"
                        class=" {{$errors->has('title') ? 'border-red-600 placeholder-red-600 mb-1' : 'mb-4 p-2 border-borderColor dark:border-borderColor-dark text-gray-900 focus:outline-none'}}
                           bg-bgColor dark:bg-bgColor-dark border rounded-lg text-sm focus:outline-none block w-full p-2  text-textSecColor dark:text-textSecColor-dark" required>
                  </div>

                  <!-- New password -->
                  <label for="content"
                     class="block mb-1 text-md font-medium text-textColor dark:text-textColor-dark">{{__('Content')}}</label>
                  <div class="relative mb-5">
                     <textarea id="content" type="text" name="content" placeholder="Today is a great day" rows="7"
                        class=" {{$errors->has('content') ? 'border-red-600 placeholder-red-600 mb-1' : 'mb-4 p-2 border-borderColor dark:border-borderColor-dark text-gray-900  dark:placeholder-gray-400'}}
                           bg-bgColor dark:bg-bgColor-dark border rounded-lg text-sm  block w-full p-2 text-textSecColor dark:text-textSecColor-dark" required>
                           </textarea>
                  </div>

                  <label for="published_at" id="published_at"
                     class="block mb-1 text-md font-medium text-textColor dark:text-textColor-dark ">Date of publishing</label>
                  <div class="flex">

                     <!-- Published at -->
                     <input type="date" placeholder="dd.mm.yyyy"
                        class=" bg-bgColor dark:bg-bgColor-dark rounded-lg border mr-3 cursor-pointer border-borderColor dark:border-borderColor-dark "
                        required>

                     <!-- Published -->
                     <div class="relative flex items-center text-textColor dark:text-textColor-dark">
                        <p>Published</p>
                        <input type="checkbox" name="published" id="published" value="1"
                           class="ml-2 bg-bgColor dark:bg-bgColor-dark rounded cursor-pointer border-borderColor dark:border-borderColor-dark  ">
                     </div>
                  </div>
                  
                  {{-- Save --}}
                  <div class="flex justify-center">
                     <button id="save" type="submit"
                        class="rounded-lg text-textColor-dark dark:text-textColor-dark py-1 px-6 hover:scale-105 bg-buttonColor dark:bg-buttonColor-dark">
                        {{__('Save')}}
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
@endsection