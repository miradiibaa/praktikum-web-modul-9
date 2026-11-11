<!DOCTYPE html>
<html>
<head>
    <title>Form Buku</title>
</head>
<body>
    <h1>{{ isset($buku) ? 'Edit Buku' : 'Tambah Buku' }}</h1>

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form
        action="{{ isset($buku) ? route('buku.update', $buku) : route('buku.store') }}"
        method="POST"
    >
        @csrf

        @if (isset($buku))
            @method('PUT')
        @endif

        <label>Kode Buku</label><br>
        <input
            type="text"
            name="kode"
            value="{{ old('kode', $buku->kode ?? '') }}"
        ><br><br>

        <label>Judul Buku</label><br>
        <input
            type="text"
            name="judul"
            value="{{ old('judul', $buku->judul ?? '') }}"
        ><br><br>

        <label>Kategori</label><br>
        <select name="kategori_id">
            <option value="">-- Pilih Kategori --</option>

            @foreach ($kategoris as $kategori)
                <option
                    value="{{ $kategori->id }}"
                    {{ old('kategori_id', $buku->kategori_id ?? '') == $kategori->id ? 'selected' : '' }}
                >
                    {{ $kategori->nama }}
                </option>
            @endforeach
        </select><br><br>

        <button type="submit">Simpan</button>
        <a href="{{ route('buku.index') }}">Kembali</a>
    </form>
</body>
</html>
