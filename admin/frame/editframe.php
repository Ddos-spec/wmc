<?php
include '../../koneksi.php';

header('Content-Type: application/json');
$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (!isset($_POST['id_frame']) || empty($_POST['nama_frame'])) {
            throw new Exception('Semua field harus diisi');
        }

        $id_frame = mysqli_real_escape_string($koneksi, $_POST['id_frame']);
        $nama_frame = mysqli_real_escape_string($koneksi, $_POST['nama_frame']);
        
        // Ambil informasi gambar lama
        $query_old = "SELECT url_gambar FROM tbframe WHERE id_frame = ?";
        $stmt_old = $koneksi->prepare($query_old);
        $stmt_old->bind_param("i", $id_frame);
        $stmt_old->execute();
        $result_old = $stmt_old->get_result();
        $row_old = $result_old->fetch_assoc();
        $old_image = $row_old['url_gambar'] ?? '';
        $stmt_old->close();

        // Proses upload gambar baru jika ada
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === 0) {
            // Validasi ukuran file (max 2MB)
            if ($_FILES['foto']['size'] > 2097152) {
                throw new Exception('Ukuran file terlalu besar (maksimal 2MB)');
            }

            $allowed = array('jpg', 'jpeg', 'png', 'gif');
            $filename = $_FILES['foto']['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

            if (!in_array($ext, $allowed)) {
                throw new Exception('Format file tidak diizinkan');
            }

            // Generate nama file unik
            $new_filename = uniqid('frame_') . '.' . $ext;
            $upload_dir = __DIR__ . '/uploadfoto/';
            
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $upload_path = $upload_dir . $new_filename;

            // Upload file baru
            if (!move_uploaded_file($_FILES['foto']['tmp_name'], $upload_path)) {
                throw new Exception('Gagal mengupload file');
            }

            // Hapus file lama jika ada dan berbeda dari file baru
            if (!empty($old_image) && $old_image !== $new_filename && file_exists($upload_dir . $old_image)) {
                if (!unlink($upload_dir . $old_image)) {
                    error_log("Failed to delete old image: " . $upload_dir . $old_image);
                }
            }

            // Update dengan gambar baru
            $query = "UPDATE tbframe SET nama_frame = ?, url_gambar = ? WHERE id_frame = ?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("ssi", $nama_frame, $new_filename, $id_frame);
        } else {
            // Update tanpa mengubah gambar
            $query = "UPDATE tbframe SET nama_frame = ? WHERE id_frame = ?";
            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("si", $nama_frame, $id_frame);
        }

        if (!$stmt->execute()) {
            throw new Exception('Gagal mengupdate data: ' . $stmt->error);
        }

        $response['success'] = true;
        $response['message'] = 'Frame berhasil diupdate';
        
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
}

echo json_encode($response);