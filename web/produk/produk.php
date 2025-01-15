<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }
        .header {
            background-image: url('/wmc/gambar/HEADER-PRODUK.jpg'); /* Set background image */
            background-size: cover; /* Cover the entire header */
            background-position: center; /* Center the image */
            height: 300px; /* Adjust header height */
            color: white; /* Text color */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 3rem;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }
        .header p {
            margin: 0;
            font-size: 1.2rem;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
        }
        #slider {
            margin-top: 20px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<?php include '../navbar.php'; ?>

<div class="header">
    <h1>Produk</h1>
    <p>Wimcycle menawarkan sepeda berkualitas dengan desain stylish</p>
</div>

<div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <h4>FILTER</h4>
            <form>
                <div class="mb-3">
                    <label for="TIPE" class="form-label">TIPE</label>
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-arrow-down"></i> Pilih Tipe
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><label class="dropdown-item"><input type="radio" name="bikeType" value="Aegyo Series"> Aegyo Series</label></li>
                            <li><label class="dropdown-item"><input type="radio" name="bikeType" value="CTB"> CTB</label></li>
                            <li><label class="dropdown-item"><input type="radio" name="bikeType" value="Kids Bike"> Sepeda Anak</label></li>
                            <li><label class="dropdown-item"><input type="radio" name="bikeType" value="BMX Bike"> Sepeda BMX</label></li>
                            <li><label class="dropdown-item"><input type="radio" name="bikeType" value="Mountain Bike (MTB)"> Sepeda Gunung (MTB)</label></li>
                        </ul>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="slider" class="form-label">Rentang Harga</label>
                    <div id="slider"></div>
                    <div class="d-flex justify-content-between mt-2">
                        <span id="slider-value-lower"></span>
                        <span id="slider-value-upper"></span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Terapkan Filter</button>
            </form>
        </div>
        <div class="col-md-9">
            <!-- Daftar produk akan ditampilkan di sini berdasarkan filter yang dipilih -->
            <p>Daftar produk akan ditampilkan di sini berdasarkan filter yang dipilih.</p>
        </div>
    </div>
</div>

<?php include '../footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"></script>
<script>
    // Inisialisasi slider untuk rentang harga
    var slider = document.getElementById('slider');

    noUiSlider.create(slider, {
        start: [0, 2500000], // Set the price range from 0 to 2,500,000
        connect: true,
        range: {
            'min': 0,
            'max': 2500000
        },
        tooltips: true, // Show tooltips
        format: {
            to: function (value) {
                return 'Rp' + Math.round(value); // Format the value to show Rp
            },
            from: function (value) {
                return value.replace('Rp', ''); // Remove Rp for internal use
            }
        }
    });

    var sliderValueLower = document.getElementById('slider-value-lower');
    var sliderValueUpper = document.getElementById('slider-value-upper');

    // Update nilai slider saat diubah
    slider.noUiSlider.on('update', function (values, handle) {
        if (handle) {
            sliderValueUpper.innerHTML = values[handle];
        } else {
            sliderValueLower.innerHTML = values[handle];
        }
    });

    // Customizing the slider appearance
    slider.noUiSlider.on('set', function () {
        var handle = slider.noUiSlider.get();
        // Change the slider line color
        slider.style.setProperty('--noUi-connect', '#ffb71b');
        // Change the handle shape to moon shape (custom CSS needed)
        // This part requires additional CSS to achieve the moon shape
    });
</script>

</body>
</html>
