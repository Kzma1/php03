<?php
    require_once('dbc.php');
    connect();
    $dbh = connect();

    // ログイン名引き継ぎ
    // session_start();
    // $userName = $_SESSION['name'];
    
    $id = $_GET["id"];

    // SQL準備
    $stmt = $dbh->prepare('DELETE FROM login2 WHERE id = :id');
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    $status = $stmt->execute();

    if ($status == false) {
        sql_error($status);
    } else {
        redirect('userlist.php');
    }

?>