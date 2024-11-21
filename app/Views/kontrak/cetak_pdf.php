<?php
$this->db = db_connect();
$bulane = array('', 'Janurari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
?>

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

        .logo {
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
            /* Ubah sesuai kebutuhan */
            height: auto;
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

        /* Bagian Tanda Tangan */
        .signatures {
            position: fixed;
            bottom: 50px;
            left: 50px;
            right: 50px;
        }

        .signature-left,
        .signature-right {
            width: 45%;
            display: inline-block;
            text-align: center;
            padding-top: 50px;
        }

        .no-border-bottom {
            border: none;
            /* Atau Anda dapat menggunakan border-bottom: none; jika ingin menghilangkan hanya garis bawah */
        }
    </style>
</head>

<body>
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
        <table width="100%">
            <tr>
                <td>
                    <br>
                    <br>
                    <p style="margin-left: 90px;">Mengetahui,</p>
                    <p style="margin-left: 90px;">Manager Jaminan Pelayanan</p>
                    <br>
                    <br>
                    <p style="margin-left: 100px; text-align: justify;">Jerry Warnerin Wiradireja</p>
                </td>
                <td>
                    <br>
                    <p style="margin-left: 415px; margin-top: 0px">Pekalongan, 20 Februari 2024</p>
                    <p style="margin-left: 455px; text-align: justify;">Staff Jaminan Pelayanan</p>
                    <br>
                    <br>
                    <p style="margin-left: 500px; text-align: justify;"> Harry Balawa</p>
                </td>
            </tr>
        </table>

</body>

</html>