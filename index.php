<?php
session_start();

// Periksa apakah pengguna sudah login
if(!isset($_SESSION['username'])){
    // Jika belum, redirect ke halaman login.php
    header("Location: login.php");
    exit();
}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Uji Kompetisi Kalkulator Digital</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap-grid.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css?v=867">
</head>
<body>
	<div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-sm-6 col-lg-4">
				<div class="card">
					<div class="card-body">
						<div class="d-flex align-items-center justify-content-between mb-3">
							<h3 class="m-0 ">Halo👋, <?= $_SESSION['username'] ?>!</h3>
							<a href="logout.php">
								<svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="19" height="19" x="0" y="0" viewBox="0 0 24 24" style="enable-background:new 0 0 512 512" xml:space="preserve" class=""><g><path fill="#ff2d2d" fill-rule="evenodd" d="M5.636 5.636C8.582 2.691 13.059 2.215 16.5 4.204a1 1 0 0 1-1 1.731 7 7 0 1 0 0 12.13 1 1 0 0 1 1 1.731c-3.441 1.99-7.918 1.514-10.864-1.432a9 9 0 0 1 0-12.728zm12.657 2.657a1 1 0 0 1 1.414 0l1.891 1.891c.179.179.353.352.488.512.148.175.308.396.402.686a2 2 0 0 1 0 1.236 2.02 2.02 0 0 1-.402.687 9.18 9.18 0 0 1-.488.511l-1.89 1.891a1 1 0 0 1-1.415-1.414L19.586 13H12a1 1 0 1 1 0-2h7.586l-1.293-1.293a1 1 0 0 1 0-1.414z" clip-rule="evenodd" opacity="1" data-original="#ff2d2d" class=""></path></g></svg>
							</a>
						</div>
						<main>
						    <div class="display mb-3">
						        <div class="outer-div">
						            <div class="inner-div sm-text"></div>
						        </div>
						        <div class="outer-div">
						            <div class="inner-div lg-text">0</div>
						        </div>
						        <div class="error"></div>
						        <div class="m-icon">M</div>
						    </div>
						   
						    <div class="keyboard" style="margin-bottom: 5px;">
						    	<button class="btn" value="backspace">DEL</button>
						        <button class="btn" value="ce">CE</button>
						        <button class="btn" value="sign">±</button>
						        <button class="btn" value="sqrt">&radic;</button>
						        <button class="btn" value="sqr"></button>
						    </div>
						    <div class="keyboard" style="margin-bottom: 5px;">
						    	<button class="btn btn-white" value="7">7</button>
						        <button class="btn btn-white" value="8">8</button>
						        <button class="btn btn-white" value="9">9</button>
						        <button class="btn" value="/">/</button>
						        <button class="btn" value="perc"> % </button>
						    </div>
						    <div class="keyboard" style="margin-bottom: 5px;">
						        <button class="btn btn-white" value="4">4</button>
						        <button class="btn btn-white" value="5">5</button>
						        <button class="btn btn-white" value="6">6</button>
						        <button class="btn" value="*">*</button>
						        <button class="btn" value="reciprocal">1/x</button>
						    </div>
						    <div class="d-flex">
						        <div class="w-100" style="margin-right: 5px;">
						        	<div class="keyboard-sec" style="margin-bottom: 5px;">
							        	<button class="btn btn-white" value="1">1</button>
							            <button class="btn btn-white" value="2">2</button>
							            <button class="btn btn-white" value="3">3</button>
							            <button class="btn" value="-">-</button>
							        </div>
							        <div class="keyboard-sec">
							            <button class="btn btn-white" value="0">0</button>
							            <button class="btn btn-white" value="00">00</button>
							            <button class="btn btn-white" value=".">.</button>
							            <button class="btn" value="+">+</button>
							        </div>
						        </div>
						        <div class="bot-right">
						            <button class="btn btn-tall btn-primary" value="=">=</button>
						        </div>
						    </div>
						</main>
					</div>
				</div>
				<div class="footer">
					<h3><p class="mb-0 text-center">&copy;Ujikom Kalkulator | Muhamad Fajar</a></p></h3>
				</div>
			</div>
		</div>
	</div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="assets/js/script.js?v=99"></script>
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#register-form').submit(function(e){
		        e.preventDefault();

		        var username = $('input[name="username"]').val();
		        var email = $('input[name="email"]').val();
		        var password = $('input[name="password"]').val();
		        var confirm_password = $('input[name="confirm_password"]').val();
		        
		        // Validasi tambahan
		        // Validasi username min 3 karakter & maks 16 karakter
		        if (username.length < 3 || username.length > 16) {
		            noty("Username harus memiliki 3-16 karakter!");
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