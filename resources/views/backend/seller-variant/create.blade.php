@extends('layouts.admin')

@section('content')
    <div class="flex justify-between items-start">
        @include('partials.breadcrumb', [
            'before' => [
                'name' => 'Daftar Varian',
                'url' => route('seller.variant.index'),
            ],
            'current' => $title,
        ])
    </div>

    <form action="{{ route('seller.variant.store') }}" method="POST">
        @csrf
        <div class="mt-5 w-1/2">
            <div class=" bg-white shadow-md rounded-md p-5 mb-5">
                <h1 class="text-lg mb-5 poppins-medium">Varian Utama</h1>
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Varian</label>
                    <input type="text" id="name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        required />
                </div>
            </div>
            <div class="bg-white shadow-md rounded-md p-5">
                <div class="flex justify-between items-center">
                    <h1 class="text-lg mb-5 poppins-medium">Detail Varian</h1>
                    <button type="button" id="add-sub-variant"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5">
                        <i class="fa-solid fa-plus"></i>
                    </button>
                </div>
                <div class="mb-5">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Detail Varian
                    </label>
                    <input type="text" id="name" name="detail_variant_name[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-red-500 dark:focus:border-red-500"
                        required />
                </div>
                <div id="more-sub-variant"></div>
            </div>
            <div class="mt-5">
                <button type="submit"
                    class="w-full text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">Tambah</button>
            </div>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $("#add-sub-variant").click(addSubvariant);
        $(".btn-delete-sub-variant").click(deleteSubvariant);

        function addSubvariant() {
            const subvariant = `
            <div class="mb-5 flex items-end gap-4">
                <div class="w-full">
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Nama Detail Varian
                    </label>
                    <input type="text" id="name" name="detail_variant_name[]"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-red-500 focus:border-red-500 block w-full p-2.5"
                        required />
                </div>
                <div class="">
                    <button type="button"
                        class="btn-delete-sub-variant bg-white border border-red-700 text-red-700 hover:bg-red-100 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-3">
                        <i class="fa-solid fa-trash"></i>
                    </button>
                </div>
            </div>
            `;

            $("#more-sub-variant").append(subvariant);
            $(".btn-delete-sub-variant").click(deleteSubvariant);
        }

        function deleteSubvariant() {
            $(this).parent().parent().remove();
        }
    </script>
@endsection
