@extends('layouts.main')
@section('main.content')

<body>

   <div class="flex w-full justify-between flex-col bg-bgColor dark:bg-bgColor-dark rounded-2xl ">
      <div class="flex p-5 w-full ">

         @if($notes->isEmpty())
            <h1>There is no notes or an error</h1>
         @else
            <div id="noteContainer" class=" w-full gap-x-4 px-4 ">
               @include('partials.notes', ['notes' => $notes])
            </div>
         @endif

      </div>
   </div>

</body>

@endsection