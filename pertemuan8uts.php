<?php
// Abstract class
abstract class BangunDatar {
    protected $jariJari;
    protected $sisi;

    public function __construct($jariJari = 0, $sisi = 0) {
        $this->jariJari = $jariJari;
        $this->sisi = $sisi;
    }

    // Method abstrak yang wajib diimplementasikan
    abstract public function hitungLuas();
}

// Class turunan untuk Setengah Lingkaran
class SetengahLingkaran extends BangunDatar {
    public function hitungLuas() {
        return 0.5 * M_PI * pow($this->jariJari, 2);
    }
}

// Class turunan untuk Persegi
class Persegi extends BangunDatar {
    public function hitungLuas() {
        return pow($this->sisi, 2);
    }
}

// Class utama untuk menghitung luas bidang hitam (gabungan)
class BidangHitam {
    private $setengahLingkaran;
    private $persegi;

    public function __construct(SetengahLingkaran $setengahLingkaran, Persegi $persegi) {
        $this->setengahLingkaran = $setengahLingkaran;
        $this->persegi = $persegi;
    }

    public function hitungLuasTotal() {
        return $this->setengahLingkaran->hitungLuas() + $this->persegi->hitungLuas();
    }
}

// ------------------------------
// Input dari user
echo "Masukkan jari-jari setengah lingkaran: ";
$jariJari = trim(fgets(STDIN));

echo "Masukkan sisi persegi: ";
$sisi = trim(fgets(STDIN));

// Buat objek masing-masing bangun
$setengahLingkaran = new SetengahLingkaran($jariJari);
$persegi = new Persegi(0, $sisi);

// Buat objek bidang hitam
$bidangHitam = new BidangHitam($setengahLingkaran, $persegi);

// Tampilkan hasil
echo "\n=== HASIL PERHITUNGAN ===\n";
echo "Jari-jari: " . $jariJari . "\n";
echo "Sisi persegi: " . $sisi . "\n";
echo "Luas setengah lingkaran: " . round($setengahLingkaran->hitungLuas(), 2) . "\n";
echo "Luas persegi: " . round($persegi->hitungLuas(), 2) . "\n";
echo "Total luas bidang hitam: " . round($bidangHitam->hitungLuasTotal(), 2) . " satuan luas\n";
?>