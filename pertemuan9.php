<?php

$data = [90, 27, 23, 53, 42, 13, 61, 34, 23, 33];

// 1. Bilangan Prima
$prima = array_filter($data, function($n) {
    if ($n < 2) return false;
    for ($i = 2; $i <= sqrt($n); $i++) {
        if ($n % $i == 0) return false;
    }
    return true;
});

// 2. Bilangan Ganjil
$ganjil = array_filter($data, fn($n) => $n % 2 !== 0);

// 3. Bilangan 20–40
$rentang = array_filter($data, fn($n) => $n >= 20 && $n <= 40);

?>
<!DOCTYPE html>
<html>
<head>
    <title>Filter Angka</title>
    <style>
        table {
            border-collapse: collapse;
            margin-bottom: 20px;
            width: 250px;
        }
        th, td {
            border: 1px solid #444;
            padding: 8px;
            text-align: center;
        }
        th {
            background: #ddd;
        }
    </style>
</head>
<body>

<h2>Bilangan Prima</h2>
<table>
    <tr><th>Angka</th></tr>
    <?php foreach ($prima as $p): ?>
        <tr><td><?= $p ?></td></tr>
    <?php endforeach; ?>
</table>

<h2>Bilangan Ganjil</h2>
<table>
    <tr><th>Angka</th></tr>
    <?php foreach ($ganjil as $g): ?>
        <tr><td><?= $g ?></td></tr>
    <?php endforeach; ?>
</table>

<h2>Bilangan 20–40</h2>
<table>
    <tr><th>Angka</th></tr>
    <?php foreach ($rentang as $r): ?>
        <tr><td><?= $r ?></td></tr>
    <?php endforeach; ?>
</table>

</body>
</html>
