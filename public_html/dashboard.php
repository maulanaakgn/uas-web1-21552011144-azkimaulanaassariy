<?php
include('header.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/dashboard.css">
</head>

<body>
    <div class="container card-body main">
        <section class="hero d-flex justify-content-center align-items-center" id="section_1">
            <div class="container">
                <div class="row">
                    <div class="col-lg-7 col-12">
                        <h1 id="welcomeMessage">Selamat datang di Dashboard</h2>
                            <div class="hero-text">
                                <h2 class="mb-4">Tugas besar Pemrograman Web 1 Kelompok 7</h2>
                                <p class="mb-4"><a class="custom-btn btn custom-link" href="information.php">Berita</a>
                                </p>
                            </div>
                    </div>

                    <div class="col-lg-5 col-12 position-relative">
                        <div class="hero-image-wrap"></div>
                        <img src="images/portrait-happy-excited-man-holding-laptop-computer.png"
                            class="hero-image img-fluid custom-image" alt="">
                    </div>

                </div>
            </div>
        </section>
    </div>
    <br></br>
    <div class="container card-body main">
        <div class="row">
            <div class="col-md-6 offset-md-3 text-center">
                <div class="row">
                    <div class="col-md-12">
                        <button onclick="downloadExcel()" class="btn btn-success mr-2 exc-btn">
                            <i class="fas fa-download"></i> Unduh Excel
                        </button>
                        <button onclick="downloadPDF()" class="btn btn-danger mr-2 pdf-btn">
                            <i class="fas fa-download"></i> Unduh PDF
                        </button>
                    </div>
                </div>
                <div class="card base my-4">
                    <div class="card-body content">
                        <h3 id="jumlahBerita" class="text-dark">
                            <i class="fas fa-newspaper"></i> Loading...
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br></br>

    <div class="container card-body main">
        <div class="form-row text-center tahun">
            <div class="form-group col-md-6">
                <label for="tahunSelect">Pilih Tahun</label>
                <select class="form-control select" id="tahunSelect"></select>
            </div>
        </div>
        <hr>

        <h2 class="text-center">GRAFIK JUMLAH BERITA DALAM 1 TAHUN</h2>
        <div class="row">
            <div class="col-md-12">
                <canvas id="newsChart" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    <br></br>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.getElementById('welcomeMessage').innerText = 'Selamat datang ' + localStorage.getItem('ndepan');
    </script>

    <script>
        function fetchData(tahun) {
            var formData = new FormData();
            formData.append('tahun', tahun);

            return axios({
                method: 'post',
                url: 'https://kel7web.000webhostapp.com/config/sum_beritatahun.php',
                data: formData,
                headers: { 'Content-Type': 'multipart/form-data' }
            });
        }

        function createChart(data) {
            var ctx = document.getElementById('newsChart').getContext('2d');

            // Check if there is an existing chart and destroy it
            var existingChart = Chart.getChart(ctx);
            if (existingChart) {
                existingChart.destroy();
            }

            var gradient = ctx.createLinearGradient(0, 0, 0, 400);
            gradient.addColorStop(0, 'rgba(0, 223, 196, 1)');
            gradient.addColorStop(1, 'rgba(0, 0, 0, 0)');

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.map(item => item.bulan),
                    datasets: [{
                        label: 'Jumlah Berita',
                        data: data.map(item => item.jumlah_berita),
                        backgroundColor: gradient,
                        borderColor: 'rgba(0, 223, 196, 1)',
                        borderWidth: 4
                    }]
                },
                options: {
                    scales: {
                        x: {
                            grid: {
                                color: 'rgba(255, 255, 255, 0.6)'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1,
                                color: 'rgba(255, 255, 255, 0.7)'
                            },
                            grid: {
                                color: 'rgba(255, 255, 255, 0.6)'
                            }
                        }
                    },
                    plugins: {
                        legend: {
                            labels: {
                                color: 'rgba(255, 255, 255, 0.7)'
                            }
                        }
                    }
                }
            });
        }


        function populateSelectOptions(data) {
            var selectElement = document.getElementById('tahunSelect');
            data.forEach(item => {
                var option = document.createElement('option');
                option.value = item.tahun;
                option.text = item.tahun;
                selectElement.add(option);
            });

            var latestYear = data[0].tahun;
            document.getElementById('tahunSelect').value = latestYear;

            fetchData(latestYear).then(response => {
                var chartData = response.data;
                createChart(chartData);
            })
                .catch(error => {
                    console.error('Error fetching data: ', error);
                });
        }

        document.getElementById('tahunSelect').addEventListener('change', function () {
            var selectedYear = this.value;
            fetchData(selectedYear).then(response => {
                var chartData = response.data;
                createChart(chartData);
            })
                .catch(error => {
                    console.error('Error fetching data: ', error);
                });
        });

        axios.get('https://kel7web.000webhostapp.com/config/select_tahun.php')
            .then(response => {
                var tahunData = response.data;
                console.log(tahunData); // Tambahkan ini untuk debugging
                populateSelectOptions(tahunData);
            })
            .catch(error => {
                console.error('Error fetching tahun data:', error);
            });

    </script>

    <script>
        axios.get('https://kel7web.000webhostapp.com/config/sum_berita.php').then(function (response) {
            var dataJumlahBerita = response.data;
            var jumlahBeritaElement = document.getElementById('jumlahBerita');
            jumlahBeritaElement.innerHTML = `<i class="fas fa-newspaper"></i> Jumlah Berita: ${dataJumlahBerita[0].jumlah_berita}`;
        })
            .catch(error => {
                console.error('Error fetching tahun data:', error);
            });
    </script>

    <script>
        function downloadExcel() {
            var selectedYear = document.getElementById('tahunSelect').value;
            fetchData(selectedYear)
                .then(response => {
                    var data = response.data;

                    var ws = XLSX.utils.json_to_sheet(data);

                    var wb = XLSX.utils.book_new(data);
                    XLSX.utils.book_append_sheet(wb, ws, "Laporan");

                    XLSX.writeFile(wb, "laporan_excel_" + selectedYear + ".xlsx");
                })
                .catch(error => {
                    console.error('Error fetching data for Excel:', error);
                });
        }

        function downloadPDF() {
            var canvas = document.getElementById('newsChart');

            var imgData = canvas.toDataURL('image/png');

            var selectedYear = document.getElementById('tahunSelect').value;

            var docDefinition = {
                content: [
                    { text: 'Laporan Tahun ' + selectedYear, style: 'header' },
                    { image: imgData, width: 500 },
                ],
                style: {
                    header: {
                        fontSize: 18,
                        bold: true,
                        margin: [0, 0, 0, 10]
                    },
                },
            };
            pdfMake.createPdf(docDefinition).download('laporan_' + selectedYear + '_pdf.pdf');
        }
    </script>
</body>

</html>

<?php
include('footer.php');
?>