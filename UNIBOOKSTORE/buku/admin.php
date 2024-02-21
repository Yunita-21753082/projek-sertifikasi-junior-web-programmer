<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - UNIBOOKSTORE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Admin Panel - UNIBOOKSTORE</h1>

        <!-- Tambah Buku Form -->
        <h2>Tambah Buku</h2>
        <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <div class="form-group">
                <label for="id_buku">ID Buku:</label>
                <input type="text" class="form-control" id="id_buku" name="id_buku">
            </div>
            <div class="form-group">
                <label for="nama_buku">Nama Buku:</label>
                <input type="text" class="form-control" id="nama_buku" name="nama_buku">
            </div>
            <button type="submit" class="btn btn-primary" name="tambah_buku">Tambah Buku</button>
        </form>

        <!-- Daftar Buku -->
        <h2>Daftar Buku</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Buku</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
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

                // Handle tambah buku
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_buku'])) {
                    $id_buku = $_POST['id_buku'];
                    $nama_buku = $_POST['nama_buku'];
                    $sql_tambah = "INSERT INTO tbl_buku (id_buku, nama_buku) VALUES ('$id_buku', '$nama_buku')";
                    if ($conn->query($sql_tambah) === TRUE) {
                        echo '<div class="alert alert-success" role="alert">Buku berhasil ditambahkan.</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error: ' . $sql_tambah . '<br>' . $conn->error . '</div>';
                    }
                }

                // Handle hapus buku
                if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hapus_buku'])) {
                    $id_buku = $_POST['id_buku'];
                    $sql_hapus = "DELETE FROM tbl_buku WHERE id_buku='$id_buku'";
                    if ($conn->query($sql_hapus) === TRUE) {
                        echo '<div class="alert alert-success" role="alert">Buku berhasil dihapus.</div>';
                    } else {
                        echo '<div class="alert alert-danger" role="alert">Error: ' . $sql_hapus . '<br>' . $conn->error . '</div>';
                    }
                }

                // Query untuk menampilkan daftar buku
                $sql = "SELECT * FROM tbl_buku";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $row["id_buku"] . "</td><td>" . $row["nama_buku"] . "</td><td>
                            <a href='edit.php?id=" . $row["id_buku"] . "' class='btn btn-sm btn-primary'>Edit</a>
                            <form method='POST' action='".htmlspecialchars($_SERVER["PHP_SELF"])."'>
                                <input type='hidden' name='id_buku' value='".$row["id_buku"]."'>
                                <button type='submit' class='btn btn-sm btn-danger' name='hapus_buku'>Hapus</button>
                            </form>
                        </td></tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>Tidak ada buku</td></tr>";
                }

                // Tutup koneksi database
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
