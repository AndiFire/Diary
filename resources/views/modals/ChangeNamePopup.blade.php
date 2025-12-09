
<!-- Main modal -->
<div id="name-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700 ">
            <div class="pt-1">
                @if (Session::has('success'))
                    <div class="m-4 mb-0 flex items-center justify-center p-2 border-2 rounded-xl border-green-400 bg-green-50">
                        <svg class="mr-2 w-4 h-4 text-green-400" fill="currentColor" xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 512 512">
                            <path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zM369 209L241 337c-9.4 9.4-24.6 9.4-33.9 0l-64-64c-9.4-9.4-9.4-24.6 0-33.9s24.6-9.4 33.9 0l47 47L335 175c9.4-9.4 24.6-9.4 33.9 0s9.4 24.6 0 33.9z"/>
                        </svg>
                        <h3 class="text-green-400 font-bold text-sm">{{ Session::get('success') }}</h3>
                    </div>
                @endif
            </div>

            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    Create a new strong password
                </h3>
                <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="name-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>

            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <form class="" method="POST" action="{{ route('name.change') }}" >
                    @csrf

                    <label for="new_name" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">New name</label>
                    <div class="relative">
                        <input id="new_name" type="text" name="new_name" placeholder="NicocadoAvocado123"
                               class=" {{$errors->has('new_name') ? 'border-red-600 placeholder-red-600 mb-1' : 'mb-4 p-2 border-gray-300 text-gray-900 dark:border-gray-500 dark:placeholder-gray-400'}}
                        bg-gray-50 border rounded-lg text-sm focus:border-blue-500 block w-full p-2 dark:bg-gray-600  dark:text-white"  >

                    </div>
                    @error('new_name')
                    <p class="mb-3 text-red-600 text-xs">{{$message}}</p>
                    @enderror

                    <label for="new_name_confirmation" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Confirm new name</label>
                    <div class="relative">
                        <input id="new_name_confirmation" type="text" name="new_name_confirmation" placeholder="NicocadoAvocado123"
                               class=" {{$errors->has('new_name') ? 'border-red-600 placeholder-red-600 mb-1' : 'mb-4 p-2 border-gray-300 text-gray-900 dark:border-gray-500 dark:placeholder-gray-400'}}
                        bg-gray-50 border rounded-lg text-sm focus:border-blue-500 block w-full p-2 dark:bg-gray-600  dark:text-white"  >

                    </div>

                    @error('new_name')
                    <p class="mb-3 text-red-600 text-xs">{{$message}}</p>
                    @enderror

                    <div class="flex justify-center">
                        <button id="save" type="submit" class="rounded-xl text-gray-200 py-1 px-6 hover:scale-105 duration-300 bg-gradient-to-r from-orange-600 to-fuchsia-600">
                            {{__('Save')}}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

