<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-secondary mb-2" data-bs-toggle="modal" data-bs-target="#modalTambah">
        <i class="bi bi-plus-lg"></i> Tambah Jadwal
    </button>
    <div class="row">
        <div class="table-responsive" id="schedule_data"></div>
        <!-- Modal Tambah -->
        <div class="modal fade" id="modalTambah" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Jadwal</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post" action="" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="formGroupExampleInput" class="form-label">Hari</label>
                                <input type="text" class="form-control" name="hari" placeholder="Tuliskan Hari" required>
                            </div>
                            <div class="mb-3">
                                <label for="floatingTextarea2">Kegiatan</label>
                                <textarea class="form-control" placeholder="Tuliskan Isi Kegiatan" name="kegiatan" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="formGroupExampleInput2" class="form-label">Deskripsi</label>
                                <input type="text" class="form-control" name="deskripsi">
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
    </div>
    <script>
        $(document).ready(function() {
            load_data();

            function load_data(hlm) {
                $.ajax({
                    url: "schedule_data.php",
                    method: "POST",
                    data: {
                        hlm: hlm
                    },
                    success: function(data) {
                        $('#schedule_data').html(data);
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
    include "connection.php";

    if (isset($_POST['simpan'])) {
        $kegiatan = $_POST['kegiatan'];
        $deskripsi = $_POST['deskripsi'];
        $hari = $_POST['hari'];

        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $stmt = $conn->prepare("UPDATE schedule SET kegiatan = ?, deskripsi = ?, hari = ? WHERE id = ?");
            $stmt->bind_param("sssi", $kegiatan, $deskripsi, $hari, $id);
            $simpan = $stmt->execute();
        } else {
            $stmt = $conn->prepare("INSERT INTO schedule (kegiatan, deskripsi, hari) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $kegiatan, $deskripsi, $hari);
            $simpan = $stmt->execute();
        }

        if ($simpan) {
            echo "<script>
            alert('Jadwal berhasil ditambahkan');
            document.location='admin.php?page=schedule';
        </script>";
        } else {
            echo "<script>
            alert('Gagal menambah jadwal');
            document.location='admin.php?page=schedule';
        </script>";
        }
    }

    if (isset($_POST['hapus'])) {
        $id = $_POST['id'];

        // Hapus jadwal dari database
        $stmt = $conn->prepare("DELETE FROM schedule WHERE id = ?");
        $stmt->bind_param("i", $id);
        $hapus = $stmt->execute();

        if ($hapus) {
            echo "<script>
            alert('Jadwal berhasil dihapus');
            document.location='admin.php?page=schedule';
        </script>";
        } else {
            echo "<script>
            alert('Gagal menghapus jadwal');
            document.location='admin.php?page=schedule';
        </script>";
        }
    }
    ?>
</div>