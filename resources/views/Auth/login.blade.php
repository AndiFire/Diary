@extends('layouts.auth')
@section('auth.content')

	{{-- <div class="flex min-h-screen items-center justify-center">
		<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
			<div>
				<a {{Route::is('home') ? 'active': ''}} href="{{ route('home')}}">

				</a>
			</div>

			<div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
				<!-- Session Status -->
				<div class="mb-4 font-medium text-sm text-green-600">
					{{ session('status') }}
				</div>

				<!-- Validation Errors -->
				@if ($errors->any())
					<div class="mb-4">
						<div class="font-medium text-red-600">
							{{ __('Whoops! Something went wrong.') }}
						</div>

						<ul class="mt-3 list-disc list-inside text-sm text-red-600">
							@foreach ($errors->all() as $error)
								<li>{{ $error }}</li>
							@endforeach
						</ul>
					</div>
				@endif

				<form method="POST" action="{{ route('login.store') }}">
				@csrf

				<!-- Email Address -->
					<div>
						<label for="email" class="block font-medium text-sm text-gray-700">
							{{ __('Email') }}
						</label>

						<input id="email" name="email" type="email" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" value="{{ old('email') }}" required autofocus>
					</div>

					<!-- Password -->
					<div class="mt-4">
						<label for="password" class="block font-medium text-sm text-gray-700">
							{{ __('Password') }}
						</label>

						<input id="password" name="password" type="password" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required autocomplete="current-password">
					</div>

					<!-- Remember Me -->
					<div class="block mt-4">
						<label for="remember_me" class="inline-flex items-center">
							<input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
							<span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
						</label>
					</div>

					<div class="flex items-center justify-end mt-4">
						@if (Route::has('password.request'))
							<a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
								{{ __('Forgot your password?') }}
							</a>
						@endif

						<button type="submit" class="ml-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
							{{ __('Log in') }}
						</button>
					</div>
				</form>
			</div>
		</div>
		<div class="flex relative flex-grow dark:bg-gray-100">
			<img src="" alt="img">
		</div>
	</div> --}}

	<section class=" min-h-screen flex items-center justify-center">
		<!-- login container -->
		<div class="relative bg-blue-200  dark:bg-zinc-800 flex  rounded-2xl shadow-lg max-w-3xl  ">

		  <!-- form -->
			<div class="md:w-1/2 px-8 py-8 ">

                @if ($errors->has('error-login'))
                    <div class="mb-4 flex items-center justify-center p-2 border-2 rounded-xl border-red-600 bg-red-100">
                        <svg class="mr-2 text-red-600" fill="currentColor" width="20" height="20" viewBox="-1.7 0 20.4 20.4" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.406 10.283a7.917 7.917 0 1 1-7.917-7.917 7.916 7.916 0 0 1 7.917 7.917zM9.48 14.367a1.003 1.003 0 1 0-1.004 1.003 1.003 1.003 0 0 0 1.004-1.003zM7.697 11.53a.792.792 0 0 0 1.583 0V5.262a.792.792 0 0 0-1.583 0z"/>
                        </svg>
                        <h3 class="text-red-600 font-bold text-sm">{{ $errors->first('error-login') }}</h3>
                    </div>
                @endif


				<h2 class="font-bold text-2xl text-blue-500">Login</h2>
				<p class="text-xs mt-4 text-blue-500 ">If you are already a member, easily log in</p>

				<!-- DATAS -->
				<form method="POST" action="{{ route('login') }}" class="flex flex-col gap-4">
					@csrf
                    <div>
                        <input class="w-full p-2 mt-8 rounded-xl border {{$errors->has('email') ? 'border-red-600 placeholder-red-600' : 'p-2 rounded-xl border'}}" type="email" name="email" placeholder="Email" value="{{ old('email') }}">
                        @error('email')
                            <p class="pt-1 text-red-600 text-xs">{{$message}}</p>
                        @enderror
                    </div>

                    <div>
                        <div class="relative">
                            <div>
                                <input class="p-2 rounded-xl border w-full {{$errors->has('password') ? 'border-red-600 placeholder-red-600' : 'p-2 rounded-xl border'}}" id="password" type="password" name="password" placeholder="Password" >

                                <div>
                                    <svg class="absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer eye-open hidden " width="16" height="16" fill="gray" viewBox="0 0 24 24" onclick="togglePasswordVisibility()" xmlns="http://www.w3.org/2000/svg" >
                                        <path d="M12 8.25C9.92893 8.25 8.25 9.92893 8.25 12C8.25 14.0711 9.92893 15.75 12 15.75C14.0711 15.75 15.75 14.0711 15.75 12C15.75 9.92893 14.0711 8.25 12 8.25ZM9.75 12C9.75 10.7574 10.7574 9.75 12 9.75C13.2426 9.75 14.25 10.7574 14.25 12C14.25 13.2426 13.2426 14.25 12 14.25C10.7574 14.25 9.75 13.2426 9.75 12Z" fill="#1C274C"/>
                                        <path d="M12 3.25C7.48587 3.25 4.44529 5.9542 2.68057 8.24686L2.64874 8.2882C2.24964 8.80653 1.88206 9.28392 1.63269 9.8484C1.36564 10.4529 1.25 11.1117 1.25 12C1.25 12.8883 1.36564 13.5471 1.63269 14.1516C1.88206 14.7161 2.24964 15.1935 2.64875 15.7118L2.68057 15.7531C4.44529 18.0458 7.48587 20.75 12 20.75C16.5141 20.75 19.5547 18.0458 21.3194 15.7531L21.3512 15.7118C21.7504 15.1935 22.1179 14.7161 22.3673 14.1516C22.6344 13.5471 22.75 12.8883 22.75 12C22.75 11.1117 22.6344 10.4529 22.3673 9.8484C22.1179 9.28391 21.7504 8.80652 21.3512 8.28818L21.3194 8.24686C19.5547 5.9542 16.5141 3.25 12 3.25ZM3.86922 9.1618C5.49864 7.04492 8.15036 4.75 12 4.75C15.8496 4.75 18.5014 7.04492 20.1308 9.1618C20.5694 9.73159 20.8263 10.0721 20.9952 10.4545C21.1532 10.812 21.25 11.2489 21.25 12C21.25 12.7511 21.1532 13.188 20.9952 13.5455C20.8263 13.9279 20.5694 14.2684 20.1308 14.8382C18.5014 16.9551 15.8496 19.25 12 19.25C8.15036 19.25 5.49864 16.9551 3.86922 14.8382C3.43064 14.2684 3.17374 13.9279 3.00476 13.5455C2.84684 13.188 2.75 12.7511 2.75 12C2.75 11.2489 2.84684 10.812 3.00476 10.4545C3.17374 10.0721 3.43063 9.73159 3.86922 9.1618Z" fill="#1C274C"/>
                                    </svg>
                                    <svg  class="absolute top-1/2 right-3 -translate-y-1/2 cursor-pointer eye-closed" width="16" height="16" viewBox="0 0 24 24" fill="gray" onclick="togglePasswordVisibility()" xmlns="http://www.w3.org/2000/svg" >
                                        <path d="M2.68936 6.70456C2.52619 6.32384 2.08528 6.14747 1.70456 6.31064C1.32384 6.47381 1.14747 6.91472 1.31064 7.29544L2.68936 6.70456ZM15.5872 13.3287L15.3125 12.6308L15.5872 13.3287ZM9.04145 13.7377C9.26736 13.3906 9.16904 12.926 8.82185 12.7001C8.47466 12.4742 8.01008 12.5725 7.78417 12.9197L9.04145 13.7377ZM6.37136 15.091C6.14545 15.4381 6.24377 15.9027 6.59096 16.1286C6.93815 16.3545 7.40273 16.2562 7.62864 15.909L6.37136 15.091ZM22.6894 7.29544C22.8525 6.91472 22.6762 6.47381 22.2954 6.31064C21.9147 6.14747 21.4738 6.32384 21.3106 6.70456L22.6894 7.29544ZM19 11.1288L18.4867 10.582V10.582L19 11.1288ZM19.9697 13.1592C20.2626 13.4521 20.7374 13.4521 21.0303 13.1592C21.3232 12.8663 21.3232 12.3914 21.0303 12.0985L19.9697 13.1592ZM11.25 16.5C11.25 16.9142 11.5858 17.25 12 17.25C12.4142 17.25 12.75 16.9142 12.75 16.5H11.25ZM16.3714 15.909C16.5973 16.2562 17.0619 16.3545 17.409 16.1286C17.7562 15.9027 17.8545 15.4381 17.6286 15.091L16.3714 15.909ZM5.53033 11.6592C5.82322 11.3663 5.82322 10.8914 5.53033 10.5985C5.23744 10.3056 4.76256 10.3056 4.46967 10.5985L5.53033 11.6592ZM2.96967 12.0985C2.67678 12.3914 2.67678 12.8663 2.96967 13.1592C3.26256 13.4521 3.73744 13.4521 4.03033 13.1592L2.96967 12.0985ZM12 13.25C8.77611 13.25 6.46133 11.6446 4.9246 9.98966C4.15645 9.16243 3.59325 8.33284 3.22259 7.71014C3.03769 7.3995 2.90187 7.14232 2.8134 6.96537C2.76919 6.87696 2.73689 6.80875 2.71627 6.76411C2.70597 6.7418 2.69859 6.7254 2.69411 6.71533C2.69187 6.7103 2.69036 6.70684 2.68957 6.70503C2.68917 6.70413 2.68896 6.70363 2.68892 6.70355C2.68891 6.70351 2.68893 6.70357 2.68901 6.70374C2.68904 6.70382 2.68913 6.70403 2.68915 6.70407C2.68925 6.7043 2.68936 6.70456 2 7C1.31064 7.29544 1.31077 7.29575 1.31092 7.29609C1.31098 7.29624 1.31114 7.2966 1.31127 7.2969C1.31152 7.29749 1.31183 7.2982 1.31218 7.299C1.31287 7.30062 1.31376 7.30266 1.31483 7.30512C1.31698 7.31003 1.31988 7.31662 1.32353 7.32483C1.33083 7.34125 1.34115 7.36415 1.35453 7.39311C1.38127 7.45102 1.42026 7.5332 1.47176 7.63619C1.57469 7.84206 1.72794 8.13175 1.93366 8.47736C2.34425 9.16716 2.96855 10.0876 3.8254 11.0103C5.53867 12.8554 8.22389 14.75 12 14.75V13.25ZM15.3125 12.6308C14.3421 13.0128 13.2417 13.25 12 13.25V14.75C13.4382 14.75 14.7246 14.4742 15.8619 14.0266L15.3125 12.6308ZM7.78417 12.9197L6.37136 15.091L7.62864 15.909L9.04145 13.7377L7.78417 12.9197ZM22 7C21.3106 6.70456 21.3107 6.70441 21.3108 6.70427C21.3108 6.70423 21.3108 6.7041 21.3109 6.70402C21.3109 6.70388 21.311 6.70376 21.311 6.70368C21.3111 6.70352 21.3111 6.70349 21.3111 6.7036C21.311 6.7038 21.3107 6.70452 21.3101 6.70576C21.309 6.70823 21.307 6.71275 21.3041 6.71924C21.2983 6.73223 21.2889 6.75309 21.2758 6.78125C21.2495 6.83757 21.2086 6.92295 21.1526 7.03267C21.0406 7.25227 20.869 7.56831 20.6354 7.9432C20.1669 8.69516 19.4563 9.67197 18.4867 10.582L19.5133 11.6757C20.6023 10.6535 21.3917 9.56587 21.9085 8.73646C22.1676 8.32068 22.36 7.9668 22.4889 7.71415C22.5533 7.58775 22.602 7.48643 22.6353 7.41507C22.6519 7.37939 22.6647 7.35118 22.6737 7.33104C22.6782 7.32097 22.6818 7.31292 22.6844 7.30696C22.6857 7.30398 22.6867 7.30153 22.6876 7.2996C22.688 7.29864 22.6883 7.29781 22.6886 7.29712C22.6888 7.29677 22.6889 7.29646 22.689 7.29618C22.6891 7.29604 22.6892 7.29585 22.6892 7.29578C22.6893 7.29561 22.6894 7.29544 22 7ZM18.4867 10.582C17.6277 11.3882 16.5739 12.1343 15.3125 12.6308L15.8619 14.0266C17.3355 13.4466 18.5466 12.583 19.5133 11.6757L18.4867 10.582ZM18.4697 11.6592L19.9697 13.1592L21.0303 12.0985L19.5303 10.5985L18.4697 11.6592ZM11.25 14V16.5H12.75V14H11.25ZM14.9586 13.7377L16.3714 15.909L17.6286 15.091L16.2158 12.9197L14.9586 13.7377ZM4.46967 10.5985L2.96967 12.0985L4.03033 13.1592L5.53033 11.6592L4.46967 10.5985Z" fill="#1C274C"/>
                                    </svg>
                                </div>
                            </div>
                        </div>
                        @error('password')
                            <p class="pt-1 text-red-600 text-xs">{{$message}}</p>
                        @enderror
                    </div>

                    <!--REMEMBER ME-->
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="remember" name="remember" class="focus:outline-none rounded-full">
                        <label for="remember" class="text-white text-sm">Remember me</label>
                    </div>

					<button type="submit" class="bg-[#002D74] rounded-xl text-white py-2 hover:scale-105 duration-300">
                        {{__('Login')}}
					</button>
				</form>

				<!-- OR -->
				<div class="mt-6 grid grid-cols-3 items-center text-gray-400">
					<hr class="border-gray-400">
						<p class="text-center text-sm">OR</p>
					<hr class="border-gray-400">
				</div>

				<!-- LOGIN ELSE -->
				<button class="bg-white border py-2 w-full rounded-xl mt-5 flex justify-center items-center text-sm hover:scale-105 duration-300 text-[#002D74]">
					<svg class="mr-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="25px">
						<path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z" />
						<path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z" />
						<path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z" />
						<path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z" />
					</svg>
					Login with Google
				</button>

				<!-- FORGOT PASSWORD -->

				 @if (Route::has('password.request'))
					<div class="mt-3 text-xs flex justify-between items-center text-blue-500">
                        <p>Forgot your password?</p>

                        <button class="py-2 px-5 bg-white border rounded-xl hover:scale-110 duration-300 text-[#002D74]">
                            <a href="{{ route('password.request') }}">
                                {{ __('Change') }}
                            </a>
                        </button>
					</div>
				@endif

				<!-- DONT HAVE AN ACCOUNT -->
				<div class="mt-1 text-xs flex justify-between items-center text-blue-500">
					<p>Don't have an account?</p>
					<button class="py-2 px-5 bg-white border rounded-xl hover:scale-110 duration-300 text-[#002D74]" >
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
