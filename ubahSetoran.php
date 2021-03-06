<?php
require 'function.php';
// menangkap id_setoran
$id = $_GET['id'];
// ambil data santri dan kelas
$santri = query("SELECT santri.*, pembimbing.kode_kelas FROM santri INNER JOIN pembimbing ON santri.id_pembimbing = pembimbing.id_pembimbing");
// ambil data setoran santri
$setoran = query("SELECT santri.*, setoran.* FROM santri INNER JOIN setoran ON santri.id_santri = setoran.id_santri");
// ambil data surat
$surat = query("SELECT * FROM surat");
// ambil data santri berdasarkan id_setoran
$santriValue = query("SELECT santri.*, pembimbing.kode_kelas, setoran.* FROM santri INNER JOIN setoran ON santri.id_santri = setoran.id_santri INNER JOIN pembimbing ON santri.id_pembimbing = pembimbing.id_pembimbing WHERE setoran.id_setoran = $id")[0];
// ambil data setoran awal berdasarkan id_setoran
$min = query("SELECT surat.*, ayat_surat.no_ayat, item_setoran.*  FROM surat INNER JOIN ayat_surat ON surat.id_surat = ayat_surat.id_surat INNER JOIN item_setoran ON ayat_surat.id_ayat = item_setoran.id_ayat WHERE ayat_surat.id_ayat = (SELECT MIN(id_ayat) FROM item_setoran WHERE id_setoran = $id) AND item_setoran.id_setoran = $id")[0];
// ambil data setoran akhir berdasarkan id_setoran
$max = query("SELECT surat.*, ayat_surat.no_ayat, item_setoran.*  FROM surat INNER JOIN ayat_surat ON surat.id_surat = ayat_surat.id_surat INNER JOIN item_setoran ON ayat_surat.id_ayat = item_setoran.id_ayat WHERE ayat_surat.id_ayat = (SELECT MAX(id_ayat) FROM item_setoran WHERE id_setoran = $id) AND item_setoran.id_setoran = $id")[0];
// ambil data setoran berdasarkan id_setoran
$setoranValue = query("SELECT santri.*, setoran.* FROM santri INNER JOIN setoran ON santri.id_santri = setoran.id_santri WHERE setoran.id_setoran = $id")[0];

$judul = 'Ubah Data Setoran'; // judul halaman
include('layout/header.php'); // panggil layout header

// jika tombil simpan di-klik maka munculkan pesan: 
if (isset($_POST['ubahSetoran'])) {
    if (ubahSetoran($_POST) > 0) {
        if (ubahItem($_POST) > 0) { ?>
            <!-- Alert sukses - jika data berhasil diubah ke database -->
            <div class="alert alert-success" role="alert">
                Data Berhasil diubah!
                <a href="setoran.php" class="btn btn-outline-success btn-sm ms-3">Ok</a>
            </div>
        <?php }
    } else { ?>
        <!-- Alert gagal - jika data gagal diubah ke database -->
        <div class="alert alert-danger" role="alert">
            Data Gagal diubah!
        </div>
<?php }
} ?>

<form action="" method="post">
    <!-- Input Nama -->
    <input type="hidden" name="id" value="<?= $id; ?>">
    <div class="mb-3 row">
        <label for="id_santri" class="col-sm-2 col-form-label">Nama</label>
        <div class="col-sm-9">
            <select name="id_santri" id="id_santri" class="form-select">
                <option value="<?= $santriValue['id_santri']; ?>"><?= $santriValue['nama']; ?> | Kelas <?= $santriValue['kode_kelas']; ?></option>
                <?php foreach ($santri as $row) : ?>
                    <option value="<?= $row['id_santri']; ?>"><?= $row['nama']; ?> | Kelas <?= $row['kode_kelas']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>
    <!-- Input Setoran Awal-->
    <div class="row g-4">
        <label for="suratAwal" class="col-sm-2 col-form-label">Setoran</label>
        <div class="col-md-3">
            <select name="suratAwal" id="suratAwal" class="form-select">
                <option value="<?= $min['id_surat']; ?>"><?= $min['nama_surat']; ?></option>
                <?php foreach ($surat as $row) : ?>
                    <option value="<?= $row['id_surat']; ?>"><?= $row['nama_surat']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" id="ayatAwal" name="ayatAwal" placeholder="Ayat" value="<?= $min['no_ayat']; ?>">
        </div>
        <!-- Input Setoran Akhir -->
        <label for="suratAkhir" class="col-sm-1 col-form-label">Sampai</label>
        <div class="col-md-3">
            <select name="suratAkhir" id="suratAkhir" class="form-select">
                <option value="<?= $max['id_surat']; ?>"><?= $max['nama_surat']; ?></option>
                <?php foreach ($surat as $row) : ?>
                    <option value="<?= $row['id_surat']; ?>"><?= $row['nama_surat']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="col-md-1">
            <input type="text" class="form-control" id="ayatAkhir" name="ayatAkhir" placeholder="Ayat" value="<?= $max['no_ayat']; ?>">
        </div>
    </div>
    <!-- Input Waktu -->
    <div class="mb-3 row mt-3">
        <label for="waktu" class="col-sm-2 col-form-label">Waktu</label>
        <div class="col-sm-9">
            <input type="datetime-local" class="form-control" id="waktu" name="waktu">
        </div>
    </div>
    <!-- Input keterangan -->
    <div class="mb-3 row">
        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
        <div class="col-sm-9">
            <select name="keterangan" id="keterangan" class="form-select">
                <option value="<?= $setoranValue['keterangan'] ?>"><?= $setoranValue['keterangan'] ?></option>
                <option value="Ziyadah">Ziyadah</option>
                <option value="Murajaah">Murajaah</option>
            </select>
        </div>
    </div>
    <!-- tombol simpan -->
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name="ubahSetoran">Simpan</button>
    </div>
</form>

<?php include('layout/footer.php'); // memanggil layout footer
?>