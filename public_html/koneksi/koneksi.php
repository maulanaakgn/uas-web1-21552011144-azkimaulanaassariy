<?php
    $database_hostname = 'localhost';
    $database_username = 'id21854155_kel7web';
    $database_password = 'UASKel7web.';
    $database_name = 'id21854155_db_kel7web';
    $database_port = '3306';

    try{
        $database_connection = new PDO("mysql:host=$database_hostname;port=$database_port;dbname=$database_name",
        $database_username, $database_password);
        $cek = "Koneksi Berhasil";
        //echo $cek;
    }catch(PDOException $x){
        die($x->getMessage());
    }
?>