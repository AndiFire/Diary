@extends('layouts.main')
@section('main.content')

   <div class=" justify-center items-center w-full h-full ">
      <div class="relative w-full h-full ">

         <div class="justify-center bg-bgSecColor dark:bg-bgSecColor-dark rounded-2xl shadow flex px-16 py-6">
            <div class="pr-2 space-y-2 flex items-center flex-col ">
               <a href="{{ url()->previous() ?? url()->current() }}">
                  <icon name="undo" class="cursor-pointer" />
               </a>
               <div class="flex-col flex justify-center items-center space-y-2">
                  @if ($note->user_id == Auth::id())
                     <a id="edit" href="{{route('user.notes.edit', $note->id)}}" class="">
                        <icon name="edit" class="h-5 w-5" />
                     </a>
                     <form action="{{ route('user.notes.delete', $note->id) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this note?');">
                        @csrf
                        @method('DELETE')

                        <button class="hover:text-red-700">
                           <icon name="trash" class="w-5 h-5 " />
                        </button>
                     </form>
                  @endif
               </div>
            </div>
            <!-- BODY -->
            <div class="max-w-5xl">

               <div class="flex items-center">
                  <!-- AUTHOR -->
                  <p class=" text-sm text-textColor dark:text-textColor-dark">{{ $note->user->name }}</p>

                  <span class=" mx-1 text-textSecColor dark:text-textSecColor-dark">•</span>
                  <!-- Published at -->
                  <div class="flex">
                     <p class="text-xs mr-3">
                        <time-ago date-time="{{ $note->published_at->toIso8601String() }}" />
                     </p>
                     @if($note->created_at != $note->updated_at)
                        <p class="flex text-xs opacity-60 italic">Updated {{$note->updated_human}}</p>
                     @endif
                  </div>

               </div>
               <!-- TITLE -->
               <div class="relative mb-2 ">
                  <p id="title" name="title"
                     class=" {{$errors->has('title') ? 'decoration-red-500 underline mb-1 ' : ' '}}
                           text-xl block w-full max-w-full text-textColor dark:text-textColor-dark font-semibold break-words break-all">
                     {{$note->title}}
                  </p>
               </div>

               <!-- Content -->
               <div class="relative mb-4">
                  <p id="title" name="title" class=" {{$errors->has('title') ? 'decoration-red-500 underline mb-1 ' : ' '}}
                        block w-full max-w-full break-words break-all text-textSecColor dark:text-textSecColor-dark">
                     {{$note->content}}
                  </p>
               </div>

               <div class="flex py-2 gap-x-2 mb-2">
                  <div class="bg-black/20 p-1 px-2 pr-3 rounded-xl">
                     <like-button type="note" :id="{{ $note->id }}" :initial-likes-count="{{ $note->likes_count }}"
                        :user-liked="{{ $note->user_liked ? 'true' : 'false' }}">
                     </like-button>
                  </div>
                  <div class="flex items-center ">
                     <p class="flex opacity-85">{{ $note->comments->count() }} comments</p>
                  </div>
               </div>

               <!-- COMMENTS -->
               <div class="flex">
                  <note-comments :autor-id="{{ $note->user_id }}" :note-id="{{ $note->id }} " :auth-user-id="{{ auth()->id() }}" />
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection