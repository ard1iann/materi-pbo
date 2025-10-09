<?php
class Keuangan {
    const PAJAK = 0.1;       // konstanta pajak
    private static $saldo = 0; 
    private static $urutan = 0;
    private static $data = []; // buat nyimpen semua transaksi

    private $jenis;
    private $nominal;
    private $keterangan;
    private $no;

    public function __construct($jenis, $nominal, $keterangan) {
        $this->jenis = $jenis;
        $this->nominal = $nominal;
        $this->keterangan = $keterangan;
        self::$urutan++;

        // hitung saldo
        if ($jenis == "D") {
            self::$saldo -= $nominal;
        } elseif ($jenis == "K") {
            $pendapatanBersih = $nominal - ($nominal * self::PAJAK);
            self::$saldo += $pendapatanBersih;
        }

        $this->no = self::$urutan;

        // simpan data transaksi ke array
        self::$data[] = [
            "no" => $this->no,
            "jenis" => $this->jenis,
            "nominal" => $this->nominal,
            "keterangan" => $this->keterangan,
            "saldo" => self::$saldo
        ];
    }

    // saldo akhir
    public static function getSaldo() {
        return self::$saldo;
    }

    // tampilkan tabel semua transaksi
    public static function tampilkanLaporan() {
        if (empty(self::$data)) {
            echo "Belum ada transaksi.";
            return;
        }

        echo "<table border='1' cellpadding='5' cellspacing='0'>";
        echo "<tr><th>No</th><th>Jenis</th><th>Nominal</th><th>Keterangan</th><th>Saldo</th></tr>";
        foreach (self::$data as $row) {
            echo "<tr>";
            echo "<td>{$row['no']}</td>";
            echo "<td>{$row['jenis']}</td>";
            echo "<td>{$row['nominal']}</td>";
            echo "<td>{$row['keterangan']}</td>";
            echo "<td>{$row['saldo']}</td>";
            echo "</tr>";
        }
        echo "</table>";
        echo "<br>Laba/Rugi : " . abs(self::getSaldo());
    }
}
?>

<!-- ====== Form Input ====== -->
<form method="post">
    Jenis (D/K): <input type="text" name="jenis" maxlength="1" required><br><br>
    Nominal: <input type="number" name="nominal" required><br><br>
    Keterangan: <input type="text" name="keterangan" required><br><br>
    <button type="submit" name="submit">Tambah Transaksi</button>
</form>

<hr>

<?php
// Proses input dari form
session_start();
if (!isset($_SESSION['transaksi'])) {
    $_SESSION['transaksi'] = [];
}

// kalau form di-submit
if (isset($_POST['submit'])) {
    $jenis = strtoupper($_POST['jenis']); // D atau K
    $nominal = (int)$_POST['nominal'];
    $ket = $_POST['keterangan'];

    // simpan transaksi baru ke session
    $_SESSION['transaksi'][] = [$jenis, $nominal, $ket];
}

// Bangun ulang transaksi dari session
foreach ($_SESSION['transaksi'] as $t) {
    new Keuangan($t[0], $t[1], $t[2]);
}

// tampilkan laporan
Keuangan::tampilkanLaporan();
?>
