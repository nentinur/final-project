<?php
require 'function.php';
$id = $_GET['id']; // ambil id_pembimbing
// ambil data pembimbing berdasarkan id_pembimbing
$pembimbing = query("SELECT * FROM pembimbing WHERE id_pembimbing = $id")[0];

$judul = 'Ubah Data Pembimbing'; // judul halaman
include('layout/header.php'); // panggil layout header

// jika tombol simpan di-klik, maka tampilkan pesan:
if (isset($_POST['ubahPembimbing'])) {
    if (ubahPembimbing($_POST) > 0) { ?>
        <!-- Alert sukses - jika data berhasil diubah di database -->
        <div class="alert alert-success" role="alert">
            Data Berhasil diubah!
            <a href="pembimbing.php" class="btn btn-outline-success btn-sm ms-3">Ok</a>
        </div>
    <?php } else { ?>
        <!-- Alert gagal jika data gagal diubah di database -->
        <div class="alert alert-danger" role="alert">
            Data Gagal diubah!
        </div>
<?php }
} ?>
<form action="" method="post">
    <!-- Input Nama -->
    <input type="hidden" name="id" value="<?= $pembimbing['id_pembimbing']; ?>">
    <div class="mb-3 row">
        <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="nama" name="nama" value="<?= $pembimbing['nama']; ?>">
        </div>
    </div>
    <!-- Input Kelas -->
    <div class="mb-3 row">
        <label for="kelas" class="col-sm-2 col-form-label">Kelas</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kelas" name="kelas" value="<?= $pembimbing['kode_kelas']; ?>">
        </div>
    </div>
    <!-- Input Jenis Kelamin -->
    <div class="mb-3 row">
        <label for="jk" class="col-sm-2 col-form-label">Jenis Kelamin</label>
        <div class="col-sm-10">
            <select name="jk" id="jk" class="form-select">
                <?php if ($pembimbing['jenis_kelamin'] == "Perempuan") { ?>
                    <option value="<?= $pembimbing['jenis_kelamin'] ?>"><?= $pembimbing['jenis_kelamin'] ?></option>
                    <option value="Laki-Laki">Laki-Laki</option>
                <?php } else { ?>
                    <option value="<?= $pembimbing['jenis_kelamin'] ?>"><?= $pembimbing['jenis_kelamin'] ?></option>
                    <option value="Perempuan">Perempuan</option>
                <?php } ?>
            </select>
        </div>
    </div>
    <!-- Input Kontak -->
    <div class="mb-3 row">
        <label for="kontak" class="col-sm-2 col-form-label">No. Telpon</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="kontak" name="kontak" value="<?= $pembimbing['kontak']; ?>">
        </div>
    </div>
    <!-- Input Alamat -->
    <div class="mb-3 row">
        <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="alamat" name="alamat" value="<?= $pembimbing['alamat']; ?>">
        </div>
    </div>
    <!-- tombol simpan -->
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="ubahPembimbing">Simpan</button>
    </div>
</form>
<?php include('layout/footer.php'); // panggil layout footer 
?>