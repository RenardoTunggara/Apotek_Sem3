<?php
$host = "localhost:8000";
$username = "root";
$password = "Renardo123";
$db = "sql_apotek";

$koneksi = new mysqli($host, $username, $password, $db);

if ($koneksi->connect_error) {
    die("Koneksi gagal: " . $koneksi->connect_error);
}
