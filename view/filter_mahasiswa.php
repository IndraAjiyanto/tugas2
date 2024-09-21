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
