<?php
session_start();

// Periksa apakah pengguna sudah login
if(isset($_SESSION['username'])){
    // Jika sudah, redirect ke halaman index.php
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daftar Kalkulator Digital</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?v=4">
</head>
<body>
	<div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-sm-6 col-lg-4">
				<div class="card">
					<div class="card-body">
						<center><h1 class="mt-0">Daftar</h1></center>
						<form id="register-form">
							<div class="mb-3">
								<label for="username">Username</label>
								<input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username">
							</div>
							<div class="mb-3">
								<label for="email">Email</label>
								<input type="email" name="email" class="form-control" id="email" placeholder="Masukkan Email">
							</div>
							<div class="mb-3">
								<label for="password">Kata sandi</label>
								<input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Kata sandi">
							</div>
							<div class="mb-3">
								<label for="confirm_password">Konfirmasi Kata sandi</label>
								<input type="password" name="confirm_password" class="form-control" id="confirm_password" placeholder="Konfirmasi Kata sandi">
							</div>
							<div id="alert"></div>
							<button type="submit" class="btn btn-primary w-100">Daftar</button>
						</form>
						<div class="mt-3">
							<p class="mb-0 text-center">Sudah punya akun? <a href="login.php">Masuk</a></p>
						</div>
					</div>
				</div>
				<div class="footer">
					<h3><p class="mb-0 text-center">&copy;Ujikom Kalkulator | Muhamad Fajar</a></p></h3>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="assets/js/script.js?v=3"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#register-form').submit(function(e){
		        e.preventDefault();

		        var username = $('input[name="username"]').val();
		        var email = $('input[name="email"]').val();
		        var password = $('input[name="password"]').val();
		        var confirm_password = $('input[name="confirm_password"]').val();
		        
		        // Validasi tambahan
		        // Validasi username min 6 karakter & maks 16 karakter
		        if (username.length < 6 || username.length > 16) {
		            noty("Username harus memiliki 6-16 karakter!");
		            return;
		        }

		        // validasi emai dengan regex
		        var email_regex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
		        if (!email_regex.test(email)) {
		            noty("Format email tidak valid!");
		            return;
		        }

		        // validasi kata sandi min 6 karakter
		        if (password.length < 6) {
		            noty("Kata sandi harus memiliki minimal 6 karakter!");
		            return;
		        }

		        // validasi konfirmasi kata sandi
		        if (password !== confirm_password) {
		            noty("Konfirmasi Kata sandi tidak cocok!");
		            return;
		        }
		        
		        // Serialize data formulir
		        var formData = $(this).serialize();
		        
		        // Tampilkan tampilan loading pada tombol
		        $('button[type="submit"]').html('Loading...').attr('disabled', true);
		        
		        // Kirim data ke server menggunakan Ajax
		        $.ajax({
		            type: 'POST',
		            url: 'api/register.php',
		            data: formData,
		            success: function(data) {
		                // Jika data == login_success maka alihkan ke halaman login
		                if (data === 'reg_success') {
		                	// Hilangkan tampilan loading pada tombol
			                $('button[type="submit"]').html('Mengalihkan...');
			                noty('Daftar berhasil!', 'success');
		                	setTimeout(()=> {
		                		window.location.href = 'login.php';
		                	}, 1000);
		                } else {
		                	// Hilangkan tampilan loading pada tombol
			                $('button[type="submit"]').html('Daftar').attr('disabled', false);
		                	noty(data);
		                }
		            },
		            error: function(xhr, status, error) {
		                console.error(xhr.responseText);
		            }
		        });
		    });
		});
	</script>
</body>
</html>