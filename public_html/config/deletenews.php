<?php
header("Access-Control-Allow-Origin: *");
include "../../public_html/koneksi/koneksi.php";

$id = $_POST["id"];

try {
    $statement = $database_connection->prepare("DELETE FROM `tb_news_catalog` WHERE `tb_news_catalog`.`id` = ?");
    $statement->execute([$id]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    $pesan = "Data berhasil dihapus";
    echo $pesan;
} catch (PDOException $cek_koneksi) {
    die($cek_koneksi->getMessage());
}