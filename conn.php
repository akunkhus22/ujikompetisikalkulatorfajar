<?php

$host = "localhost"; // Ganti dengan host Anda
$user = "root"; // Ganti dengan username MySQL Anda
$pass = ""; // Ganti dengan password MySQL Anda
$dbname = "kalkulator"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($host, $user, $pass, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
