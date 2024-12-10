@extends('layouts.main')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content">
    <div class="container-fluid">
        <br>
        <h2>Dashboard Admin</h2>
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <?php
            $statBoxes = [
                ['class' => 'bg-info', 'icon' => 'ion ion-android-person', 'count' => $dokters, 'text' => 'Dokter', 'route' => route('dokter')],
                ['class' => 'bg-success', 'icon' => 'ion ion-android-person', 'count' => $pasiens, 'text' => 'Pasien', 'route' => route('pasien')],
                ['class' => 'bg-warning', 'icon' => 'ion ion-clipboard', 'count' => $polis, 'text' => 'Poli', 'route' => route('poli')],
                ['class' => 'bg-danger', 'icon' => 'ion ion-clipboard', 'count' => $obats, 'text' => 'Obat', 'route' => route('obat')],
            ];

            foreach ($statBoxes as $box) {
                echo '<div class="col-lg-3 col-6">';
                echo '<div class="small-box ' . $box['class'] . '">';
                echo '<div class="inner">';
                echo '<h3>' . $box['count'] . '</h3>';
                echo '<p>' . $box['text'] . '</p>';
                echo '</div>';
                echo '<div class="icon"><i class="' . $box['icon'] . '"></i></div>';
                echo '<a href="' . $box['route'] . '" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>
</section>

@endsection
