<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kebutuhan Buku</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Laporan Kebutuhan Buku</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Judul Buku</th>
                    <th>Nama Penerbit</th>
                    <th>Sisa Stok</th>
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

                // Query untuk mendapatkan buku dengan sisa stok paling sedikit
                $sql = "SELECT tbl_buku.*, tbl_penerbit.nama FROM tbl_buku 
                        INNER JOIN tbl_penerbit ON tbl_buku.id_buku = tbl_penerbit.id_penerbit 
                        ORDER BY tbl_buku.stok ASC";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    $no = 1;
                    while($row = $result->fetch_assoc()) {
                        echo "<tr><td>" . $no . "</td><td>" . $row["judul_buku"] . "</td><td>" . $row["nama_penerbit"] . "</td><td>" . $row["stok"] . "</td></tr>";
                        $no++;
                    }
                } else {
                    echo "<tr><td colspan='4'>Tidak ada data</td></tr>";
                }

                // Tutup koneksi database
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
