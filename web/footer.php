<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Footer Section</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        .footer {
    background-image: url('../gambar/bg-footer.jpg');
    background-size: cover;
    background-position: center;
    color: #ffb400;
    padding: 30px 20px; /* Memperpendek padding atas/bawah */
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
}
        .footer .subscribe-section {
            display: flex;
            justify-content: space-between;
            width: 100%;
            max-width: 1200px;
            margin-bottom: 30px;
        }
        .footer .subscribe {
            flex: 1;
            margin-right: 20px;
        }
        .footer .subscribe input[type="email"] {
            padding: 12px;
            border: none;
            border-radius: 5px;
            width: 80%;
        }
        .footer .subscribe button {
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            background-color: #ffb400;
            color: #000;
            font-weight: bold;
            cursor: pointer;
        }
        .footer .links {
            flex: 2;
            display: flex;
            justify-content: space-between;
            text-align: left;
        }
        .footer .links div h3 {
            color: #ffb400;
            margin-bottom: 15px;
            font-size: 18px;
        }
        .footer .links div a {
            color: #ffb400;
            text-decoration: none;
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
        }
        .footer .links div a:hover {
            text-decoration: underline;
        }
        .footer .follow-section {
            text-align: center;
            margin-top: 30px;
        }
        .footer .follow-us {
            margin: 20px 0;
            font-weight: bold;
            font-size: 18px;
        }
        .footer .social-icons {
            display: flex;
            justify-content: center;
            gap: 20px;
        }
        .footer .social-icons a {
            color: #ffb400;
            font-size: 28px;
        }
        .footer {
    background-image: url('../gambar/bg-footer.jpg');
    background-size: cover;
    background-position: center;
    color: #ffb400;
    padding: 30px 20px; /* Memperpendek padding atas/bawah */
    font-family: Arial, sans-serif;
    display: flex;
    flex-direction: column;
    align-items: center;
}
.footer .copyright-section {
    margin-top: 20px;
    width: 100%; /* Ambil seluruh lebar footer */
    text-align: left; /* Atur teks ke kiri */
    position: relative;
}
.footer .copyright-line {
    width: 100%; /* Panjang garis ke ujung */
    height: 3px; /* Tinggi garis */
    background-color: #ffb71b;
    margin-bottom: 10px; /* Jarak garis dengan teks */
}
.footer .copyright {
    font-size: 14px;
    margin-left: 20px; /* Memberi jarak dari sisi kiri */
}

    </style>
</head>
<body>
    <div class="footer">
        <div class="subscribe-section">
            <div class="subscribe">
                <input type="email" placeholder="Alamat Email Anda" style="width: 40%; padding: 6px;">
                <button style="margin-left: 5px; padding: 6px; width: 40%;">Berlangganan</button>
            </div>
            <div class="links">
                <div>
                    <h3>Dukungan</h3>
                    <a href="#">Kontak Kami</a>
                    <a href="#">Garansi</a>
                    <a href="#">Panduan Ukuran</a>
                    <a href="#">Registrasi Sepeda</a>
                    <a href="#">Buku Manual</a>
                </div>
                <div>
                    <h3>Produk</h3>
                    <a href="#">Sepeda Anak</a>
                    <a href="#">BMX</a>
                    <a href="#">CTB</a>
                    <a href="#">MTB</a>
                    <a href="#">Sepeda Lipat</a>
                </div>
                <div>
                    <h3>Tentang Kami</h3>
                    <a href="#">Blog</a>
                    <a href="#">Sejarah</a>
                    <a href="#">Dealer</a>
                    <a href="#">Acara</a>
                    <a href="#">Karir</a>
                    <a href="#">Arsip Produk</a>
                </div>
            </div>
        </div>
        <div class="follow-section">
            <div class="follow-us">Ikuti Kami</div>
            <div class="social-icons">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-youtube"></i></a>
                <a href="#"><i class="fab fa-facebook-f"></i></a>
            </div>
        </div>
        <div class="copyright-section">
            <div class="copyright-line"></div>
            <div class="copyright">
                © 2023 Wimcycle. All Rights Reserved.
            </div>
        </div>

    </div>
</body>
</html>
