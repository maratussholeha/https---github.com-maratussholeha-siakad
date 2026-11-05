<?php
/*
    Nama file : PenggunaController.php
    NIM       : 3202416144
    Nama      : Mar'atussholeha
*/

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;

class PenggunaController extends Controller
{
    public function index(): View
    {
        $kolom = [
            'name' => 'Nama', 'email' => 'Email', 'role' => 'Peran',  'last_login_at' => 'Login Terakhir',
        ];

        // password tidak diambil dari database
        $pengguna = User::orderBy('name')
            ->get(['name', 'email', 'role', 'last_login_at'])
            ->toArray();

        return view('pengguna.index', compact('kolom', 'pengguna'));
    }
}