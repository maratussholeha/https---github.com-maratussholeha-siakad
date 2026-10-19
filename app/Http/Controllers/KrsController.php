<?php
/*
    Nama file   : KrsController.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

namespace App\Http\Controllers;

class KrsController extends Controller
{
    public function index()
    {
        $krs = [
            [
                'nim' => '2401001',
                'nama' => 'Ahmad Fauzi',
                'semester' => 2,
                'sks' => 22,
                'status' => 'Disetujui'
            ],
            [
                'nim' => '2401002',
                'nama' => 'Siti Rahmawati',
                'semester' => 4,
                'sks' => 20,
                'status' => 'Disetujui'
            ],
            [
                'nim' => '2301005',
                'nama' => 'Budi Santoso',
                'semester' => 4,
                'sks' => 24,
                'status' => 'Menunggu'
            ],
            [
                'nim' => '2301012',
                'nama' => 'Dewi Lestari',
                'semester' => 4,
                'sks' => 18,
                'status' => 'Menunggu'
            ],
        ];

        return view('krs.index', compact('krs'));
    }
}
