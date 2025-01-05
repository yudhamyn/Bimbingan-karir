<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Sistem Temu Janji Pasien</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('OnePage/assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('OnePage/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|Raleway:300,400,500,700|Poppins:300,400,500,700" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('OnePage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f7f9fc;
        }

        .content-header {
            margin-bottom: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .table thead {
            background-color: #007bff;
            color: #fff;
        }

        .modal-header {
            background-color: #007bff;
            color: #fff;
        }

        .modal-footer {
            justify-content: space-between;
        }

        .form-group label {
            font-weight: 500;
        }

        .btn-outline-primary {
            margin-bottom: 15px;
        }
    </style>

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-sm-6">
                    <h1 class="m-0 text-primary">Riwayat Pasien</h1>
                </div>
                <div class="col-sm-6 text-end">
                    <a href="/pasien/daftar-poli" class="btn btn-outline-primary">Kembali</a>
                </div>
            </div>

            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h3 class="card-title">Riwayat Pasien</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Nama Pasien</th>
                                <th>Alamat</th>
                                <th>No. KTP</th>
                                <th>No. Telepon</th>
                                <th>No. RM</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($detailPeriksas->groupBy('id_periksa') as $idPeriksa => $groupedDetailPeriksas)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->nama ?? '-' }}</td>
                                    <td>{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->alamat ?? '-' }}</td>
                                    <td>{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->no_ktp ?? '-' }}</td>
                                    <td>{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->no_hp ?? '-' }}</td>
                                    <td>{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->no_rm ?? '-' }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $idPeriksa }}">
                                            <i class="bi bi-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Tidak ada riwayat periksa pasien.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Modals -->
            @foreach ($detailPeriksas->groupBy('id_periksa') as $idPeriksa => $groupedDetailPeriksas)
                <div class="modal fade" id="detailModal{{ $idPeriksa }}" tabindex="-1" role="dialog">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Detail Riwayat Periksa</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label>Tanggal Periksa</label>
                                    <input type="text" class="form-control" readonly value="{{ $groupedDetailPeriksas[0]->created_at }}">
                                </div>
                                <div class="mb-3">
                                    <label>Nama Pasien</label>
                                    <input type="text" class="form-control" readonly value="{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->nama }}">
                                </div>
                                <div class="mb-3">
                                    <label>Nama Dokter</label>
                                    <input type="text" class="form-control" readonly value="{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->jadwal->dokter->nama }}">
                                </div>
                                <div class="mb-3">
                                    <label>Keluhan</label>
                                    <textarea class="form-control" readonly>{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->keluhan }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Catatan</label>
                                    <textarea class="form-control" readonly>{{ $groupedDetailPeriksas[0]->periksa->catatan }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label>Obat</label>
                                    <div class="border p-2" style="height: 100px; overflow-y: auto;">
                                        @foreach ($groupedDetailPeriksas as $detailPeriksa)
                                            {{ $detailPeriksa->obat->nama_obat }} ({{ $detailPeriksa->obat->kemasan }}) - Rp. {{ $detailPeriksa->obat->harga }}
                                            @if (!$loop->last)
                                                <br>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <label>Total Biaya</label>
                                    <input type="text" class="form-control" readonly value="Rp {{ $groupedDetailPeriksas[0]->periksa->biaya }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                <a href="/pasien/logout" class="btn btn-danger">Keluar</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="{{ asset('OnePage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>

</html>
