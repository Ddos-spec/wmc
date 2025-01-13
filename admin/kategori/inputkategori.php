<?php
include '../../koneksi.php';

header('Content-Type: application/json');
$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validasi input
        if (empty($_POST['nama_kategori'])) {
            throw new Exception('Nama kategori harus diisi');
        }

        $nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
        
        // Validasi dan proses upload file
        if (!isset($_FILES['foto']) || $_FILES['foto']['error'] === UPLOAD_ERR_NO_FILE) {
            throw new Exception('Foto harus diunggah');
        }

        // Validasi ukuran file (max 2MB)
        if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
            throw new Exception('Ukuran file terlalu besar (maksimal 2MB)');
        }

        // Validasi tipe file
        $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
        if (!in_array($_FILES['foto']['type'], $allowed_types)) {
            throw new Exception('Tipe file tidak didukung (hanya JPG, JPEG, PNG)');
        }

        // Buat direktori upload jika belum ada
        $upload_dir = __DIR__ . '/uploadfoto/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Generate nama file unik
        $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('kategori_') . '.' . $file_extension;
        $filepath = $upload_dir . $filename;

        // Upload file
        if (!move_uploaded_file($_FILES['foto']['tmp_name'], $filepath)) {
            throw new Exception('Gagal mengupload file');
        }

        $deskripsi_kategori = mysqli_real_escape_string($koneksi, $_POST['deskripsi_kategori']);
        
        // Simpan ke database
        $query = "INSERT INTO tbkategori (nama_kategori, deskripsi_kategori, url_gambar) VALUES (?, ?, ?)";
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("sss", $nama_kategori, $deskripsi_kategori, $filename);

        if (!$stmt->execute()) {
            // Hapus file jika gagal menyimpan ke database
            unlink($filepath);
            throw new Exception('Gagal menyimpan data: ' . $stmt->error);
        }

        $response['success'] = true;
        $response['message'] = 'Data kategori berhasil ditambahkan!';

    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
}

echo json_encode($response);