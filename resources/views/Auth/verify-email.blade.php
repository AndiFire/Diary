@extends('layouts.auth')
@section('auth.content')
    <section class="min-h-screen flex items-center justify-center">
        <!-- login container -->

            <!-- form -->
            <div class="relative px-8 py-8 bg-white dark:bg-zinc-800 rounded-xl">

                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 flex items-center justify-center p-2 border-2 rounded-xl border-amber-500 bg-amber-100">
                        <svg class="mr-2 text-amber-500" fill="currentColor" width="20" height="20" viewBox="-1.7 0 20.4 20.4" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.406 10.283a7.917 7.917 0 1 1-7.917-7.917 7.916 7.916 0 0 1 7.917 7.917zM9.48 14.367a1.003 1.003 0 1 0-1.004 1.003 1.003 1.003 0 0 0 1.004-1.003zM7.697 11.53a.792.792 0 0 0 1.583 0V5.262a.792.792 0 0 0-1.583 0z"/>
                        </svg>
                        <h3 class="text-amber-500 font-bold text-sm">We have send your email verification link.</h3>
                    </div>
                @endif

                <div class="mb-5">
                    <svg class="w-full mb-4 text-blue-500" fill="currentColor" height="80" width="40" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 75.294 75.294">
                        <g>
                                <path d="M66.097,12.089h-56.9C4.126,12.089,0,16.215,0,21.286v32.722c0,5.071,4.126,9.197,9.197,9.197h56.9
                                    c5.071,0,9.197-4.126,9.197-9.197V21.287C75.295,16.215,71.169,12.089,66.097,12.089z M61.603,18.089L37.647,33.523L13.691,18.089
                                    H61.603z M66.097,57.206h-56.9C7.434,57.206,6,55.771,6,54.009V21.457l29.796,19.16c0.04,0.025,0.083,0.042,0.124,0.065
                                    c0.043,0.024,0.087,0.047,0.131,0.069c0.231,0.119,0.469,0.215,0.712,0.278c0.025,0.007,0.05,0.01,0.075,0.016
                                    c0.267,0.063,0.537,0.102,0.807,0.102c0.001,0,0.002,0,0.002,0c0.002,0,0.003,0,0.004,0c0.27,0,0.54-0.038,0.807-0.102
                                    c0.025-0.006,0.05-0.009,0.075-0.016c0.243-0.063,0.48-0.159,0.712-0.278c0.044-0.022,0.088-0.045,0.131-0.069
                                    c0.041-0.023,0.084-0.04,0.124-0.065l29.796-19.16v32.551C69.295,55.771,67.86,57.206,66.097,57.206z"/>
                            </g>
                    </svg>

                    <h2 class="flex items-center justify-center font-bold text-4xl text-blue-500">Verify Email</h2>
                    <p class="flex justify-center text-sm mt-4 text-gray-200 border-t border-white pt-4">If you haven't received the email, you can easily resend it. </p>
                </div>

                <div class="rounded-xl">
                    <!-- DATAS -->
                    <form method="POST" action="{{route('verification.send')}}" class="flex flex-col pt-4">
                        @csrf

                        <button type="submit" class="font-bold bg-[#002D74] rounded-xl text-gray-200 text-xl py-2 px-24 hover:scale-105 duration-300 ">
                                {{__('Send verification email')}}
                        </button>
                    </form>
                </div>

        </div>
    </section>

@endsection
