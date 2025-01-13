<?php
header('Content-Type: application/json');
require_once '../../koneksi.php';

try {
    if (!isset($_POST['id_sepeda'])) {
        throw new Exception('ID sepeda tidak ditemukan');
    }

    $id_sepeda = intval($_POST['id_sepeda']);
    
    // Prepare statement to prevent SQL injection
    $check_query = $koneksi->prepare("SELECT url_gambar FROM tbsepeda WHERE id_sepeda = ?");
    $check_query->bind_param("i", $id_sepeda);
    $check_query->execute();
    $result = $check_query->get_result();
    
    if ($row = $result->fetch_assoc()) {
        // Hapus file gambar jika ada
        if (!empty($row['url_gambar']) && file_exists($row['url_gambar'])) {
            unlink($row['url_gambar']);
        }
        
        // Prepare delete statement
        $delete_stmt = $koneksi->prepare("DELETE FROM tbsepeda WHERE id_sepeda = ?");
        $delete_stmt->bind_param("i", $id_sepeda);
        
        if ($delete_stmt->execute()) {
            echo json_encode(['success' => true, 'message' => 'Data sepeda berhasil dihapus']);
        } else {
            throw new Exception('Gagal menghapus data sepeda: ' . $koneksi->error);
        }
    } else {
        throw new Exception('Data sepeda tidak ditemukan');
    }
    
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}