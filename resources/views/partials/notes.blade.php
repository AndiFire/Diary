@foreach ($notes as $note)
   @if ($note->published == true)

      <div class="border-b border-borderColor dark:border-borderColor-dark  py-3 px-1 mb-2   ">

         {{-- Texts --}}
         <div class="flex pb-2 items-center gap-x-1">
            <a href="{{ auth()->id() === $note->user->id 
            ? route('user.edit', ['id' => auth()->user()->id]) 
            : route('user.show', ['id' => $note->user->id]) }}" 
               class="flex gap-x-2 items-center justify-center">

               <div class="block h-6 w-6 rounded-full overflow-hidden">
                  <img class="h-full w-full object-cover" src="{{ $note->user?->avatar_url }}" alt="Avatar ">
               </div>

               <p class="{{ $note->user->id == auth()->id() ? 'text-activeColor dark:text-activeColor-dark font-semibold' : 'text-textColor dark:text-textColor-dark' }} text-sm "> 
                  {{$note->user->name}}
               </p>    
            </a>                 
            <span class=" hidden sm:inline">•</span>
            
            <div class="flex text-sm text-textColor dark:text-textColor-dark ">
               <p class="">{{ $note->published_at->diffForHumans() }} </p>
            </div>

         </div>
         <div class="">
            <h2 class="text-lg font-medium " >
               <a class="w-full line-clamp-1 sm:line-clamp-3" href="{{ route('user.notes.show', $note->id)}}">
                  {{ $note->title }}
               </a>

            </h2>
            <p class="text-textSecColor dark:text-textSecColor-dark opacity-85 line-clamp-1 sm:line-clamp-3 ">
               {{ $note->content }}
            </p>
         </div>

         <div class="flex gap-x-2 py-2">

            @if(empty($searchMode))
               <div class="bg-black/20 p-1 px-2 pr-3 rounded-xl">
                  {{-- обычный режим --}}
                  <like-button
                     type="note"
                     :id="{{ $note->id }}"
                     :initial-likes-count="{{ $note->likes()->count() }}"
                     :user-liked="{{ $note->likes()->where('user_id', auth()->id())->exists() ? 'true' : 'false' }}"
                  ></like-button>
               </div>
            @else
               {{-- режим поиска --}}
               <span class="opacity-80">
                  {{ $note->likes()->count() }} likes
               </span>
            @endif

            <div class="flex items-center ">
               <p class="flex opacity-85">{{ $note->comments_count }} comments</p>
            </div>

         </div>

      </div>  
   @endif
      
@endforeach
