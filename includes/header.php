
<?php
if (!isset($judul)) {
    $judul = "Kantin Kampus";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($judul) ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>
<header>
    <h1>Pemesanan Kantin Kampus</h1>
    <nav>
        <a href="index.php">Daftar Menu</a>
        <a href="keranjang.php">Keranjang</a>
    </nav>
</header>
<main>

