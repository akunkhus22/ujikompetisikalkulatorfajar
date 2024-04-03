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
	<title>Masuk Kalkulator Digital</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?v=89">
</head>
<body>
	<div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-sm-6 col-lg-4">
				<div class="card">
					<div class="card-body">
						<center><h1 class="mt-0">Masuk</h1></center>
						<form id="register-form">
							<div class="mb-3">
								<label for="username">Username</label>
								<input type="text" name="username" class="form-control" id="username" placeholder="Masukkan Username">
							</div>
							<div class="mb-3">
								<label for="password">Kata sandi</label>
								<input type="password" name="password" class="form-control" id="password" placeholder="Masukkan Kata sandi">
							</div>
							<div id="alert"></div>
							<button type="submit" class="btn btn-primary w-100">Masuk</button>
						</form>
						<div class="mt-3">
							<p class="mb-0 text-center">Belum punya akun? <a href="register.php">Daftar</a></p>
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
		        var password = $('input[name="password"]').val();
		        
		        // Validasi tambahan
		        // Validasi username min 6 karakter & maks 16 karakter
		        if (username.length < 6 || username.length > 16) {
		            noty("Username harus memiliki 6-16 karakter!");
		            return;
		        }

		        // validasi kata sandi min 6 karakter
		        if (password.length < 6) {
		            noty("Kata sandi harus memiliki minimal 6 karakter!");
		            return;
		        }

		        // Serialize data formulir
		        var formData = $(this).serialize();
		        
		        // Tampilkan tampilan loading pada tombol
		        $('button[type="submit"]').html('Loading...').attr('disabled', true);
		        
		        // Kirim data ke server menggunakan Ajax
		        $.ajax({
		            type: 'POST',
		            url: 'api/login.php',
		            data: formData,
		            success: function(data) {
		                // Jika data == login_success maka alihkan ke halaman login
		                if (data === 'log_success') {
		                	// Hilangkan tampilan loading pada tombol
			                $('button[type="submit"]').html('Mengalihkan...');
			                noty('Masuk berhasil!', 'success');
		                	setTimeout(()=> {
		                		window.location.href = 'index.php';
		                	}, 1000);
		                } else {
		                	// Hilangkan tampilan loading pada tombol
			                $('button[type="submit"]').html('Masuk').attr('disabled', false);
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