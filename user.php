<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
            <i class="bi bi-plus-lg"></i> Tambah User
        </button>
        <div class="row">
            <div class="table-responsive" id="user_data">

            </div>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary" style="display: none" data-toggle=" modal" data-target="#exampleModal">
                Launch demo modal
            </button>
            <!-- Awal Modal Tambah-->
            <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah User</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" placeholder="Masukkan Username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="text" class="form-control" name="password" placeholder="Masukkan Password" required>
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Foto User</label>
                                    <input type="file" class="form-control" name="foto">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" value="simpan" name="simpan" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal Tambah-->
        </div>

        <script>
            $(document).ready(function() {
                load_data();

                function load_data(hlm) {
                    $.ajax({
                        url: "user_data.php",
                        method: "POST",
                        data: {
                            hlm: hlm
                        },
                        success: function(data) {
                            $('#user_data').html(data);
                        }
                    })
                }
                $(document).on('click', '.halaman', function() {
                    var hlm = $(this).attr("id");
                    load_data(hlm);
                });
            });
        </script>

        <?php
        include "upload_foto.php"; // Fungsi upload foto yang sudah ada sebelumnya

        //jika tombol simpan diklik
        if (isset($_POST['simpan'])) {
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Simpan password dengan hash
            $foto = '';
            $nama_foto = $_FILES['foto']['name'];

            //jika ada file yang dikirim  
            if ($nama_foto != '') {
                $cek_upload = upload_foto($_FILES["foto"]); // Panggil fungsi upload_foto

                if ($cek_upload['status']) {
                    $foto = $cek_upload['message']; // Ambil nama file foto
                } else {
                    echo "<script>
                alert('" . $cek_upload['message'] . "');
                document.location='admin.php?page=user';
            </script>";
                    die;
                }
            }

            if (isset($_POST['id']) && !empty($_POST['id'])) {
                // Update data user
                $id = $_POST['id'];

                if ($nama_foto == '') {
                    $foto = $_POST['foto_lama']; // Tetap gunakan foto lama jika tidak diubah
                } else {
                    unlink("image/" . $_POST['foto_lama']); // Hapus foto lama
                }

                $stmt = $conn->prepare("UPDATE user SET username = ?, password = ?, foto = ? WHERE id = ?");
                $stmt->bind_param("sssi", $username, $password, $foto, $id);
            } else {
                // Insert data user baru
                $stmt = $conn->prepare("INSERT INTO user (username, password, foto) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $password, $foto);
            }

            $simpan = $stmt->execute();

            if ($simpan) {
                echo "<script>
            alert('Simpan data sukses');
            document.location='admin.php?page=user';
        </script>";
            } else {
                echo "<script>
            alert('Simpan data gagal');
            document.location='admin.php?page=user';
        </script>";
            }

            $stmt->close();
            $conn->close();
        }

        //jika tombol hapus diklik
        if (isset($_POST['hapus'])) {
            $id = $_POST['id'];
            $foto = $_POST['foto'];

            if ($foto != '') {
                unlink("image/" . $foto); // Hapus file foto
            }

            $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
            $stmt->bind_param("i", $id);
            $hapus = $stmt->execute();

            if ($hapus) {
                echo "<script>
            alert('Hapus data sukses');
            document.location='admin.php?page=user';
        </script>";
            } else {
                echo "<script>
            alert('Hapus data gagal');
            document.location='admin.php?page=user';
        </script>";
            }

            $stmt->close();
            $conn->close();
        }
        ?>

    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</body>