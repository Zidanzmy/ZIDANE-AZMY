
<?php
require_once "includes/fungsi.php";
require_once "data/menu.php";

$judul = "Daftar Menu Kantin";
$pesan = ambilFlash();

// Menentukan kategori
$kategori = $_GET["kategori"] ?? "";
if (!in_array($kategori, ["", "Makanan", "Minuman"], true)) {
    $kategori = "";
}

// Pencarian menu
$cari = trim($_GET["cari"] ?? "");
?>

<?php require "includes/header.php"; ?>

<h2>Daftar Menu Kantin</h2>

<?php if ($pesan): ?>
    <p><?= e($pesan) ?></p>
<?php endif; ?>

<form method="get" action="index.php">
    <label for="cari">Cari menu:</label>
    <input
        type="text"
        id="cari"
        name="cari"
        placeholder="Contoh: Nasi Goreng"
        value="<?= e($cari) ?>"
    >

    <label for="kategori">Kategori:</label>
    <select name="kategori" id="kategori">
        <option value="">Semua</option>
        <option value="Makanan"
            <?= $kategori === "Makanan" ? "selected" : "" ?>>
            Makanan
        </option>
        <option value="Minuman"
            <?= $kategori === "Minuman" ? "selected" : "" ?>>
            Minuman
        </option>
    </select>

    <button type="submit">Cari</button>
</form>

<div class="daftar-menu">
    <?php
    $ditemukan = false;

    foreach ($menu as $kode => $item):
        if (
            $kategori !== "" &&
            $item["kategori"] !== $kategori
        ) {
            continue;
        }

        if (
            $cari !== "" &&
            stripos($item["nama"], $cari) === false
        ) {
            continue;
        }

        $ditemukan = true;
    ?>
        <article class="menu">
            <h3><?= e($item["nama"]) ?></h3>

            <p>Kode: <?= e($kode) ?></p>
            <p>Kategori: <?= e($item["kategori"]) ?></p>
            <p>Harga: <?= rupiah($item["harga"]) ?></p>

            <form action="proses.php" method="post">
                <input type="hidden" name="aksi" value="tambah">
                <input type="hidden" name="kode" value="<?= e($kode) ?>">

                <label for="jumlah-<?= e($kode) ?>">
                    Jumlah:
                </label>

                <input
                    type="number"
                    id="jumlah-<?= e($kode) ?>"
                    name="jumlah"
                    min="1"
                    max="10"
                    value="1"
                    required
                >

                <button type="submit">Tambah ke Keranjang</button>
            </form>
        </article>
    <?php endforeach; ?>

    <?php if (!$ditemukan): ?>
        <p>Menu tidak ditemukan.</p>
    <?php endif; ?>
</div>

<?php require "includes/footer.php"; ?>
