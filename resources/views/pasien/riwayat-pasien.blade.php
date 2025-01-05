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
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('OnePage/assets/vendor/aos/aos.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/remixicon/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('OnePage/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="{{ asset('OnePage/assets/css/style.css') }}" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Riwayat Pasien</h1>

                </div><!-- /.col -->
            </div><!-- /.row -->
            <a href="/pasien/daftar-poli">
                <button type="button" class="btn btn-outline-primary">Kembali</button>
            </a>
            <div class="card">
    <div class="card-header">
        <h3 class="card-title">Riwayat Pasien</h3>
    </div>
    <!-- /.card-header -->
                                        
            <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
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
                                <td>
                                    <button class="btn btn-primary" data-toggle="modal"
                                        data-target="#editModal{{ $idPeriksa }}">
                                        <i class="fas fa-eye"></i> Detail Riwayat Periksa
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7">Tidak ada riwayat periksa pasien.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                
            </div>
            <!-- /.card-body -->
        </div>

                    @foreach ($detailPeriksas->groupBy('id_periksa') as $idPeriksa => $groupedDetailPeriksas)
                        <!-- Modal Edit -->
                        <div class="modal fade" id="editModal{{ $idPeriksa }}" tabindex="-1" role="dialog"
                            aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Detail Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="editForm">
                                            <div class="form-group">
                                                <label>Tanggal Periksa</label>
                                                <input type="text" class="form-control" readonly required
                                                    value="{{ $groupedDetailPeriksas[0]->created_at }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Pasien</label>
                                                <input type="text" class="form-control" readonly required
                                                    value="{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->pasien->nama }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Dokter</label>
                                                <input type="text" class="form-control" readonly required
                                                    value="{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->jadwal->dokter->nama }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Keluhan</label>
                                                <input type="text" class="form-control" readonly required
                                                    value="{{ $groupedDetailPeriksas[0]->periksa->daftarPoli->keluhan }}">
                                            </div>
                                            <div class="form-group">
                                                <label>Catatan</label>
                                                <textarea class="form-control" readonly required>{{ $groupedDetailPeriksas[0]->periksa->catatan }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>Obat</label>
                                                <div id="selectedObats" class="border overflow-auto p-2"
                                                    style="height: 100px;">
                                                    @foreach ($groupedDetailPeriksas as $detailPeriksa)
                                                        {{ $detailPeriksa->obat->nama_obat }}
                                                        ({{ $detailPeriksa->obat->kemasan }})
                                                        - Rp. {{ $detailPeriksa->obat->harga }}
                                                        @if (!$loop->last)
                                                            <br>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label>Jasa</label>
                                                <input type="text" class="form-control" readonly required value="150000">
                                            </div>
                                            <div class="form-group">
                                                <label>Total Biaya (Jasa + Obat)</label>
                                                <input type="text" class="form-control" readonly required
                                                    value="Rp {{ $groupedDetailPeriksas[0]->periksa->biaya }}">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <a href="/pasien/logout">
                                            <button class="logout-style btn btn-danger" data-toggle="tooltip"
                                                data-placement="top" title="Logout" type="button">
                                                <span class="glyphicon glyphicon-off" aria-hidden="true"></span> Keluar
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    @endforeach
                </div>
            </div><!-- /.container-fluid -->
        </div>
        
        </body>
<!-- Bootstrap 4 -->
<script src="{{ asset('template-admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    
</html>
