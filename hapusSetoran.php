<?php
require 'function.php';
$id = $_GET['id']; // tangkap id_setoran yang dikirimkan dengan method get
// jika function hapusSetoran() mengembalikan nilai > 0, berarti ada baris yang terpengaruhi di database
if (hapusSetoran($id) > 0) {
    // maka, tampilkan pesan berhasil
    echo " 
    <script>
        alert('Data Berhasil dihapus!');
        document.location.href = 'setoran.php';
    </script> ";
    // jika tidak, maka tampilkan pesan gagal
} else {
    echo " 
    <script>
        alert('Data Gagal dihapus!');
        document.location.href = 'setoran.php';
    </script> ";
}
