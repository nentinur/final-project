<?php
require 'function.php';

$id = $_GET['id'];

if (hapusPembimbing($id) > 0) {
    echo " 
    <script>
        alert('Data Berhasil dihapus!');
        document.location.href = 'pembimbing.php';
    </script> ";
} else {
    echo " 
    <script>
        alert('Data Gagal dihapus!');
        document.location.href = 'pembimbing.php';
    </script> ";
}
