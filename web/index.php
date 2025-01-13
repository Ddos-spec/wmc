<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wimcycle</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
    }

    /* Enhanced Carousel Styles */
    .carousel {
      position: relative;
      overflow: hidden;
    }

    .carousel-inner {
      position: relative;
      width: 100%;
      overflow: hidden;
    }

    .carousel-item {
      position: relative;
      display: none;
      float: left;
      width: 100%;
      margin-right: -100%;
      backface-visibility: hidden;
      transition: transform 1.2s ease-in-out;
    }

    .carousel-item img {
        width: auto; /* Allow images to display at their natural width */
        height: auto; /* Allow images to display at their natural height */
        object-fit: contain; /* Ensure images are fully visible */
    }

    .carousel-fade .carousel-item {
      opacity: 0;
      transition: opacity 1.2s ease-in-out;
    }

    .carousel-fade .carousel-item.active {
      opacity: 1;
    }

    .carousel-indicators {
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      z-index: 15;
      display: flex;
      justify-content: center;
      margin: 0;
      padding: 0;
      list-style: none;
    }

    .carousel-indicators [data-bs-target] {
      width: 12px;
      height: 12px;
      margin: 0 5px;
      border-radius: 50%;
      background-color: rgba(255, 255, 255, 0.5);
      cursor: pointer;
      transition: background-color 0.3s ease;
      border: none;
    }

    .carousel-indicators .active {
      background-color: #fff;
    }

    .carousel-control-prev,
    .carousel-control-next {
      width: 50px;
      height: 50px;
background: transparent; /* Keep the background transparent */
      border: 2px solid #ffb71b; /* Set the outline color */
      border-radius: 50%;
      top: 50%;
      transform: translateY(-50%);
      opacity: 0;
      transition: all 0.3s ease;
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
background-color: transparent; /* Set the arrow background to transparent */
    }

    .carousel:hover .carousel-control-prev,
    .carousel:hover .carousel-control-next {
      opacity: 1;
    }

    .carousel-control-prev {
      left: 20px;
    }

    .carousel-control-next {
      right: 20px;
    }

    .carousel-control-prev:hover,
    .carousel-control-next:hover {
      opacity: 0.9;
      background: rgba(0, 0, 0, 0.7);
    }

    .section-title {
      text-align: center;
      margin: 50px 0 20px;
      font-weight: bold;
    }

    .section-title span {
      display: block;
      width: 50px;
      height: 3px;
      background-color: #f0ad4e;
      margin: 10px auto;
    }

    .product-card {
      border: none;
      transition: all 0.3s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .product-card:hover {
      outline: 2px solid #002856;
      outline-offset: -2px;
    }

    .product-card img {
      width: 100%;
      height: auto;
    }

    .product-card .card-body {
      padding: 20px;
      height: 220px;
      display: flex;
      flex-direction: column;
      position: relative;
    }

    .product-card .card-text {
      text-align: left;
      color: #000;
      transition: color 0.3s ease;
      padding: 0 5px;
      margin-bottom: 40px;
    }

    .product-card .btn {
      width: fit-content;
      min-width: 100px;
      padding: 8px 20px;
      position: absolute;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
    }

    .product-card .card-title {
      color: #000;
      text-decoration: none;
      transition: color 0.3s ease;
      text-align: center;
      margin-bottom: 15px;
      width: 100%;
    }

    .product-card:hover .card-title,
    .product-card:hover .card-text {
      color: #002856;
    }

    .product-card .btn,
    .latest-product .btn,
    .info-section .btn {
      background-color: #002856;
      color: white;
      border: none;
      border-radius: 25px;
      padding: 8px 25px;
      transition: all 0.3s ease;
    }

    .product-card .btn:hover,
    .latest-product .btn:hover,
    .info-section .btn:hover {
      background-color: #ffb71b;
      color: white;
    }

    .latest-product img {
      width: 100%;
      height: auto;
    }

    .info-section img {
      width: 100%;
      height: auto;
    }
  </style>
</head>
<body>
  <?php include 'navbar.php'; ?>

  <div id="carouselExampleControls" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4000" data-bs-pause="hover" data-bs-touch="true" data-bs-wrap="true">
    <!-- Carousel Indicators -->
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="2" aria-label="Slide 3"></button>
      <button type="button" data-bs-target="#carouselExampleControls" data-bs-slide-to="3" aria-label="Slide 4"></button>
    </div>

    <div class="carousel-inner">
    <div class="carousel-item active">
        <img src="../gambar/banner.jpg" class="d-block w-100" alt="Banner 1">
    </div>
    <div class="carousel-item">
        <img src="../gambar/banner (2).jpg" class="d-block w-100" alt="Banner 2">
    </div>
    <div class="carousel-item">
        <img src="../gambar/banner (3).jpg" class="d-block w-100" alt="Banner 3">
    </div>
    <div class="carousel-item">
        <img src="../gambar/banner (4).jpg" class="d-block w-100" alt="Banner 4">
    </div>
</div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>

  <div class="container">
    <h2 class="section-title" style="color: #ffb71b;">SEPEDA WIMCYCLE</h2>
    <span></span>
    <p class="text-center"><strong>Wimcycle menawarkan rangkaian sepeda berkualitas dengan desain yang stylish dan nyaman sesuai kebutuhan bersepeda keluarga anda!</strong></p>
    <p class="text-center"><strong>sesuai kebutuhan bersepeda keluarga anda!</strong></p>
    <hr style="border: 3px solid #ffb71b; width: 100%; margin: 20px auto;">
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card product-card sepeda-anak">
                <img src="../gambar/sepeda-anak.jpg" class="card-img-top" alt="Sepeda Anak" width="300" height="200">
                <div class="card-body">
                    <h5 class="card-title">Sepeda Anak</h5>
                    <p class="card-text">Berbagai pilihan sepeda hadir untuk menemani bersepeda anak Anda.</p>
                    <a href="#" class="btn btn-primary">Lihat Semua</a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card product-card">
                <img src="../gambar/sepeda-bmx.jpg" class="card-img-top" alt="Sepeda BMX" width="300" height="200">
                <div class="card-body">
                    <h5 class="card-title">Sepeda BMX</h5>
                    <p class="card-text">Jenis sepeda yang cocok bagi Anda pecinta olahraga sepeda ekstrim, melakukan trik dan gerakan menakjubkan.</p>
                    <a href="#" class="btn btn-primary">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card product-card">
                <img src="../gambar/COVER_MTB-352x350.jpg" class="card-img-top" alt="Sepeda Gunung (MTB)" width="300" height="200">
                <div class="card-body">
                    <h5 class="card-title">Sepeda Gunung (MTB)</h5>
                    <p class="card-text">Sepeda yang cocok bagi Anda ingin merasakan sepeda gunung untuk off-road ringan di akhir pekan.</p>
                    <a href="#" class="btn btn-primary">Lihat Semua</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card product-card ctb">
                <img src="../gambar/CTB-1-352x350.jpg" class="card-img-top" alt="CTB" width="300" height="200">
                <div class="card-body">
                    <h5 class="card-title">CTB</h5>
                    <p class="card-text">Sepeda yang cocok bagi Anda yang ingin berpergian dengan teman-teman untuk meningkatkan kebugaran tubuh.</p>
                    <a href="#" class="btn btn-primary">Lihat Semua</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card product-card">
                <img src="../gambar/Sepeda-Lipat-16-352x350.jpg" class="card-img-top" alt="Sepeda Lipat" width="300" height="200">
                <div class="card-body">
                    <h5 class="card-title">Sepeda Lipat</h5>
                    <p class="card-text">Sepeda lipat yang cocok bagi Anda untuk menjelajahi kota.</p>
                    <a href="#" class="btn btn-primary">Lihat Semua</a>
                </div>
            </div>   
        </div>
    </div>
      
    <h2 class="section-title" style="color: #ffb71b;">PRODUK TERBARU WIMCYCLE</h2>
    <span></span>
    <p class="text-center" style="font-size: 15px; color: #002856;">Nantikan produk terbaru dari Wimcycle dengan desain lebih fresh dan colorful</p>
    <hr style="border: 3px solid #ffb71b; width: 100%; margin: 20px auto;">
    <div class="row latest-product">
      <div class="col-md-6">
        <img src="../gambar/sepeda-bigfoot.jpg" alt="BMX Big foot Road 20" width="600" height="400">
      </div>
      <div class="col-md-6">
        <div style="display: flex; flex-direction: column; align-items: center; text-align: center;">
        </div>
        <h5 style="font-size: 30px; margin-bottom: 10px; font-weight: bold;">BMX Big foot Road 20"</h5>
        <p style="margin-bottom: 20px;">Sepeda BMX Bigfoot "Road" hadir dengan improvement dari seri sebelumnya "Solid Series". Seri "Road" hadir sebagai sepeda pertunjukan Anda menampilkan gaya yang sangat tangguh dari Amerika Hobi dengan warna Baru Red Light & Green Light.</p>
        <a href="#" class="btn btn-primary">Lihat Semua</a>
      </div>
    </div>

    <h2 class="section-title" style="color: #ffb71b;">INFORMASI TERBARU</h2>
    <span></span>
    <p class="text-center" style="color: #002856;">Temukan kumpulan tips bersepeda dengan keluarga dari Wimcycle</p>
    <hr style="border: 3px solid #ffb71b; width: 100%; margin: 20px auto;">
    <div class="row info-section">
      <div class="col-md-6">
        <img src="../gambar/WEBSITE-2.jpg" alt="To Do List Sebelum Bersepeda" width="600" height="400">
      </div>
      <div class="col-md-6">
        <h5 style="font-size: 30px; margin-bottom: 10px; font-weight: bold;">Perlengkapan Yang Perlu di Siapkan Sebelum Bersepeda</h5>
        <a href="#" class="btn btn-primary">Baca Lebih Lanjut</a>
      </div>
    </div>
  </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <?php include 'footer.php'; ?>

    </body>
    </html>
