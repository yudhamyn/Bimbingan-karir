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
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

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
    <main id="main">
        <!-- Hero Section -->
        <section id="hero" class="d-flex align-items-center">
            <div class="container position-relative" data-aos="fade-up" data-aos-delay="100">
                <div class="row justify-content-center">
                    <div class="col-xl-7 col-lg-9 text-center mb-5">
                        <h1 class="display-4 fw-bold">Pendaftaran Poliklinik</h1>
                        <p class="lead">Sistem Temu Janji Pasien - Dokter</p>
                    </div>

                    <div class="card shadow">
                        <div class="card-header bg-secondary text-white text-center">
                            <h3 class="card-title mb-0">Formulir Daftar Poli</h3>
                        </div>
                        <form action="{{ route('pasien.daftarpoli.store') }}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group mb-3">
                                    <label for="no_rm">Nomor Rekam Medis</label>
                                    <input type="text" class="form-control" id="no_rm" name="no_rm" 
                                           placeholder="Nomor Rekam Medis" value="{{ $pasien->no_rm }}" disabled>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_poli">Pilih Poli</label>
                                    <select class="form-control" id="id_poli" name="id_poli" required>
                                        <option value="">-- Pilih Poli --</option>
                                        @foreach ($polis as $poli)
                                            <option value="{{ $poli->id }}">{{ $poli->nama_poli }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_poli')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="id_jadwal">Pilih Jadwal</label>
                                    <select class="form-control" id="id_jadwal" name="id_jadwal" disabled required>
                                        <option value="">-- Pilih Jadwal --</option>
                                    </select>
                                    @error('id_jadwal')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="keluhan">Keluhan</label>
                                    <textarea class="form-control" id="keluhan" name="keluhan" rows="4"
                                              placeholder="Tuliskan keluhan Anda di sini"></textarea>
                                </div>
                            </div>

                            <div class="card-footer d-flex justify-content-between">
                                <div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>
                                <div>
                                    <a href="/riwayat-pasien" class="btn btn-outline-primary">Lihat Riwayat</a>
                                    <a href="/pasien/logout" class="btn btn-danger">Keluar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <div id="preloader"></div>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center">
        <i class="bi bi-arrow-up-short"></i>
    </a>

    <script>
        $(document).ready(function() {
            $('#id_poli').on('change', function() {
                var poliID = $(this).val();

                $('#id_jadwal').prop('disabled', true).empty().append('<option value="">-- Pilih Jadwal --</option>');

                if (poliID) {
                    $.get('/getJadwals', { id_poli: poliID }, function(data) {
                        if (data.length > 0) {
                            $('#id_jadwal').prop('disabled', false);
                            data.forEach(function(jadwal) {
                                $('#id_jadwal').append(
                                    `<option value="${jadwal.id}">${jadwal.dokter.nama} - ${jadwal.hari} (${jadwal.jam_mulai}-${jadwal.jam_selesai})</option>`
                                );
                            });
                        }
                    });
                }
            });
        });
    </script>

    <!-- Vendor JS Files -->
    <script src="{{ asset('OnePage/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('OnePage/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('OnePage/assets/js/main.js') }}"></script>
</body>

</html>
