<?php

// Ambil file koneksi
include('conn.php');

// Tangkap data yang dikirim dari form
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

// Validasi tambahan
if (strlen($username) < 3 || strlen($username) > 16) {
    echo "Username harus memiliki 3-16 karakter!";
    exit;
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Format email tidak valid!";
    exit;
}
if (strlen($password) < 6) {
    echo "Kata sandi harus memiliki minimal 6 karakter!";
    exit;
}
if ($password !== $confirm_password) {
    echo "Konfirmasi Kata sandi tidak cocok!";
    exit;
}

// Hash password dengan md5
$password_hashed = md5($password);

// Periksa apakah password dan konfirmasi password cocok
if ($password !== $confirm_password) {
    echo "Konfirmasi Kata sandi tidak cocok!";
    exit;
}

// Query untuk memeriksa apakah username dan email unik
$sql_check = "SELECT * FROM users WHERE username='$username' OR email='$email'";
$result_check = $conn->query($sql_check);

if ($result_check->num_rows > 0) {
    echo "Username atau email sudah digunakan.";
} else {
    // Query untuk menyimpan data ke database
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password_hashed')";

    if ($conn->query($sql) === TRUE) {
        echo "reg_success";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();