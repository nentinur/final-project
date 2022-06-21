<?php require 'function.php';
// ambil data santri dari database
$santri = query("SELECT * FROM santri");

$judul = 'Dashboard'; // judul halaman
include('layout/header.php'); // memanggil layout header
?>
<div class="cart" style="width: 400px">
    <!-- Menampilkan tabel perkembangan setoran santri -->
    <canvas id="myChart" width="400" height="400"></canvas>
    <script>
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [
                    // menampilkan nama santri
                    <?php foreach ($santri as $row) : ?> "<?= $row['nama']; ?>",
                    <?php endforeach; ?>
                ],
                datasets: [{
                    label: '',
                    data: [
                        // menampilkan jumlah ayat yang sudah disetorkan
                        <?php foreach ($santri as $row) : ?> "
                            <?php $id = $row['id_santri'];
                            echo query("SELECT COUNT(item_setoran.id_ayat) FROM item_setoran INNER JOIN setoran ON setoran.id_setoran = item_setoran.id_setoran INNER JOIN santri ON setoran.id_santri = santri.id_santri WHERE santri.id_santri = $id")[0]['COUNT(item_setoran.id_ayat)'];
                            ?> ",
                        <?php endforeach; ?>
                    ],

                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>
</div>


<?php include('layout/footer.php'); // memanggil layout footer 
?>