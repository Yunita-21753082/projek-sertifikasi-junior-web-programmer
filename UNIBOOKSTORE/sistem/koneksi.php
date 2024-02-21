<?php

function open_connection() {
    $host = 'localhost';
    $username = 'root';
    $password = '';
    $database = 'data';

    $hub = new mysqli($host, $username, $password, $database);

    if ($hub->connect_error) {
        die("Connection failed: " . $hub->connect_error);
    }

    return $hub;
}

?>
