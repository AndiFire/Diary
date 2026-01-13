@extends('layouts.main')
@section('main.content')

<p>changed to user.notes.show</p>

{{-- <div class=" justify-center items-center w-full h-full ">
   <div class="relative w-full h-full ">

      <div class="justify-center bg-bgSecColor dark:bg-bgSecColor-dark rounded-lg shadow flex px-16 py-6">
      <div class="pr-2">
         <a href="{{ url()->previous() ?? url()->current() }}">
            <icon name="back" class="cursor-pointer" />
         </a>
      </div>
         <!-- BODY -->
         <div class="max-w-5xl">

            <div class="flex items-center">
               <!-- AUTHOR -->
               <p class=" text-sm text-textColor dark:text-textColor-dark">{{ $note->user->name }}</p>

               <span class=" mx-1 text-textSecColor dark:text-textSecColor-dark">•</span>
               <!-- Published at -->
               <p class="text-xs mr-3" >
                  <time-ago date-time="{{ $note->published_at->toIso8601String() }}"/>
               </p>
               
            </div>
            <!-- TITLE -->
            <div class="relative mb-2 ">
               <p id="title" name="title" 
                  class=" {{$errors->has('title') ? 'decoration-red-500 underline mb-1 ' : ' '}}
                        text-xl block w-full max-w-full text-textColor dark:text-textColor-dark font-semibold break-words break-all"  >
                  {{$note->title}}
               </p>
            </div>
            
            <!-- Content -->
            <div class="relative mb-4">
               <p id="title" name="title" 
                  class=" {{$errors->has('title') ? 'decoration-red-500 underline mb-1 ' : ' '}}
                     block w-full max-w-full break-words break-all text-textSecColor dark:text-textSecColor-dark"  >
                  {{$note->content}}
               </p>
            </div>

            <div class="flex py-2 gap-x-2 mb-2">
               <div class="bg-black/20 p-1 px-2 pr-3 rounded-xl">
                  <like-button 
                     type="note" 
                     :id="{{ $note->id }}" 
                     :initial-likes-count="{{ $note->likes()->count() }}">
                     :user-liked="{{  $note->likes()->where('user_id', auth()->id())->exists() ? 'true' : 'false' }}"
                  </like-button>
               </div>
               <div class="flex items-center ">
                  <p class="flex opacity-85">{{ $note->comments->count() }} comments</p>
               </div>
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
</div> --}}
@endsection