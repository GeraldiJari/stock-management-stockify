@extends('layout.default.dashboard')
@section('content')
<h1>Edit Stock Transaction</h1>
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="#" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Home
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="javascript:history.back()" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Stock Transactions</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">Edit</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Edit Stock Transaction</h1>
        </div>
    </div>
</div>

<div class="mx-auto max-w-screen-xl px-4 2xl:px-0">
    <div class="mx-auto max-w-5xl">
        <div class="mt-6 sm:mt-8 lg:flex lg:items-start lg:gap-12">
            <form action="{{ route('stok.update', $transaction->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-6 grid grid-cols-2 gap-4">
                    <div class="col-span-2 sm:col-span-1">
                        <label for="product_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Product</label>
                        <input value="{{ $transaction->product->name }}" type="text" name="product_id" id="product_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" disabled>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">User</label>
                        <input value="{{ $transaction->user->name }}" type="text" name="user_id" id="user_id" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" disabled>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                        <select name="type" id="type" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                            <option value="Masuk" {{ $transaction->type == 'Masuk' ? 'selected' : '' }}>Masuk</option>
                            <option value="Keluar" {{ $transaction->type == 'Keluar' ? 'selected' : '' }}>Keluar</option>
                        </select>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock</label>
                        <input value="{{ $transaction->quantity }}" type="text" name="quantity" id="quantity" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date</label>
                        <input value="{{ $transaction->date }}" type="date" name="date" id="date" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" disabled>
                    </div>
                    <div class="col-span-2 sm:col-span-1">
                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                        <select name="status" id="status" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" required>
                            <option value="Pending" {{ $transaction->status == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Diterima" {{ $transaction->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="Ditolak" {{ $transaction->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="Dikeluarkan" {{ $transaction->status == 'Dikeluarkan' ? 'selected' : '' }}>Dikeluarkan</option>
                        </select>
                    </div>
                    <div class="col-span-2">
                        <label for="notes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Notes</label>
                        <textarea name="notes" id="notes" rows="4" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg block w-full p-2.5" disabled>{{ $transaction->notes }}</textarea>
                    </div>
                </div>
                <button type="submit" class="flex w-full items-center justify-center rounded-lg bg-primary-700 px-5 py-2.5 text-sm font-medium text-white hover:bg-primary-800 focus:outline-none focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
