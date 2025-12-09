@extends('layouts.base')
<script src="{{ asset('js/Auth/hidePass.js') }}"></script>
<script src="{{ asset('js/Auth/activeRoute.js') }}"></script>

@section('content')
	<body class="max-w-screen-xl overflow-y-hidden flex-wrap mx-auto bg-[url('/public/images/intro6.avif')]">
		@include('includes.nav')
		<div class="font-sans text-gray-900 ">
			@yield('auth.content')
		</div>
	</body>
@endsection
