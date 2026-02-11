@extends('layouts.auth')
@section('auth.content')



<section class=" min-h-screen flex items-center justify-center auth-page">
    <!-- login container -->
    <div class="relative bg-bgColor dark:bg-bgColor-dark flex  rounded-2xl shadow-lg max-w-3xl  ">

        <!-- form -->
        <div class="md:w-1/2 px-8 py-8 ">

            @if (session('status'))
                <div class="mb-4 flex items-center justify-center p-2  border-2 rounded-xl border-green-400 bg-green-50">
                    <svg class="mr-2 w-4 h-4 text-green-400" fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512">
                        <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
                    </svg>
                    <h3 class="text-green-400 font-bold text-sm">We've emailed your password reset link.</h3>
                </div>
            @endif

            <h2 class="font-bold text-2xl ">Forgot password</h2>
            <p class="text-xs mt-4 ">If you forgot your password, easily send email </p>


            <!-- DATAS -->
            <form method="POST" action="{{ route('password.request') }}"  class="flex flex-col gap-4">
                @csrf
					<div>
						<input class=" {{$errors->has('email') ? 'border-red-600 placeholder-red-600 focus:border-red-600' : 'focus:border-activeColor dark:focus:border-activeColor-dark'}} 
                  p-2 rounded-xl mt-8 border-2 dark:border-bgColor-dark border-bgColor  focus:border-2 focus:outline-none focus:ring-0 w-full dark:bg-bgSecColor-dark bg-bgSecColor"  
                  type="text" name="email" placeholder="Email" value="{{ old('email') }}">
						@error('email') <p class="pt-1 text-red-600 text-xs">{{$message}}</p> @enderror
					</div>

                <button type="submit" class="bg-buttonColor dark:bg-buttonColor-dark rounded-xl text-textColor dark:text-textColor-dark py-2 hover:scale-105 duration-300">
                    {{__('Send')}}
                </button>
            </form>

            <!-- OR -->
            <div class="mt-6 grid grid-cols-3 items-center ">
                <hr class="border-gray-400">
                <p class="text-center text-sm">OR</p>
                <hr class="border-gray-400">
            </div>

            <!-- DONT HAVE AN ACCOUNT -->
            <div class="mt-3 text-xs flex justify-between items-center ">
                <p>Don't have an account?</p>
                <button class="py-2 px-5 bg-buttonColor dark:bg-buttonColor-dark rounded-xl hover:scale-110 duration-300 text-textColor dark:text-textColor-dark" >
                    <a href="{{route('register')}}" class="{{Route::is('register') ? "active": '' }}">{{__('Sign up')}}</a>
                </button>
            </div>
        </div>

        <!-- image -->
        <div class="relative w-1/2 ">
            <img class=" h-full hidden rounded-r-2xl md:block object-cover" src="{{ asset('images/login.jpg')}}" alt="">
            <!-- text on image  -->
            <div class="absolute hidden md:block top-0 left-0 w-full text-center p-10">
					<span class="text-white text-lg bg-black bg-opacity-50 p-2 rounded">
						Thank you for using our site!
					</span>
            </div>
        </div>
    </div>
</section>

@endsection
