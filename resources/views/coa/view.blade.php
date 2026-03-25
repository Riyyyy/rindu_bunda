@extends('layout')

@section('konten')
<div class="container mt-5">
    <div class="row mb-4">
        <div class="col-md-12 text-center">
            <h2>{{ $title }}</h2>
            <p class="text-muted">Dibuat oleh: {{ $nama }}</p>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Daftar Chart of Accounts (COA)</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th scope="col" class="px-4">#</th>
                            <th scope="col">Header Akun</th>
                            <th scope="col">Kode Akun</th>
                            <th scope="col">Nama Akun</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($coa as $index => $item)
                        <tr>
                            <td class="px-4">{{ $index + 1 }}</td>
                            <td>{{ $item->header_akun }}</td>
                            <td>{{ $item->kode_akun }}</td>
                            <td>{{ $item->nama_akun }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">
                                <em>Tidak ada data COA yang tersedia saat ini.</em>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
