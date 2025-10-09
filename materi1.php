<?php
// Definisi class Lingkaran
class Lingkaran {
    // Property (variabel dalam class)
    private $jariJari;

    // Constructor untuk menginisialisasi nilai jari-jari
    public function __construct($jariJari) {
        $this->jariJari = $jariJari;
    }

    // Method untuk menghitung luas lingkaran
    public function hitungLuas() {
        return pi() * pow($this->jariJari, 2);
    }

    // Method untuk menampilkan informasi
    public function tampilkanLuas() {
        echo "Luas lingkaran dengan jari-jari {$this->jariJari} adalah: " . $this->hitungLuas();
    }
}

// Membuat object dari class Lingkaran
$lingkaran1 = new Lingkaran(7); // jari-jari = 7
$lingkaran1->tampilkanLuas();
