@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-gray-50 to-white">
    <div class="max-w-7xl mx-auto p-6 sm:p-10">
        <div class="flex flex-col items-center justify-between space-y-4 md:flex-row md:space-y-0 md:space-x-4 mb-8">
            <div>
                <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Admin Dashboard
                </h1>
                <p class="mt-2 text-gray-500">Overview of your e-commerce performance</p>
            </div>
            <div class="flex items-center space-x-2">
                <button class="inline-flex items-center px-3 py-2 border border-gray-300 shadow-sm text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Today
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Total Products -->
            <div class="bg-white overflow-hidden rounded-lg border-none shadow-md hover:shadow-xl transition-all duration-300">
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 px-6 py-4">
                    <div class="flex items-center justify-between">
<div class="text-4xl font-bold text-gray-800">{{ $totalProducts }}</div>
                        <div class="inline-flex items-center justify-center p-2 bg-emerald-100 rounded-full">
                            <i class="fas fa-box text-emerald-600"></i>
                        </div>
                    </div>
                    <div class="text-emerald-600/70 text-sm">All available products</div>
                </div>
                <div class="px-6 py-4">
                    <div class="flex items-baseline">
                        <div class="text-4xl font-bold text-gray-800"></div>
                        <div class="ml-2 text-sm font-medium text-emerald-600"></div>
                    </div>
                    <div class="mt-4 h-1 w-full bg-gray-200 rounded-full overflow-hidden">
                        <div class="bg-emerald-500 h-full rounded-full" style="width: 75%"></div>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="bg-white overflow-hidden rounded-lg border-none shadow-md hover:shadow-xl transition-all duration-300">
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4">
                    <div class="flex items-center justify-between">
<div class="text-4xl font-bold text-gray-800">{{ $totalOrders }}</div>
                        <div class="inline-flex items-center justify-center p-2 bg-blue-100 rounded-full">
                            <i class="fas fa-shopping-cart text-blue-600"></i>
                        </div>
                    </div>
                    <div class="text-blue-600/70 text-sm">All processed orders</div>
                </div>
                <div class="px-6 py-4">
                    <div class="flex items-baseline">
                        <div class="text-4xl font-bold text-gray-800"></div>
                        <div class="ml-2 text-sm font-medium text-blue-600"></div>
                    </div>
                    <div class="mt-4 h-1 w-full bg-gray-200 rounded-full overflow-hidden">
                        <div class="bg-blue-500 h-full rounded-full" style="width: 60%"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 flex justify-center">
            <a href="{{ route('admin.products.create') }}" 
               class="inline-flex items-center px-8 py-3 border border-transparent text-base font-medium rounded-lg shadow-lg text-white bg-gradient-to-r from-green-600 to-teal-600 hover:from-green-700 hover:to-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 transition-all duration-300">
                <span class="text-lg mr-1">+</span> Tambah Produk Baru
            </a>
        </div>

        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
        </div>
    </div>
</div>
@endsection
