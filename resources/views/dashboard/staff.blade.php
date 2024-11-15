@extends('layout.default.dashboard')
@section('content')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
        <div class="sm:hidden">
            <label for="tabs" class="sr-only">Select tab</label>
            <select id="tabs" class="bg-gray-50 border-0 border-b border-gray-200 text-gray-900 text-sm rounded-t-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                <option>Statistics</option>
                <option>Request Stok Task</option>
                <option>Task Today</option>
            </select>
        </div>
        <ul class="hidden text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg sm:flex dark:divide-gray-600 dark:text-gray-400 rtl:divide-x-reverse" id="fullWidthTab" data-tabs-toggle="#fullWidthTabContent" role="tablist">
            <li class="w-full">
                <button id="stats-tab" data-tabs-target="#stats" type="button" role="tab" aria-controls="stats" aria-selected="true" class="inline-block w-full p-4 rounded-ss-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Statistics</button>
            </li>
            <li class="w-full">
                <button id="task-tab" data-tabs-target="#task" type="button" role="tab" aria-controls="stats" aria-selected="false" class="inline-block w-full p-4 bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Task</button>
            </li>
            <li class="w-full">
                <button id="faq-tab" data-tabs-target="#faq" type="button" role="tab" aria-controls="faq" aria-selected="false" class="inline-block w-full p-4 rounded-se-lg bg-gray-50 hover:bg-gray-100 focus:outline-none dark:bg-gray-700 dark:hover:bg-gray-600">Task Today</button>
            </li>
        </ul>

        {{-- Statistik --}}
        <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
            <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
                <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="stats" role="tabpanel" aria-labelledby="stats-tab">
                    <!-- Container untuk kedua card -->
                    <div class="flex space-x-4 items-start">
                        <div class="flex flex-col space-y-4">
                            <!-- Card 1 -->
                            <div class="max-w-sm p-6 bg-blue-500 border border-gray-200 rounded-lg shadow dark:bg-blue-800 dark:hover:bg-blue-600 dark:border-gray-700">
                                <svg class="w-7 h-7 text-gray-100 dark:text-gray-200 mb-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path stroke="currentColor" strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 6c0 1.657-3.134 3-7 3S5 7.657 5 6m14 0c0-1.657-3.134-3-7-3S5 4.343 5 6m14 0v6M5 6v6m0 0c0 1.657 3.134 3 7 3s7-1.343 7-3M5 12v6c0 1.657 3.134 3 7 3s7-1.343 7-3v-6"/>
                                </svg>
                                <a href="#">
                                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-white dark:text-white">Jumlah Produk</h5>
                                </a>
                                <h1 class="mb-3 font-normal text-gray-100 dark:text-gray-300"> {{ $productCount }} </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      

            {{-- Task --}}
            <div id="fullWidthTabContent" class="border-t border-gray-200 dark:border-gray-600">
                <div class="hidden p-4 bg-white dark:bg-gray-800" id="task" role="tabpanel" aria-labelledby="task-tab">
                    <!-- Container untuk kedua card -->

                @if($reqOut->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400">Tidak ada stok masuk hari ini.</p>
                @else

                <ol class="relative border-l border-gray-200 dark:border-gray-700 mt-4">
                    @foreach($reqOut as $stok)
                        <li class="mb-10 ml-6">
                            <div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:bg-gray-700 dark:border-gray-600">
                                <!-- Waktu transaksi -->
                                <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{ $stok->created_at->diffForHumans() }}</time>
                                
                                <!-- Deskripsi transaksi stok -->
                                <div class="text-sm font-normal text-gray-500 dark:text-gray-300">
                                    {{-- <span class="font-semibold text-blue-600 dark:text-blue-500 hover:underline">{{ $stok->user->name }}</span>  --}}
                                    Produk 
                                    <a href="{{ url('dashboard/activities/request/'.$stok->id) }}" class="font-semibold text-blue-600 dark:text-blue-500">{{ $stok->product->name }}</a> 
                                    {{-- <a  class="font-medium text-blue-600 dark:text-blue-500 hover:underline" data-modal-toggle="edit-user-modal" data-user-id="{{ $stok->id }}">Edit</a> --}}
                                    perlu disiapkan. Status saat ini adalah <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $stok->status }}</span>Barang <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $stok->type }}</span> 
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ol>
                @endif

                @if($reqIn->isEmpty())
                    <p class="text-gray-500 dark:text-gray-400">Tidak ada stok masuk hari ini.</p>
                @else

                <ol class="relative border-l border-gray-200 dark:border-gray-700 mt-4">
                    @foreach($reqIn as $stok)
                        <li class="mb-10 ml-6">
                            <div class="flex items-center justify-between p-4 bg-white border border-gray-200 rounded-lg shadow-sm sm:flex dark:bg-gray-700 dark:border-gray-600">
                                <!-- Waktu transaksi -->
                                <time class="mb-1 text-xs font-normal text-gray-400 sm:order-last sm:mb-0">{{ $stok->created_at->diffForHumans() }}</time>
                                
                                <!-- Deskripsi transaksi stok -->
                                <div class="text-sm font-normal text-gray-500 dark:text-gray-300">
                                    {{-- <span class="font-semibold text-blue-600 dark:text-blue-500 hover:underline">{{ $stok->user->name }}</span>  --}}
                                    Produk 
                                    <a href="{{ url('dashboard/activities/request/'.$stok->id) }}" class="font-semibold text-blue-600 dark:text-blue-500">{{ $stok->product->name }}</a> 
                                    {{-- <a  class="font-medium text-blue-600 dark:text-blue-500 hover:underline" data-modal-toggle="edit-user-modal" data-user-id="{{ $stok->id }}">Edit</a> --}}
                                    perlu diperiksa. Status saat ini adalah <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $stok->status }}</span>Barang <span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300">{{ $stok->type }}</span> 
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ol>
                @endif
                </div>
            </div>        
            <div class="hidden p-4 bg-white rounded-lg md:p-8 dark:bg-gray-800" id="about" role="tabpanel" aria-labelledby="about-tab">
                <h2 class="mb-4 text-2xl font-extrabold text-gray-900 dark:text-white md:text-2xl lg:text-2xl"><span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-400 to-blue-500">Stok Masuk Hari Ini</span></h2>
                <!-- List -->
            </div>
            <div class="hidden p-4 bg-white rounded-lg dark:bg-gray-800" id="faq" role="tabpanel" aria-labelledby="faq-tab">
                    <h2 class="mb-5 text-2xl font-extrabold tracking-tight text-gray-900 dark:text-white">Riwayat Aktivitas User</h2>            
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
