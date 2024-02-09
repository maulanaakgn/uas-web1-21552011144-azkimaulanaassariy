<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json; charset=utf-8');
include '../../public_html/koneksi/koneksi.php';

$tahun = $_POST['tahun'];
$statement = $database_connection->prepare("SELECT months.m AS bulan, COALESCE
    (COUNT(tb_news_catalog.id), 0) AS jumlah_berita
FROM
    (SELECT 1 AS m 
    UNION SELECT 2
    UNION SELECT 3
    UNION SELECT 4
    UNION SELECT 5
    UNION SELECT 6
    UNION SELECT 7
    UNION SELECT 8
    UNION SELECT 9
    UNION SELECT 10
    UNION SELECT 11
    UNION SELECT 12) AS months
LEFT JOIN tb_news_catalog ON MONTH(tb_news_catalog.date) = months.m AND YEAR(tb_news_catalog.date) = ? AND tb_news_catalog.date IS NOT NULL GROUP
BY 
    months.m ORDER BY months.m;");
$statement->execute([$tahun]);
$data = array();
while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
    $data[] = $row;
}
echo json_encode($data);
?>