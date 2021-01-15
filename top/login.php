<?php
    require_once('../index/dbc.php');
    connect();
    $dbh = connect();

    session_start();
    $mail = $_POST['mail'];

    // メールアドレスで一致するものを検索
    $sql = "SELECT * FROM kanri WHERE mail = :mail";
    $stmt = $dbh->prepare($sql);
    $stmt->bindValue(':mail', $mail);
    $stmt->execute();
    $member = $stmt->fetch((PDO::FETCH_ASSOC));

    //指定したハッシュがパスワードにマッチしているかチェック
    if (password_verify($_POST['pass'], $member['pass'])) {// login_formから来た
        $_SESSION['id'] = $member['id'];
        $_SESSION['name'] = $member['name'];
        redirect('../index/top.php');
    } else {
        $msg = 'メールアドレスもしくはパスワードが間違っています。';
        $link = '<a href="./login_form.php">戻る</a>';
    }
?>
