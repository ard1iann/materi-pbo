<?php

 class hitung {
    private $sisi;
    private $jari;
    private $keliling;
    private $luas;

    private function kelper($jari) {
        $this->keliling="...";
    }

    private function keling($sisi) {

    }

    private function luas($var) {

    }

    public function hitungan($jari, $sisi=5) {
        if($sisi==5) {
            // hitung keliling persegi
            $this->kelper($jari);
            // tampilkan hitung luas
            $this->luas($sisi);
        } else {
            // keliling lingkaran
            $this->keling($sisi);
            // tampilkan hitung luas
            $this->luas($sisi);
        }
    }
 }


?>