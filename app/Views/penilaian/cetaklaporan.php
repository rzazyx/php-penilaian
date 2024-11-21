<!-- views/penilaian/cetak_laporan.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penilaian</title>
    <style>
        .container {
            max-width: 100%;
            margin-top: 20px;
        }

        .company-name {
            text-align: center;
            font-size: 14px;
            line-height: 1.4;
        }

        .company-name h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }

        .company-name p {
            margin: 0;
        }

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
        <!--container-->
        <div class="container">
            <div class="header-container">
                <div class="company-name">
                    <div class="logo">


                        <h1>PT ASDP Indonesia Ferry (Persero)</h1>
                        <p>Kantor Pusat : Jl. Jend. Ahmad Yani Kav. 52 A, Cempaka Putih Timur,Kota Jakarta Pusat,10510, Indonesia</p>
                        <p>Call Center 021191
                            E-mail: cs@indonesiaferry.co.id</p>
                    </div>
                </div>
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
                <table width="100%">
                    <tr>
                        <td>
                            <br>
                            <br>
                            <p style="margin-left: 50px;">Mengetahui,</p>
                            <p style="margin-left: 50px;">Manager Jaminan Pelayanan</p>
                            <br>
                            <br>
                            <p style="margin-left: 50px; text-align: justify;">Jerry Warnerin Wiradireja</p>
                        </td>
                        <td>
                            <br>
                            <p style="margin-left: 200px; margin-top: 0px">Pekalongan, 20 Februari 2024</p>
                            <p style="margin-left: 200px; text-align: justify;">Staff Jaminan Pelayanan</p>
                            <br>
                            <br>
                            <p style="margin-left: 200px; text-align: justify;"> Harry Balawa</p>
                        </td>
                    </tr>
                </table>

            </div>
</body>

</html>