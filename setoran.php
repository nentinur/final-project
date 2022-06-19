<?php
require 'function.php';
$santri = query("SELECT santri.*, pembimbing.kode_kelas FROM santri INNER JOIN pembimbing ON santri.id_pembimbing = pembimbing.id_pembimbing");
$setoran = query("SELECT santri.*, setoran.* FROM santri INNER JOIN setoran ON santri.id_santri = setoran.id_santri");
$surat = query("SELECT * FROM surat");

$judul = 'Data Setoran santri';
include('layout/header.php');

if (isset($_POST['tambahSetoran'])) {
    if (tambahSetoran($_POST) > 0) {
        if (tambahItem($_POST) > 0) { ?>
            <div class="alert alert-success" role="alert">
                Data Berhasil ditambahkan!
            </div>
        <?php }
    } else { ?>
        <div class="alert alert-danger" role="alert">
            Data Gagal ditambahkan!
        </div>
<?php }
} ?>
<!-- Modal -->
<button type="button" class="btn btn-primary btn-sm mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Tambah Data Setoran
</button>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Form Data Setoran Santri</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form Input Data -->
                <form action="" method="post">
                    <!-- Input Nama -->
                    <div class="mb-3 row">
                        <label for="id_santri" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-9">
                            <select name="id_santri" id="id_santri" class="form-select">
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
                                <option value="0">Pilih Surat</option>
                                <?php foreach ($surat as $row) : ?>
                                    <option value="<?= $row['id_surat']; ?>"><?= $row['nama_surat']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <input type="text" class="form-control" id="ayatAwal" name="ayatAwal" placeholder="Ayat">
                        </div>
                        <!-- Input Setoran Akhir -->
                        <label for="suratAkhir" class="col-sm-1 col-form-label">Sampai</label>
                        <div class="col-md-3">
                            <select name="suratAkhir" id="suratAkhir" class="form-select">
                                <option value="0">Pilih Surat</option>
                                <?php foreach ($surat as $row) : ?>
                                    <option value="<?= $row['id_surat']; ?>"><?= $row['nama_surat']; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-1">
                            <input type="text" class="form-control" id="ayatAkhir" name="ayatAkhir" placeholder="Ayat">
                        </div>
                    </div>
                    <!-- Input Waktu -->
                    <div class="mb-3 row mt-3">
                        <label for="waktu" class="col-sm-2 col-form-label">Waktu</label>
                        <div class="col-sm-9">
                            <input type="datetime" class="form-control" id="waktu" name="waktu">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <select name="keterangan" id="keterangan" class="form-select">
                                <option value="0">Keterangan</option>
                                <option value="Ziyadah">Ziyadah</option>
                                <option value="Murajaah">Murajaah</option>
                            </select>
                        </div>
                    </div>
                    <!-- tombol simpan -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="tambahSetoran">Simpan</button>
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
            <th scope="col">Nama Santri</th>
            <th scope="col">Waktu</th>
            <th scope="col">Setoran</th>
            <th scope="col">Keterangan</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $i = 1; ?>
        <?php foreach ($setoran as $row) : ?>
            <tr>
                <td scope="row"><?= $i++; ?></td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['waktu']; ?></td>
                <td>
                    <?php
                    $idSetor = $row['id_setoran'];
                    $min = query("SELECT MIN(id_ayat) FROM item_setoran WHERE id_setoran = $idSetor")[0]['MIN(id_ayat)'];
                    $max = query("SELECT MAX(id_ayat) FROM item_setoran WHERE id_setoran = $idSetor")[0]['MAX(id_ayat)'];
                    $awal = query("SELECT item_setoran.id_setoran, ayat_surat.*, surat.nama_surat FROM item_setoran INNER JOIN ayat_surat ON item_setoran.id_ayat = ayat_surat.id_ayat INNER JOIN surat ON ayat_surat.id_surat = surat.id_surat WHERE item_setoran.id_ayat = $min")[0];
                    $akhir = query("SELECT item_setoran.id_setoran, ayat_surat.*, surat.nama_surat FROM item_setoran INNER JOIN ayat_surat ON item_setoran.id_ayat = ayat_surat.id_ayat INNER JOIN surat ON ayat_surat.id_surat = surat.id_surat WHERE item_setoran.id_ayat = $max")[0];
                    ?>
                    <?= $awal['nama_surat']; ?>:<?= $awal['no_ayat']; ?> - <?= $akhir['nama_surat']; ?>:<?= $akhir['no_ayat']; ?>
                </td>
                <td><?= $row['keterangan']; ?></td>
                <td>
                    <a class="btn btn-danger btn-sm" role="button" aria-pressed="true" onclick="return confirm('Yakin menghapus data?');" href="hapusSetoran.php?id=<?= $row['id_setoran']; ?> ">Hapus</a>
                    <a class="btn btn-warning btn-sm" role="button" aria-pressed="true" href="ubahSetoran.php?id=<?= $row['id_setoran']; ?>">Edit</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include('layout/footer.php'); ?>