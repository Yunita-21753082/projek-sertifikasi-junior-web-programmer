<?php
require("koneksi.php");

try {
    $hub = open_connection();

    if ($hub) {
        echo ("Koneksi SUKSES");
    } else {
        echo ("Koneksi GAGAL");
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
