<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
error_reporting(E_ALL);
ini_set('display_errors', 1);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
/* Navbar */
.navbar {
    background-color: white;
    padding: 20px 10px;
    position: sticky; /* Navbar akan menempel di atas */
    top: 0; /* Berada di posisi atas */
    z-index: 1020; /* Pastikan di atas elemen lain */
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Tambahkan bayangan agar terlihat jelas */
}

.nav-link {
    font-size: 1.5rem; /* Perbesar font navbar */
    font-weight: bold;
    color: black !important;
    transition: background-color 0.3s ease; /* Tambahkan transisi smooth */
}

.nav-link:hover {
    background-color: #FFB71B; /* Warna background saat hover */
    color: white !important; /* Warna teks jadi putih saat hover */
    border-radius: 5px; /* Efek rounded biar lebih modern */
    padding: 5px 10px; /* Tambahkan padding untuk link */
}

.navbar-brand img {
    width: 120px; /* Perbesar logo */
    height: auto;
}

/* Logout button */
.btn-logout {
    background-color: #dc3545;
    color: white !important;
    margin-left: 15px;
    padding: 8px 20px;
    border-radius: 25px;
    transition: all 0.3s ease;
    margin-top: 5px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.btn-logout:hover {
    background-color: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.3);
}

/* Body */
body {
    background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
    color: white;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

    /* Jumbotron */
    .jumbotron {
        position: relative;
        background: url('gambar/naiksepeda.gif') no-repeat center center;
        background-size: cover;
        height: 400px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }
    .jumbotron h1, .jumbotron p {
        z-index: 1;
    }

    /* Carousel Styling */
    .carousel-item {
        position: relative;
        overflow: hidden;
    }
    
    .carousel-item img {
        height: 600px;
        object-fit: cover;
        transition: transform 1.2s ease-in-out, opacity 0.8s ease-in-out;
        filter: brightness(0.9);
    }
    
    .carousel-item:hover img {
        transform: scale(1.05);
    }
    
    .carousel-caption {
        background: rgba(0, 0, 0, 0.7);
        border-radius: 15px;
        padding: 20px;
        max-width: 80%;
        margin: 0 auto;
        bottom: 40px;
        backdrop-filter: blur(5px);
    }
    
    .carousel-caption h5 {
        color: #FFB71B;
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        text-transform: uppercase;
    }
    
    .carousel-caption p {
        color: white;
        font-size: 16px;
        line-height: 1.6;
    }
    
    .carousel-control-prev, .carousel-control-next {
        width: 5%;
        opacity: 0.8;
        transition: all 0.3s ease;
    }
    
    .carousel-control-prev:hover, .carousel-control-next:hover {
        opacity: 1;
        background: rgba(0,0,0,0.2);
    }
    
    .carousel-indicators {
        bottom: 20px;
    }
    
    .carousel-indicators li {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        margin: 0 5px;
        background-color: #FFB71B;
        opacity: 0.5;
        transition: all 0.3s ease;
    }
    
    .carousel-indicators .active {
        opacity: 1;
        transform: scale(1.2);
    }
</style>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
        <a class="navbar-brand" href="#">
<img src="gambar/logo.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
<a class="nav-link" href="web/index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/sepeda/showsepeda.php">Sepeda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/kategori/showkategori.php">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin/frame/showframe.php">Frame</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-logout" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Jumbotron -->
<div class="container mt-4">
    <div class="jumbotron text-center">
        <h1 class="display-4">Selamat Datang di Dashboard Admin</h1>
        <p class="lead">Temukan berbagai koleksi sepeda berkualitas untuk kebutuhan Anda</p>
    </div>

    <!-- Carousel: Sepeda Terbaru -->
<section class="mb-5">
    <h2 class="text-center mb-4">Sepeda Terbaru</h2>
    <div id="carouselSepeda" class="carousel slide" data-ride="carousel" data-interval="4000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="gambar/sepeda (1).jpg" class="d-block w-100" alt="Sepeda 1">
                <div class="carousel-caption text-dark">
                    <h5>Sepeda 1</h5>
                    <p>Sepeda dengan desain modern dan kuat.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="gambar/sepeda (2).jpg" class="d-block w-100" alt="Sepeda 2">
                <div class="carousel-caption text-dark">
                    <h5>Sepeda 2</h5>
                    <p>Desain yang elegan dan nyaman digunakan.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="gambar/sepeda (3).jpg" class="d-block w-100" alt="Sepeda 3">
                <div class="carousel-caption text-dark">
                    <h5>Sepeda 3</h5>
                    <p>Sepeda sport dengan performa tinggi.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselSepeda" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselSepeda" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<!-- Carousel: Jenis Frame -->
<section class="mb-5">
    <h2 class="text-center mb-4">Frame Terbaru</h2>
    <div id="carouselFrame" class="carousel slide" data-ride="carousel" data-interval="4000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="gambar/frameAlloy (Aluminium).jpg" class="d-block w-100" alt="Frame Alloy Aluminium">
                <div class="carousel-caption text-dark">
                    <h5>Frame Alloy Aluminium</h5>
                    <p>Material: Alloy (Aluminium).</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="gambar/framebaja.jpg" class="d-block w-100" alt="Frame Baja">
                <div class="carousel-caption text-dark">
                    <h5>Frame Baja</h5>
                    <p>Material: Baja.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="gambar/frameCarbon Fiber.jpg" class="d-block w-100" alt="Frame Carbon Fiber">
                <div class="carousel-caption text-dark">
                    <h5>Frame Carbon Fiber</h5>
                    <p>Material: Carbon Fiber.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="gambar/frameChromoly.jpg" class="d-block w-100" alt="Frame Chromoly">
                <div class="carousel-caption text-dark">
                    <h5>Frame Chromoly</h5>
                    <p>Material: Chromoly.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselFrame" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselFrame" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>

<!-- Carousel: Kategori Sepeda -->
<section class="mb-5">
    <h2 class="text-center mb-4">Kategori Sepeda</h2>
    <div id="carouselKategori" class="carousel slide" data-ride="carousel" data-interval="4000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="gambar/Sepeda-Hybrid.jpg" class="d-block w-100" alt="Sepeda Hybrid">
                <div class="carousel-caption text-dark">
                    <h5>Sepeda Hybrid</h5>
                    <p>Kategori: Hybrid.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="gambar/Sepeda-Lipat-Folding-Bike.jpg" class="d-block w-100" alt="Sepeda Lipat">
                <div class="carousel-caption text-dark">
                    <h5>Sepeda Lipat</h5>
                    <p>Kategori: Lipat (Folding Bike).</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="gambar/Sepeda-Touring.jpg" class="d-block w-100" alt="Sepeda Touring">
                <div class="carousel-caption text-dark">
                    <h5>Sepeda Touring</h5>
                    <p>Kategori: Touring.</p>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselKategori" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselKategori" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>