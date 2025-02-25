@extends('layouts.user')

@section('content')
    <main class="max-w-8xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Kategori Produk</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 lg:gap-6">
            @foreach ($categories as $category)
                <div class="bg-white rounded-lg shadow p-4 lg:p-6 hover:shadow-lg transition-shadow">
                    <h2 class="text-xl font-semibold mb-4 text-red-600">
                        <i class="{{ $category->icon }} mr-2"></i>
                        {{ $category->name }}
                    </h2>
                    <ul class="space-y-3">
                        @foreach ($category->subCategories as $sub)
                            <li>
                                <a href="{{ route('category', ['slug' => $sub->slug]) }}"
                                    class="text-black hover:scale-105 block duration-200">{{ $sub->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </main>
@endsection
