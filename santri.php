<?php
require 'function.php';
$santri = query("SELECT santri.*, pembimbing.kode_kelas FROM santri INNER JOIN pembimbing ON santri.id_pembimbing = pembimbing.id_pembimbing");
$pembimbing = query("SELECT * FROM pembimbing");

$judul = 'Data Santri';
include('layout/header.php');

if (isset($_POST['tambah'])) {
    if (tambah($_POST) > 0) { ?>
        <div class="alert alert-success" role="alert">
            Data Berhasil ditambahkan!
        </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            Data Gagal ditambahkan!
        </div>
<?php }
} ?>
<!-- Modal -->
<button type="button" class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Data Santri
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
                    <!-- Input Pembimbing -->
                    <div class="mb-3 row">
                        <label for="id_pembimbing" class="col-sm-2 col-form-label">Kelas</label>
                        <div class="col-sm-10">
                            <select name="id_pembimbing" id="id_pembimbing" class="form-select">
                                <?php foreach ($pembimbing as $row) : ?>
                                    <option value="<?= $row['id_pembimbing']; ?>"><?= $row['kode_kelas']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <!-- Input Tanggal Lahir -->
                    <div class="mb-3 row">
                        <label for="ttl" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="date" class="form-control" id="ttl" name="ttl">
                        </div>
                    </div>
                    <!-- Input Jenis Kelamin -->
                    <div class="mb-3 row">
                        <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <select name="jk" id="jk" class="form-select">
                                <option value="Perempuan">Perempuan</option>
                                <option value="Laki-Laki">Laki-Laki</option>
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
                        <button type="submit" class="btn btn-primary" name="tambah">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Tabel Data Santri -->
<table class="table">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Kelas</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">Tanggal Lahir</th>
            <th scope="col">Kontak</th>
            <th scope="col">Alamat</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($santri as $row) : ?>
            <tr>
                <td scope="row"><?= $i++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['kode_kelas']; ?></td>
                <td><?= $row['jenis_kelamin']; ?></td>
                <td><?= $row['tanggal_lahir']; ?></td>
                <td><?= $row['kontak']; ?></td>
                <td><?= $row['alamat']; ?></td>
                <td>
                    <a class="btn btn-danger btn-sm" role="button" aria-pressed="true" onclick="return confirm('Yakin menghapus data?');" href="hapus.php?id=<?= $row['id_santri']; ?> ">Hapus</a>
                    <a class="btn btn-warning btn-sm" role="button" aria-pressed="true" href="ubah.php?id=<?= $row['id_santri']; ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include('layout/footer.php'); ?>