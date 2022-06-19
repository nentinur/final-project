<?php
require 'function.php';
$id = $_GET['id'];

if (hapusSetoran($id) > 0) {
    echo " 
    <script>
        alert('Data Berhasil dihapus!');
        document.location.href = 'setoran.php';
    </script> ";
} else {
    echo " 
    <script>
        alert('Data Gagal dihapus!');
        document.location.href = 'setoran.php';
    </script> ";
}
