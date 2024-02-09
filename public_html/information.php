<?php
include('header_information.php');
include('check_session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Information</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/information.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">List Berita</h2>
        <!--<input type="text" id="searchInput" class="form-control mb-3" placeholder="Search by title or description">-->
        <div id="newsContainer">
            <!-- News items will be dynamically added here -->
        </div>
        <p id="noResultText" style="display:none;">Data tidak ditemukan.</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function () {
            var newsContainer = $('#newsContainer');

            // Fetch news data and populate the container with list items
            axios.post('https://kel7web.000webhostapp.com/config/listnews.php', { key: '' })
                .then(function (response) {
                    var newsData = response.data.data;
                    displayNews(newsData); // Initial display

                    // Handle search input
                    $('#searchInput').on('input', function () {
                        var searchTerm = $(this).val().toLowerCase();
                        var filteredNews = newsData.filter(function (news) {
                            return news.title.toLowerCase().includes(searchTerm) || news.desc.toLowerCase().includes(searchTerm);
                        });
                        displayNews(filteredNews);
                    });
                })
                .catch(function (error) {
                    console.error('Error fetching news data:', error);
                });
        });

        function handleSearchInput(searchTerm) {
            var newsContainer = $('#newsContainer');
            var noResultText = $('#noResultText');

            // Fetch news data and populate the container with list items
            axios.post('https://kel7web.000webhostapp.com/config/listnews.php', { key: '' })
                .then(function (response) {
                    var newsData = response.data.data;

                    // Filter data berdasarkan kata kunci pencarian
                    var filteredNews = newsData.filter(function (news) {
                        return news.title.toLowerCase().includes(searchTerm) || news.desc.toLowerCase().includes(searchTerm);
                    });

                    // Menampilkan atau menyembunyikan teks "Data tidak ditemukan"
                    if (filteredNews.length > 0) {
                        noResultText.hide();
                        displayNews(filteredNews);
                    } else {
                        noResultText.show();
                        newsContainer.empty();
                    }
                })
                .catch(function (error) {
                    console.error('Error fetching news data:', error);
                });
        }

        function displayNews(newsData) {
            var newsContainer = $('#newsContainer');
            newsContainer.empty(); // Clear existing content

            newsData.forEach(function (news, index) {
                var newsItem = createNewsItem(news);
                newsContainer.append(newsItem);
            });
        }

        function createNewsItem(news) {
            var newsHtml = '<div class="news-item" onclick="showDetails(' + news.id + ')">' +
                '<img src="' + news.image + '" alt="Image">' +
                '<div class="news-details">' +
                '<h4 class="news-title">' + news.title + '</h4>' +
                '<p class="news-desc">' + news.desc + '</p>' +
                '</div>' +
                '</div>' +
                '</div>';

            return $(newsHtml);
        }

        function showDetails(id) {
            window.location.href = 'detail_information.php?id=' + id;
        }
    </script>
</body>
</html>
