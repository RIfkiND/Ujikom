<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pelanggan;
use App\Models\Tarif;
class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tarifs = Tarif::all();

        if ($tarifs->isEmpty()) {
            $this->command->warn('No Tarif records found. Please seed the Tarifs table first.');
            return;
        }

        // Seed 10 Pelanggan records
        for ($i = 0; $i < 10; $i++) {
            do {
                $no_kontrol = 'PLG-' . mt_rand(1000000, 9999999);
            } while (Pelanggan::where('no_kontrol', '=', $no_kontrol)->exists());

            Pelanggan::create([
                'no_kontrol' => $no_kontrol,
                'name' => fake()->name(),
                'alamat' => fake()->address(),
                'no_telepon' => fake()->phoneNumber(),
                'jenis_plg' => $tarifs->random()->id, // Randomly associate with a Tarif
            ]);
        }
    }
}
