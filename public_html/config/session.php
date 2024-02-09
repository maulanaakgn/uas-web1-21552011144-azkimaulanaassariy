<?php
header("Access-Control-Allow-Origin: *");
include '../../public_html/koneksi/koneksi.php';

$session_token = $_POST['session_token'];
if(isset($session_token)) {
    $statement = $database_connection->prepare("SELECT tb_user.*, tb_profile.* 
        FROM tb_user 
        JOIN tb_profile ON tb_user.id = tb_profile.id
        WHERE tb_user.session_token = ?");
    $statement->execute([$session_token]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    if($user) {
        echo json_encode(['status' => 'success', 'hasil' => $user]);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid session']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>