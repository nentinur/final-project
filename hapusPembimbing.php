<?php
require 'function.php';
// ambil id_pembimbing yang dikirimkan dengan method get
$id = $_GET['id'];

// jika function hapusPembimbing() mengembalikan nilai > 0, berarti ada baris yang terpengaruhi di database
if (hapusPembimbing($id) > 0) {
    // maka, tampilkan pesan berhasil
    echo " 
    <script>
        alert('Data Berhasil dihapus!');
        document.location.href = 'pembimbing.php';
    </script> ";
    // jika tidak, maka tampilkan pesan gagal
} else {
    echo " 
    <script>
        alert('Data Gagal dihapus!');
        document.location.href = 'pembimbing.php';
    </script> ";
}
