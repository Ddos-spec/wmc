<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Validasi input
        if (empty($_POST['nama_sepeda']) || empty($_POST['id_frame']) || empty($_POST['id_kategori'])) {
            throw new Exception("Semua field harus diisi");
        }

        // Upload gambar
        $targetDir = "../../uploads/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = basename($_FILES["gambar"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Validasi file
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (!in_array(strtolower($fileType), $allowTypes)) {
            throw new Exception("Hanya file JPG, JPEG, PNG & GIF yang diperbolehkan.");
        }

        // Upload file
        if (!move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFilePath)) {
            throw new Exception("Gagal mengupload file.");
        }

        // Prepare query
        $query = "INSERT INTO tbsepeda (nama_sepeda, deskripsi_sepeda, id_frame, id_kategori, shifter, rd, berat, diameter, harga, url_gambar) 
                 VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $koneksi->prepare($query);
        $stmt->bind_param("ssiissddds", 
            $_POST['nama_sepeda'],
            $_POST['deskripsi_sepeda'],
            $_POST['id_frame'],
            $_POST['id_kategori'],
            $_POST['shifter'],
            $_POST['rd'],
            $_POST['berat'],
            $_POST['diameter'],
            $_POST['harga'],
            $targetFilePath
        );

        if ($stmt->execute()) {
            echo json_encode(['status' => 'success', 'message' => 'Data berhasil ditambahkan']);
        } else {
            throw new Exception("Gagal menyimpan data ke database");
        }

    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }
    exit;
}
?>