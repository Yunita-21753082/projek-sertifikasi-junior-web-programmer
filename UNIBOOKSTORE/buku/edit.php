<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku - UNIBOOKSTORE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Edit Buku - UNIBOOKSTORE</h1>
        <?php
        // Koneksi ke database
        $host = 'localhost';
        $username = 'root'; // Ganti dengan username database Anda
        $password = ''; // Ganti dengan password database Anda
        $database = 'data'; // Ganti dengan nama database Anda

        $conn = new mysqli($host, $username, $password, $database);

        if ($conn->connect_error) {
            die("Koneksi gagal: " . $conn->connect_error);
        }

        if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
            $id_buku = $_GET['id'];
            $sql = "SELECT * FROM tbl_buku WHERE id_buku='$id_buku'";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                ?>
                <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                    <input type="hidden" name="id_buku" value="<?php echo $row['id_buku']; ?>">
                    <div class="form-group">
                        <label for="nama_buku">Nama Buku:</label>
                        <input type="text" class="form-control" id="nama_buku" name="nama_buku" value="<?php echo $row['nama_buku']; ?>">
                        <label for="id_buku">Id Buku:</label>
                        <input type="text" class="form-control" id="id_buku" name="id_buku" value="<?php echo $row['id_buku']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary" name="simpan_buku">Simpan</button>
                </form>
                <?php
            } else {
                echo "Buku tidak ditemukan.";
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan_buku'])) {
            $id_buku = $_POST['id_buku'];
            $nama_buku = $_POST['nama_buku'];

            // Pastikan buku dengan id yang sama sudah ada di database sebelum melakukan operasi update
            $check_sql = "SELECT * FROM tbl_buku WHERE id_buku='$id_buku'";
            $check_result = $conn->query($check_sql);

            if ($check_result->num_rows > 0) {
                $update_sql = "UPDATE tbl_buku SET nama_buku='$nama_buku' WHERE id_buku='$id_buku'";

                if ($conn->query($update_sql) === TRUE) {
                    echo '<div class="alert alert-success" role="alert">Buku berhasil diupdate.</div>';
                    echo '<script>window.location.href = "admin.php";</script>'; // Mengarahkan kembali ke halaman admin setelah berhasil mengedit
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error: ' . $update_sql . '<br>' . $conn->error . '</div>';
                }
            } else {
                echo "Buku tidak ditemukan.";
            }
        }

        // Tutup koneksi database
        $conn->close();
        ?>
    </div>
</body>
</html>
