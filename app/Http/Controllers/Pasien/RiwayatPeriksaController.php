<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\JanjiPeriksa;

class RiwayatPeriksaController extends Controller
{
    public function index()
    {
        // Ambil nomor rekam medis dari user yang login
        $no_rm = Auth::user()->no_rm;

        // Ambil semua janji periksa milik user yang login
        $janjiPeriksas = JanjiPeriksa::where('id_pasien', Auth::user()->id)->get();

        // Tampilkan view riwayat periksa
        return view('pasien.riwayat-periksa.index')->with([
            'no_rm' => $no_rm,
            'janjiPeriksas' => $janjiPeriksas,
        ]);
    }

    public function detail($id)
    {
        // Ambil data janji periksa beserta relasi dokter
        $janjiPeriksa = JanjiPeriksa::with(['jadwalPeriksa.dokter'])->findOrFail($id);

        // Tampilkan detail janji periksa
        return view('pasien.riwayat-periksa.detail')->with([
            'janjiPeriksa' => $janjiPeriksa,
        ]);
    }

    public function riwayat($id)
    {
        // Ambil data janji periksa beserta relasi dokter
        $janjiPeriksa = JanjiPeriksa::with(['jadwalPeriksa.dokter'])->findOrFail($id);

        // Ambil riwayat periksa dari janji periksa tersebut
        $riwayat = $janjiPeriksa->riwayatPeriksa;

        // Tampilkan view riwayat pemeriksaan
        return view('pasien.riwayat-periksa.riwayat')->with([
            'riwayat' => $riwayat,
            'janjiPeriksa' => $janjiPeriksa,
        ]);
    }
}
