<?php
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Ubah Kata Sandi</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <div class="container profile">
        <div class="form signup">
            <h2>Ubah Kata Sandi</h2>
            <form method="post" action="config/register.php" id="profileForm">
                <div class="form-row">
                    <div class="inputBox">
                        <input class="inputText" type="password" id="password" name="password" required="required">
                        <i class="fa-solid fa-lock"></i>
                        <span>Password</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="inputBox">
                        <input class="inputText" type="submit" value="Simpan" id="submitButton">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function updatePassword() {
            const password = document.getElementById("password").value;
            
            const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])(?!.*\s)[A-Za-z\d@$!%*?&]{8,}$/;
            if (!passwordRegex.test(password)) {
                alert('Password harus mengandung setidaknya 1 huruf kecil, 1 huruf besar, 1 angka, 1 simbol, dan minimal 8 karakter; tidak boleh ada spasi');
                return false;
            }
    
            var formData = new FormData();
            formData.append('session_token', localStorage.getItem('session_token'));
            formData.append('password', password);
    
            axios.post('https://kel7web.000webhostapp.com/config/password_up.php', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
                .then(function (response) {
                    console.log(response.data);
                    alert(response.data);
                    window.location.href = 'index.php';
                })
                .catch(function (error) {
                    console.log(error);
                    alert('Error editing profile.');
                });
        }
    
        document.getElementById('submitButton').addEventListener('click', function (event) {
            event.preventDefault();
    
            const passwordInput = document.getElementById("password");
            if (passwordInput.value.trim() === '') {
                
            } else {
                updatePassword();
            }
        });
    </script>
</body>
</html>
