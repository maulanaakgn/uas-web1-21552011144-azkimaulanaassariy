<?php
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/profile.css">
</head>

<body>
    <div class="container profile">
        <div class="form signup">
            <h2>Profile</h2>
            <form method="post" action="config/register.php" id="profileForm">
                <div class="form-row">
                    <div class="inputBox">
                        <input class="inputFile" type="file" name="url_image" id="url_image" accept="image/*" required="required">
                    </div>
                </div>
                <div class="form-row">
                    <div class="inputBox">
                        <input class="inputText" type="text" id="namadepan" name="namadepan" required="required">
                        <span>Nama Depan</span>
                    </div>
                    <div class="inputBox">
                        <input class="inputText" type="text" id="namabelakang" name="namabelakang" required="required">
                        <span>Nama Belakang</span>
                    </div>
                </div>
                <div class="form-row">
                    <div class="inputBox">
                        <input class="inputText" type="email" id="email" name="email" required="required">
                        <i class="fa-solid fa-envelope"></i>
                    </div>
                    <div class="inputBox">
                        <input class="inputText" type="text" id="username" name="username" required="required">
                        <i class="fa-regular fa-user"></i>
                    </div>
                </div>
                <div class="form-row">
                    <div class="inputBox">
                        <input class="inputText" type="number" id="telp" name="telp" required="required">
                        <i class="fa-solid fa-phone"></i>
                        <span>No Hp</span>
                    </div>
                    <div class="inputBox">
                        <input class="inputText" type="submit" value="Simpan" id="submitButton">
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function getData() {
            const formData = new FormData();
            formData.append('session_token', localStorage.getItem('session_token'));
    
            axios.post('https://kel7web.000webhostapp.com/config/select_profile_data.php', formData)
                .then(function (response) {
                    document.getElementById('username').value = response.data.username;
                    document.getElementById('namadepan').value = response.data.ndepan;
                    document.getElementById('namabelakang').value = response.data.nbelakang;
                    document.getElementById('email').value = response.data.email;
                    document.getElementById('telp').value = response.data.phone;
                })
                .catch(function (error) {
                    console.log(error);
                    alert('Error fetching news data.');
                });
        }
        function updateProfile() {
            const ndepan = document.getElementById("namadepan").value;
            const nbelakang = document.getElementById("namabelakang").value;
            const telp = document.getElementById("telp").value;
            const urlImageInput = document.getElementById("url_image");
            const url_image = urlImageInput.files[0];

            var formData = new FormData();
            formData.append('session_token', localStorage.getItem('session_token'));
            formData.append('namadepan', ndepan);
            formData.append('namabelakang', nbelakang);
            formData.append('telp', telp);

            if (urlImageInput.files.length > 0) {
                formData.append('url_image', url_image);
            } else {
                formData.append('url_image', null);
            }

            axios.post('https://kel7web.000webhostapp.com/config/profile_up.php', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                },
            })
                .then(function (response) {
                    console.log(response.data);
                    alert(response.data);
                    window.location.href = 'index.php'
                })
                .catch(function (error) {
                    console.log(error);
                    alert('Error editing profile.');
                });

        }
    </script>

    <script>
        document.getElementById('submitButton').addEventListener('click', function (event) {
            event.preventDefault();
            updateProfile();
        });

    </script>
    
    <script>
        function disableInput() {
            document.getElementById('email').disabled = true;
            document.getElementById('username').disabled = true;
        }
    
        window.onload = function () {
            getData();
            disableInput();
        };
    </script>
</body>
</html>