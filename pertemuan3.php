<?php
class Segitiga { 
    private $a; // sisi a
    private $b; // sisi b
    private $c; // sisi c

    // Constructor dijalankan saat objek dibuat
    public function __construct($a, $b, $c) {
        $this->a = $a;
        $this->b = $b;
        $this->c = $c;
        echo "Objek Segitiga dibuat dengan sisi: a={$a}, b={$b}, c={$c}<br>";
    }

    // Method untuk menghitung keliling
    public function keliling() {
        return $this->a + $this->b + $this->c;
    }

    // Method untuk menghitung luas (pakai rumus Heron)
    public function luas() {
        $s = $this->keliling() / 2; // setengah keliling
        return sqrt($s * ($s - $this->a) * ($s - $this->b) * ($s - $this->c));
    }

    // Destructor dijalankan saat objek dihapus
    public function __destruct() {
        echo "<br>Objek Segitiga dihapus dari memori.";
    }
}

// Membuat objek segitiga
$segitiga1 = new Segitiga(5, 7, 8);

// Tampilkan hasil
echo "Keliling Segitiga: " . $segitiga1->keliling() . "<br>";
echo "Luas Segitiga: " . round($segitiga1->luas(), 2) . "<br>";
?>
