<?php
header("Access-Control-Allow-Origin: *");
include "../../public_html/koneksi/koneksi.php";

$session_token = $_POST['session_token'];
$ndepan = $_POST["namadepan"];
$nbelakang = $_POST["namabelakang"];
$phone = $_POST["telp"];

if (isset($_FILES['url_image']) && $_FILES['url_image']['error'] === UPLOAD_ERR_OK) {
    $namafile = $_FILES['url_image']['name'];
    $tmp_name = $_FILES['url_image']['tmp_name'];
    $upload_directory = '../photo/';

    move_uploaded_file($tmp_name, $upload_directory . $namafile);

    $statement = $database_connection->prepare("UPDATE tb_user JOIN tb_profile ON tb_user.id = tb_profile.id 
    SET tb_profile.ndepan= ?,
        tb_profile.nbelakang= ?,
        tb_profile.phone= ?,
        tb_profile.image= ?
    WHERE tb_user.session_token = ?");
    $statement->execute([$ndepan, $nbelakang, $phone, $upload_directory . $namafile, $session_token]);
} else {
    $statement = $database_connection->prepare("UPDATE tb_user JOIN tb_profile ON tb_user.id = tb_profile.id 
    SET tb_profile.ndepan= ?,
        tb_profile.nbelakang= ?,
        tb_profile.phone= ?
    WHERE tb_user.session_token = ?");
    $statement->execute([$ndepan, $nbelakang, $phone, $session_token]);
}

$pesan = "Profile berhasil diubah";
echo $pesan;
?>
