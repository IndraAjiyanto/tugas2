# Implementasi CRUD menggunakan PHP OOP
## Database
<a href="pweb2.sql">Database</a>

## TASK
<ul>
  <li>Create an OOP-based View, by retrieving data from the MySQL database</li>
  <li>Use the _construct as a link to the database</li>
  <li>Create a derived class using the concept of inheritance</li>
  <li>Apply polymorphism for at least 2 roles according to the case study</li>
</ul>

## TOOLS
<ul>
<li><a href="https://getbootstrap.com/">Bootstrap</a></li>
<li><a href="https://www.php.net/">php</a></li>
<li><a href="https://www.mysql.com/">MySQL</a></li>
<li><a href="https://httpd.apache.org/">Sever Lokal Apache</a></li>
<li><a href="https://www.phpmyadmin.net/">phpMyAdmin</a></li>
</ul>

### utama.php 
```php
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
```

### index.php
```php
<?php

// Mangarahkan langsung ke folder view file mahasiswa.php
header('location:view/mahasiswa.php');

?>
```

### view
### mahasiswa.php
```php
<?php
require_once '../utama.php';

// Membuat objek dari class Mahasiswa
$mahasiswa = new Mahasiswa();
$result = $mahasiswa->tampilMahasiswa();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Mahasiswa</title>
    
    <style>
        /* Kustomisasi card agar memiliki efek bayangan dan transisi */
        .card-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        /* Kustomisasi tampilan link navigasi dengan efek hover */
        .nav-link {
            transition: transform 0.2s;
        }

        .nav-link:hover {
            color: red;
            transform: translateY(-5px);
        }

        /* Kustomisasi table dan navbar */
        .table-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .navbar-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-primary-subtle">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom pt-4 d-flex flex-column">
    <h3 class="fw-bold">Mahasiswa</h3>
    <div class="justify-content-center d-flex flex-row">
        <a class="nav-link m-2 p-1" href="mahasiswa.php">Data Mahasiswa Lengkap</a>
        <a class="nav-link m-2 p-1" href="filter_mahasiswa.php">Data Mahasiswa Ajibarang</a>
        <a class="nav-link m-2 fw-bold bg-secondary-subtle p-1 border rounded" href="nilaiPerbaikan.php">
            Nilai Perbaikan 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5"/>
            </svg>
        </a>
    </div>
</nav>

<!-- Konten utama berupa tabel data mahasiswa -->
<div class="container mt-5">
    <div class="card card-custom p-4">
        <h3 class="text-center mb-4">Daftar Mahasiswa Lengkap</h3>
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                <tr>
                    <th>Id Mahasiswa</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Alamat</th>
                    <th>Email</th>
                    <th>No Telepon</th>
                </tr>
                </thead>
                <tbody>
                <!-- Looping data mahasiswa dari database dan menampilkannya di tabel -->
                <?php
                foreach ($result as $row) {
                ?>
                    <tr>
                        <td><?php echo $row['mahasiswa_id']; ?></td>
                        <td><?php echo $row['nim']; ?></td>
                        <td><?php echo $row['nama_mhs']; ?></td>
                        <td><?php echo $row['alamat']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['no_telp']; ?></td>
                    </tr>
                <?php
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

```
### output :
![image](https://github.com/user-attachments/assets/b6668f75-c5ac-4a0f-a576-476713ada143)

### filter_mahasiswa.php
```php
<?php
require_once '../utama.php';

// Membuat objek dari class MahasiswaAjibarang
$mahasiswa = new MahasiswaAjibarang();
$result = $mahasiswa->tampilMahasiswa();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Data Mahasiswa</title>
    
    <style>
        /* Kustomisasi card agar memiliki efek bayangan dan transisi */
        .card-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        /* Kustomisasi tampilan link navigasi dengan efek hover */
        .nav-link {
            transition: transform 0.2s;
        }

        .nav-link:hover {
            color: red;
            transform: translateY(-5px);
        }

        /* Kustomisasi table dan navbar */
        .table-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .navbar-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-primary-subtle">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom pt-4 d-flex flex-column">
    <h3 class="fw-bold">Mahasiswa</h3>
    <div class="justify-content-center d-flex flex-row">
        <a class="nav-link m-2 p-1" href="mahasiswa.php">Data Mahasiswa Lengkap</a>
        <a class="nav-link m-2 p-1" href="filter_mahasiswa.php">Data Mahasiswa Ajibarang</a>
        <a class="nav-link m-2 fw-bold bg-secondary-subtle p-1 border rounded" href="nilaiPerbaikan.php">
            Nilai Perbaikan 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5"/>
            </svg>
        </a>
    </div>
</nav>

<!-- Konten utama berupa tabel data mahasiswa ajibarang -->
<div class="container mt-5">
    <div class="card card-custom p-4">
        <h3 class="text-center mb-4">Daftar Mahasiswa Ajibarang</h3>
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>ID Mahasiswa</th>
                        <th>NIM</th>
                        <th>Nama Mahasiswa</th>
                        <th>Alamat</th>
                        <th>Email</th>
                        <th>No Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping data mahasiswa ajibarang dari database dan menampilkannya di tabel -->
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?php echo $row['mahasiswa_id']; ?></td>
                            <td><?php echo $row['nim']; ?></td>
                            <td><?php echo $row['nama_mhs']; ?></td>
                            <td><?php echo $row['alamat']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['no_telp']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

```

### output :
![image](https://github.com/user-attachments/assets/5648cd8f-e7b9-4f0c-be33-4cc57ea0fbfa)

### nilaiPerbaikan.php
```php
<?php
require_once '../utama.php';

// Membuat objek dari class NilaiPerbaikan
$nilai = new NilaiPerbaikan();
$result = $nilai->tampilNilaiPerbaikan();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Nilai Perbaikan</title>
    
    <style>
        /* Kustomisasi card dengan efek bayangan dan transisi */
        .card-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        /* Kustomisasi tampilan link navigasi dengan efek hover */
        .nav-link {
            transition: transform 0.2s;
        }

        .nav-link:hover {
            color: red;
            transform: translateY(-5px);
        }

        /* Kustomisasi tabel dan navbar */
        .table-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .navbar-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-primary-subtle">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom pt-4 d-flex flex-column">
    <h3 class="fw-bold">Nilai Perbaikan</h3>
    
    <div class="justify-content-center d-flex flex-row">
        <a class="nav-link m-2 p-1" href="nilaiPerbaikan.php">Data Nilai Perbaikan</a>
        <a class="nav-link m-2 p-1" href="filter_nilaiPerbaikan.php">Data Nilai Perbaikan Filter</a>
        <a class="nav-link m-2 fw-bold bg-secondary-subtle p-1 border rounded" href="mahasiswa.php">
            Mahasiswa 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5"/>
            </svg>
        </a>
    </div>
</nav>

<!-- Konten utama berupa tabel data nilai perbaikan -->
<div class="container mt-5">
    <div class="card card-custom p-4">
        <h3 class="text-center mb-4">Data Nilai Perbaikan</h3>
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                <tr>
                    <th>Perbaikan ID</th>
                    <th>Tanggal Perbaikan</th>
                    <th>Keterangan</th>
                    <th>Mahasiswa ID</th>
                    <th>Matkul ID</th>
                    <th>Semester ID</th>
                    <th>Nilai ID</th>
                    <th>Dosen ID</th>
                </tr>
                </thead>
                <tbody>
                <!-- Looping data nilai perbaikan dari database dan menampilkannya di tabel -->
                <?php foreach ($result as $row): ?>
                    <tr>
                        <td><?php echo $row['perbaikan_id']; ?></td>
                        <td><?php echo $row['tgl_perbaikan']; ?></td>
                        <td><?php echo $row['keterangan']; ?></td>
                        <td><?php echo $row['mahasiswa_id']; ?></td>
                        <td><?php echo $row['matkul_id']; ?></td>
                        <td><?php echo $row['semester_id']; ?></td>
                        <td><?php echo $row['nilai_id']; ?></td>
                        <td><?php echo $row['dosen_id']; ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

```

### output : 
![image](https://github.com/user-attachments/assets/b53421bb-990a-44ad-85c3-891ae510ea24)

### filter_nilaiPerbaikan.php
```php
<?php
require_once '../utama.php'; 

// Membuat objek dari class NilaiPerbaikanId
$nilai = new NilaiPerbaikanId();
$result = $nilai->tampilNilaiPerbaikan();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Data Mahasiswa</title>
    
    <style>
        /* Kustomisasi card dengan efek bayangan dan transisi */
        .card-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }

        /* Kustomisasi tampilan link navigasi dengan efek hover */
        .nav-link {
            transition: transform 0.2s;
        }

        .nav-link:hover {
            color: red;
            transform: translateY(-5px);
        }

        //* Kustomisasi tabel dan navbar */
        .table-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        .navbar-custom {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body class="bg-primary-subtle">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-custom pt-4 d-flex flex-column">
    <h3 class="fw-bold">Nilai Perbaikan</h3>
    <div class="justify-content-center d-flex flex-row">
        <a class="nav-link m-2 p-1" href="nilaiPerbaikan.php">Data Nilai Perbaikan</a>
        <a class="nav-link m-2 p-1" href="filter_nilaiPerbaikan.php">Data Nilai Perbaikan Filter</a>
        <a class="nav-link m-2 fw-bold bg-secondary-subtle p-1 border rounded" href="mahasiswa.php">
            Mahasiswa 
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5m14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5"/>
            </svg>
        </a>
    </div>
</nav>

<!-- Konten utama berupa tabel data nilai perbaikan id 2 -->
<div class="container mt-5">
    <div class="card card-custom p-4">
        <h3 class="text-center mb-4">Data Nilai Perbaikan Filter</h3>
        
        <div class="table-responsive">
            <table class="table table-dark table-striped">
                <thead>
                    <tr>
                        <th>Perbaikan ID</th>
                        <th>Tanggal Perbaikan</th>
                        <th>Keterangan</th>
                        <th>Mahasiswa ID</th>
                        <th>Matkul ID</th>
                        <th>Semester ID</th>
                        <th>Nilai ID</th>
                        <th>Dosen ID</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Looping data nilai perbaikan id 2 dari database dan menampilkannya di tabel -->
                    <?php foreach ($result as $row): ?>
                        <tr>
                            <td><?php echo $row['perbaikan_id']; ?></td>
                            <td><?php echo $row['tgl_perbaikan']; ?></td>
                            <td><?php echo $row['keterangan']; ?></td>
                            <td><?php echo $row['mahasiswa_id']; ?></td>
                            <td><?php echo $row['matkul_id']; ?></td>
                            <td><?php echo $row['semester_id']; ?></td>
                            <td><?php echo $row['nilai_id']; ?></td>
                            <td><?php echo $row['dosen_id']; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

```

### output :
![image](https://github.com/user-attachments/assets/3c87a56b-e797-405c-a012-9ed2a8ff5f96)
