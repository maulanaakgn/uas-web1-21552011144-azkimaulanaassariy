<?php
include('header.php');
include('check_session.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kelola Berita</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/kelola.css">
</head>

<body>

    <div class="container mt-5">
        <div class="table-responsive">
            <table id="newsTable" class="table text-white" style="width:100%;">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Deskripsi</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <br>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    $(document).ready(function () {
        var table = $('#newsTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": 'https://kel7web.000webhostapp.com/config/listnews.php',
                "type": "POST",
                "data": function (data) {
                    return {
                        key: data.search.value
                    };
                },
                "dataSrc": function (json) {
                    json.data.forEach(function (row, index) {
                        row.no = index + 1;
                    });
                    return json.data;
                }
            },
            "columns": [
                { "data": "no" },
                { "data": "title" },
                {
                    "data": "desc",
                    "render": function (data, type, row) {
                        // Display only first 100 characters and add ellipsis if needed
                        return type === 'display' && data.length > 50 ?
                            data.substr(0, 50) + '...' :
                            data;
                    }
                },
                {
                    "data": "image",
                    "render": function (data, type, row) {
                        return '<img src="' + data + '" alt="Image" style="max-width: 100px; max-height: 100px;">';
                    }
                },
                {
                    "data": null,
                    "render": function (data, type, row) {
                        return '<button class="btn btn-danger btn-sm" onclick="deleteNews(' + row.id + ')">Delete</button>' +
                            '<form action="edit.php" method="post">' +
                            '<input type="hidden" name="id" value="' + row.id + '">' +
                            '<button type="submit" class="btn btn-primary btn-sm">Edit</button>' +
                            '</form>';
                    }
                }
            ]
        });
    });


    function deleteNews(id) {
        var formData = new FormData();
        formData.append("id", id);

        if (confirm("Are you sure you want to delete this news?")) {
            axios.post('https://kel7web.000webhostapp.com/config/deletenews.php', formData)
                .then(function (response) {
                    alert(response.data);
                    $('#newsTable').DataTable().ajax.reload();
                })
                .catch(function (error) {
                    console.log(error);
                    alert('Error deleting news.');
                });
        }
    }
</script>

</body>
</html>

<?php
include 'footer.php';
?>