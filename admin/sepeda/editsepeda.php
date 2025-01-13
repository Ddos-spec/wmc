<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once '../../koneksi.php';

// Initialize response array
$response = array('success' => false, 'message' => '');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit();
}

if (!isset($_POST['id_sepeda'])) {
    $response['message'] = 'ID sepeda tidak ditemukan';
    echo json_encode($response);
    exit();
}

$id = $_POST['id_sepeda'];

// Ambil data sepeda berdasarkan ID
$query = "SELECT * FROM tbsepeda WHERE id_sepeda = ?";
$stmt = $koneksi->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();

if (!$data) {
    echo "<script>
        alert('Data sepeda tidak ditemukan!');
        window.location.href = 'showsepeda.php';
    </script>";
    exit();
}

// Query untuk mendapatkan data frame - UPDATED FROM frame TO tbframe
$queryFrame = "SELECT * FROM tbframe ORDER BY nama_frame";
$resultFrame = $koneksi->query($queryFrame);

// Query untuk mendapatkan data kategori 
$queryKategori = "SELECT * FROM tbkategori ORDER BY nama_kategori";
$resultKategori = $koneksi->query($queryKategori);

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $nama_sepeda = $_POST['nama_sepeda'];
        $deskripsi_sepeda = $_POST['deskripsi_sepeda'];
        $id_frame = $_POST['id_frame'];
        $id_kategori = $_POST['id_kategori'];
        $shifter = $_POST['shifter'];
        $rd = $_POST['rd'];
        $berat = $_POST['berat'];
        $diameter = $_POST['diameter'];
        $harga = $_POST['harga'];
        $url_gambar = $data['url_gambar']; // Default ke gambar yang sudah ada

        // Jika ada file gambar baru yang diupload
        if (!empty($_FILES['gambar']['name'])) {
            $targetDir = "../../uploads/sepeda/";
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

            // Hapus file lama jika ada
            if (file_exists($data['url_gambar'])) {
                unlink($data['url_gambar']);
            }

            // Upload file baru
            if (!move_uploaded_file($_FILES["gambar"]["tmp_name"], $targetFilePath)) {
                throw new Exception("Gagal mengupload file.");
            }

            $url_gambar = $targetFilePath;
        }

        // Update data ke database
        $update_query = "UPDATE tbsepeda SET 
            nama_sepeda = ?,
            deskripsi_sepeda = ?,
            id_frame = ?,
            id_kategori = ?,
            shifter = ?,
            rd = ?,
            berat = ?,
            diameter = ?,
            harga = ?,
            url_gambar = ?
            WHERE id_sepeda = ?";
        
        $stmt = $koneksi->prepare($update_query);
        $stmt->bind_param("ssiissddisi", 
            $nama_sepeda,
            $deskripsi_sepeda,
            $id_frame,
            $id_kategori,
            $shifter,
            $rd,
            $berat,
            $diameter,
            $harga,
            $url_gambar,
            $id
        );

        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Data sepeda berhasil diupdate!';
        } else {
            throw new Exception("Gagal mengupdate data sepeda");
        }

    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
    
    echo json_encode($response);
    exit();
}
?>