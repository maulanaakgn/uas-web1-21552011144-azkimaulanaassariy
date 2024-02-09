<?php
session_start();
include('session.php');
?>

<head>
	<meta charset="UTF-8">
	<title>Registrasi</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="css/loginregister.css">
</head>

<body>
	<div class="container">
		<div class="form signup">
			<h2>Registrasi</h2>
			<form method="post" action="config/register.php">
			    <div class="inputBox">
					<input type="text" name="namadepan" required="required">
					<span>Nama Depan</span>
			    </div>
			    <div class="inputBox">
					<input type="text" name="namabelakang" required="required">
					<span>Nama Belakang</span>
			    </div>
			    <div class="inputBox">
					<input type="text" name="email" required="required">
					<i class="fa-solid fa-envelope"></i>
					<span>Email</span>
				</div>
				<div class="inputBox">
					<input type="text" name="username" required="required">
					<i class="fa-regular fa-user"></i>
					<span>username</span>
				</div>
				<div class="inputBox">
					<input type="password" name="password" required="required">
					<i class="fa-solid fa-lock"></i>
					<span>password</span>
				</div>
				<div class="inputBox">
					<input type="submit" value="Buat akun">
				</div>
			</form>
			<p>Sudah punya akun ? <a href="login.php" class="login">Masuk</a></p>
		</div>
	</div>

	<script>
		let login = document.querySelector('.login');
		let container = document.querySelector('.container');

		login.onclick = function(){
			container.classList.add('signinForm');
		}
	</script>
</body>
</html>
