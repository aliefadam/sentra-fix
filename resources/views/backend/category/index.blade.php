@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'current' => 'Daftar Kategori',
        ])
        <a href="{{ route('admin.category.create') }}"
            class="text-white bg-pink-600 border border-pink-600 hover:bg-pink-700 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5">
            <i class="fas fa-plus mr-1.5"></i> Tambah Kategori
        </a>
    </div>

    <div class="mt-5">


        <div class="relative overflow-x-auto rounded-md bg-white shadow-md">
            <table id="data-table" class="w-full text-sm text-left rtl:text-right text-gray-700 dark:text-gray-400">
                <thead class="text-xs text-pink-600 uppercase bg-white dark:bg-gray-700 dark:text-gray-400">
                    <tr class="bg-white border-b border-t border-gray-200">
                        <th scope="col" class="px-6 py-4">
                            No
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Icon
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Nama Kategori
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Sub Kategori
                        </th>
                        <th scope="col" class="px-6 py-4">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="bg-white border-b border-gray-200">
                        <td class="px-6 py-4">
                            1
                        </td>
                        <td class="px-6 py-4">
                            <i class="fa-solid fa-laptop"></i>
                        </td>
                        <td class="px-6 py-4">
                            Laptop
                        </td>
                        <td class="px-6 py-4">
                            4
                        </td>
                        <td class="px-6 py-4 flex gap-4">
                            <a href="#" class="font-medium text-blue-600 hover:underline">Edit</a>
                            <a href="#" class="font-medium text-red-600 hover:underline">Hapus</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
