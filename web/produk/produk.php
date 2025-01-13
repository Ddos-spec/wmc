<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <style>
        body {
            background-color: white;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }
        .header, .body {
            padding: 15px;
        }
        h1 {
            color: #002856;
            margin-bottom: 5px;
        }
        .header .heading {
            margin-bottom: 0;
        }
        .header .desc {
            margin-top: 0;
        }
        .heading, .desc {
            margin: 0;
            padding: 0;
            display: block;
        }
        .header {
            margin-top: 80px;
            margin-left: 140px;
        }
        .container {
            display: flex;
        }
        .filter-section {
            width: 30%;
            padding: 15px;
            border-right: 1px solid black;
        }
        .product-section {
            width: 70%;
            padding: 15px;
        }
        .product {
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid #ddd;
            padding-bottom: 10px;
        }
        .product img {
            width: 150px;
            height: auto;
            margin-right: 15px;
        }
        .product h3 {
            margin: 0;
        }
        .product p {
            margin: 5px 0;
            font-size: 16px;
        }
        .filter-section button {
            border-radius: 20px;
            padding: 10px;
            background-color: #002856;
            color: white;
            border: none;
            cursor: pointer;
        }
        .filter-section button:hover {
            background-color: #00509e;
        }
        .radio-group {
            margin-bottom: 15px;
        }
        .radio-group label {
            display: block;
            margin-bottom: 5px;
        }
        .dropdown-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .dropdown-container h3 {
            margin-right: 15px; 
        }
        .dropdown-icon {
            cursor: pointer;
            font-size: 18px;
            transition: transform 0.3s ease;
            margin-left: 10px; /* Adjusted position */
            opacity: 0.5; 
            z-index: 10; /* Ensure it can be clicked */
        }
        .dropdown-content {
            display: none;
            margin-top: 10px;
            padding-left: 20px;
        }
        .barrier {
            height: 20px; /* Adjust height as needed */
            background-color: #f0f0f0; /* Light gray color for separation */
        }
        .show {
            display: block;
        }
        .rotate {
            transform: rotate(180deg);
        }
    </style>
</head>
<body>
    <?php include '../navbar.php'; ?>
    <div class="header">
        <h1>PRODUK</h1>
        <div class="heading">Wimcycle menawarkan sepeda</div>
        <div class="desc">berkualitas dengan desain yang stylish</div>
    </div>
    <div class="body">
        <div class="container">
            <div class="filter-section">
                <h2>FILTER</h2>
                <div class="dropdown-container">
                    <h3>TIPE</h3>
<span class="dropdown-icon" onclick="toggleDropdown()">&#9654;</span> <!-- Changed arrow icon -->
                </div>
                <div class="dropdown-content">
                    <label>
                        <input type="radio" name="bikeType" value="BMX"> BMX
                    </label>
                    <label>
                        <input type="radio" name="bikeType" value="Sepeda Anak"> Sepeda Anak
                    </label>
                    <label>
                        <input type="radio" name="bikeType" value="Sepeda Gunung"> Sepeda Gunung
                    </label>
                    <label>
                        <input type="radio" name="bikeType" value="Sepeda Lipat"> Sepeda Lipat
                    </label>
                </div>
                <h3>HARGA</h3>
                <input type="range" min="0" max="2500000" value="1250000" id="priceRange">
                <button onclick="applyFilter()">Filter</button>
            </div>
            <div class="product-section">
                <h2>All Products</h2>
                <?php
                // Database connection
include '../../koneksi.php';
$query = "SELECT * FROM tbsepeda";
$result = mysqli_query($koneksi, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="product">';
                    echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '">'; 
                    echo '<div>';
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '<p>Price: ' . number_format($row['price'], 0, ',', '.') . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="barrier"></div>
    <?php include '../footer.php'; ?>
    <script>
        function toggleDropdown() {
            const dropdownContent = document.querySelector('.dropdown-content');
            const dropdownIcon = document.querySelector('.dropdown-icon');

            dropdownContent.classList.toggle('show');
            dropdownIcon.classList.toggle('rotate');
            console.log('Dropdown toggled'); // Debugging log
            console.log('Dropdown content visibility:', dropdownContent.classList.contains('show')); // Check visibility
        }

        function applyFilter() {
            const bikeType = document.querySelector('input[name="bikeType"]:checked')?.value;
            const price = document.getElementById('priceRange').value;

            console.log('Filter applied with bike type:', bikeType);
            console.log('Price range:', price);
        }
    </script>
</body>
</html>
