<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use App\Models\Pemakaian;
class PemakaianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

     // Fetch all Pelanggan records
     $pelanggans = Pelanggan::all();

     if ($pelanggans->isEmpty()) {
         $this->command->warn('No Pelanggan records found. Please seed the Pelanggans table first.');
         return;
     }

     // Seed Pemakaian records for each Pelanggan
     foreach ($pelanggans as $pelanggan) {
         for ($i = 1; $i <= 12; $i++) { // Generate data for 12 months
             $meter_awal = fake()->numberBetween(0, 5000);
             $meter_akhir = $meter_awal + fake()->numberBetween(100, 500); // Ensure meter_akhir > meter_awal
             $jumlah_pakai = $meter_akhir - $meter_awal;
             $biaya_beban_pemakaian = $pelanggan->tarif->biaya_beban;
             $biaya_pemakaian = $jumlah_pakai * $pelanggan->tarif->tarif_kwh;
             $total_bayar = $biaya_beban_pemakaian + $biaya_pemakaian;

             Pemakaian::create([
                 'tahun' => now()->year, // Use the current year
                 'bulan' => $i, // Ensure unique month for each record
                 'no_kontrol' => $pelanggan->no_kontrol,
                 'meter_awal' => $meter_awal,
                 'meter_akhir' => $meter_akhir,
                 'jumlah_pakai' => $jumlah_pakai,
                 'biaya_beban_pemakaian' => $biaya_beban_pemakaian,
                 'biaya_pemakaian' => $biaya_pemakaian,
                 'total_bayar' => $total_bayar,
                 'jumlah_bayar' => fake()->optional()->numberBetween(0, $total_bayar),
                 'tanggal_bayar' => fake()->optional()->date(),
                 'status' => fake()->randomElement(['belum_bayar', 'lunas']),
             ]);
         }
     }
    }
}
