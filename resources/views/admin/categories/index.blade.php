@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 px-4 sm:px-6 lg:px-8">
    <div class="bg-white rounded-xl shadow-md overflow-hidden">
        <!-- Header with gradient background -->
        <div class="bg-gradient-to-r from-green-600 to-green-400 px-6 py-5">
            <div class="flex justify-between items-center">
                <h3 class="text-2xl font-bold text-white">Kelola Kategori</h3>
                <form action="{{ route('categories.quickAdd') }}" method="POST" class="flex flex-col sm:flex-row items-start sm:items-center gap-3">
                    @csrf
                    <input type="text" name="name" placeholder="Nama Kategori" required
                           class="flex-1 w-full border border-gray-300 rounded px-4 py-2 focus:ring-2 focus:ring-green-500">
                    <button type="submit"
                            class="bg-green-600 text-white px-5 py-2 rounded hover:bg-green-700 transition">
                        Tambah
                    </button>
                </form>
            </div>
        </div>
        


        <!-- Success message -->
        @if(session('success'))
            <div class="mx-6 mt-4 bg-green-50 border-l-4 border-green-500 text-green-700 p-4 rounded-md flex items-start">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-3 mt-0.5 flex-shrink-0" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <!-- Categories table -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Nama Kategori</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach ($categories as $category)
                    <tr class="hover:bg-gray-50 transition-colors duration-150 ease-in-out">
                        <td class="px-6 py-4 whitespace-nowrap text-gray-700">
                            <div class="flex items-center">
                                <div class="h-8 w-8 flex-shrink-0 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                    <span class="text-green-600 font-medium">{{ substr($category->name, 0, 1) }}</span>
                                </div>
                                <span class="font-medium">{{ $category->name }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm">
                            <div class="flex justify-end space-x-3">
                                <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600 hover:text-blue-800 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit
                                </a>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                    @if(count($categories) == 0)
                    <tr>
                        <td colspan="2" class="px-6 py-10 text-center text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mx-auto mb-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                            <p>Belum ada kategori yang tersedia</p>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <!-- Pagination if needed -->
        @if(method_exists($categories, 'links') && $categories->hasPages())
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
            {{ $categories->links() }}
        </div>
        @endif
    </div>
</div>
@endsection
