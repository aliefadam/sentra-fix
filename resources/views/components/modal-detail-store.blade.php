<div class="border bg-white shadow-md p-5 flex justify-between">
    <div class="">
        <div class="flex items-center gap-4">
            <img class="size-14 object-cover rounded-full shadow-sm" src="/uploads/stores/{{ $store->image }}"
                alt="">
            <div class="flex flex-col">
                <span class="text-base poppins-medium">
                    <i class="fa-regular fa-store"></i> {{ $store->name }}
                </span>
                <span class="text-sm">{{ json_decode($store->user->addresses()->first()->city)->name }}</span>
            </div>
        </div>
    </div>
    <div class=" flex items-center gap-5">
        <div class="flex flex-col items-center">
            <span class="text-lg text-pink-700 poppins-semibold">{{ $store->user->products()->count() }}</span>
            <span class="text-gray-700 poppins-medium text-sm">Jumlah Produk</span>
        </div>
        <div class="flex flex-col items-center">
            <span class="text-lg text-pink-700 poppins-semibold">{{ $store->transactionsDetails()->count() }}</span>
            <span class="text-gray-700 poppins-medium text-sm">Pesanan Diproses</span>
        </div>
    </div>
</div>
<div class="p-5 space-y-4">
    <div class="">
        <h1 class="text-base poppins-semibold">Desripsi Toko</h1>
        <p class="text-sm mt-2">{{ $store->description }}</p>
    </div>
    <div class="">
        <h1 class="text-base poppins-semibold">Bergabung Sejak</h1>
        <p class="text-sm mt-2">{{ showingDays($store->created_at) }}</p>
    </div>
    <div class="">
        <h1 class="text-base poppins-semibold">Status Toko</h1>
        <p class="text-sm mt-2 w-fit {{ getStatusStoreBadges($store->status) }}">
            {{ getStatusStore($store->status) }}</p>
    </div>
</div>
