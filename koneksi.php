<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "dbseto";

$koneksi = new mysqli($host, $user, $password, $database);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}

// Set karakter encoding
$koneksi->set_charset("utf8mb4");
?>