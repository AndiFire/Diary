@extends('layouts.base')

@section('content')

<body class="bg-cover bg-center bg-fixed dark:bg-[url('/public/images/bg-black.webp')] bg-[url('/public/images/bg-light.jpg')]"  >
   <div class="flex-wrap text-textColor dark:text-textColor-dark ">

      <div class="">
         @include('includes.nav')
      </div>

      <main class="flex mb-10 ">
         @include('includes.leftnav')
         @yield('main.content')
      </main>

      @include('includes.footer')

   </div>
</body>

@endsection