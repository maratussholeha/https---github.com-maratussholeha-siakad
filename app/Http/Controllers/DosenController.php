<?php
/*
    Nama file   : DosenController.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

namespace App\Http\Controllers;

class DosenController extends Controller
{
    public function index()
    {
        $kolom = [
            'nidn' => 'NIDN',
            'nama' => 'Nama Dosen',
            'keahlian' => 'Keahlian',
            'status' => 'Status',
        ];

        $dosen = [
            [
                'nidn' => '0012038801',
                'nama' => 'Hendra Wijaya',
                'keahlian' => 'Pemrograman Web',
                'status' => 'Aktif'
            ],
            [
                'nidn' => '0015048702',
                'nama' => 'Maya Sari',
                'keahlian' => 'Basis Data',
                'status' => 'Aktif'
            ],
            [
                'nidn' => '0021058503',
                'nama' => 'Andi Kurniawan',
                'keahlian' => 'Jaringan Komputer',
                'status' => 'Aktif'
            ],
            [
                'nidn' => '0008037904',
                'nama' => 'Rina Marlina',
                'keahlian' => 'Rekayasa Perangkat Lunak',
                'status' => 'Belajar'
            ],
        ];

        return view('dosen.index', compact('kolom', 'dosen'));
    }
}