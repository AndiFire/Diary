<div class="overflow-y-auto max-h-[212px]">
   @if($notes->isEmpty())
   <h1>There is no notes or an error</h1>
   @else
      <div class="flex flex-col">
         @foreach ($notes as $note)

            @if ($note->likes()->where('user_id', Auth::id())->exists())
               <div class="border-b border-l pl-2 rounded-bl-xl border-borderColor dark:border-borderColor-dark mx-4 mt-6">
                  <div class="mb-1 ">

                     {{-- Title --}}
                     <h2 class="text-lg text-textColor dark:text-textColor-dark " >
                        <a href="{{ route('user.notes.show', $note->id)}}">
                           {{ Str::limit($note->title, $limit = 35, $end = '...') }}
                        </a>
                     </h2>

                     {{-- Content --}}
                     <p class="text-textSecColor dark:text-textSecColor-dark border-b border-borderColor/50 dark:border-borderColor-dark/50">
                        {{ $note->content }}
                     </p>

                     <div class="flex justify-between items-center pt-1 ">

                        {{-- published_at --}}
                        <p class="flex justify-end text-xs mr-3 cursor-pointer text-textSecColor dark:text-textSecColor-dark" >
                           {{$note->published_at->diffForHumans()}}
                        </p>
                        {{-- Updated --}}
                        @if($note->created_at != $note->updated_at)
                           <p class="flex text-sm opacity-60 custom-text-gradient ">Updated: {{$note->updated_at->diffForHumans()}}</p>
                        @endif
                     </div>

                  </div>
               </div>  
            @endif
            
         @endforeach
      </div>
   @endif
</div>