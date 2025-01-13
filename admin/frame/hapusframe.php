<?php
include '../../koneksi.php';

header('Content-Type: application/json');
$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_frame'])) {
    try {
        $id_frame = mysqli_real_escape_string($koneksi, $_POST['id_frame']);
        
        // Cek apakah frame digunakan di tbsepeda
        $check_query = "SELECT COUNT(*) as count FROM tbsepeda WHERE id_frame = ?";
        $stmt = $koneksi->prepare($check_query);
        $stmt->bind_param("i", $id_frame);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row['count'] > 0) {
            throw new Exception('Frame tidak dapat dihapus karena masih digunakan oleh data sepeda');
        }

        // Ambil informasi gambar sebelum menghapus
        $query_select = "SELECT url_gambar FROM tbframe WHERE id_frame = ?";
        $stmt = $koneksi->prepare($query_select);
        $stmt->bind_param("i", $id_frame);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Hapus dari database
        $query_delete = "DELETE FROM tbframe WHERE id_frame = ?";
        $stmt = $koneksi->prepare($query_delete);
        $stmt->bind_param("i", $id_frame);

        if (!$stmt->execute()) {
            throw new Exception('Gagal menghapus frame: ' . $stmt->error);
        }

        // Hapus file gambar jika ada
        if ($row && !empty($row['url_gambar'])) {
            $file_path = __DIR__ . '/uploadfoto/' . $row['url_gambar'];
            if (file_exists($file_path)) {
                if (!unlink($file_path)) {
                    error_log("Failed to delete image file: " . $file_path);
                    // Continue with deletion from database even if file deletion fails
                }
            }
        }

        $response['success'] = true;
        $response['message'] = 'Frame berhasil dihapus';

    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
} else {
    $response['message'] = 'Invalid request';
}

echo json_encode($response);