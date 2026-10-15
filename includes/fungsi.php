
<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["keranjang"])) {
    $_SESSION["keranjang"] = [];
}

function e($teks) {
    return htmlspecialchars(
        (string) $teks,
        ENT_QUOTES,
        "UTF-8"
    );
}

function rupiah($angka) {
    return "Rp" . number_format($angka, 0, ",", ".");
}

function hitungSubtotalKeranjang($keranjang, $menu) {
    $subtotal = 0;

    foreach ($keranjang as $kode => $jumlah) {
        if (isset($menu[$kode])) {
            $subtotal += $menu[$kode]["harga"] * $jumlah;
        }
    }

    return $subtotal;
}

function hitungDiskon($subtotal) {
    return $subtotal >= 50000 ? $subtotal * 0.10 : 0;
}

function hitungTotalAkhir($subtotal) {
    return $subtotal - hitungDiskon($subtotal);
}

function setFlash($pesan) {
    $_SESSION["flash"] = $pesan;
}

function ambilFlash() {
    $pesan = $_SESSION["flash"] ?? null;
    unset($_SESSION["flash"]);
    return $pesan;
}

function redirect($halaman) {
    header("Location: " . $halaman);
    exit;
}
