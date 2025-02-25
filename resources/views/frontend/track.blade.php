<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sentra Fix - Simulasi Pembayaran</title>

    {{-- Font Poppins --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-duotone-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-solid.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/sharp-light.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-thin.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-regular.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.7.2/css/duotone-light.css">

    {{-- Glide --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.6.0/css/glide.core.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/Glide.js/3.6.0/css/glide.theme.min.css" rel="stylesheet" />

    {{-- Flowbite --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script
        src="https://cdn.tailwindcss.com/3.4.5?plugins=forms@0.5.7,typography@0.5.13,aspect-ratio@0.4.2,container-queries@0.1.1">
    </script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script> --}}
    <script src="https://ai-public.creatie.ai/gen_page/tailwind-config.min.js" data-color="#000000"
        data-border-radius="small"></script>

    {{-- Custom CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Sweetalert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Poppins CSS --}}
    <link rel="stylesheet" href="{{ asset('css/poppins.css') }}">

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="font-[Poppins] w-full ">
    @include('partials.notification')

    {{-- <div class="absolute top-10 left-0 right-0 flex justify-center">
        <img class="drop-shadow-lg size-16 object-cover" src="{{ asset('imgs/logo-sentra-fix-removebg-preview.png') }}"
            alt="">
    </div> --}}

    <div class="bg-gray-50 w-full h-full min-h-screen flex justify-center items-center p-5">
        <main class="w-full flex items-center flex-col">
            <div class="text-center text-pink-700">
                <h1 class="poppins-black text-4xl">SENTRA FIX</h1>
                <p class="poppins-semibold text-lg">LACAK PAKET</p>
            </div>

            <div class="bg-white border-2 border-pink-700 mt-10 p-10 rounded-md shadow-md w-1/3">
                <form action="{{ route('track_packet_post') }}" class="w-full" method="GET">
                    {{-- @csrf --}}
                    <div class="mb-5">
                        <label for="waybill"
                            class="block mb-3 text-sm text-center font-medium text-gray-900 dark:text-white">
                            Masukkan Nomor Resi
                        </label>
                        <input type="text" id="waybill" name="waybill" value="{{ $waybill ?? '' }}"
                            class="text-center bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-500 dark:focus:border-pink-500"
                            required />
                    </div>
                    <div class="mb-5">
                        <label for="courier" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Pilih Kurir
                        </label>
                        <select id="courier" name="courier"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected>-- Pilih --</option>
                            <option {{ isset($courier) && $courier == 'jne' ? 'selected' : '' }} value="jne">JNE
                            </option>
                            <option {{ isset($courier) && $courier == 'jnt' ? 'selected' : '' }} value="jnt">JNT
                            </option>
                            <option {{ isset($courier) && $courier == 'sicepat' ? 'selected' : '' }} value="sicepat">
                                SICEPAT</option>
                        </select>
                    </div>
                    <button type="submit"
                        class="text-white bg-pink-700 hover:bg-pink-800 focus:ring-4 focus:ring-pink-300 font-medium rounded-lg text-sm px-5 py-2.5 w-full text-center dark:bg-pink-600 dark:hover:bg-pink-700 focus:outline-none dark:focus:ring-pink-800">
                        Lacak
                    </button>
                </form>
            </div>

            @if (isset($data) && !empty($data))
                @php
                    $detail = $data['details'];
                    $manifest = $data['manifest'];
                @endphp
                <div class="bg-white border-2 border-pink-700 mt-10 p-10 rounded-md shadow-md w-1/2">
                    <h1 class="text-center text-2xl poppins-semibold text-pink-700">Detail Paket</h1>
                    <div class="mt-5 grid grid-cols-2 gap-5">
                        <div class="space-y-5">
                            <div class="">
                                <h1 class="text-sm text-pink-700 poppins-medium">Nomor Resi</h1>
                                <span>{{ $detail['waybill_number'] }}</span>
                            </div>
                            <div class="">
                                <h1 class="text-sm text-pink-700 poppins-medium">Tanggal Pemberangkatan</h1>
                                <span>{{ showingDays($detail['waybill_date']) }}</span>
                            </div>
                            <div class="">
                                <h1 class="text-sm text-pink-700 poppins-medium">Kota Awal</h1>
                                <span>{{ $detail['origin'] }}</span>
                            </div>
                            <div class="">
                                <h1 class="text-sm text-pink-700 poppins-medium">Kota Tujuan</h1>
                                <span>{{ $detail['destination'] }}</span>
                            </div>
                        </div>
                        <div class="space-y-5 text-end">
                            <div class="">
                                <h1 class="text-sm text-pink-700 poppins-medium">Nama Pengirim</h1>
                                <span>{{ $detail['shipper_name'] }}</span>
                            </div>
                            <div class="">
                                <h1 class="text-sm text-pink-700 poppins-medium">Alamat Pengirim</h1>
                                <span>{{ $detail['shipper_address1'] }}</span>
                            </div>
                            <div class="">
                                <h1 class="text-sm text-pink-700 poppins-medium">Nama Penerima</h1>
                                <span>{{ $detail['receiver_name'] }}</span>
                            </div>
                            <div class="">
                                <h1 class="text-sm text-pink-700 poppins-medium">Alamat Penerima</h1>
                                <span>{{ $detail['receiver_address1'] }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white border-2 border-pink-700 mt-10 p-10 rounded-md shadow-md w-1/2">
                    <h1 class="text-center text-2xl poppins-semibold text-pink-700">Hasil Lacak Paket</h1>
                    <div class="mt-5">
                        <ol class="relative border-s-2 border-pink-200 dark:border-gray-700 ms-2">
                            @foreach ($manifest as $m)
                                <li class="mb-7 ms-4">
                                    <div
                                        class="absolute w-3 h-3 bg-pink-700 rounded-full mt-1.5 -start-[6.5px] border border-white">
                                    </div>
                                    <time class="mb-1 text-xs poppins-medium text-pink-700 leading-none">
                                        {{ showingDays($m['manifest_date']) }}
                                    </time>
                                    <h3 class="text-sm poppins-medium text-gray-900 dark:text-white">
                                        {{ $m['manifest_description'] }} [{{ $m['city_name'] }}]
                                    </h3>
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            @endif
        </main>
    </div>

    {{-- <div class="absolute bottom-10 left-0 right-0 flex justify-center">
        <p class="text-pink-700 poppins-medium">© 2025 SentraFix. Hak Cipta Dilindungi.</p>
    </div> --}}
</body>

</html>
