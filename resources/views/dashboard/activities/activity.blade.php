@extends('layout.default.dashboard')

@section('content')
<div class="container">
    <h1 class="text-2xl font-semibold mb-4">Riwayat Aktivitas Pengguna</h1>

    <!-- Timeline untuk Aktivitas -->
    <ol class="relative border-l border-gray-200 dark:border-gray-700">
        @foreach($activities as $activity)
            <li class="mb-10 ml-6">
                <div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:bg-gray-700 dark:border-gray-600">
                    <!-- Waktu aktivitas -->
                    <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{ $activity->created_at->diffForHumans() }}</time>

                    <!-- Deskripsi aktivitas -->
                    <div class="text-sm font-normal text-gray-500 dark:text-gray-300">
                        <span class="font-semibold text-blue-600 dark:text-blue-500 hover:underline">{{ $activity->user->name }}</span> 
                        {{ ucfirst($activity->activity) }} 
                        @if($activity->target_type) 
                            <a href="#" class="font-semibold text-blue-600 dark:text-blue-500">{{ class_basename($activity->target_type) }}</a> 
                        @endif
                        @if($activity->description)
                            <div class="p-3 mt-2 text-xs italic font-normal text-gray-500 border border-gray-200 rounded-lg bg-gray-50 dark:bg-gray-600 dark:border-gray-500 dark:text-gray-300">
                                {{ $activity->description }}
                            </div>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    </ol>
</div>
@endsection
