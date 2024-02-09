<?php
header("Access-Control-Allow-Origin: *");
include "../../public_html/koneksi/koneksi.php";

$session_token = $_POST['session_token'];

if(isset($session_token)) {
    $statement = $database_connection->prepare("SELECT tb_user.*, tb_profile.* 
        FROM tb_user 
        JOIN tb_profile ON tb_user.id = tb_profile.id
        WHERE tb_user.session_token = ?");
    $statement->execute([$session_token]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo json_encode($result);
    } else {
        echo json_encode(["error" => "Data not found"]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>
