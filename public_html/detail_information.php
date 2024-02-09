<?php
include('header.php');
?>

<head>
    <meta charset="UTF-8">
    <title>Detail</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/detail_information.css">
</head>

<body>
    <div class="container mt-5">
        <h2 id="judul" class="mb-4"></h2>
        <div id="newsContainer">
            <div class="news-item">
                <img src="" alt="Image Preview" id="url_image" class="image">
                <div class="news-details">
                    <p id="deskripsi" class="news-desc text-white"></p>
                </div>
            </div>
        </div>
       
    </div>
    <div class="container mt-5">
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function getData() {
            const urlParams = new URLSearchParams(window.location.search);
            const newsId = urlParams.get('id');

            var formData = new FormData();
            formData.append("id", newsId);

            axios.post('https://kel7web.000webhostapp.com/config/selectdata.php', formData)
                .then(function (response) {
                    document.getElementById('judul').innerHTML = response.data.title;
                    document.getElementById('deskripsi').innerHTML = response.data.desc;
                    
                    // Setel atribut src pada elemen gambar
                    document.getElementById('url_image').src = response.data.image;
                })
                .catch(function (error) {
                    console.log(error);
                    alert('Error fetching news data.');
                });
        }

        // Panggil fungsi getData saat halaman dimuat
        window.onload = getData;
    </script>
</body>

</html>

<?php
include('footer.php');
?>
