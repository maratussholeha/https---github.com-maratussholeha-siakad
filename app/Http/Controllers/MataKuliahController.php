<?php

/*
    Nama file   : MataKuliahController.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

namespace App\Http\Controllers;

use App\Models\Mata_Kuliah;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class MataKuliahController extends Controller
{
    // Menampilkan halaman daftar mata kuliah
    public function index(): View
    {
        return view('matakuliah.index');
    }

    // Mengambil data mata kuliah untuk DataTables
    public function data(): JsonResponse
    {
        $query = Mata_Kuliah::query()->select([
            'id',
            'kode_mk',
            'nama_mk',
            'sks',
        ]);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($matakuliah) {
                return view('matakuliah._aksi', compact('matakuliah'))->render();
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    // Menampilkan formulir tambah mata kuliah
    public function create(): View
    {
        $matakuliah = new Mata_Kuliah();

        return view('matakuliah.create', compact('matakuliah'));
    }

    // Aturan validasi data mata kuliah
    private function aturanValidasi(?Mata_Kuliah $matakuliah = null): array
    {
        return [
            'kode_mk' => [
                'required',
                'string',
                'max:10',
                Rule::unique('mata_kuliah', 'kode_mk')
                    ->ignore($matakuliah?->id),
            ],

            'nama_mk' => [
                'required',
                'string',
                'max:100',
            ],

            'sks' => [
                'required',
                'integer',
                'min:1',
                'max:255',
            ],
        ];
    }

    // Pesan kesalahan validasi
    private function pesanValidasi(): array
    {
        return [
            'kode_mk.required' => 'Kode mata kuliah wajib diisi.',
            'kode_mk.max' => 'Kode mata kuliah maksimal 10 karakter.',
            'kode_mk.unique' => 'Kode mata kuliah sudah digunakan.',

            'nama_mk.required' => 'Nama mata kuliah wajib diisi.',
            'nama_mk.max' => 'Nama mata kuliah maksimal 100 karakter.',

            'sks.required' => 'Jumlah SKS wajib diisi.',
            'sks.integer' => 'Jumlah SKS harus berupa angka.',
            'sks.min' => 'Jumlah SKS minimal 1.',
            'sks.max' => 'Jumlah SKS maksimal 255.',
        ];
    }

    // Menyimpan data mata kuliah baru
    public function store(Request $request)
    {
        $data = $request->validate(
            $this->aturanValidasi(),
            $this->pesanValidasi()
        );

        Mata_Kuliah::create($data);

        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil ditambahkan!');
    }

    // Menampilkan detail mata kuliah
    public function show(Mata_Kuliah $matakuliah): View
    {
        return view('matakuliah.show', compact('matakuliah'));
    }

    // Menampilkan formulir edit mata kuliah
    public function edit(Mata_Kuliah $matakuliah): View
    {
        return view('matakuliah.edit', compact('matakuliah'));
    }

    // Memperbarui data mata kuliah
    public function update(Request $request, Mata_Kuliah $matakuliah)
    {
        $data = $request->validate(
            $this->aturanValidasi($matakuliah),
            $this->pesanValidasi()
        );

        $matakuliah->update($data);

        return redirect()
            ->route('matakuliah.index')
            ->with('success', 'Data mata kuliah berhasil diperbarui!');
    }

    // Menghapus data mata kuliah
    public function destroy(Mata_Kuliah $matakuliah): JsonResponse
    {
        try {
            $matakuliah->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data mata kuliah berhasil dihapus!',
            ]);

        } catch (QueryException $e) {

            return response()->json([
                'success' => false,
                'message' => 'Data mata kuliah tidak dapat dihapus karena masih digunakan dalam KRS.',
            ], 409);
        }
    }
}
