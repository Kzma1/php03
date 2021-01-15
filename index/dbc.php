<?php

function connect() {
    $dsn = 'mysql:dbname=test01; host=localhost; charset=utf8';
    $username = 'root';
    $password = "root";

    try {
        $dbh = new PDO($dsn, $username, $password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]);
    } catch (PDOException $e) {
        echo 'DBConnectError'.$e->getMessage();
        exit();
    }

    return $dbh;
}

function h($s){
    return htmlspecialchars($s, ENT_QUOTES, 'utf-8');
}

function session() {
    session_start();
    $userName = $_SESSION['name'];
    return $userName;
}

//リダイレクト関数: redirect($file_name)
function redirect($file_name) {
    header("Location: $file_name");
    exit();
}

//SQLエラー関数：sql_error($stmt)
function sql_error($stmt) {
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}

?>