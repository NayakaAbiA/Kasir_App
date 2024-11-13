<?php 

    function format_uang($angka)
    {
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }

function terbilang($angka) {
    $angka = abs($angka); // Menghilangkan tanda minus jika ada
    $baca = array(
        '', 'satu', 'dua', 'tiga', 'empat', 'lima', 'enam', 'tujuh', 'delapan', 'sembilan', 
        'sepuluh', 'sebelas', 'dua belas', 'tiga belas', 'empat belas', 'lima belas', 
        'enam belas', 'tujuh belas', 'delapan belas', 'sembilan belas', 
        'dua puluh', 'tiga puluh', 'empat puluh', 'lima puluh', 'enam puluh', 
        'tujuh puluh', 'delapan puluh', 'sembilan puluh'
    );
    $terbilang = '';

    if ($angka < 12) {
        $terbilang = $baca[$angka]; // Angka kurang dari 12 langsung ambil dari array
    } elseif ($angka < 20) {
        $terbilang = $baca[$angka]; // Angka 10-19 langsung ambil dari array
    } elseif ($angka < 100) {
        $puluhan = floor($angka / 10); // Membulatkan angka ke bawah untuk puluhan
        $satuan = $angka % 10; // Mendapatkan angka satuan
        $terbilang = $baca[$puluhan + 18]; // 'dua puluh', 'tiga puluh', dll. dimulai dari index 18
        if ($satuan) {
            $terbilang .= ' ' . $baca[$satuan]; // Menambahkan satuan jika ada
        }
    } elseif ($angka < 200) {
        // Menangani angka 100-199
        $terbilang = 'seratus';
        if ($angka > 100) {
            $terbilang .= ' ' . terbilang($angka - 100); // Memanggil rekursi hanya untuk angka lebih besar dari 100
        }
    } elseif ($angka < 1000) {
        // Menangani angka 200-999
        $ratusan = floor($angka / 100); // Mengambil ratusan
        $terbilang = $baca[$ratusan] . ' ratus'; // Menambahkan 'ratus' pada bagian ratusan
        if ($angka % 100) {
            $terbilang .= ' ' . terbilang($angka % 100); // Rekursi untuk sisa angka (puluhan dan satuan)
        }
    } elseif ($angka < 1000000) {
        // Menangani angka 1.000-999.999
        $ribuan = floor($angka / 1000); // Mengambil ribuan
        $terbilang = terbilang($ribuan) . ' ribu'; // Menambahkan 'ribu' pada bagian ribuan
        if ($angka % 1000) {
            $terbilang .= ' ' . terbilang($angka % 1000); // Rekursi untuk sisa angka (ratusan, puluhan, dan satuan)
        }
    } elseif ($angka < 1000000000) {
        // Menangani angka 1.000.000-999.999.999
        $jutaan = floor($angka / 1000000); // Mengambil jutaan
        $terbilang = terbilang($jutaan) . ' juta'; // Menambahkan 'juta' pada bagian juta
        if ($angka % 1000000) {
            $terbilang .= ' ' . terbilang($angka % 1000000); // Rekursi untuk sisa angka (ribuan, ratusan, puluhan, dan satuan)
        }
    }

    return $terbilang;
}

function tanggalInd($tgl) {
    // Array nama bulan dimulai dari indeks 1 (Januari) hingga 12 (Desember)
    $namaBulan = array(
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    );

    // Array nama hari dalam bahasa Indonesia
    $namaHari = array(
        'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 
        'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 
        'Saturday' => 'Sabtu'
    );

    // Mengambil tahun, bulan, dan tanggal dari string $tgl yang diharapkan dalam format 'Y-m-d'
    $tahun = substr($tgl, 0, 4); // Mengambil 4 karakter pertama untuk tahun
    $bulan = (int) substr($tgl, 5, 2); // Mengambil 2 karakter dari indeks 5 untuk bulan
    $tanggal = substr($tgl, 8, 2); // Mengambil 2 karakter dari indeks 8 untuk tanggal

    // Mendapatkan nama hari dalam bahasa Inggris (contoh: 'Monday')
    $hariini = date('l', strtotime($tgl)); 

    // Mengubah nama hari dalam bahasa Inggris ke dalam bahasa Indonesia
    $hari = $namaHari[$hariini];

    // Menyusun format tanggal dalam bentuk 'hari, tanggal bulan tahun'
    $text = "$hari, $tanggal " . $namaBulan[$bulan] . " $tahun";

    return $text;
}
    
