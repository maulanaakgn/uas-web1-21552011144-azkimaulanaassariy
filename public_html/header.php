<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/header.css">
    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.68/vfs_fonts.js"></script>
    <title>Dashboard</title>
</head>

<body>
    <nav class="navbar navbar-expand-md navbar-custom bg-info">
        <a href="#" class="navbar-brand text-white" onclick="dashboard()">UAS Kelompok 7 WEB 1</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="nabarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link text-white" href="#" onclick="information()">Information</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      Data
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#" onclick="tambahdata()">Tambah Data</a>
                      <a class="dropdown-item" href="#" onclick="keloladata()">Kelola Data</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="about.php" onclick="about()">About</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="d-flex align-items-center">
                            <img id="profileImage" alt="Profile Image" class="rounded-circle mr-2" style="width: 30px; height: 30px;">
                            <span class="text-white" id="namaProfile">John Doe</span>
                        </div>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="#" onclick="profile()">Profile</a>
                      <a class="dropdown-item" href="#" onclick="ubahPassword()">Ubah Kata Sandi</a>
                    <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="#" onclick="logout()">Logout</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
    
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script>
        document.getElementById('namaProfile').innerText = localStorage.getItem('ndepan') + " " + localStorage.getItem('nbelakang');
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var imagePath = localStorage.getItem('imagePath');
        
            var profileImage = document.getElementById('profileImage');
        
            if (imagePath) {
                profileImage.src = imagePath;
            }
        });
    </script>
    <script>
        function keloladata() {
            window.location.href = 'kelola.php';
        }
        
        function information() {
            window.location.href = 'information.php';
        }

        function dashboard() {
            window.location.href = 'index.php';
        }

        function tambahdata() {
            window.location.href = 'tambah.php';
        }
        
        function profile() {
            window.location.href = 'profile.php';
        }
        
        function ubahPassword() {
            window.location.href = 'passwordchange.php';
        }

        function logout() {
            const sessionToken = localStorage.getItem('session_token');
            localStorage.removeItem('nama');

            const formData = new FormData();
            formData.append('session_token', sessionToken);

            axios.post('https://kel7web.000webhostapp.com/config/logout.php', formData)
                .then(response => {
                    if (response.data.status == 'success') {
                        localStorage.removeItem('session_token');
                        window.location.href = 'login.php';
                    } else {
                        alert('Logout gagal. Silakan coba lagi');
                    }
                })
                .catch(error => {
                    console.error('Error during logout:', error);
                });
        }

    </script>
</body>

</html>