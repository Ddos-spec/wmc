<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../../login.php");
    exit;
}

include('../../koneksi.php');

// Initialize response array for AJAX responses
$response = array('success' => false, 'message' => '');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Kategori</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        .kategori-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            transition: opacity 0.3s ease;
            background-color: #f8f9fa;
        }
        .kategori-img.loading {
            opacity: 0;
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

<div class="container-fluid mt-4 px-4">
    <div class="header-container">
        <h1>Manajemen Kategori</h1>
        <div>
            <a href="../../home.php" class="btn btn-secondary btn-home">Home</a>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah Kategori</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Deskripsi</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT * FROM tbkategori ORDER BY nama_kategori ASC";
                $result = $koneksi->query($query);
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama_kategori']}</td>
                        <td>{$row['deskripsi_kategori']}</td>
                        <td><img src='uploadfoto/{$row['url_gambar']}' class='kategori-img loading' alt='Foto Kategori' onload='this.classList.remove(\"loading\")' onerror='this.src=\"../../assets/img/default.jpg\";this.classList.remove(\"loading\")'></td>
                        <td>
                            <div class='btn-group btn-group-sm'>
                                <button class='btn btn-warning' onclick='editKategori({$row['id_kategori']})'>
                                    <i class='fas fa-edit'></i> Edit
                                </button>
                                <button class='btn btn-danger' onclick='hapusKategori({$row['id_kategori']})'>
                                    <i class='fas fa-trash'></i> Hapus
                                </button>
                            </div>
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
            <form id="formTambah" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" name="nama_kategori" id="nama_kategori" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_kategori">Deskripsi</label>
                        <textarea name="deskripsi_kategori" id="deskripsi_kategori" class="form-control" rows="3"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Upload Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control" accept="image/*" required>
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
<div class="modal fade" id="modalEdit<?php echo $row['id_kategori']; ?>" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="editkategori.php" method="POST" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Kategori</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_kategori" value="<?php echo $row['id_kategori']; ?>">
                    <div class="form-group">
                        <label for="nama_kategori">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" value="<?php echo $row['nama_kategori']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi_kategori">Deskripsi</label>
                        <textarea name="deskripsi_kategori" class="form-control" rows="3"><?php echo $row['deskripsi_kategori']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="foto">Upload Foto</label>
                        <input type="file" name="foto" class="form-control" accept="image/*">
                        <p class="mt-2">Foto saat ini:</p>
                        <img src="uploadfoto/<?php echo $row['url_gambar']; ?>" alt="Foto Kategori" style="max-width:200px;max-height:200px;object-fit:contain;">
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
function editSepeda(id) {
    $(`#modalEdit${id}`).modal('show');
}

function hapusSepeda(id) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: "Apakah Anda yakin ingin menghapus sepeda ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
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
            
            $.ajax({
                url: 'hapussepeda.php',
                type: 'POST',
                data: {
                    id_sepeda: id
                },
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

$(document).ready(function() {
    // Handle form submissions
    $('form').on('submit', function(e) {
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
        let actionUrl = $(this).attr('action');
        
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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
                        text: response.message || 'Terjadi kesalahan saat menyimpan data'
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
    });
});
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
function editKategori(id) {
    $(`#modalEdit${id}`).modal('show');
}

function hapusKategori(id) {
    Swal.fire({
        title: 'Konfirmasi Hapus',
        text: "Apakah Anda yakin ingin menghapus kategori ini?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'hapuskategori.php',
                type: 'POST',
                data: {
                    id_kategori: id
                },
                success: function(response) {
                    if (response.success) {
                        Swal.fire(
                            'Berhasil!',
                            response.message,
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Gagal!',
                            response.message,
                            'error'
                        );
                    }
                },
                error: function() {
                    Swal.fire(
                        'Error!',
                        'Terjadi kesalahan pada server',
                        'error'
                    );
                }
            });
        }
    });
}

// Handle form submissions with AJAX
$(document).ready(function() {
    $('#formTambah').on('submit', function(e) {
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
        
        $.ajax({
            url: 'inputkategori.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                if (response.success) {
                    Swal.fire(
                        'Berhasil!',
                        response.message,
                        'success'
                    ).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire(
                        'Gagal!',
                        response.message || 'Terjadi kesalahan saat menambah data',
                        'error'
                    );
                }
            },
            error: function() {
                Swal.fire(
                    'Error!',
                    'Terjadi kesalahan pada server',
                    'error'
                );
            }
        });
    });

    // Handle image loading
    $('.kategori-img').each(function() {
        $(this).on('load', function() {
            $(this).removeClass('loading');
        }).on('error', function() {
            $(this).attr('src', '../../assets/img/default.jpg');
            $(this).removeClass('loading');
        });
        
        if (this.complete) {
            $(this).removeClass('loading');
        }
    });
});
</script>
</body>
</html>