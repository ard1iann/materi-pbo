<?php
// Interface dasar
interface Shape {
    public function getArea();
}

// Abstract class
abstract class BangunDatar implements Shape {
    protected $r;
    public function __construct($r) {
        $this->r = $r;
    }
}

// Class turunan
class Persegi extends BangunDatar {
    public function getArea() {
        return pow(2 * $this->r, 2); // (2r)^2 = 4r²
    }
}

class Lingkaran extends BangunDatar {
    public function getArea() {
        return M_PI * pow($this->r, 2); // πr²
    }
}

class Segitiga extends BangunDatar {
    public function getArea() {
        return 0.5 * pow($this->r, 2); // ½r²
    }
}

// Kelas utama untuk menghitung luas biru
class LatarBiru {
    private $persegi;
    private $lingkaran;
    private $segitiga;
    private $luasBiru;
    private $r;

    public function __construct($r) {
        $this->r = $r;
        $this->persegi = new Persegi($r);
        $this->lingkaran = new Lingkaran($r);
        $this->segitiga = new Segitiga($r);
    }

    public function hitung() {
        $this->luasBiru = $this->persegi->getArea() - 
                         ($this->lingkaran->getArea() + $this->segitiga->getArea());
        return $this;
    }

    public function tampilkan() {
        echo "\n=== HASIL PERHITUNGAN ===\n";
        echo "Jari-jari (r): {$this->r}\n";
        echo "Luas bidang berwarna biru = " . number_format($this->luasBiru, 2) . " satuan luas\n";
        return $this;
    }
}

// --- Logika Interaktif ---
echo "=== Hitung Luas Bidang Biru ===\n";
echo "Pilih input yang diketahui:\n";
echo "1. Jari-jari lingkaran\n";
echo "2. Alas segitiga\n";
echo "3. Panjang sisi persegi\n";
$pilihan = (int) readline("Pilihan (1/2/3): ");

switch ($pilihan) {
    case 1:
        $r = (float) readline("Masukkan jari-jari (r): ");
        break;
    case 2:
        $alas = (float) readline("Masukkan alas segitiga: ");
        $r = $alas; // karena alas = r
        break;
    case 3:
        $sisi = (float) readline("Masukkan panjang sisi persegi: ");
        $r = $sisi / 2; // karena sisi = 2r
        break;
    default:
        echo "Pilihan tidak valid!\n";
        exit;
}

$latar = new LatarBiru($r);
$latar->hitung()->tampilkan();
?>
