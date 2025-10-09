<?php

class Mobil {
    public $nama, $merk, $warna,
    $kecepatanMaksimal, $jumlahPenumpang;

    public function tambahKecepatan() {
        return "kecepatan bertambah!";
    }
}

class MobilSport extends Mobil {
    public $turbo = false;

    public function JalankanTurbo() {
        $this->turbo = true;
        return "turbo dijalankan!";
    }
}

$mobil1 = new MobilSport();
echo $mobil1->tambahKecepatan();
echo "<br>";
echo $mobil1->JalankanTurbo();

?>