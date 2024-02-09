<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="css/loginregister.css">
</head>

<body>
	<div class="container">
		<div class="form signinForm">
			<h2>Masuk</h2>
			<form method="post" action="config/login.php">
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
					<input type="submit" value="Masuk" onclick="login()">
				</div>
			</form>
			<p>Tidak Terdaftar ? <a href="register.php" class="create">Buat akun</a></p>
		</div>
	</div>

	<script>
		let create = document.querySelector('.create');
		let container = document.querySelector('.container');

        function login() {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            const formData = new FormData();
            formData.append("username", username);
            formData.append("password", password);

            axios.post('https://kel7web.000webhostapp.com/login.php', formData)
            .then(response => {
                console.log(response);
                if (response.data.status === 'success') {
                    const sessionToken = response.data.session_token;
                    localStorage.setItem('session_token', sessionToken);
                    window.location.href = 'index.php';
                } else {
                    alert('Username atau Password salah!');
                }
            })
            .catch((error) => {
                console.error('Error:', error);
            });
        }
        
		create.onclick = function(){
			container.classList.remove('signinForm');
		}
	</script>
</body>
</html>
