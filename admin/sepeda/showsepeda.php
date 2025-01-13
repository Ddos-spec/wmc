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
    <title>Data Sepeda</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
        .sepeda-img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            transition: opacity 0.3s ease;
            background-color: #f8f9fa;
        }
        .sepeda-img.loading {
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
        <h1>Manajemen Sepeda</h1>
        <div>
            <a href="../../home.php" class="btn btn-secondary btn-home">Home</a>
            <button class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">Tambah Sepeda</button>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="thead-dark">
                <tr>
                    <th width="3%">No</th>
                    <th width="15%">Nama Sepeda</th>
                    <th width="10%">Frame</th>
                    <th width="10%">Kategori</th>
                    <th width="10%">Shifter</th>
                    <th width="10%">RD</th>
                    <th width="7%">Berat</th>
                    <th width="7%">Diameter</th>
                    <th width="10%">Harga</th>
                    <th width="8%">Foto</th>
                    <th width="10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $query = "SELECT s.*, f.nama_frame, k.nama_kategori 
                         FROM tbsepeda s 
                         LEFT JOIN tbframe f ON s.id_frame = f.id_frame 
                         LEFT JOIN tbkategori k ON s.id_kategori = k.id_kategori 
                         ORDER BY s.nama_sepeda ASC";
                $result = $koneksi->query($query);
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$no}</td>
                        <td>{$row['nama_sepeda']}</td>
                        <td>{$row['nama_frame']}</td>
                        <td>{$row['nama_kategori']}</td>
                        <td>{$row['shifter']}</td>
                        <td>{$row['rd']}</td>
                        <td>{$row['berat']} kg</td>
                        <td>{$row['diameter']}\"</td>
                        <td>Rp " . number_format($row['harga'], 0, ',', '.') . "</td>
                        <td><img src='{$row['url_gambar']}' class='sepeda-img loading' alt='Foto Sepeda' onload='this.classList.remove(\"loading\")' onerror='this.src=\"../../assets/img/default.jpg\";this.classList.remove(\"loading\")'></td>
                        <td>
                            <div class='btn-group btn-group-sm'>
                                <button class='btn btn-warning' onclick='editSepeda({$row['id_sepeda']})' data-toggle='modal' data-target='#modalEdit{$row['id_sepeda']}'>
                                    <i class='fas fa-edit'></i> Edit
                                </button>
                                <button class='btn btn-danger' onclick='confirmDelete({$row['id_sepeda']})'>
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
            <?php
                // Generate Edit Modal for each row
                $result->data_seek(0);
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='modal fade' id='modalEdit{$row['id_sepeda']}' tabindex='-1' aria-labelledby='modalEditLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-lg'>
                            <form action='editsepeda.php' method='POST' enctype='multipart/form-data' id='formEdit{$row['id_sepeda']}'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title'>Edit Sepeda</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>
                                        <input type='hidden' name='id_sepeda' value='{$row['id_sepeda']}'>
                                        <div class='mb-3'>
                                            <label class='form-label'>Nama Sepeda</label>
                                            <input type='text' name='nama_sepeda' class='form-control' value='{$row['nama_sepeda']}' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label'>Deskripsi</label>
                                            <textarea name='deskripsi_sepeda' class='form-control' rows='3' required>{$row['deskripsi_sepeda']}</textarea>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label'>Frame</label>
                                            <select name='id_frame' class='form-control' required>";
                                            $query_frame = "SELECT * FROM tbframe ORDER BY nama_frame ASC";
                                            $result_frame = $koneksi->query($query_frame);
                                            while ($frame = $result_frame->fetch_assoc()) {
                                                $selected = ($frame['id_frame'] == $row['id_frame']) ? 'selected' : '';
                                                echo "<option value='{$frame['id_frame']}' {$selected}>{$frame['nama_frame']}</option>";
                                            }
                                            echo "</select>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label'>Kategori</label>
                                            <select name='id_kategori' class='form-control' required>";
                                            $query_kategori = "SELECT * FROM tbkategori ORDER BY nama_kategori ASC";
                                            $result_kategori = $koneksi->query($query_kategori);
                                            while ($kategori = $result_kategori->fetch_assoc()) {
                                                $selected = ($kategori['id_kategori'] == $row['id_kategori']) ? 'selected' : '';
                                                echo "<option value='{$kategori['id_kategori']}' {$selected}>{$kategori['nama_kategori']}</option>";
                                            }
                                            echo "</select>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label'>Shifter</label>
                                            <input type='text' name='shifter' class='form-control' value='{$row['shifter']}' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label'>RD</label>
                                            <input type='text' name='rd' class='form-control' value='{$row['rd']}' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label'>Berat (kg)</label>
                                            <input type='number' step='0.01' name='berat' class='form-control' value='{$row['berat']}' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label'>Diameter (inch)</label>
                                            <input type='number' step='0.01' name='diameter' class='form-control' value='{$row['diameter']}' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label'>Harga</label>
                                            <input type='number' name='harga' class='form-control' value='{$row['harga']}' required>
                                        </div>
                                        <div class='mb-3'>
                                            <label class='form-label'>Gambar</label>
                                            <input type='file' name='gambar' class='form-control'>
                                            <small class='text-muted'>Biarkan kosong jika tidak ingin mengubah gambar</small>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Batal</button>
                                        <button type='submit' class='btn btn-primary'>Simpan Perubahan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>";
                } 
            ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah -->
<div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="inputsepeda.php" method="POST" enctype="multipart/form-data" id="formTambahSepeda">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalTambahLabel">Tambah Sepeda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_sepeda" class="form-label">Nama Sepeda</label>
                        <input type="text" name="nama_sepeda" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi_sepeda" class="form-label">Deskripsi</label>
                        <textarea name="deskripsi_sepeda" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="id_frame" class="form-label">Frame</label>
                        <select name="id_frame" class="form-control" required>
                            <?php
                            $query_frame = "SELECT * FROM tbframe ORDER BY nama_frame ASC";
                            $result_frame = $koneksi->query($query_frame);
                            while ($frame = $result_frame->fetch_assoc()) {
                                echo "<option value='{$frame['id_frame']}'>{$frame['nama_frame']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="id_kategori" class="form-label">Kategori</label>
                        <select name="id_kategori" class="form-control" required>
                            <?php
                            $query_kategori = "SELECT * FROM tbkategori ORDER BY nama_kategori ASC";
                            $result_kategori = $koneksi->query($query_kategori);
                            while ($kategori = $result_kategori->fetch_assoc()) {
                                echo "<option value='{$kategori['id_kategori']}'>{$kategori['nama_kategori']}</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="shifter" class="form-label">Shifter</label>
                        <input type="text" name="shifter" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="rd" class="form-label">RD</label>
                        <input type="text" name="rd" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="berat" class="form-label">Berat (kg)</label>
                        <input type="number" step="0.01" name="berat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="diameter" class="form-label">Diameter (inch)</label>
                        <input type="number" step="0.01" name="diameter" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="number" name="harga" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input type="file" name="gambar" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Data</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#formTambahSepeda').on('submit', function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        
        $.ajax({
            url: 'inputsepeda.php',
            type: 'POST',
            data: formData,
            success: function(response) {
                try {
                    var result = JSON.parse(response);
                    if(result.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: result.message,
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: result.message
                        });
                    }
                } catch (e) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan dalam memproses response'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan: ' + error
                });
            },
            cache: false,
            contentType: false,
            processData: false
        });
        
        $('#modalTambah').modal('hide');
    });
});
</script>
<script>
function confirmDelete(id) {
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
                error: function(xhr, status, error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Terjadi kesalahan pada server: ' + error
                    });
                }
            });
        }
    });
}

$(document).ready(function() {
    // Handle edit form submission
    $('form[id^="formEdit"]').on('submit', function(e) {
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
        
        var formData = new FormData(this);
        
        $.ajax({
            url: 'editsepeda.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
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
                        text: response.message || 'Terjadi kesalahan saat menyimpan perubahan'
                    });
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan pada server: ' + error
                });
            }
        });
    });
});
</script>
</body>
</html>