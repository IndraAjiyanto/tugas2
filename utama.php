<?php

// Kelas Mahasiswa untuk berinteraksi dengan tabel mahasiswa di database
class Mahasiswa {
    // Properti koneksi database
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $name_database = "pweb2";
    protected $koneksi;

    // Konstruktor untuk membuat koneksi ke database
    public function __construct() {
        $this->koneksi = mysqli_connect($this->server, $this->username, $this->password, $this->name_database);
        
        // Cek apakah koneksi berhasil
        if (!$this->koneksi) {
            die("Koneksi ke database gagal: " . mysqli_connect_error());
        }
    }

    // Method untuk mengambil semua data mahasiswa
    public function tampilMahasiswa() {
        $query = "SELECT * FROM mahasiswa";
        return mysqli_query($this->koneksi, $query);
    }
}

// Kelas turunan MahasiswaAjibarang untuk mengambil data mahasiswa berdasarkan alamat Ajibarang
class MahasiswaAjibarang extends Mahasiswa {
    // Override method tampilMahasiswa untuk hanya menampilkan mahasiswa dari Ajibarang
    public function tampilMahasiswa() {
        $query = "SELECT * FROM mahasiswa WHERE alamat = 'Ajibarang'";
        return mysqli_query($this->koneksi, $query);
    }
}

// Kelas NilaiPerbaikan untuk berinteraksi dengan tabel nilai_perbaikan di database
class NilaiPerbaikan {
    // Properti koneksi database
    private $server = "localhost";
    private $username = "root";
    private $password = "";
    private $name_database = "pweb2";
    protected $koneksi;

    // Konstruktor untuk membuat koneksi ke database
    public function __construct() {
        $this->koneksi = mysqli_connect($this->server, $this->username, $this->password, $this->name_database);
        
        // Cek apakah koneksi berhasil
        if (!$this->koneksi) {
            die("Koneksi ke database gagal: " . mysqli_connect_error());
        }
    }

    // Method untuk mengambil semua data nilai perbaikan
    public function tampilNilaiPerbaikan() {
        $query = "SELECT * FROM nilai_perbaikan";
        return mysqli_query($this->koneksi, $query);
    }
}

// Kelas turunan NilaiPerbaikanId untuk mengambil data nilai perbaikan berdasarkan ID perbaikan tertentu
class NilaiPerbaikanId extends NilaiPerbaikan {
    // Override method tampilNilaiPerbaikan untuk menampilkan data dengan perbaikan_id = 2
    public function tampilNilaiPerbaikan() {
        $query = "SELECT * FROM nilai_perbaikan WHERE perbaikan_id = 2";
        return mysqli_query($this->koneksi, $query);
    }
}

?>