<?php
/*
    Nama file   : StatistikController.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Mata_Kuliah;
use App\Models\Krs;
use Illuminate\View\View;

class StatistikController extends Controller
{
    public function index(): View
    {
        $jumlahMahasiswa = Mahasiswa::count();
        $jumlahDosen = Dosen::count();
        $jumlahMataKuliah = Mata_Kuliah::count();
        $jumlahKrs = Krs::count();

        return view('dashboard.statistik', compact(
            'jumlahMahasiswa',
            'jumlahDosen',
            'jumlahMataKuliah',
            'jumlahKrs'
        ));
    }
}
