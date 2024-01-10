<!-- app/Views/kontrak/cetak_dompdf.php -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kontrak</title>
    <!-- Include necessary stylesheets -->
    <style>
        .container {
            max-width: 100%;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <!--container-->
    <div class="container">
        <!--card-->
        <div class="card">
            <div class="card-header bg-primary text-white">
                Data Kontrak
            </div>
            <div class="card-body">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Kontrak</th>
                            <th>Jenis Petugas</th>
                            <th>Nama Vendor</th>
                            <th>Nama Cabang</th>
                            <th>Awal Kontrak</th>
                            <th>Akhir Kontrak</th>
                            <th>Sisa Waktu (hari)</th>
                            <th>Keterangan</th>
                            <!-- Add other fields as needed -->
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($kontrak as $kontrak) : ?>
                            <tr>
                                <td><?= $i++; ?></td>
                                <td><?= $kontrak['no_kontrak']; ?></td>
                                <td><?= $kontrak['jenis_petugas']; ?></td>
                                <td><?= $kontrak['nama_vendor']; ?></td>
                                <td><?= $kontrak['nama_cabang']; ?></td>
                                <td><?= $kontrak['awal_kontrak']; ?></td>
                                <td><?= $kontrak['akhir_kontrak']; ?></td>
                                <td><?= $kontrak['sisa_waktu']; ?></td>
                                <td><?= $kontrak['keterangan']; ?></td>
                                <!-- Add other fields as needed -->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>