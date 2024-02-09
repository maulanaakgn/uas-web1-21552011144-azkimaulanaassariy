<?php
header("Access-Control-Allow-Origin: *");
include "../../public_html/koneksi/koneksi.php";
$id = $_POST["id"];
$title = $_POST["judul"];
$content = $_POST["deskripsi"];
$date = $_POST["tanggal"];

if (isset($_FILES['url_image']) && $_FILES['url_image']['error'] === UPLOAD_ERR_OK) {
   
    $namafile = $_FILES['url_image']['name'];
    $tmp_name = $_FILES['url_image']['tmp_name'];
    $upload_directory = '../archive/';
    
    move_uploaded_file($tmp_name, $upload_directory . $namafile);
   
    $statement = $database_connection->prepare("UPDATE `tb_news_catalog` SET `title`=?, `desc`=?, `image`=?, `date`=? WHERE `id`=?");
    $statement->execute([$title, $content, $upload_directory . $namafile, $date, $id]);
} else {
  
    $statement = $database_connection->prepare("UPDATE `tb_news_catalog` SET `title`=?, `desc`=?, `date`=? WHERE `id`=?");
    $statement->execute([$title, $content, $date, $id]);
}
$pesan = "Data berhasil diubah";
echo $pesan;
?>