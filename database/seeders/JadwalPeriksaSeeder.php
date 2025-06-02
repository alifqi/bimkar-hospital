<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\JadwalPeriksa;

class JadwalPeriksaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user dengan role dokter
        $dokters = User::where('role', 'dokter')->get();

        // Hari dalam seminggu
        $days = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];

        // Membuat jadwal untuk setiap dokter
        foreach ($dokters as $dokter) {
            // Assign 2 hari kerja per dokter dengan index berdasarkan id dokter
            $doctorDays = array_slice($days, $dokter->id % 5, 2);

            $firstSchedule = true; // Tandai jadwal pertama sebagai aktif

            foreach ($doctorDays as $day) {
                // Jadwal pagi (08:00 - 12:00)
                JadwalPeriksa::create([
                    'id_dokter' => $dokter->id,
                    'hari' => $day,
                    'jam_mulai' => '08:00:00',
                    'jam_selesai' => '12:00:00',
                    'status' => $firstSchedule ? true : false, // Jadwal pertama aktif, sisanya tidak
                ]);

                $firstSchedule = false; // Jadwal berikutnya non-aktif

                // Jadwal siang (13:00 - 16:00) hanya untuk dokter dengan ID genap
                if ($dokter->id % 2 === 0) {
                    JadwalPeriksa::create([
                        'id_dokter' => $dokter->id,
                        'hari' => $day,
                        'jam_mulai' => '13:00:00',
                        'jam_selesai' => '16:00:00',
                        'status' => false, // Jadwal siang selalu non-aktif
                    ]);
                }
            }
        }
    }
}
