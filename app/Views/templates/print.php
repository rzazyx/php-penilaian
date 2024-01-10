<!-- views/templates/print.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 10px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        h1 {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <?= $this->renderSection('print-content'); ?>
    </div>
</body>

</html>