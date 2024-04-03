<?php

// Ambil file koneksi
include('conn.php');

// Tangkap data yang dikirim dari form
$username = $_POST['username'];
$password = $_POST['password'];

// Query untuk mencari pengguna berdasarkan username
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Pengguna ditemukan, periksa password
    $row = $result->fetch_assoc();
    if (md5($password) === $row['password']) {
        // Password cocok, buat sesi login
        session_start();
        $_SESSION['username'] = $row['username'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['created_at'] = $row['created_at'];
        echo "log_success";
    } else {
        // Password tidak cocok
        echo "Kata sandi salah.";
    }
} else {
    // Pengguna tidak ditemukan
    echo "Username tidak ditemukan.";
}

$conn->close();
?>
