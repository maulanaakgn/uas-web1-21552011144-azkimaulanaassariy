<?php
header("Access-Control-Allow-Origin: *");
include "../../public_html/koneksi/koneksi.php";

$session_token = $_POST['session_token'];
$password = $_POST["password"];
$hashedPassword = sha1($password);

$statement = $database_connection->prepare("UPDATE tb_user SET password = ? WHERE session_token = ?");
$statement->execute([$hashedPassword, $session_token]);

$pesan = "Kata sandi berhasil diubah";
echo $pesan;
?>
