<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="icon" href="/wmc/gambar/LOGO-WIMCYCLE-e1670387342889.png" type="image/png">

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: transparent;
            box-shadow: none;
            transition: background-color 0.3s, box-shadow 0.3s, padding 0.3s;
            z-index: 1000;
            border-radius: 0 0 100px 100px;
        }
        nav.scrolled {
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 20px;
        }
        .navbar-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px 20px;
        }
        .logo img {
            height: 50px;
            display: block;
        }
        .menu {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .menu li {
            margin: 0 30px; /* Tambah jarak antar item menu */
            position: relative; /* For positioning the submenu */
        }
        .menu a {
            text-decoration: none;
            color: #002856;
            transition: color 0.3s;
            font-size: 18px;
            font-weight: bold;
        }
        .menu a:hover {
            color: #ffb71b;
        }
        .submenu {
            display: none; /* Hide submenu by default */
            position: absolute;
            top: 100%; /* Position below the parent menu */
            left: 0;
            background-color: #002856; /* Background color for submenu */
            border-radius: 5px;
            padding: 10px;
            z-index: 1000;
            min-width: 150px; /* Set minimum width for submenu */
        }
        .menu li:hover .submenu {
            display: block; /* Show submenu on hover */
        }
        .submenu a {
            color: white; /* Text color for submenu */
            font-weight: bold; /* Make submenu items bold */
            font-size: 14px; /* Set font size for submenu items */
            white-space: nowrap; /* Prevent text from wrapping */
        }
        .circle-button {
            position: relative;
            display: inline-block;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #022856;
            border: 2px solid #002856;
            transition: background-color 0.3s, border 0.3s, transform 0.3s;
            cursor: pointer;
            transform: translateX(-100px); /* Geser tombol pencarian ke kiri */
        }
        svg {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            fill: white;
        }
        @media (max-width: 768px) {
            .menu {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 60px;
                left: 0;
                right: 0;
                background-color: white;
                border-radius: 0 0 30px 30px;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }
            .menu.active {
                display: flex;
            }
            .menu li {
                margin: 10px 0;
            }
            .menu-toggle {
                display: block;
                cursor: pointer;
            }
        }
        .menu-toggle {
            display: none;
        }
    </style>
</head>
<body>

<nav id="navbar">
    <div class="navbar-container">
        <div class="logo" style="margin-left: 50px;"> <!-- Geser logo ke kanan -->
            <a href="/wmc/web/index.php">
                <img src="/wmc/gambar/logo.png" alt="Brand Logo">
            </a>
        </div>
        <div class="menu-toggle" id="menuToggle">
            <i class="fas fa-bars"></i>
        </div>
        <ul class="menu" id="menu">
            <li>
                <a href="produk/produk.php">Produk</a> <!-- Updated link -->
                <ul class="submenu">
                    <li><a href="#BMX">BMX</a></li>
                    <li><a href="#ChildrensBikes">Sepeda Anak</a></li>
                    <li><a href="#MTB">Sepeda Gunung</a></li>
                    <li><a href="#FoldingBikes">Sepeda Lipat</a></li>
                </ul>
            </li>
            <li>
                <a href="#Dukungan">Dukungan</a>
                <ul class="submenu">
                    <li><a href="#ContactUs">Hubungi Kami</a></li>
                    <li><a href="#BikeRegistration">Registrasi Sepeda</a></li>
                    <li><a href="#Warranty">Garansi</a></li>
                </ul>
            </li>
            <li><a href="#Dealer">Dealer</a></li>
        </ul>
        <div class="circle-button" onmouseover="this.style.backgroundColor='#ffb71b';" onmouseout="this.style.backgroundColor='#022856';">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="26" viewBox="0 0 24 24">
                <path d="M10 2C5.58 2 2 5.58 2 10s3.58 8 8 8c1.66 0 3.19-.5 4.47-1.34l4.88 4.88c.39.39 1.02.39 1.41 0s.39-1.02 0-1.41l-4.88-4.88C18.5 13.19 20 11.66 20 10c0-4.42-3.58-8-8-8zm0 14c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6z"/>
            </svg>
        </div>
    </div>
</nav>

<script>
    const navbar = document.getElementById('navbar');
    const menuToggle = document.getElementById('menuToggle');
    const menu = document.getElementById('menu');

    window.addEventListener('scroll', () => {
        if (window.scrollY > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
    });

    menuToggle.addEventListener('click', () => {
        menu.classList.toggle('active');
    });
</script>

</body>
</html>
