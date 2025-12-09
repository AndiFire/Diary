@extends('layouts.main')
@section('main.content')

<body>

   <div class="flex w-full justify-between flex-col bg-bgColor dark:bg-bgColor-dark rounded-2xl ">

      <div class="my-4 px-5 w-full flex-col items-center gap-x-12 justify-between bg-bgSecColor dark:bg-bgSecColor-dark ">
         <div class="flex w-full justify-center items-center pt-4"><h1 class="font-semibold text-3xl text-textColor dark:text-textColor-dark">My notes</h1></div>
         @if ($userNotes->isEmpty())
            <h1>You have no notes yet</h1>
         @else
         <div class="md:grid md:grid-cols-3 w-full gap-x-4 px-4 py-4">
            @foreach ($userNotes as $note)
                     
               <div class="border border-borderColor dark:border-borderColor-dark rounded-2xl p-3 mb-4 ">
                  <div class="flex w-full justify-between text-textSecColor dark:text-textSecColor-dark">
                     <div class="flex text-sm justify-center items-center">
                        <button >
                           <a class="border-r pr-2 border-borderColor dark:border-borderColor-dark" href="{{route('user.notes.edit', $note->id)}}">Edit</a>
                        </button>
                        <form action="{{ route('user.notes.delete', $note->id) }}" method="POST">
                           @csrf
                           @method('DELETE')
                           <button class="pl-2 mr-6 " type="submit">Delete</button>
                        </form>
                     </div>
                     <p>***</p>
                  </div>
                  
                  <div class="flex justify-between pb-2 border-b border-borderColor dark:border-borderColor-dark ">
                     <p class="text-sm mr-6"> {{$note->user->name}}</p>
                     <div class="flex text-sm justify-end text-textColor dark:text-textColor-dark ">
                        <p class="justify-end">{{ $note->published_at->diffForHumans() }} </p>
                     </div>

                  </div>
                  <div class="mb-1 pt-1">
                     <h2 class="text-lg font-medium" >
                        <a href="{{ route('user.notes.show', $note->id)}}">
                           {{ Str::limit($note->title, $limit = 35, $end = '...') }}
                        </a>

                     </h2>
                     <p class="text-textSecColor dark:text-textSecColor-dark opacity-85">
                        {{ Str::limit($note->content, $limit = 40, $end = '...') }}
                     </p>
                  </div>

                  <div class="flex gap-x-2 py-2">

                     <like-button 
                        type="note" 
                        :id="{{ $note->id }}" 
                        :initial-likes-count="{{ $note->likes()->count() }}">
                        :user-liked="{{  $note->likes()->where('user_id', auth()->id())->exists() ? 'true' : 'false' }}"
                     </like-button>

                     <div class="flex items-center">
                        {{ $note->comments_count }} comments
                     </div>

                  </div>
                  
               </div>  
            @endforeach
         </div>
         @endif
      </div>
      <div class="flex p-5 w-full ">

         @if($notes->isEmpty())
            <h1>There is no notes or an error</h1>
         @else
            <div class="md:grid md:grid-cols-3 w-full gap-x-4 px-4 ">
               @foreach ($notes as $note)
                  @if ($note->published && $note->user_id != Auth::id())
                     
                     <div class="border border-borderColor dark:border-borderColor-dark rounded-2xl p-3 mb-4  ">
                        <div class="flex w-full justify-end">
                           <p >***</p>
                        </div>
                        {{-- Texts --}}
                        <div class="flex justify-between pb-2 border-b border-borderColor dark:border-borderColor-dark ">
                           {{-- <p class="text-sm mr-3">Note ID: {{$note->id}}</p> --}}
                           <p class="text-sm mr-6"> {{$note->user->name}}</p>
                           <div class="flex text-sm justify-end text-textColor dark:text-textColor-dark ">
                              <p class="justify-end">{{ $note->published_at->diffForHumans() }} </p>
                           </div>

                        </div>
                        <div class="mb-1 pt-1">
                           <h2 class="text-lg font-medium" >
                              <a href="{{ route('notes.show', $note->id)}}">
                                 {{ Str::limit($note->title, $limit = 35, $end = '...') }}
                              </a>

                           </h2>
                           <p class="text-textSecColor dark:text-textSecColor-dark opacity-85">
                              {{ Str::limit($note->content, $limit = 40, $end = '...') }}
                           </p>
                        </div>

                        <div class="flex gap-x-2 py-2">

                           <like-button 
                              type="note" 
                              :id="{{ $note->id }}" 
                              :initial-likes-count="{{ $note->likes()->count() }}">
                              :user-liked="{{  $note->likes()->where('user_id', auth()->id())->exists() ? 'true' : 'false' }}"
                           </like-button>

                           <div class="flex items-center">
                              {{ $note->comments_count }} comments
                           </div>

                        </div>
                        {{-- <div class="">
                           <span class="">
                              <svg aria-label="Не нравится" class="dark:text-red-500" fill="currentColor" height="24" role="img" viewBox="0 0 48 48" width="24">
                                 <title>Не нравится</title>
                                 <path d="M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path>
                              </svg>
                           </span>
                        </div> --}}

                     </div>  
                  @endif
                     
               @endforeach
            </div>
         @endif

      </div>
   </div>

</body>

@endsection