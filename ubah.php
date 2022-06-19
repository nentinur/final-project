<?php
require 'function.php';
$id = $_GET['id'];
$santri = query("SELECT * FROM santri WHERE id_santri = $id")[0];
$pembimbing = query("SELECT * FROM pembimbing");

$judul = ' Ubah Data Santri';
include('layout/header.php');

if (isset($_POST['ubah'])) {
    if (ubah($_POST) > 0) { ?>
        <div class="alert alert-success" role="alert">
            Data Berhasil diubah!
            <a href="santri.php" class="btn btn-outline-success btn-sm ms-3">Ok</a>
        </div>
    <?php } else { ?>
        <div class="alert alert-danger" role="alert">
            Data Gagal diubah!
        </div>
<?php }
} ?>
<form action="" method="post">
    <!-- Input Nama -->
    <input type="hidden" name="id" value="<?= $santri['id_santri']; ?>">
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $santri['nama']; ?>">
        </div>
    </div>
    <!-- Input Pembimbing -->
    <div class="mb-3 row">
        <label for="id_pembimbing" class="col-sm-2 col-form-label">Pembimbing</label>
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
            <input type="date" class="form-control" id="ttl" name="ttl" value="<?= $santri['tanggal_lahir']; ?>">
        </div>
    </div>
    <!-- Input Jenis Kelamin -->
    <div class="mb-3 row">
        <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-10">
            <select name="jk" id="jk" class="form-select">
                <?php if ($santri['jenis_kelamin'] == "Perempuan") { ?>
                    <option value="<?= $santri['jenis_kelamin'] ?>"><?= $santri['jenis_kelamin'] ?></option>
                    <option value="Laki-Laki">Laki-Laki</option>
                <?php } else { ?>
                    <option value="<?= $santri['jenis_kelamin'] ?>"><?= $santri['jenis_kelamin'] ?></option>
                    <option value="Perempuan">Perempuan</option>
                <?php } ?>
            </select>
        </div>
    </div>
    <!-- Input Kontak -->
    <div class="mb-3 row">
        <label for="kontak" class="col-sm-2 col-form-label">No. Telpon</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kontak" name="kontak" value="<?= $santri['kontak']; ?>">
        </div>
    </div>
    <!-- Input Alamat -->
    <div class="mb-3 row">
        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $santri['alamat']; ?>">
        </div>
    </div>
    <!-- tombol simpan -->
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="ubah">Simpan</button>
    </div>
</form>
<?php include('layout/footer.php'); ?>