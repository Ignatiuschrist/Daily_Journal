<?php
include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg navbar-light sticky-top">
            <div class="container">
                <a class="navbar-brand" href="index.html">My Journal</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
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
                            <a class="nav-link" href="logout.php">logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <section id="hero" class="text-sm-start p-0">
            <div class="container-fluid bg-secondary-subtle p-3">
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

        <!-- <section id="article" class="py-5">
            <div class="container">
                <h1 class="text-center mb-4">Article</h1>
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                    <div class="col">
                        <div class="card h-100">
                            <img src="image/dataran-tinggi-dieng-wonosobo-1.png" class="card-img-top" alt="Dataran Tinggi Dieng">
                            <div class="card-body text-center">
                                <h5 class="card-title">Dataran Tinggi Dieng</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                            </div>
                            <div class="card-footer text-center">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="image/fe59a84551a18e54f4cba99331e890df-1.png" class="card-img-top" alt="Card title">
                            <div class="card-body text-center">
                                <h5 class="card-title">Card title</h5>
                                <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
                            </div>
                            <div class="card-footer text-center">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="image/headerborobudur-1.png" class="card-img-top" alt="Candi Borobudur">
                            <div class="card-body text-center">
                                <h5 class="card-title">Candi Borobudur</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                            </div>
                            <div class="card-footer text-center">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card h-100">
                            <img src="image/sam-poo-kong-604391744-1.png" class="card-img-top" alt="Sam-Poo-Kong">
                            <div class="card-body text-center">
                                <h5 class="card-title">Sam-Poo-Kong</h5>
                                <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content.</p>
                            </div>
                            <div class="card-footer text-center">
                                <small class="text-body-secondary">Last updated 3 mins ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> -->

        <!-- article begin -->
        <section id="article" class="text-center p-5">
            <div class="container">
                <h1 class="fw-bold display-4 pb-3">article</h1>
                <div class="row row-cols-1 row-cols-md-3 g-4 justify-content-center">
                    <?php
                    $sql = "SELECT * FROM article ORDER BY tanggal DESC";
                    $hasil = $conn->query($sql);

                    while ($row = $hasil->fetch_assoc()) {
                    ?>
                        <div class="col">
                            <div class="card h-100">
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
                        <div class="carousel-item active">
                            <img src="image/Wallpaper 1.jpg" class="d-block w-100" height="500" alt="Wallpaper 1">
                        </div>
                        <div class="carousel-item">
                            <img src="image/Wallpaper 2.jpg" class="d-block w-100" height="500" alt="Wallpaper 2">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
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
                    <!-- Monday -->
                    <div class="col-md-4">
                        <div class="card text-bg-light mb-3">
                            <div class="card-header">Senin</div>
                            <div class="card-body">
                                <p class="card-text">
                                    09:00-10:00 <br>
                                    Basis Data <br>
                                    Ruang H.3.1 <br><br>
                                    10:00-11:00 <br>
                                    Algoritma <br>
                                    Ruang H.3.2
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Tuesday -->
                    <div class="col-md-4">
                        <div class="card text-bg-light mb-3">
                            <div class="card-header">Selasa</div>
                            <div class="card-body">
                                <p class="card-text">
                                    09:00-10:00 <br>
                                    Struktur Data <br>
                                    Ruang H.3.1 <br><br>
                                    10:00-11:00 <br>
                                    Jaringan Komputer <br>
                                    Ruang H.3.3
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Wednesday -->
                    <div class="col-md-4">
                        <div class="card text-bg-light mb-3">
                            <div class="card-header">Rabu</div>
                            <div class="card-body">
                                <p class="card-text">
                                    08:00-09:00 <br>
                                    Sistem Operasi <br>
                                    Ruang H.3.4 <br><br>
                                    10:00-11:00 <br>
                                    Pemrograman <br>
                                    Ruang H.3.5
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Thursday -->
                    <div class="col-md-4">
                        <div class="card text-bg-light mb-3">
                            <div class="card-header">Kamis</div>
                            <div class="card-body">
                                <p class="card-text">
                                    09:00-10:00 <br>
                                    Statistik <br>
                                    Ruang H.3.1 <br><br>
                                    11:00-12:00 <br>
                                    Manajemen Proyek <br>
                                    Ruang H.3.2
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Friday -->
                    <div class="col-md-4">
                        <div class="card text-bg-light mb-3">
                            <div class="card-header">Jumat</div>
                            <div class="card-body">
                                <p class="card-text">
                                    07:00-08:00 <br>
                                    Basis Data <br>
                                    Ruang H.3.1 <br><br>
                                    09:00-10:00 <br>
                                    Pemrograman Berbasis Web <br>
                                    Ruang H.3.3
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Saturday -->
                    <div class="col-md-4">
                        <div class="card text-bg-light mb-3">
                            <div class="card-header">Sabtu</div>
                            <div class="card-body">
                                <p class="card-text">
                                    10:00-11:00 <br>
                                    Analisis Data <br>
                                    Ruang H.3.2
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="profile">
            <div class="container">
                <h1 class="text-center mb-4">Profile</h1>
                <div class="container-fluid bg-secondary-subtle p-3">
                    <div class="row align-items-center p-2 mx-3">
                        <div class="col-12 col-sm-6 text-center">
                            <img src="./image/bird-thumbnail.jpg" class="img-fluid py-4 img-rounded-4" width="300" alt="hero-image">
                        </div>
                        <div class="col-12 col-sm-6">
                            <h1 class="fw-bold display-4">Ignatius Christabel</h1>
                            <p class="lead display-6">----</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <footer class="text-center py-4">
            <div class="mb-3">
                <a href="https://www.instagram.com/ignatiuschristabel_/" class="bi bi-instagram fs-3 text-dark me-3"></a>
                <a href="#" class="bi bi-twitter fs-3 text-dark me-3"></a>
                <a href="#" class="bi bi-whatsapp fs-3 text-dark"></a>
            </div>
            <div>&copy; ignatiuschristabel_ 2024</div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>

</html>