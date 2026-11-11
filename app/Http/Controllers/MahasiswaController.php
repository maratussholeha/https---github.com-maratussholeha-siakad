<?php
/*
    Nama file   : MahasiswaController.php
    NIM         : 3202416144
    Nama        : Mar'atussholeha
*/

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Database\QueryException;
use Yajra\DataTables\Facades\DataTables;

class MahasiswaController extends Controller
{
    // Menampilkan halaman daftar mahasiswa
    public function index(): View
    {
        return view('mahasiswa.index');
    }

    // Mengambil data mahasiswa untuk DataTables Server-Side
    public function data(): JsonResponse
    {
        $query = Mahasiswa::query()->select([
            'id',
            'nim',
            'nama',
            'jenis_kelamin',
            'email',
            'angkatan',
            'program_studi',
        ]);

        return DataTables::eloquent($query)
            ->addIndexColumn()
            ->addColumn('aksi', function ($mahasiswa) {
                return view('mahasiswa._aksi', compact('mahasiswa'));
            })
            ->rawColumns(['aksi'])
            ->toJson();
    }

    // Menampilkan form tambah mahasiswa
    public function create(): View
    {
        $mahasiswa = new Mahasiswa();

        return view('mahasiswa.create', compact('mahasiswa'));
    }

    // Aturan validasi mahasiswa
    private function aturanValidasi(?Mahasiswa $mahasiswa = null): array
    {
        return [
            'nim' => [
                'required',
                'string',
                'max:20',
                Rule::unique('mahasiswa', 'nim')->ignore($mahasiswa?->id),
            ],
            'nama' => ['required', 'string', 'max:120'],
            'jenis_kelamin' => ['required', Rule::in(['L', 'P'])],
            'email' => [
                'required',
                'email',
                'max:120',
                Rule::unique('mahasiswa', 'email')->ignore($mahasiswa?->id),
            ],
            'angkatan' => ['required', 'integer', 'digits:4'],
            'program_studi' => ['required', 'string', 'max:100'],
        ];
    }

    // Pesan validasi dalam bahasa Indonesia
    private function pesanValidasi(): array
    {
        return [
            'nim.required' => 'NIM wajib diisi.',
            'nim.unique' => 'NIM sudah digunakan.',
            'nama.required' => 'Nama mahasiswa wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'angkatan.required' => 'Angkatan wajib diisi.',
            'angkatan.digits' => 'Angkatan harus terdiri dari 4 angka.',
            'program_studi.required' => 'Program studi wajib diisi.',
        ];
    }

    // Menyimpan mahasiswa baru
    public function store(Request $request)
    {
        $data = $request->validate(
            $this->aturanValidasi(),
            $this->pesanValidasi()
        );

        Mahasiswa::create($data);

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil ditambahkan.');
    }

    // Menampilkan detail mahasiswa
    public function show(Mahasiswa $mahasiswa): View
    {
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    // Menampilkan form edit mahasiswa
    public function edit(Mahasiswa $mahasiswa): View
    {
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    // Memperbarui data mahasiswa
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $data = $request->validate(
            $this->aturanValidasi($mahasiswa),
            $this->pesanValidasi()
        );

        $mahasiswa->update($data);

        return redirect()
            ->route('mahasiswa.index')
            ->with('success', 'Data mahasiswa berhasil diperbarui.');
    }

    // Menghapus data mahasiswa
    public function destroy(Mahasiswa $mahasiswa): JsonResponse
    {
        try {
            $mahasiswa->delete();

            return response()->json([
                'success' => true,
                'message' => 'Data mahasiswa berhasil dihapus.',
            ]);
        } catch (QueryException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Data mahasiswa tidak dapat dihapus karena masih memiliki data KRS.',
            ], 409);
        }
    }
}
