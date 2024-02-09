<?php
header("Access-Control-Allow-Origin: *");
include "../../public_html/koneksi/koneksi.php";

$id = isset($_POST['id']) ? $_POST['id'] : null;

try {
    $statement = $database_connection->prepare("SELECT * FROM `tb_news_catalog` WHERE `id` = ?");
    $statement->execute([$id]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(["error" => "Data not found"]);
    }
} catch (PDOException $cek_koneksi) {
    die('Error: ' . $cek_koneksi->getMessage());
}
?>