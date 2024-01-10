<!-- app/Views/penilaian/cetak.php -->
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
    </style>
</head>

<body>
    <h2>Laporan Penilaian</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No Kontrak</th>
                <th>Jenis Petugas</th>
                <th>Nama Vendor</th>
                <th>Nama Cabang</th>
                <th>Tanggal Penilaian</th>
                <th>Score Personil</th>
                <th>Score Kinerja</th>
                <th>Score Manajemen Mitra</th>
                <th>Score Material dan Machine</th>
                <th>Score Kedisipilnan</th>
                <th>Score Fatal Error</th>
                <th>Total Nilai</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($penilaian as $key => $item) : ?>
                <tr>
                    <td><?= $key + 1; ?></td>
                    <td><?= $item['no_kontrak']; ?></td>
                    <td><?= $item['jenis_petugas']; ?></td>
                    <td><?= $item['nama_vendor']; ?></td>
                    <td><?= $item['nama_cabang']; ?></td>
                    <td><?= $item['tanggal'] ?? 'Belum Dinilai'; ?></td>
                    <td><?= $item['personil'] == 0 ? '' : $item['personil']; ?></td>
                    <td><?= $item['kinerja'] == 0 ? '' : $item['kinerja']; ?></td>
                    <td><?= $item['m_mitra'] == 0 ? '' : $item['m_mitra']; ?></td>
                    <td><?= $item['material'] == 0 ? '' : $item['material']; ?></td>
                    <td><?= $item['kedisiplinan'] == 0 ? '' : $item['kedisiplinan']; ?></td>
                    <td><?= $item['fatal_error'] == 0 ? '' : $item['fatal_error']; ?></td>
                    <td><?= $item['personil'] + $item['kinerja'] + $item['m_mitra'] + $item['material'] + $item['kedisiplinan'] + $item['fatal_error']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>