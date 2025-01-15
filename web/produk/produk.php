<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>

<?php include '../navbar.php'; ?>

<?php
if (file_exists('../gambar/HEADER-PRODUK.jpg')) {
    echo 'File exists!';
} else {
    echo 'File not found!';
}
?>

<img src="../gambar/HEADER-PRODUK.jpg" alt="Header Image" style="width: 100%; height: auto;">

<!-- Main content for produk page goes here -->

<?php include '../footer.php'; ?>

</body>
</html>
