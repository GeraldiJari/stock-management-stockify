@extends('layout.default.baseof')
@section('main')
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@vite(['resources/css/app.css','resources/js/app.js'])
    @include('layout.partials.navbar-dashboard')
    <div class="flex pt-16 overflow-hidden bg-gray-50 dark:bg-gray-900">

      
      @include('layout.partials.sidebar')

      <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64 dark:bg-gray-900">
@if ($errors->any())
    <div x-data="{ show: true }" 
         x-show="show" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0 translate-y-4" 
         x-transition:enter-end="opacity-100 translate-y-0" 
         x-transition:leave="transition ease-in duration-300" 
         x-transition:leave-start="opacity-100 translate-y-0" 
         x-transition:leave-end="opacity-0 translate-y-4" 
         class="fixed top-5 right-5 z-50 max-w-sm p-4 bg-red-100 border border-red-400 rounded-lg shadow-lg" 
         x-init="setTimeout(() => { show = false }, 5000)"> <!-- 5 detik -->
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v8m0 4h.01M21 12c0 4.418-3.582 8-8 8S5 16.418 5 12s3.582-8 8-8 8 3.582 8 8z"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="font-medium text-red-700">Ada beberapa kesalahan:</p>
                <ul class="mt-1 text-sm text-red-600">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            <button @click="show = false" class="ml-auto -mx-1.5 -my-1.5 bg-transparent hover:bg-red-300 rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-500 focus:ring-white">
                <span class="sr-only">Tutup</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
@endif

@if (session('error'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0 translate-y-4" 
         x-transition:enter-end="opacity-100 translate-y-0" 
         x-transition:leave="transition ease-in duration-300" 
         x-transition:leave-start="opacity-100 translate-y-0" 
         x-transition:leave-end="opacity-0 translate-y-4" 
         class="fixed top-5 right-5 z-50 max-w-sm p-4 bg-red-100 border border-red-400 rounded-lg shadow-lg" 
         x-init="setTimeout(() => { show = false }, 5000)">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v8m0 4h.01M21 12c0 4.418-3.582 8-8 8S5 16.418 5 12s3.582-8 8-8 8 3.582 8 8z"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="font-medium text-red-700">Kesalahan:</p>
                <p class="mt-1 text-sm text-red-600">
                    {{ session('error') }}
                </p>
            </div>
            <button @click="show = false" class="ml-auto -mx-1.5 -my-1.5 bg-transparent hover:bg-red-300 rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-red-500 focus:ring-white">
                <span class="sr-only">Tutup</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
@endif

@if (session('success'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0 translate-y-4" 
         x-transition:enter-end="opacity-100 translate-y-0" 
         x-transition:leave="transition ease-in duration-300" 
         x-transition:leave-start="opacity-100 translate-y-0" 
         x-transition:leave-end="opacity-0 translate-y-4" 
         class="fixed top-5 right-5 z-50 max-w-sm p-4 bg-green-100 border border-green-400 rounded-lg shadow-lg" 
         x-init="setTimeout(() => { show = false }, 5000)">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m1-1a9 9 0 10-2 2 9 9 0 001-1z"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="font-medium text-green-700">Berhasil:</p>
                <p class="mt-1 text-sm text-green-600">
                    {{ session('success') }}
                </p>
            </div>
            <button @click="show = false" class="ml-auto -mx-1.5 -my-1.5 bg-transparent hover:bg-green-300 rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-500 focus:ring-white">
                <span class="sr-only">Tutup</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
@endif

@if (session('success'))
    <div x-data="{ show: true }" 
         x-show="show" 
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0 translate-y-4" 
         x-transition:enter-end="opacity-100 translate-y-0" 
         x-transition:leave="transition ease-in duration-300" 
         x-transition:leave-start="opacity-100 translate-y-0" 
         x-transition:leave-end="opacity-0 translate-y-4" 
         class="fixed top-5 right-5 z-50 max-w-sm p-4 bg-green-100 border border-green-400 rounded-lg shadow-lg" 
         x-init="setTimeout(() => { show = false }, 5000)"> <!-- 5 detik -->
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="font-medium text-green-700">Sukses:</p>
                <p class="mt-1 text-sm text-green-600">{{ session('success') }}</p>
            </div>
            <button @click="show = false" class="ml-auto -mx-1.5 -my-1.5 bg-transparent hover:bg-green-300 rounded-md p-1.5 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-500 focus:ring-white">
                <span class="sr-only">Tutup</span>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    </div>
@endif




          @yield('content')
      </div>
    </div>
@endsection
