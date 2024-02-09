<?php
header("Access-Control-Allow-Origin: *");
header("Cache-Control: no-cache, no-store, max-age=0, must-revalidate");
header("X-Content-Type-Options: nosniff");
include '../../public_html/koneksi/koneksi.php';
$title = $_POST["judul"];
$content = $_POST["deskripsi"];
$date = $_POST["tanggal"];
$namafile = $_FILES['url_image']['name'];
$tmp_name = $_FILES['url_image']['tmp_name'];

try {
    move_uploaded_file($tmp_name, '../archive/'.$namafile);
    $statement = $database_connection->prepare("INSERT INTO `tb_news_catalog` (`id`, `title`, `desc`, `image`, `date`) VALUE (NULL,?,?,?,?)");
    $statement->execute([$title, $content, 'archive/' . $namafile, $date]);
    $pesan = "Data berhasil ditambah";
    echo $pesan;
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    echo "General error: " . $e->getMessage();
}
?>