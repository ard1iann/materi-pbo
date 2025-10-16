<?php
// Abstract class sebagai cetak biru
abstract class Bangun {
    protected $luas;

    // Method wajib yang harus diimplementasikan oleh turunan
    abstract protected function hitungLuas($var);
    abstract protected function cetakLuas();
}

// Kelas pertama: menghitung luas lingkaran
class Lingkaran extends Bangun {
    protected $jari;

    public function __construct($jari) {
        $this->jari = $jari;
        // panggil method protected dari dalam class
        $this->hitungLuas($this->jari);
    }

    // Overriding: implementasi method abstract
    protected function hitungLuas($var) {
        $this->luas = M_PI * pow($var, 2);
    }

    protected function cetakLuas() {
        echo "Luas Lingkaran = " . $this->luas . " cm²<br>";
    }

    // Overloading pakai __call untuk method tak dikenal (contoh dinamis)
    public function __call($name, $arguments) {
        if ($name == 'setJari') {
            $this->jari = $arguments[0];
            $this->hitungLuas($this->jari);
        } else {
            echo "Method '$name' tidak ditemukan.<br>";
        }
    }
}

// Kelas kedua: menghitung volume tabung (turunan Lingkaran)
class Tabung extends Lingkaran {
    private $tinggi;
    private $volume;

    // Overloading: method dengan nama sama tapi parameter beda
    public function hitungLuas($jari, $tinggi = null) {
        // kalau tinggi dikasih, artinya kita mau hitung luas permukaan tabung
        if ($tinggi !== null) {
            $this->luas = (2 * M_PI * $jari * ($jari + $tinggi));
        } else {
            // panggil parent method (overriding)
            parent::hitungLuas($jari);
        }
    }

    // Method public untuk hitung volume tabung
    public function hitungVolume($tinggi) {
        $this->tinggi = $tinggi;
        $this->volume = M_PI * pow($this->jari, 2) * $this->tinggi;
    }

    // Override cetakLuas
    protected function cetakLuas() {
        echo "Luas Permukaan Tabung = " . $this->luas . " cm²<br>";
    }

    public function cetakVolume() {
        echo "Volume Tabung = " . $this->volume . " cm³<br>";
    }
}

// --------------------
// Contoh Penggunaan
// --------------------
$lingkaran = new Lingkaran(7);
$lingkaran->cetakLuas();
$lingkaran->setJari(10); // overloading pakai __call
$lingkaran->cetakLuas();

$tabung = new Tabung(7);
$tabung->hitungVolume(10);
$tabung->cetakVolume();
$tabung->hitungLuas(7, 10); // overloading method hitungLuas()
$tabung->cetakLuas();
?>
