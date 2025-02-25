<?php

namespace Database\Seeders;

use App\Models\Voucher;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VoucherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Voucher::create([
            'user_id' => 1,
            'available_for' => 'Diskon Total Transaksi',
            'code' => 'TESTINGVOUCHER',
            'unit' => 'Persen',
            'nominal' => 5,
            'minimal_transaction' => 100000,
            'maximal_used' => 10,
            'used' => 0,
            'active' => 1
        ]);

        Voucher::create([
            'user_id' => 1,
            'available_for' => 'Diskon Total Transaksi',
            'code' => 'TESTINGVOUCHERRUPIAH',
            'unit' => 'Rupiah',
            'nominal' => 100000,
            'minimal_transaction' => 200000,
            'maximal_used' => 10,
            'used' => 0,
            'active' => 1
        ]);

        Voucher::create([
            'user_id' => 1,
            'available_for' => 'Gratis Ongkos Kirim',
            'code' => 'ONGKIRHANYAILUSI',
            'unit' => null,
            'nominal' => null,
            'minimal_transaction' => 100000,
            'maximal_used' => 10,
            'used' => 0,
            'active' => 1
        ]);
    }
}
