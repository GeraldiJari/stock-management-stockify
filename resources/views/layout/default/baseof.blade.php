<!doctype html>
<html lang="en" class="dark">
  <head>
    @include('layout.partials.header')
  </head>
  @php
    $whiteBg = isset($params['white_bg']) && $params['white_bg'];
  @endphp


<body class="{{ $whiteBg ? 'bg-white dark:bg-gray-900' : 'bg-gray-50 dark:bg-gray-800' }}">

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
  @yield('main')
  @include('layout.partials.scripts')
</body>
    <!-- Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="{{asset('js/ajaxscript.js')}}"></script>
</html>
