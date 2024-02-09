<?php
header("Access-Control-Allow-Origin: *");
include "../../public_html/koneksi/koneksi.php";

function getProtocol() {
    $protocol = isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS'] !== 'off') ? 'https' : 'http';
    return $protocol . "://" . $_SERVER['HTTP_HOST'];
}

$keyword = isset($_POST["key"]) ? $_POST["key"] : '';

$statement = $database_connection->prepare("SELECT * FROM `tb_news_catalog` WHERE `title` LIKE ?");
$statement->execute(["%$keyword%"]);

$data = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $row["no"] = count($data) + 1;
    $row["image"] = getProtocol() . "/" . $row["image"];
    $data[] = $row;
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode(['data' => $data]); 
?>
