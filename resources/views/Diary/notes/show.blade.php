@extends('layouts.main')
@section('main.content')

<div class=" justify-center items-center w-full h-full ">
   <div class="relative w-full h-full ">

      <div class="relative bg-bgSecColor dark:bg-bgSecColor-dark rounded-lg shadow flex px-16 py-6">
         <div class="pr-2 cursor-pointer" onclick="history.back()">
            <icon name="back" />
         </div>
         <!-- BODY -->
         <div class="">

            <div class="flex items-center">
               <!-- AUTHOR -->
               <p class="font-bold text-sm text-textColor dark:text-textColor-dark">{{ $note->user->name }}</p>

               <span class=" mx-1 text-textSecColor dark:text-textSecColor-dark">•</span>
               <!-- Published at -->
               <p class="text-xs mr-3" >
                  <time-ago date-time="{{ $note->published_at->toIso8601String() }}"/>
               </p>
               
            </div>
            <!-- TITLE -->
            <div class="relative mb-5">
               <p id="title" name="title" 
                  class=" {{$errors->has('title') ? 'decoration-red-500 underline mb-1 ' : ' '}}
                     text-xl block w-full text-textColor dark:text-textColor-dark"  >
                  {{$note->title}}
               </p>
            </div>
            
            <!-- Content -->
            <div class="relative mb-5">
               <p id="title" name="title" 
                  class=" {{$errors->has('title') ? 'decoration-red-500 underline mb-1 ' : ' '}}
                     block w-full text-textSecColor dark:text-textSecColor-dark"  >
                  {{$note->content}}
               </p>

            </div>

            <div class="flex">
               @if($note->created_at != $note->updated_at)
                  <p class="flex text-sm opacity-60 custom-text-gradient">Updated: {{$note->updated_at}}</p>
               @endif
            </div>  
            
            <!-- COMMENTS -->
            <div class="flex">
               <note-comments :note-id="{{ $note->id }}"/>
            </div>   
         </div>
      </div>
   </div>
</div>
@endsection