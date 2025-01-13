<?php
include '../../koneksi.php';

header('Content-Type: application/json');
$response = array('success' => false, 'message' => '');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_kategori'])) {
    try {
        $id_kategori = mysqli_real_escape_string($koneksi, $_POST['id_kategori']);
        
        // Check if category is used in tbsepeda
        $check_query = "SELECT COUNT(*) as count FROM tbsepeda WHERE id_kategori = ?";
        $stmt = $koneksi->prepare($check_query);
        $stmt->bind_param("i", $id_kategori);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row['count'] > 0) {
            throw new Exception('Kategori tidak dapat dihapus karena masih digunakan oleh data sepeda');
        }

        // Get image information before deleting
        $query_select = "SELECT url_gambar FROM tbkategori WHERE id_kategori = ?";
        $stmt = $koneksi->prepare($query_select);
        $stmt->bind_param("i", $id_kategori);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Delete image file if exists
        if ($row && !empty($row['url_gambar'])) {
            $file_path = __DIR__ . '/uploadfoto/' . basename($row['url_gambar']);
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }

        // Delete from database
        $query_delete = "DELETE FROM tbkategori WHERE id_kategori = ?";
        $stmt = $koneksi->prepare($query_delete);
        $stmt->bind_param("i", $id_kategori);

        if (!$stmt->execute()) {
            throw new Exception('Gagal menghapus kategori: ' . $stmt->error);
        }

        $response['success'] = true;
        $response['message'] = 'Kategori berhasil dihapus';

    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
} else {
    $response['message'] = 'Invalid request';
}

echo json_encode($response);