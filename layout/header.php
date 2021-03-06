<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- Scripst javascript -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <title><?= $judul; ?></title>
</head>

<body>
    <div class="container mt-3">
        <div class="card">
            <!-- Navbar -->
            <div class="card-header">
                <nav class="navbar navbar-expand-lg bg-light">
                    <div class="container-fluid">
                        <a class="navbar-brand" href="#">Hafiz</a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                                <!-- Link halaman dashboard -->
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
                                </li>
                                <!-- Link halaman santri -->
                                <li class="nav-item">
                                    <a class="nav-link active" href="santri.php">Santri</a>
                                </li>
                                <!-- Link halaman pembimbing -->
                                <li class="nav-item">
                                    <a class="nav-link active" href="pembimbing.php">Pembimbing</a>
                                </li>
                                <!-- link halaman setoran -->
                                <li class="nav-item">
                                    <a class="nav-link active" href="setoran.php">Setoran</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="list-group list-group-flush">
                <div class="list-group-item mt-2">
                    <h5 class="card-title"><?= $judul; ?></h5>
                </div>
                <div class="list-group-item">