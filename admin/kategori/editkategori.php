<?php
include '../../koneksi.php';

header('Content-Type: application/json');
$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!isset($_POST['id_kategori']) || empty($_POST['nama_kategori']) || empty($_POST['deskripsi_kategori'])) {
            throw new Exception('Semua field harus diisi');
        }

        $id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
        $nama_kategori = mysqli_real_escape_string($koneksi, $_POST['nama_kategori']);
        $deskripsi_kategori = mysqli_real_escape_string($koneksi, $_POST['deskripsi_kategori']);

        // Start with basic query
        $query = "UPDATE tbkategori SET nama_kategori = ?, deskripsi_kategori = ?";
        $params = array($nama_kategori, $deskripsi_kategori);
        $types = "ss";

        // Handle file upload if exists
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
            // Validate file size
            if ($_FILES['foto']['size'] > 2 * 1024 * 1024) {
                throw new Exception('Ukuran file terlalu besar (maksimal 2MB)');
            }

            // Validate file type
            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
            if (!in_array($_FILES['foto']['type'], $allowed_types)) {
                throw new Exception('Tipe file tidak didukung (hanya JPG, JPEG, PNG)');
            }

            // Create upload directory if not exists
            $upload_dir = 'uploadfoto/';
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }

            // Generate unique filename
            $file_extension = pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION);
            $filename = uniqid('kategori_') . '.' . $file_extension;
            $filepath = $upload_dir . $filename;

            // Delete old image if exists
            $old_image_query = "SELECT url_gambar FROM tbkategori WHERE id_kategori = ?";
            $stmt = $koneksi->prepare($old_image_query);
            $stmt->bind_param("i", $id_kategori);
            $stmt->execute();
            $result = $stmt->get_result();
            if ($row = $result->fetch_assoc()) {
                if (!empty($row['url_gambar'])) {
                    $old_file = $upload_dir . $row['url_gambar'];
                    if (file_exists($old_file)) {
                        unlink($old_file);
                    }
                }
            }

            // Upload new file
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $filepath)) {
                throw new Exception('Gagal mengupload file');
            }

            // Add url_gambar to query
            $url_gambar = $filename;
            $query .= ", url_gambar = ?";
            $params[] = $url_gambar;
            $types .= "s";
        }

        // Add WHERE clause
        $query .= " WHERE id_kategori = ?";
        $params[] = $id_kategori;
        $types .= "i";

        // Execute query
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param($types, ...$params);

        if (!$stmt->execute()) {
            throw new Exception('Gagal mengupdate data: ' . $stmt->error);
        }

        $response['success'] = true;
        $response['message'] = 'Kategori berhasil diupdate';

    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
}

echo json_encode($response);