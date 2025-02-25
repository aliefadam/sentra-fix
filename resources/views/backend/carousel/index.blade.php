@extends('layouts.admin')

@section('content')
    <form action="{{ route('admin.carousel.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex justify-between items-center">
            <h1 class="text-lg poppins-semibold">Pengaturan Carousel</h1>
            <button type="button" id="btn-add-carousel"
                class="bg-white border border-red-700 text-red-700 hover:bg-red-50 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5">
                <i class="fa-regular fa-plus"></i>
                <span>Tambah Carousel</span>
            </button>
        </div>
        <div class="space-y-5 mt-8" id="carousel-container">
            @foreach ($carousels as $index => $carousel)
                <div class="bg-white shadow-md rounded-md p-5">
                    <div class="flex justify-between mb-4">
                        <h1 class="mb-3">Carousel {{ $loop->iteration }}</h1>
                        @if ($index > 0)
                            <button type="button" data-carousel-id="{{ $carousel->id }}"
                                class="btn-delete-carousel text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5">
                                Hapus
                            </button>
                        @endif
                    </div>
                    <img class="w-full h-[350px] object-cover rounded-md shadow-md"
                        src="/uploads/carousels/{{ $carousel->image }}" alt="">

                    <div class="mt-3">
                        <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">
                            Edit Gambar
                        </label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                            id="file_input" type="file" name="carousel_old[{{ $carousel->id }}]">
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-10 flex justify-center">
            <button type="submit"
                class="text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 w-1/2 dark:bg-red-600 dark:hover:bg-red-700 focus:outline-none dark:focus:ring-red-800">
                Simpan Perubahan
            </button>
        </div>
    </form>
@endsection

@section('script')
    <script>
        $("#btn-add-carousel").click(addCarousel);
        $(".btn-delete-carousel").click(deleteCarousel);
        $(".btn-cancel-add-carousel").click(cancelAddCarousel);

        function addCarousel() {
            const html = `
            <div class="bg-white shadow-md rounded-md p-5">
                <div class="flex justify-between items-center mb-2">
                    <label class="block text-sm font-medium text-gray-900 dark:text-white" for="file_input">
                        Pilih Gambar
                    </label>
                    <button type="button" class="btn-cancel-add-carousel text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-xs px-5 py-2.5">Hapus</button>
                </div>
                <input
                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                    id="file_input" name="carousel_new[]" type="file" required>
            </div>
            `;
            $("#carousel-container").append(html);
            $(".btn-cancel-add-carousel").click(cancelAddCarousel);
        }

        function cancelAddCarousel() {
            $(this).parent().parent().remove();
        }

        function deleteCarousel() {
            const carouselID = $(this).data("carousel-id");
            Swal.fire({
                title: 'Apakah Anda Yakin?',
                text: "Data tidak dapat dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: `/admin/carousel/${carouselID}`,
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: "Loading",
                                text: "Menghapus carousel...",
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },
                        success: function(response) {
                            window.location.reload();
                        }
                    });
                }
            })
        }
    </script>
@endsection
