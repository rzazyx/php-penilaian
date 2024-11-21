<!-- views/penilaian/cetak_penalty.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Summary of Monthly Penalties</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <style>
        .container {
            max-width: 1200px;
            margin-top: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Summary of Monthly Penalties
            </div>

            <div class="card-body">
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
            </div>
        </div>
    </div>
</body>

</html>