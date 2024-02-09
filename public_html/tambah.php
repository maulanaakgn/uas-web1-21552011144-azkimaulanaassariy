<?php
include('header.php');
include('check_session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Tambah Berita</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="css/addeditnews.css">
</head>

<body>

<div class="container profile">
    <div class="form addnews">
        <h2>Tambah Berita</h2>
        <form id="addNewsForm" method="post" action="config/addnews.php">
            <div class="form-row">
                <div class="inputBox">
                    <input class="inputFile" type="file" name="url_image" id="url_image" accept="image/*"
                        required="required">
                </div>
                <div class="inputBox">
                    <input class="inputText" type="text" id="judul" name="judul" required="required">
                    <span>Judul</span>
                </div>
            </div>
            <div class="form-row">
                <div class="inputBox box-desc">
                    <textarea class="inputText" id="deskripsi" name="deskripsi" required="required"></textarea>
                </div>
            </div>
            <div class="form-row">
                <div class="inputBox">
                    <input class="inputText" type="submit" value="Tambah" id="submitButton">
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function addNews() {
        const judul =document.getElementById('judul').value;
        const deskripsi= document.getElementById("deskripsi").value;
        const urlImageInput= document.getElementById("url_image");
        const url_image= urlImageInput.files[0];
        const tanggal = new Date().toISOString().split('T')[0];

        var formData = new FormData();
        formData.append('judul', judul);
        formData.append('deskripsi', deskripsi);
        formData.append('url_image', url_image);
        formData.append('tanggal', tanggal);

        axios.post('https://kel7web.000webhostapp.com/config/addnews.php', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        })
        .then(function (response) {
            console.log(response.data);
            console.log(formData);
            alert(response.data);
            document.getElementById('addNewsForm').reset();
        })
        .catch(function (error) {
            console.log(error);
            alert('Error adding news.');
        });
    }
</script>

<script>
    document.getElementById('submitButton').addEventListener('click', function(event) {
        event.preventDefault();
        addNews();
    });

</script>

</body>
</html>