<?php
header("Access-Control-Allow-Origin: *");
include '../../public_html/koneksi/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_depan = $_POST["namadepan"];
    $nama_belakang= $_POST["namabelakang"];
    $email= $_POST["email"];
    $username = $_POST["username"];
    $password = $_POST["password"];

    if (isset($nama_depan, $nama_belakang, $email, $username, $password)) {
        $checkUsernameStatement = $database_connection->prepare("SELECT id FROM tb_user WHERE username = ?");
        $checkUsernameStatement->execute([$username]);
        $existingUser = $checkUsernameStatement->fetch(PDO::FETCH_ASSOC);
        
        $checkUserEmailStatement = $database_connection->prepare("SELECT id FROM tb_profile WHERE email = ?");
        $checkUserEmailStatement->execute([$email]);
        $existingUserEmail = $checkUserEmailStatement->fetch(PDO::FETCH_ASSOC);

        if ($existingUser) {
            echo json_encode(['status' => 'error', 'message' => 'Username sudah digunakan']);
            exit();
        } elseif ($existingUserEmail) {
            echo json_encode(['status' => 'error', 'message' => 'Email sudah digunakan']);
            exit();
        }

        $hashedPassword = sha1($password);
        $insertStatement = $database_connection->prepare("INSERT INTO tb_user (username, password) VALUES (?, ?)");
        $insertStatement->execute([$username, $hashedPassword]);
        
        $lastUserId = $database_connection->lastInsertId();
        
        $insertProfileStatement = $database_connection->prepare("INSERT INTO tb_profile (id, ndepan, nbelakang, email) VALUES (?, ?, ?, ?)");
        $insertProfileStatement->execute([$lastUserId, $nama_depan, $nama_belakang, $email]);

        echo json_encode(['status' => 'success', 'message' => 'Daftar berhasil!']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
    }
    exit();
}
?>
