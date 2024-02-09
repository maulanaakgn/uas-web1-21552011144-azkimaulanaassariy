<?php
include('header.php');
include('check_session.php');

$id = isset($_POST['id']) ? $_POST['id'] : null;

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>Edit Berita</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" href="css/addeditnews.css">
</head>

<body>

<div class="container profile">
    <div class="form addnews">
        <h2>Edit Berita</h2>
        <form id="addNewsForm" method="post" action="config/addnews.php">
            <div class="form-row">
                <div class="inputBox">
                    <input class="inputFile" type="file" name="url_image" id="url_image" accept="image/*">
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
                    <input class="inputText" type="submit" value="Simpan" id="submitButton">
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function getData() {
        const newsId = '<?php echo $id; ?>';
        var formData = new FormData();
        formData.append("id", newsId);

        axios.post('https://kel7web.000webhostapp.com/config/selectdata.php', formData)
            .then(function (response) {
                document.getElementById('judul').value = response.data.title;
                document.getElementById('deskripsi').value = response.data.desc;
            })
            .catch(function (error) {
                console.log(error);
                alert('Error fetching news data.');
            });
    }

    function editNews() {
        const newsId = '<?php echo $id; ?>';
        const judul =document.getElementById('judul').value;
        const deskripsi= document.getElementById("deskripsi").value;
        const urlImageInput= document.getElementById("url_image");
        const url_image= urlImageInput.files[0];
        const tanggal = new Date().toISOString().split('T')[0];

        var formData = new FormData();
        formData.append('id', newsId);
        formData.append('judul', judul);
        formData.append('deskripsi', deskripsi);
        formData.append('tanggal', tanggal);

        if (urlImageInput.files.length > 0) {
            formData.append('url_image', url_image);
        } else {
            formData.append('url_image', null);
        }

        axios.post('https://kel7web.000webhostapp.com/config/editnews.php', formData, {
            headers: {
                'Content-Type': 'multipart/form-data',
            },
        })
        .then(function (response) {
            console.log(response.data);
            alert(response.data);
            window.location.href = 'kelola.php'
        })
        .catch(function (error) {
            console.log(error);
            alert('Error editing news.');
        });

    }
    window.onload = getData;
</script>

<script>
    document.getElementById('submitButton').addEventListener('click', function(event) {
        event.preventDefault();
        editNews();
    });

</script>

</body>
</html>