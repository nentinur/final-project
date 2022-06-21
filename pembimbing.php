<?php
require 'function.php';
// ambil data pembimbing
$pembimbing = query("SELECT * FROM pembimbing");

$judul = 'Data Pembimbing'; // judul halaman
include('layout/header.php'); // panggil layout header

// jika tombol simpan di-klik, maka tampilkan pesan
if (isset($_POST['tambahPembimbing'])) {
    if (tambahPembimbing($_POST) > 0) { ?>
        <!-- Alert suskses - jika data berhasil ditambhkan ke database -->
        <div class="alert alert-success" role="alert">
            Data Berhasil ditambahkan!
        </div>
    <?php } else { ?>
        <!-- Alert gagal - jika data gagal ditambahkan ke database -->
        <div class="alert alert-danger" role="alert">
            Data Gagal ditambahkan!
        </div>
<?php }
} ?>
<!-- Modal input data ppembimbing -->
<button type="button" class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Data Pembimbing
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Data Santri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Input Data -->
                <form action="" method="post">
                    <!-- Input Nama -->
                    <div class="mb-3 row">
                        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama">
                        </div>
                    </div>
                    <!-- Input Kode Kelas -->
                    <div class="mb-3 row">
                        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kelas" name="kelas">
                        </div>
                    </div>
                    <!-- Input Jenis Kelamin -->
                    <div class="mb-3 row">
                        <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select name="jk" id="jk" class="form-select">
                                <option value="0">Perempuan</option>
                                <option value="1">Laki-Laki</option>
                            </select>
                        </div>
                    </div>
                    <!-- Input Kontak -->
                    <div class="mb-3 row">
                        <label for="kontak" class="col-sm-2 col-form-label">No. Telpon</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="kontak" name="kontak">
                        </div>
                    </div>
                    <!-- Input Alamat -->
                    <div class="mb-3 row">
                        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="alamat" name="alamat">
                        </div>
                    </div>
                    <!-- tombol simpan -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="tambahPembimbing">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Data Pembimbing -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Kode Kelas</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Kontak</th>
            <th scope="col">Alamat</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($pembimbing as $row) : ?>
            <tr>
                <td scope="row"><?= $i++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['kode_kelas']; ?></td>
                <td><?= $row['jenis_kelamin']; ?></td>
                <td><?= $row['kontak']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td>
                    <a class="btn btn-danger btn-sm" role="button" aria-pressed="true" onclick="return confirm('Yakin menghapus data?');" href="hapusPembimbing.php?id=<?= $row['id_pembimbing']; ?> ">Hapus</a>
                    <a class="btn btn-warning btn-sm" role="button" aria-pressed="true" href="ubahPembimbing.php?id=<?= $row['id_pembimbing']; ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include('layout/footer.php'); // panggil layout footer 
?>