{{-- resources/views/dokter/edit.blade.php --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edit Pemeriksaan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto space-y-6 max-w-7xl sm:px-6 lg:px-8">
            <div class="p-4 bg-white shadow-sm sm:p-8 sm:rounded-lg">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Edit Pemeriksaan Pasien') }}
                            </h2>
                        </header>

                        <form class="mt-6" action="{{ route('dokter.memeriksa.update', $janjiPeriksa->id) }}" method="POST">
                            @csrf
                            @method('PATCH')

                            <div class="mb-3 form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" value="{{ $janjiPeriksa->pasien->nama }}" readonly>
                            </div>

                            <div class="mb-3 form-group">
                                <label for="tgl_periksa">Tanggal Periksa</label>
                                <input type="datetime-local" class="form-control" name="tgl_periksa"
                                    value="{{ \Carbon\Carbon::parse($janjiPeriksa->periksa->tgl_periksa)->format('Y-m-d\TH:i') }}"
                                    required>
                            </div>

                            <div class="mb-3 form-group">
                                <label for="catatan">Catatan</label>
                                <textarea class="form-control" name="catatan" rows="3">{{ $janjiPeriksa->periksa->catatan }}</textarea>
                            </div>

                            <div class="mb-3 form-group">
                                <label for="obat">Pilih Obat</label>
                                <select class="form-control" name="obat" id="obat" onchange="hitungBiaya()">
                                    @foreach ($obats as $obat)
                                        <option value="{{ $obat->id }}"
                                            data-harga="{{ $obat->harga }}"
                                            {{ $janjiPeriksa->periksa->obat_id == $obat->id ? 'selected' : '' }}>
                                            {{ $obat->nama_obat }} - {{ $obat->kemasan }} (Rp {{ number_format($obat->harga, 0, ',', '.') }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-3 form-group">
                                <label for="biaya_periksa">Biaya Pemeriksaan (Rp)</label>
                                <input type="text" class="form-control" id="biaya_periksa"
                                    name="biaya_periksa"
                                    value="{{ $janjiPeriksa->periksa->biaya_periksa }}" readonly>
                            </div>

                            <a href="{{ route('dokter.memeriksa.index') }}" class="btn btn-secondary">Batal</a>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>

                        <script>
                            function hitungBiaya() {
                                const baseBiaya = 150000;
                                let totalBiaya = baseBiaya;
                                const select = document.getElementById('obat');
                                const selectedOption = select.options[select.selectedIndex];
                                const harga = parseInt(selectedOption.getAttribute('data-harga')) || 0;
                                totalBiaya += harga;
                                document.getElementById('biaya_periksa').value = totalBiaya;
                            }

                            // Jalankan saat halaman pertama kali dibuka
                            document.addEventListener('DOMContentLoaded', hitungBiaya);
                        </script>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
