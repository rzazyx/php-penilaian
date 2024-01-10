<!-- views/penilaian/laporan.php -->
<?= $this->extend('templates/index'); ?>

<?= $this->section('page-content'); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Penilaian</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .container {
            max-width: 1200px;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Laporan
            </div>

            <div class="card-body">
                <h3 style="margin-bottom: 20px;">Laporan Penilaian</h3>
                <!-- Cetak Button -->
                <a href="<?= base_url('penilaian/cetakPDFlaporan'); ?>" class="btn btn-primary">Cetak</a>
                <!-- Table -->
                <table class="table">
                    <!-- Table Headers -->
                    <thead>
                        <tr>
                            <th>No Kontrak</th>
                            <th>Nama Vendor</th>
                            <th>Nama Cabang</th>
                            <th>Bulan</th>
                            <th>Total Nilai</th>
                            <th>Monthly Penalty</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $monthlyPenalties = [];

                        foreach ($laporan as $item) : ?>
                            <!-- Table Rows -->
                            <tr>
                                <td><?= $item['no_kontrak']; ?></td>
                                <td><?= $item['nama_vendor']; ?></td>
                                <td><?= $item['nama_cabang']; ?></td>
                                <td><?= $item['month']; ?></td>
                                <td><?= $totalScore = $item['personil'] + $item['kinerja'] + $item['m_mitra'] + $item['material'] + $item['kedisiplinan'] + $item['fatal_error']; ?></td>
                                <td><?= $penalty = calculateMonthlyPenalty($totalScore); ?>%</td>
                            </tr>

                        <?php
                            // Track monthly penalty counts
                            $monthKey = $item['month'];
                            if (!isset($monthlyPenalties[$monthKey])) {
                                $monthlyPenalties[$monthKey] = [
                                    0 => 0, 5 => 0, 10 => 0, 20 => 0, 30 => 0, 100 => 0
                                ];
                            }

                            // Count records in each monthly penalty range
                            $monthlyPenalties[$monthKey][$penalty]++;
                        endforeach; ?>
                    </tbody>
                </table>

                </table>

                <!-- Summary of Monthly Penalties -->
                <!-- Display Monthly Penalties -->
                <h3 style="margin-top: 40px;"> Summary of Monthly Penalties</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Bulan</th>
                            <th>Monthly Penalty</th>
                            <th>Total Count</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($monthlyPenalties as $month => $penalties) : ?>
                            <?php foreach ($penalties as $penalty => $count) : ?>
                                <tr>
                                    <td><?= $month; ?></td>
                                    <td><?= $penalty; ?>%</td>
                                    <td><?= $count; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>


                <?= $this->endSection(); ?>

                <?php
                function calculateMonthlyPenalty($totalScore)
                {
                    if ($totalScore >= 92) {
                        return 0.00;
                    } elseif ($totalScore >= 80) {
                        return 5.00;
                    } elseif ($totalScore >= 70) {
                        return 10.00;
                    } elseif ($totalScore >= 60) {
                        return 20.00;
                    } elseif ($totalScore >= 50) {
                        return 30.00;
                    } else {
                        return 100.00;
                    }
                }
                ?>