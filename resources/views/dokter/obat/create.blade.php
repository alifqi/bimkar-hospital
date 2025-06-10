<x-app-layout>
<div class="container py-4">
    <div class="card">
        <div class="card-header">
            <h4>Tambah Obat</h4>
        </div>
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('dokter.obat.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="nama_obat" class="form-label">Nama Obat</label>
                    <input type="text" name="nama_obat" id="nama_obat" class="form-control" value="{{ old('nama_obat') }}" required>
                </div>

                <div class="mb-3">
                    <label for="kemasan" class="form-label">Kemasan</label>
                    <input type="text" name="kemasan" id="kemasan" class="form-control" value="{{ old('kemasan') }}">
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" value="{{ old('harga') }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('dokter.obat.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
</x-app-layout>
