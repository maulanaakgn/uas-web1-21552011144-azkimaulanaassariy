<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registrasi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/loginregister.css">
</head>

<body>
    <div class="container">
        <div class="form signup">
            <h2>Registrasi</h2>
            <form method="post" action="config/register.php" onsubmit="return validateForm()">
                <div class="inputBox">
                    <input type="text" id="namadepan" name="namadepan" required="required">
                    <span>Nama Depan</span>
                </div>
                <div class="inputBox">
                    <input type="text" id="namabelakang" name="namabelakang" required="required">
                    <span>Nama Belakang</span>
                </div>
                <div class="inputBox">
                    <input type="email" id="email" name="email" required="required">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Email</span>
                </div>
                <div class="inputBox">
                    <input type="text" id="username" name="username" required="required">
                    <i class="fa-regular fa-user"></i>
                    <span>username</span>
                </div>
                <div class="inputBox">
                    <input type="password" id="password" name="password" required="required">
                    <i class="fa-solid fa-lock"></i>
                    <span>password</span>
                </div>
                <div class="inputBox">
                    <input type="submit" value="Buat akun" id="submitButton">
                </div>
            </form>
            <p>Sudah punya akun ? <a href="login.php" class="login">Masuk</a></p>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function validateForm() {
            const ndepan = document.getElementById('namadepan').value;
            const nbelakang = document.getElementById('namabelakang').value;
            const email = document.getElementById('email').value;
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (ndepan === '' || nbelakang === '' || email === '' || username === '' || password === '') {
                alert('Harap isi semua kolom');
                return false;
            }
            
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])(?!.*\s)[A-Za-z\d@$!%*?&]{8,}$/;

            if (!passwordRegex.test(password)) {
                alert('Password harus mengandung setidaknya 1 huruf kecil, 1 huruf besar, 1 angka, 1 simbol, dan minimal 8 karakter; tidak boleh ada spasi');
                return false;
            }

            return true;
        }

        function register() {
            if (validateForm()) {
                
                const ndepan = document.getElementById('namadepan').value;
                const nbelakang = document.getElementById('namabelakang').value;
                const email = document.getElementById('email').value;
                const username = document.getElementById('username').value;
                const password = document.getElementById('password').value;
                
                const formData = new FormData();
                formData.append("namadepan", ndepan);
                formData.append("namabelakang", nbelakang);
                formData.append("email", email);
                formData.append("username", username);
                formData.append("password", password);

                axios.post('https://kel7web.000webhostapp.com/config/register.php', formData)
                    .then(response => {
                        console.log(response);
                        if (response.data.status === 'success') {
                            alert('Registrasi Berhasil. Silahkan Login!');
                            window.location.href = 'login.php';
                        } else {
                            alert(response.data.message);
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                    });
            }
        }

        document.getElementById('submitButton').addEventListener('click', function (event) {
            event.preventDefault();
            register();
        });
    </script>

    <script>
        let login = document.querySelector('.login');
        let container = document.querySelector('.container');

        login.onclick = function () {
            container.classList.add('signinForm');
        }
    </script>
</body>

</html>
