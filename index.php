<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Journal</title>
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" />
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
        crossorigin="anonymous" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <style>
        html {
            position: relative;
            min-height: 100%;
        }

        body {
            margin-bottom: 100px;
            /* Margin bottom by footer height */
        }

        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 100px;
            /* Set the fixed height of the footer here */
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-sm bg-body-tertiary sticky-top bg-secondary-subtle">
        <div class="container">
            <a class="navbar-brand">My Journal</a>
            <button
                class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent"
                aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 text-dark">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#hero">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#article">Article</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#schedule">Schedule</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#profile">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" target="_blank" href="login.php">login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <div class="container-fluid">
        <section id="hero" class="text-sm-start p-5">
            <div class="container-fluid bg-light p-3 rounded-4">
                <div class="row align-items-center p-2 mx-3 flex-sm-row-reverse">
                    <div class="col-12 col-sm-6 text-center">
                        <img src="./image/bird-thumbnail.jpg" class="img-fluid py-4" width="300" alt="hero-image">
                    </div>
                    <div class="col-12 col-sm-6">
                        <h1 class="fw-bold display-4">Create Memories, Save Memories, Everyday</h1>
                        <p class="lead display-6">Mencatat semua kegiatan sehari - hari yang ada tanpa terkendali</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- article begin -->
        <section id="article" class="text-center p-5">
            <div class="container">
                <h1 class="fw-bold display-4 pb-3">Article</h1>
                <div class="row row-cols-1 row-cols-md-4 g-4 justify-content-center">
                    <?php
                    $sql = "SELECT * FROM article ORDER BY tanggal DESC";
                    $hasil = $conn->query($sql);

                    while ($row = $hasil->fetch_assoc()) {
                    ?>
                        <div class="col">
                            <div class="card h-100 rounded-5">
                                <img src="image/<?= $row["gambar"] ?>" class="card-img-top" alt="..." />
                                <div class="card-body">
                                    <h5 class="card-title"><?= $row["judul"] ?></h5>
                                    <p class="card-text">
                                        <?= $row["isi"] ?>
                                    </p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-body-secondary">
                                        <?= $row["tanggal"] ?>
                                    </small>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <!-- article end -->

        <section id="gallery" class="py-5 bg-light">
            <div class="container">
                <h1 class="text-center mb-4">Gallery</h1>
                <div id="carouselExample" class="carousel slide">
                    <div class="carousel-inner">
                        <?php
                        // Menarik data dari database untuk gallery
                        $sql = "SELECT * FROM gallery ORDER BY tanggal DESC";
                        $hasil = $conn->query($sql);

                        // Menginisialisasi flag untuk menentukan item pertama
                        $activeClass = 'active';

                        // Perulangan untuk menampilkan gambar-gambar
                        while ($row = $hasil->fetch_assoc()) {
                        ?>
                            <div class="carousel-item <?= $activeClass ?>">
                                <img src="image/<?= $row['gambar'] ?>" class="d-block w-100 rounded-3" height="500" alt="..." />
                            </div>
                        <?php
                            // Menghapus class 'active' setelah item pertama
                            $activeClass = '';
                        }
                        ?>
                    </div>
                    <button class=" carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </section>


        <section id="schedule" class="py-5">
            <div class="container">
                <h1 class="text-center mb-4">Schedule</h1>
                <div class="row row-gap-4 text-center">
                    <?php
                    include 'connection.php';
                    $query = "SELECT * FROM schedule ORDER BY id ASC";
                    $result = $conn->query($query);

                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo '<div class="col-md-4">';
                            echo '<div class="card text-bg-light mb-3">';
                            echo '<div class="card-body">';
                            echo '<h2 class="card-text">' . htmlspecialchars($row['hari']) . '</h2>';
                            echo '<p class="card-text">' . htmlspecialchars($row['kegiatan']) . '</p>';
                            echo '<p class="card-text">' . htmlspecialchars($row['deskripsi']) . '</p>';
                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text-center">Tidak ada jadwal tersedia.</p>';
                    }
                    ?>
                </div>
            </div>
        </section>

        <section id="profile" class="py-5">
            <div class="container">
                <h1 class="text-center mb-5">Profile</h1>
                <div class="container-fluid bg-secondary-subtle shadow-sm rounded-4 p-4">
                    <div class="row align-items-center">
                        <div class="col-12 col-md-5 text-center">
                            <img src="./image/20191128_183019.jpg" class="img-fluid border border-4 rounded-4" width="250" alt="Profile Image">
                        </div>
                        <div class="col-12 col-md-7">
                            <h2 class="fw-bold display-5 mb-3">Ignatius Christabel</h2>
                            <p class="lead mb-4 text-secondary">A11.2020.13066</p>
                            <ul class="list-unstyled">
                                <li><i class="bi bi-envelope me-2 text-primary"></i> ignatiuschrist134@gmail.com</li>
                                <li><i class="bi bi-phone me-2 text-primary"></i> +6285602495944</li>
                                <li><i class="bi bi-geo-alt me-2 text-primary"></i> Semarang, Indonesia</li>
                            </ul>
                            <div class="mt-4">
                                <a href="https://github.com/ignatiuschrist" class="btn btn-outline-secondary"><i class="bi bi-github"></i> GitHub</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <footer class="text-center p-3 bg-secondary-subtle">
        <div>
            <a href="https://www.instagram.com/ignatiuschristabel_/"><i class="bi bi-instagram h2 p-2 text-dark"></i></a>
            <a href="https://twitter.com/udinusofficial"><i class="bi bi-twitter h2 p-2 text-dark"></i></a>
            <a href="https://wa.me/qr/UCNGPGDGDDFPH1"><i class="bi bi-whatsapp h2 p-2 text-dark"></i></a>
        </div>
        <div>Ignatius Christabel &copy; 2024</div>
    </footer>
    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
        crossorigin="anonymous">
    </script>
</body>

</html>