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
        }
        .header, .body {
            border: 1px solid black;
            padding: 10px;
        }
        h1 {
            color: #002856;
        }
        .container {
            display: flex;
        }
        .filter-section {
            width: 30%;
            padding: 10px;
            border-right: 1px solid black;
        }
        .product-section {
            width: 70%;
            padding: 10px;
        }
    </style>
</head>
<body>
    <?php include '../navbar.php'; ?>
    <div class="header">
        <h1>PRODUK</h1>
        <p>Wimcycle offers high-quality bicycles with stylish designs.</p>
    </div>
    <div class="body">
        <div class="container">
            <div class="filter-section">
                <h2>FILTER</h2>
                <h3>TIPE</h3>
                <h3>UKURAN</h3>
                <h3>WARNA</h3>
                <h3>USIA</h3>
                <h3>HARGA</h3>
                <input type="range" min="0" max="2500000" value="1250000" id="priceRange">
                <button onclick="applyFilter()">Filter</button>
            </div>
            <div class="product-section">
                <h2>Products</h2>
                <?php
                // Database connection
                include '../koneksi.php';
                $query = "SELECT * FROM tbsepeda";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="product">';
                    echo '<img src="' . $row['image'] . '" alt="' . $row['name'] . '" style="width:100px;height:auto;">';
                    echo '<h3>' . $row['name'] . '</h3>';
                    echo '<p>Price: ' . number_format($row['price'], 0, ',', '.') . '</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>
    <?php include '../footer.php'; ?>
    <script>
        function applyFilter() {
            // Implement filter logic here
            const price = document.getElementById('priceRange').value;
            console.log('Filter applied with price:', price);
            // You can add AJAX call to fetch filtered products based on price
        }
    </script>
</body>
</html>
