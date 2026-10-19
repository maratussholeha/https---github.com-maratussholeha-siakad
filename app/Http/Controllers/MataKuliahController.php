<?php
/*
    Nama file   : MataKuliahController.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

namespace App\Http\Controllers;

class MataKuliahController extends Controller
{
    public function index()
    {
        $matakuliah = [
            [
                'kode' => 'TIF201',
                'nama' => 'Pemrograman Web',
                'sks' => 3,
                'semester' => 3,
                'jenis' => 'Praktik'
            ],
            [
                'kode' => 'TIF202',
                'nama' => 'Basis Data',
                'sks' => 3,
                'semester' => 2,
                'jenis' => 'Praktik'
            ],
            [
                'kode' => 'TIF301',
                'nama' => 'Rekayasa Perangkat Lunak',
                'sks' => 3,
                'semester' => 4,
                'jenis' => 'Teori'
            ],
            [
                'kode' => 'TIF203',
                'nama' => 'Jaringan Komputer',
                'sks' => 2,
                'semester' => 3,
                'jenis' => 'Teori'
            ],
        ];

        return view('matakuliah.index', compact('matakuliah'));
    }
}
