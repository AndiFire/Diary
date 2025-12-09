@extends('layouts.main')
@section('main.content')
<div class=" justify-center items-center w-full h-full ">
    <div class="relative w-full h-full">

        <div class="relative bg-bgSecColor dark:bg-bgSecColor-dark rounded-lg shadow ">
            
            <!-- BODY -->
            <div class="p-4 md:p-5">
                @if ($note->user_id == Auth::id())
                    <a id="edit" href="{{route('diary')}}" class="">
                        <div class="hover:scale-105 bg-buttonColor dark:bg-buttonColor-dark cursor-pointer p-2 w-10 rounded-xl mb-4">
                            <svg class="" width="22" height="18" viewBox="0 0 26 28" fill="white" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0.290059 7.70695C-0.0999414 7.31695 -0.0999414 6.68301 0.290059 6.29301L6.29006 0.293006C6.68006 -0.0979941 7.31998 -0.0979941 7.70998 0.293006C8.09998 0.683006 8.09998 1.31695 7.70998 1.70695L3.40993 5.99998H18C23.52 5.99998 28 10.477 28 16C28 21.523 23.52 26 18 26H2.00002C1.45002 26 1.00002 25.552 1.00002 25C1.00002 24.448 1.45002 24 2.00002 24H18C22.42 24 26 20.418 26 16C26 11.582 22.42 7.99998 18 7.99998H3.40993L7.70998 12.293C8.09998 12.683 8.09998 13.3169 7.70998 13.7069C7.31998 14.0979 6.68006 14.0979 6.29006 13.7069L0.290059 7.70695Z" fill="white"/>
                            </svg>
                        </div>
                    </a>                
                @endif

                <!-- TITLE -->
                <label for="title" class="block mb-1 text-md font-medium text-textColor dark:text-textColor-dark">{{__('Title')}}</label>
                <div class="relative mb-5">
                    <p id="title" type="text" name="title" placeholder="My day"
                        class=" {{$errors->has('title') ? 'border-red-600 placeholder-red-600 mb-1' : 'mb-4 p-2 border-borderColor dark:border-borderColor-dark dark:placeholder-gray-400'}}
                        bg-bgColor dark:bg-bgColor-dark border rounded-lg text-sm  block w-full p-2 text-textSecColor dark:text-textSecColor-dark"  >
                        {{$note->title}}
                    </p>
                </div>

                <!-- Content -->
                <label for="content" class="block mb-1 text-md font-medium text-textColor dark:text-textColor-dark">{{__('Content')}}</label>
                <div class="relative mb-5">
                    <p id="content" type="text" name="content" placeholder="Today is a great day" rows="7"
                        class=" {{$errors->has('content') ? 'border-red-600 placeholder-red-600 mb-1' : 'mb-4 p-2 border-borderColor dark:border-borderColor-dark dark:placeholder-gray-400'}}
                        bg-bgColor dark:bg-bgColor-dark border rounded-lg text-sm  block w-full p-2 text-textSecColor dark:text-textSecColor-dark"  >
                        {{$note->content}}
                    </p>

                </div>

                <div class="flex items-center">
                    <!-- Published at -->
                    <label for="published_at" class="block mb-1 text-md font-medium text-textColor dark:text-textColor-dark mr-2 ">Date of publishing: </label>
                    <p class="p-1 mr-3 cursor-pointer  " >
                        {{$note->published_at}}
                    </p>
                    
                    <!-- Published -->
                    <div class="relative flex items-center border-l-2 border-borderColor dark:border-borderColor-dark pl-3">
                        <p>Published: {{$note->published ? 'yes' : 'no'}}</p>
                    </div>     
                </div>     
                <div class="flex">
                    @if($note->created_at != $note->updated_at)
                        <p class="flex text-sm opacity-60 custom-text-gradient">Updated: {{$note->updated_at}}</p>
                    @endif
                </div>      
                  <note-comments :note-id="{{ $note->id }}"></note-comments>    

                <div class="flex justify-center">
                    @if ($note->user_id == Auth::id())
                        <a id="edit" href="{{route('user.notes.edit', $note->id)}}" class="rounded-xl text-textColor-dark dark:text-textColor-dark py-1 px-6 hover:scale-105 bg-buttonColor dark:bg-buttonColor-dark">
                            {{__('Edit')}}
                        </a>               
                    @else
                        <a id="back" href="{{route('diary')}}" class="rounded-xl text-textColor-dark dark:text-textColor-dark py-1 px-6 hover:scale-105 bg-buttonColor dark:bg-buttonColor-dark">
                            {{__('Back')}}
                        </a>       
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>
@endsection