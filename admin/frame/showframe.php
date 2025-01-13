<?php
session_start();
include('../../koneksi.php');

// Cek apakah user sudah login
if (!isset($_SESSION['login'])) {
    header("Location: ../../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Frame</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
    <style>
        .table-responsive {
            margin-top: 20px;
        }
        .modal img {
            max-width: 100%;
            max-height: 200px;
            display: block;
            margin: 10px auto;
        }
        .preview-image {
            max-width: 200px;
            max-height: 200px;
            margin-top: 10px;
        }
        .action-buttons {
            white-space: nowrap;
        }
    </style>
</head>
<body>

<style>
.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
}
.btn-home {
    margin-right: 10px;
    transition: background-color 0.3s ease;
}
.btn-home:hover {
    background-color: #dc3545 !important;
    color: white !important;
}
</style>

<div class="container-fluid mt-4">
    <div class="header-container">
        <h1>Manajemen Frame</h1>
        <div>
            <a href="../../home.php" class="btn btn-secondary btn-home">Home</a>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
                <i class="fas fa-plus"></i> Tambah Frame
            </button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped" id="frameTable">
            <thead class="thead-dark">
                <tr>
                    <th width="5%">No</th>
                    <th>Nama Frame</th>
                    <th width="20%">Foto</th>
                    <th width="15%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM tbframe ORDER BY id_frame DESC";
                $result = $koneksi->query($query);
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    $gambar = !empty($row['url_gambar']) ? 'uploadfoto/'.$row['url_gambar'] : 'assets/img/no-image.jpg';
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama_frame']}</td>
                        <td class='text-center'><img src='{$gambar}' alt='Foto Frame' class='img-thumbnail' style='width:100px;height:100px;object-fit:cover;'></td>
                        <td class='action-buttons'>
                            <button class='btn btn-warning btn-sm' onclick='editFrame({$row['id_frame']})'>
                                <i class='fas fa-edit'></i> Edit
                            </button>
                            <button class='btn btn-danger btn-sm' onclick='hapusFrame({$row['id_frame']})'>
                                <i class='fas fa-trash'></i> Hapus
                            </button>
                        </td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="inputframe.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Frame</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_frame">Nama Frame</label>
                        <input type="text" name="nama_frame" id="nama_frame" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="foto">Upload Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control" accept="image/jpeg,image/png,image/gif" required>
                        <small class="form-text text-muted">Format yang diizinkan: JPG, PNG, GIF (Max. 2MB)</small>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Edit -->
<?php
$result->data_seek(0); // Reset result set pointer
while ($row = $result->fetch_assoc()) {
?>
<div class="modal fade" id="modalEdit<?php echo $row['id_frame']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="editframe.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Frame</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_frame" value="<?php echo $row['id_frame']; ?>">
                    <div class="form-group">
                        <label for="nama_frame">Nama Frame</label>
                        <input type="text" name="nama_frame" class="form-control" value="<?php echo $row['nama_frame']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="foto">Upload Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        <p class="mt-2">Foto saat ini:</p>
                        <img src="uploadfoto/<?php echo $row['url_gambar']; ?>" alt="Foto Frame">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function editFrame(id) {
    $(`#modalEdit${id}`).modal('show');
}

function hapusFrame(id) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: "Apakah Anda yakin ingin menghapus frame ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'hapusframe.php',
                type: 'POST',
                data: { id_frame: id },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message || 'Terjadi kesalahan saat menghapus data'
                        });
                    }
                },
                error: function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan pada server'
                    });
                }
            });
        }
    });
}

// Handle form submissions with AJAX
$(document).ready(function() {
    $('form').on('submit', function(e) {
        // Validasi form
        let namaFrame = $(this).find('input[name="nama_frame"]').val();
        if (!namaFrame.trim()) {
            e.preventDefault();
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Nama frame tidak boleh kosong!'
            });
            return false;
        }

        // Validasi file untuk form tambah
        if ($(this).attr('action').includes('inputframe.php')) {
            let fileInput = $(this).find('input[type="file"]');
            if (fileInput.length && !fileInput[0].files.length) {
                e.preventDefault();
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Silakan pilih file gambar!'
                });
                return false;
            }
        }
        e.preventDefault();
        
        Swal.fire({
            title: 'Sedang memproses...',
            text: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            allowEscapeKey: false,
            showConfirmButton: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });
        
        let formData = new FormData(this);
        let isEdit = $(this).attr('action').includes('editframe.php');
        
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                Swal.fire({
                    title: 'Sedang memproses...',
                    text: 'Mohon tunggu sebentar',
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    showConfirmButton: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });
            },
            success: function(response) {
                try {
                    // Parse response jika belum berbentuk objek
                    if (typeof response === 'string') {
                        response = JSON.parse(response);
                    }
                    
                    if (response.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: response.message,
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Gagal!',
                            text: response.message || 'Terjadi kesalahan saat menyimpan data',
                            confirmButtonText: 'Tutup'
                        });
                    }
                } catch (e) {
                    console.error('Error parsing response:', e);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan saat memproses response server',
                        confirmButtonText: 'Tutup'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan pada server: ' + error,
                    confirmButtonText: 'Tutup'
                });
            }
        });
    });
});
</script>
</body>
</html>