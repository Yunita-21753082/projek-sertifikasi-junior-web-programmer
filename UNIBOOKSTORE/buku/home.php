<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Buku - UNIBOOKSTORE</title>

    <!-- Latest Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>

<div class="container">
    <h1 class="mt-4">Welcome to UNIBOOKSTORE</h1>
    <p class="lead">Find your favorite books here.</p>

    <!-- Search form -->
    <form method="GET" action="home.php">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search Book" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Display book data -->
    <h2 class="mt-4">Book List</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Buku</th>
                <!-- Add more table headers for other book attributes if needed -->
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

            // Query untuk mencari buku
            $sql = "SELECT * FROM tbl_buku";

            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $search = $_GET['search'];
                $sql .= " WHERE nama_buku LIKE '%$search%'";
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo "<tr><td>" . $row["id_buku"] . "</td><td>" . $row["nama_buku"] . "</td></tr>";
                    // Add more table cells for other book attributes if needed
                }
            } else {
                echo "<tr><td colspan='2'>No books found</td></tr>";
            }

            // Tutup koneksi database
            $conn->close();
            ?>
        </tbody>
    </table>
</div>

<!-- Bootstrap core JavaScript-->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
