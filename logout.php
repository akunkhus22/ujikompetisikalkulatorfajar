<?php
session_start();
session_destroy(); // Hapus semua sesi
header("Location: login.php"); // Redirect kembali ke halaman login
exit();
