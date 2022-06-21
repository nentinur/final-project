<?php
require 'function.php';
// tangkap id_santri yang dikirimkan dengan method get
$id = $_GET['id'];

// jika function hapus() mengembalikan nilai > 0, berarti ada baris yang terpengaruhi di database
if (hapus($id) > 0) {
    // maka tampilkan pesan berhasil
    echo " 
    <script>
        alert('Data Berhasil dihapus!');
        document.location.href = 'santri.php';
    </script> ";
} else {
    // jika tidak, tampilkan pesan gagal
    echo " 
    <script>
        alert('Data Gagal dihapus!');
        document.location.href = 'santri.php';
    </script> ";
}
