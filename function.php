<?php
// Koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "final-project");

// Ambil data dari database
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}

// tambah data santri
function tambah($santri)
{
    global $conn;
    // Ambil data dari form input data santri
    $nama = htmlspecialchars($santri['nama']);
    $pembimbing = htmlspecialchars($santri['id_pembimbing']);
    $ttl = htmlspecialchars($santri['ttl']);
    $jk = htmlspecialchars($santri['jk']);
    $kontak = htmlspecialchars($santri['kontak']);
    $alamat = htmlspecialchars($santri['alamat']);

    // masukkan data ke database
    $tambah = "INSERT INTO santri VALUES 
        ('', '$pembimbing', '$nama', '$ttl', '$jk', '$kontak', '$alamat') ";
    mysqli_query($conn, $tambah);

    // return jumlah baris yang terpengaruhi di database
    return mysqli_affected_rows($conn);
}

// tambah data setoran santri
function tambahSetoran($setoran)
{
    global $conn;
    // Ambil data dari form input data setoran santri
    $id = htmlspecialchars($setoran['id_santri']);
    $waktu = htmlspecialchars($setoran['waktu']);
    $keterangan = htmlspecialchars($setoran['keterangan']);

    // masukkan data ke database tabel setoran
    $tambah = "INSERT INTO setoran VALUES 
        ('', '$id', '$waktu', '$keterangan') ";
    mysqli_query($conn, $tambah);

    // return jumlah baris yang terpengaruhi di database
    return mysqli_affected_rows($conn);
}

// tambah darta item setoran
function tambahItem($setoran)
{
    global $conn;
    // ambil data dari form input
    $suratAwal = htmlspecialchars($setoran['suratAwal']);
    $suratAkhir = htmlspecialchars($setoran['suratAkhir']);
    $ayatAwal = htmlspecialchars($setoran['ayatAwal']);
    $ayatAkhir = htmlspecialchars($setoran['ayatAkhir']);
    // mencari id_ayat yang sesuai dengan form input
    // setoran dari surat apa ayat berapa
    $awal = query("SELECT id_ayat FROM ayat_surat WHERE id_surat = $suratAwal AND no_ayat = $ayatAwal")[0]['id_ayat'];
    // setoran sampai surat apa ayat berapa
    $akhir = query("SELECT id_ayat FROM ayat_surat WHERE id_surat = $suratAkhir AND no_ayat = $ayatAkhir")[0]['id_ayat'];
    // mencari id_setoran yang terakhir kali ditambahkan pada tabel setoran
    $idSetoran = query("SELECT MAX(id_setoran) FROM setoran")[0]["MAX(id_setoran)"];

    // masukkan data item setoran di databse table item_setoran
    while ($awal <= $akhir) {
        $tambahItem = "INSERT INTO item_setoran VALUES ('$idSetoran', '$awal')";
        mysqli_query($conn, $tambahItem);
        $awal++;
    }

    // return jumlah baris yang terpengaruhi di database
    return mysqli_affected_rows($conn);
}

// tambah data pembimbing
function tambahPembimbing($pembimbing)
{
    global $conn;
    // Ambil data dari form input data pembimbing
    $nama = htmlspecialchars($pembimbing['nama']);
    $kelas = htmlspecialchars($pembimbing['kelas']);
    $jk = htmlspecialchars($pembimbing['jk']);
    $kontak = htmlspecialchars($pembimbing['kontak']);
    $alamat = htmlspecialchars($pembimbing['alamat']);

    // masukkan data ke database
    $tambah = "INSERT INTO pembimbing VALUES 
        ('', '$kelas', '$nama', '$jk', '$kontak', '$alamat') ";

    mysqli_query($conn, $tambah);

    // return jumlah baris yang terpengaruhi di database
    return mysqli_affected_rows($conn);
}

// hapus data santri
function hapus($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM santri WHERE id_santri = $id");
    return mysqli_affected_rows($conn);
}

// hapus data pembimbing
function hapusPembimbing($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM pembimbing WHERE id_pembimbing = $id");
    return mysqli_affected_rows($conn);
}

// hapus data setoran santri
function hapusSetoran($id)
{
    global $conn;
    // hapus dari tabel setoran
    mysqli_query($conn, "DELETE FROM setoran WHERE id_setoran = $id");
    // hapus dari tabel item_setoran
    mysqli_query($conn, "DELETE FROM item_setoran WHERE id_setoran = $id");
    return mysqli_affected_rows($conn);
}

// ubah data santri
function ubah($santri)
{
    global $conn;
    // ambil data santri
    $id = $santri['id'];
    $nama = htmlspecialchars($santri['nama']);
    $pembimbing = htmlspecialchars($santri['id_pembimbing']);
    $ttl = htmlspecialchars($santri['ttl']);
    $jk = htmlspecialchars($santri['jk']);
    $kontak = htmlspecialchars($santri['kontak']);
    $alamat = htmlspecialchars($santri['alamat']);

    // masukkan ke databse tabel santri
    $ubah = "UPDATE santri SET 
        id_pembimbing = '$pembimbing', 
        nama = '$nama', 
        tanggal_lahir = '$ttl', 
        jenis_kelamin = '$jk', 
        kontak = '$kontak',
        alamat = '$alamat'
    WHERE id_santri = $id
    ";
    mysqli_query($conn, $ubah);

    return mysqli_affected_rows($conn);
}

// uabh data pembimbing
function ubahPembimbing($pembimbing)
{
    global $conn;
    // ambil data pembimbing
    $id = $pembimbing['id'];
    $nama = htmlspecialchars($pembimbing['nama']);
    $kelas = htmlspecialchars($pembimbing['kelas']);
    $jk = htmlspecialchars($pembimbing['jk']);
    $kontak = htmlspecialchars($pembimbing['kontak']);
    $alamat = htmlspecialchars($pembimbing['alamat']);

    // ubah data pembimbing di database
    $ubah = "UPDATE pembimbing SET 
        nama = '$nama', 
        kode_kelas = '$kelas',
        jenis_kelamin = '$jk', 
        kontak = '$kontak',
        alamat = '$alamat'
    WHERE id_pembimbing = $id
    ";
    mysqli_query($conn, $ubah);

    return mysqli_affected_rows($conn);
}

// ubah data setoran santri
function ubahSetoran($setoran)
{
    global $conn;
    // Ambil data dari form input data
    $idSetoran = $setoran['id'];
    $id = htmlspecialchars($setoran['id_santri']);
    $waktu = htmlspecialchars($setoran['waktu']);
    $keterangan = htmlspecialchars($setoran['keterangan']);

    $tambah = "UPDATE setoran SET
        id_santri = '$id', 
        waktu = '$waktu', 
        keterangan = '$keterangan' 
    WHERE id_setoran = $idSetoran
    ";
    mysqli_query($conn, $tambah);

    return mysqli_affected_rows($conn);
}

// ubah data item_setoran
function ubahItem($setoran)
{
    global $conn;
    // ambil data
    $suratAwal = htmlspecialchars($setoran['suratAwal']);
    $suratAkhir = htmlspecialchars($setoran['suratAkhir']);
    $ayatAwal = htmlspecialchars($setoran['ayatAwal']);
    $ayatAkhir = htmlspecialchars($setoran['ayatAkhir']);
    $awal = query("SELECT id_ayat FROM ayat_surat WHERE id_surat = $suratAwal AND no_ayat = $ayatAwal")[0]['id_ayat'];
    $akhir = query("SELECT id_ayat FROM ayat_surat WHERE id_surat = $suratAkhir AND no_ayat = $ayatAkhir")[0]['id_ayat'];
    $id = $setoran['id'];
    // hapus data item setoran lama
    mysqli_query($conn, "DELETE FROM item_setoran WHERE id_setoran = $id");
    // masukkan data item setoran baru
    while ($awal <= $akhir) {
        $ubahItem = "INSERT INTO item_setoran VALUES ('$id', '$awal')";
        mysqli_query($conn, $ubahItem);
        $awal++;
    }
    return mysqli_affected_rows($conn);
}
