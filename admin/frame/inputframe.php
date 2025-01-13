<?php
require_once '../../koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_frame = $_POST['nama_frame'];
    
    // Membuat direktori upload jika belum ada
    $upload_dir = 'uploadfoto/';
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    
    // Proses upload gambar
    if(isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
        $allowed = array('jpg', 'jpeg', 'png', 'gif');
        $filename = $_FILES['foto']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if(in_array($ext, $allowed)) {
            if($_FILES['foto']['size'] <= 2097152) {
                $new_filename = uniqid('frame_') . '.' . $ext;
                $upload_path = $upload_dir . $new_filename;
                
                if(move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path)) {
                    $foto = $new_filename;
                    
                    // Insert ke database
                    $query = "INSERT INTO tbframe (nama_frame, url_gambar) VALUES (?, ?)";
                    $stmt = $koneksi->prepare($query);
                    if (!$stmt) {
                        die("Prepare failed: " . $koneksi->error);
                    }
                    
                    if (!$stmt->bind_param("ss", $nama_frame, $foto)) {
                        die("Binding parameters failed: " . $stmt->error);
                    }
                    
                    header('Content-Type: application/json');
                    if ($stmt->execute()) {
                        echo json_encode([
                            'success' => true,
                            'message' => 'Data frame berhasil ditambahkan!'
                        ]);
                        exit;
                    } else {
                        echo json_encode([
                            'success' => false,
                            'message' => 'Gagal menambahkan data frame!'
                        ]);
                        exit;
                    }
                }
            } else {
                echo json_encode([
                    'success' => false,
                    'message' => 'Ukuran file terlalu besar (maksimal 2MB)'
                ]);
                exit;
            }
        } else {
            echo json_encode([
                'success' => false,
                'message' => 'Format file tidak diizinkan'
            ]);
            exit;
        }
    }
}
?>