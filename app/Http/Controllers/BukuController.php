<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BukuController extends Controller
{
    public function index()
    {
        $bukus = Buku::with('kategori')->get();

        return view('buku.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = Kategori::all();

        return view('buku.form', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kode' => 'required|string|max:10|unique:bukus,kode',
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        Buku::create($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function edit(Buku $buku)
    {
        $kategoris = Kategori::all();

        return view('buku.form', compact('buku', 'kategoris'));
    }

    public function update(Request $request, Buku $buku)
    {
        $validated = $request->validate([
            'kode' => [
                'required',
                'string',
                'max:10',
                Rule::unique('bukus', 'kode')->ignore($buku->id),
            ],
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
        ]);

        $buku->update($validated);

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil diperbarui.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.index')
            ->with('success', 'Data buku berhasil dihapus.');
    }
}
