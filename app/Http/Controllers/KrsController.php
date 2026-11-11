<?php

/*
    Nama file   : KrsController.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

namespace App\Http\Controllers;

use App\Models\Krs;
use App\Models\Mahasiswa;
use App\Models\Mata_Kuliah;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class KrsController extends Controller
{
    // ==========================================
    // MENAMPILKAN DAFTAR KRS
    // ==========================================
   public function index(): View
{
    // Mengambil daftar tahun akademik dari database.
    $daftarTahun = Krs::select('tahun_akademik')
        ->distinct()
        ->orderByDesc('tahun_akademik')
        ->pluck('tahun_akademik');

    return view('krs.index', compact('daftarTahun'));
}

    // ==========================================
    // MENAMPILKAN FORM TAMBAH KRS
    // ==========================================
    public function create(): View
    {
        $mahasiswa = Mahasiswa::orderBy('nama')->get();

        $mataKuliah = Mata_Kuliah::orderBy('kode_mk')->get();

        return view('krs.create', compact(
            'mahasiswa',
            'mataKuliah'
        ));
    }

    // ==========================================
    // MENYIMPAN DATA KRS
    // ==========================================
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mahasiswa_id' => [
                'required',
                'exists:mahasiswa,id',
                Rule::unique('krs')
                    ->where('tahun_akademik', $request->tahun_akademik)
                    ->where('semester', $request->semester),
            ],

            'tahun_akademik' => [
                'required',
                'regex:/^\d{4}\/\d{4}$/',
            ],

            'semester' => [
                'required',
                Rule::in(['Ganjil', 'Genap']),
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'diajukan',
                    'disetejui',
                    'ditolak'
                ]),
            ],

            'mata_kuliah' => [
                'required',
                'array',
                'min:1',
            ],

            'mata_kuliah.*' => [
                'required',
                'distinct',
                'exists:mata_kuliah,id',
            ],

        ], [
            'mahasiswa_id.unique' =>
                'Mahasiswa sudah memiliki KRS pada tahun akademik dan semester tersebut.',

            'mata_kuliah.required' =>
                'Pilih minimal satu mata kuliah.',

            'mata_kuliah.min' =>
                'Pilih minimal satu mata kuliah.',
        ]);

        DB::transaction(function () use ($validated) {

            // Simpan data utama KRS
            $kr = Krs::create([
                'mahasiswa_id' => $validated['mahasiswa_id'],
                'tahun_akademik' => $validated['tahun_akademik'],
                'semester' => $validated['semester'],
                'status' => $validated['status'],
            ]);

            // Simpan mata kuliah ke tabel krs_detail
            $kr->mataKuliah()->sync($validated['mata_kuliah']);
        });

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil ditambahkan.');
    }

    // ==========================================
    // MENGAMBIL DATA KRS UNTUK DATATABLES
    // ==========================================
    public function data(Request $request): JsonResponse
{
    $query = Krs::with([
        'mahasiswa',
        'mataKuliah'
    ])->select([
        'id',
        'mahasiswa_id',
        'tahun_akademik',
        'semester',
        'status',
    ]);
	// Filter berdasarkan tahun akademik.
    if ($request->filled('tahun_akademik')) {
        $query->where(
            'tahun_akademik',
            $request->tahun_akademik
        );
    }
	// Filter berdasarkan semester.
    if ($request->filled('semester')) {
        $query->where(
            'semester',
            $request->semester
        );
    }
	return DataTables::eloquent($query)
        ->addIndexColumn()

        ->addColumn('nim', function ($krs) {
            return $krs->mahasiswa->nim ?? '-';
        })

        ->addColumn('nama_mahasiswa', function ($krs) {
            return $krs->mahasiswa->nama ?? '-';
        })

        ->addColumn('jumlah_sks', function ($krs) {
            return $krs->mataKuliah->sum('sks');
        })

        ->addColumn('jumlah_mk', function ($krs) {
            return $krs->mataKuliah->count();
        })

        ->addColumn('aksi', function ($krs) {
            return view('krs._aksi', compact('krs'))->render();
        })

        ->rawColumns(['aksi'])
        ->toJson();
}
    // ==========================================
    // MENAMPILKAN DETAIL KRS
    // ==========================================
    public function show(Krs $kr): View
    {
        $kr->load([
            'mahasiswa',
            'mataKuliah'
        ]);

        return view('krs.show', compact('kr'));
    }

    // ==========================================
    // MENAMPILKAN FORM EDIT KRS
    // ==========================================
    public function edit(Krs $kr): View
    {
        $kr->load([
            'mahasiswa',
            'mataKuliah'
        ]);

        $mahasiswa = Mahasiswa::orderBy('nama')->get();

        $mataKuliah = Mata_Kuliah::orderBy('kode_mk')->get();

        return view('krs.edit', compact(
            'kr',
            'mahasiswa',
            'mataKuliah'
        ));
    }

    // ==========================================
    // MEMPERBARUI DATA KRS
    // ==========================================
    public function update(Request $request, Krs $kr)
    {
        $validated = $request->validate([
            'mahasiswa_id' => [
                'required',
                'exists:mahasiswa,id',
                Rule::unique('krs')
                    ->where('tahun_akademik', $request->tahun_akademik)
                    ->where('semester', $request->semester)
                    ->ignore($kr->id),
            ],

            'tahun_akademik' => [
                'required',
                'regex:/^\d{4}\/\d{4}$/',
            ],

            'semester' => [
                'required',
                Rule::in(['Ganjil', 'Genap']),
            ],

            'status' => [
                'required',
                Rule::in([
                    'draft',
                    'diajukan',
                    'disetejui',
                    'ditolak'
                ]),
            ],

            'mata_kuliah' => [
                'required',
                'array',
                'min:1',
            ],

            'mata_kuliah.*' => [
                'required',
                'distinct',
                'exists:mata_kuliah,id',
            ],

        ], [
            'mahasiswa_id.unique' =>
                'Mahasiswa sudah memiliki KRS pada tahun akademik dan semester tersebut.',

            'mata_kuliah.required' =>
                'Pilih minimal satu mata kuliah.',
        ]);

        DB::transaction(function () use ($kr, $validated) {

            // Perbarui data utama
            $kr->update([
                'mahasiswa_id' => $validated['mahasiswa_id'],
                'tahun_akademik' => $validated['tahun_akademik'],
                'semester' => $validated['semester'],
                'status' => $validated['status'],
            ]);

            // Perbarui daftar mata kuliah
            $kr->mataKuliah()->sync($validated['mata_kuliah']);
        });

        return redirect()
            ->route('krs.index')
            ->with('success', 'Data KRS berhasil diperbarui.');
    }

    // ==========================================
    // MENGHAPUS DATA KRS
    // ==========================================
    public function destroy(Krs $kr): JsonResponse
    {
        try {

            DB::transaction(function () use ($kr) {

                // Hapus relasi mata kuliah terlebih dahulu
                $kr->mataKuliah()->detach();

                // Hapus data KRS
                $kr->delete();
            });

            return response()->json([
                'success' => true,
                'message' => 'Data KRS berhasil dihapus.',
            ]);

        } catch (\Throwable $e) {

            report($e);

            return response()->json([
                'success' => false,
                'message' => 'Data KRS gagal dihapus.',
            ], 500);
        }
    }
}
