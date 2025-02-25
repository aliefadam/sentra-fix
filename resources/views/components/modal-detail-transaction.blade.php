@php
    $payment = json_decode($transaction->payment);
    $payment_type = $payment->type;
    $payment_name = $payment->name;
    $data = $payment->data;
@endphp

<div class="space-y-4">
    <div class="flex justify-between">
        <span class="lg:text-sm text-xs ">Status</span>
        <span class="lg:text-sm text-xs text-gray-600">{{ getStatus($transaction->payment_status) }}</span>
    </div>
    <div class="flex justify-between">
        <span class="lg:text-sm text-xs ">No Invoice</span>
        <span class="lg:text-sm text-xs text-gray-600">{{ $transaction->invoice }}</span>
    </div>
    <div class="flex justify-between">
        <span class="lg:text-sm text-xs ">Tanggal Pembelian</span>
        <span class="lg:text-sm text-xs text-gray-600 text-right">
            {{ showingDays($transaction->created_at) }}
        </span>
    </div>
    <div class="flex justify-between">
        <span class="lg:text-sm text-xs flex-[3]">Metode Pembayaran</span>
        <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
            {{ $payment_type }} {{ $payment_name }}
        </span>
    </div>
    @if ($payment_type != 'QRIS')
        <div class="flex justify-between">
            <span class="lg:text-sm text-xs flex-[3]">Virtual Account</span>
            <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
                {{ $data }}
            </span>
        </div>
    @else
        <div class="flex justify-end">
            {!! showQR($data['virtual_account'], 100) !!}
        </div>
    @endif
</div>
<hr>
<div class="">
    <h1 class="poppins-semibold">Detail Produk</h1>
    <div class="mt-4 flex flex-col gap-4">
        @foreach ($transaction->transactionDetails as $detail)
            <div class="border shadow-sm rounded-lg p-3">
                <div class="flex gap-3">
                    <div class="flex-[2]">
                        <div class="flex gap-3">
                            <img src="/uploads/products/{{ $detail->product_image }}"
                                class="w-[80px] h-[80px] object-cover rounded-md shadow-md">
                            <div class="flex flex-col">
                                <span class="poppins-medium lg:text-base text-sm block leading-[17px]">
                                    {{ $detail->product_name }}
                                </span>
                                <span class="text-xs capitalize poppin-semibold text-gray-500 lg:mt-0 mt-2">
                                    {{ $detail->variant }}
                                </span>
                                <span class="lg:text-sm text-xs mt-2">
                                    {{ $detail->qty }} Barang
                                    X
                                    {{ format_rupiah($detail->product_price, true) }}
                                </span>
                            </div>
                        </div>
                        <div class="mt-3 lg:text-sm text-xs">Catatan : </div>
                        <div class="mt-1 lg:text-sm text-xs poppins-medium">
                            {{ $detail->notes ?? '-' }}
                        </div>
                    </div>
                    <div class="flex-[1] flex flex-col gap-1 items-end">
                        <span class="lg:text-sm text-xs text-right">Total</span>
                        <span class="poppins-semibold leading-none lg:text-base text-sm">
                            {{ format_rupiah($detail->total, true) }}
                        </span>
                    </div>
                </div>
                <div class="mt-2">
                    <div class="mt-3 lg:text-sm text-xs">Layanan Pengiriman : </div>
                    <div class="mt-1 lg:text-sm text-xs poppins-medium">
                        {{ $detail->shipping_service }} •
                        {{ format_rupiah($detail->shipping_cost, true) }}
                    </div>
                </div>
                <div class="mt-2">
                    <div class="mt-3 lg:text-sm text-xs">No. Resi : </div>
                    <div class="mt-1 lg:text-sm text-xs poppins-medium">
                        {{ $detail->shipping_code ?? '-' }}
                    </div>
                </div>
                {{-- <div class="mt-2">
                    <div class="mt-3 lg:text-sm text-xs">Status Pengiriman : </div>
                    <div class="mt-1 lg:text-sm text-xs poppins-medium">
                        {{ $detail->shipping_status }}
                    </div>
                </div> --}}
                <div class="mt-5 space-y-4">
                    <h1 class="text-sm">Informasi Pengiriman : </h1>
                    <ol class="relative border-s-2 border-pink-200 dark:border-gray-700 ms-2">
                        @foreach ($detail->shippingStatuses as $status)
                            <li class="mb-7 ms-4">
                                <div
                                    class="absolute w-3 h-3 bg-pink-700 rounded-full mt-1.5 -start-[6.5px] border border-white">
                                </div>
                                <time class="mb-1 text-xs poppins-medium text-pink-700 leading-none">
                                    {{ showingDays($status->created_at) }}
                                </time>
                                <h3 class="text-sm poppins-medium text-gray-900 dark:text-white">{{ $status->title }}
                                </h3>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>
        @endforeach
    </div>
</div>
<hr>
{{-- @if ($transaction->created_at != $transaction->updated_at)
    <div class="space-y-4">
        <h1 class="poppins-semibold">Detail Status</h1>
        <ol class="relative border-s-2 border-pink-200 dark:border-gray-700 ms-2">
            @foreach ($transaction->shippingStatus as $status)
                <li class="mb-7 ms-4">
                    <div class="absolute w-3 h-3 bg-pink-700 rounded-full mt-1.5 -start-[6.5px] border border-white">
                    </div>
                    <time class="mb-1 text-xs poppins-medium text-pink-700 leading-none">
                        {{ showingDays($status->created_at) }}
                    </time>
                    <h3 class="text-sm poppins-medium text-gray-900 dark:text-white">{{ $status->title }}</h3>
                </li>
            @endforeach
        </ol>
    </div>
    <hr>
@endif --}}
<div class="space-y-4">
    <h1 class="poppins-semibold">Informasi Alamat</h1>
    <div class="flex justify-between">
        <span class="lg:text-sm text-xs flex-[3]">Alamat</span>
        <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
            {{ $transaction->shipping_address }}
        </span>
    </div>
</div>
<hr>
{{-- <div class="space-y-4">
    <h1 class="poppins-semibold">Informasi Pengiriman</h1>
    <div class="flex justify-between">
        <span class="lg:text-sm text-xs flex-[3]">Layanan</span>
        <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end uppercase">
            {{ $transaction->shipping_service }}
        </span>
    </div>
    @if (isset($transaction->shipping_service))
        <div class="flex justify-between">
            <span class="lg:text-sm text-xs flex-[3]">No Resi</span>
            <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end uppercase">
                {{ $transaction->shipping_code ?? '-' }}
            </span>
        </div>
    @endif
</div>
<hr> --}}
<div class="space-y-4">
    <h1 class="poppins-semibold">Rincian Pembayaran</h1>
    <div class="flex justify-between">
        <span class="lg:text-sm text-xs flex-[3]">
            Total Harga Barang
        </span>
        <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
            {{ format_rupiah($transaction->transactionDetails()->sum('sub_total'), true) }}
        </span>
    </div>
    <div class="flex justify-between">
        <span class="lg:text-sm text-xs flex-[3]">Total Ongkos Kirim</span>
        <span class="lg:text-sm text-xs flex-[2] text-gray-600 text-end">
            {{ format_rupiah($transaction->transactionDetails()->sum('shipping_cost'), true) }}
        </span>
    </div>
    <div class="flex justify-between poppins-semibold">
        <span class="text-[15px] flex-[3]">Total Belanja</span>
        <span class="text-[15px] flex-[2] text-gray-600 text-end">{{ format_rupiah($transaction->total, true) }}</span>
    </div>
    @if ($transaction->promo_code)
        <div class="flex justify-between text-pink-700 poppins-medium border-t-2 border-dashed border-pink-700 pt-5">
            <span class="lg:text-sm text-xs flex-[3]">
                <i class="fa-regular fa-ticket"></i>
                {{ $transaction->promo_code }}
            </span>
            <span class="lg:text-sm text-xs flex-[2] text-end">
                -{{ format_rupiah($transaction->discount, true) }}
            </span>
        </div>
        <div class="flex justify-between poppins-semibold">
            <span class="text-[15px] flex-[3]">Total Akhir</span>
            <span
                class="text-[15px] flex-[2] text-gray-600 text-end">{{ format_rupiah($transaction->total_after_discount, true) }}</span>
        </div>
    @endif
</div>
