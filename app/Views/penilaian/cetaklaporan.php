<!-- views/penilaian/cetak_laporan.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penilaian</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .table-container {
            max-width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        h3 {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <div class="table-container">
        <h3>Laporan Penilaian</h3>
        <!-- Table -->
        <table>
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
                <?php foreach ($laporan as $item) : ?>
                    <!-- Table Rows -->
                    <tr>
                        <td><?= $item['no_kontrak']; ?></td>
                        <td><?= $item['nama_vendor']; ?></td>
                        <td><?= $item['nama_cabang']; ?></td>
                        <td><?= $item['month']; ?></td>
                        <td><?= $totalScore = $item['personil'] + $item['kinerja'] + $item['m_mitra'] + $item['material'] + $item['kedisiplinan'] + $item['fatal_error']; ?></td>
                        <td><?= $calculateMonthlyPenalty($totalScore); ?>%</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>

</html>