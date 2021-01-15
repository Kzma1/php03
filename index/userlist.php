<?php
    require_once('dbc.php');
    connect();
    $dbh = connect();

    session_start();
    $userName = $_SESSION['name'];

    // login2からユーザー一覧をとってくる
    $sql = "SELECT * FROM login2";
    $stmt = $dbh->prepare($sql);
    $status = $stmt->execute();

    // 一覧を表示
    $view = "";
    if ($status == false) {
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
    } else {
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
                $view .=
                '<tr><td>' .  h($result['id']) . '</td><td>' . h($result['name']) . '</td><td>' . h($result['mail']) . 
                '</td><td>' . h($result['pass']) . '</td><td>' . h($result['age']) . '</td>' . 
                '<td><a class="none-style root_authority" href="delete.php?id=' . h($result['id']) . '">削除</a>' . 
                '</td></tr>';
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- jQuery table-->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/js/jquery.tablesorter.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.31.0/css/theme.default.min.css">
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

<style>
#fav-table th {
    background-color: pink;
}
</style>
<script>
    $(document).ready(function() {
        $('#fav-table').tablesorter();
    });
</script>
</head>

<body>
<br>
<br>

    <a id="skippy" class="sr-only sr-only-focusable" href="#content">
        <div class="container">
        <span class="skiplink-text">Skip to main content</span>
    </div>
    </a>

    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <!-- <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a> -->
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="">管理画面</a>
        <!-- <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search"> -->
        <input class="form-control form-control-dark w-100" type="text" placeholder="検索" aria-label="検索">

        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
            <!-- <a class="nav-link" href="#">Sign out</a> -->
            <a class="nav-link" href="../top/logout.php">サインアウト</a>
            </li>
        </ul>
    </nav>

<div class="container-fluid">
    <div class="row">
        
    <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="./top.php">
                        <span data-feather="home"></span>
                            <!-- Dashboard <span class="sr-only">(current)</span> -->
                            <!-- グラフに変化をつけれるようにする -->
                            ダッシュボード <span class="sr-only">(現在位置)
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./userlist.php">
                    <span data-feather="users"></span>
                    <!-- Orders -->
                    <!-- ユーザー削除機能つける -->
                    ユーザー一覧
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="./postlist.php">
                    <span data-feather="file"></span>
                    <!-- Products -->
                    投稿一覧
                    </a>
                </li>
                </ul>

                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                    <!-- <span>Saved reports</span> -->
                    <span>保存したレポート</span>
                    <a class="d-flex align-items-center text-muted" href="#">
                        <span data-feather="plus-circle"></span>
                    </a>
                </h6>

                <ul class="nav flex-column mb-2">
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">
                        <span data-feather="file-text"></span>
                        ユーザー数遷移
                        </a>
                    </li> -->
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">
                        <span data-feather="file-text"></span>
                        投稿頻度
                        </a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="./report.php">
                        <span data-feather="file-text"></span>
                        <!-- Social engagement -->
                        ユーザー年齢層
                        </a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">
                        <span data-feather="file-text"></span>
                        投稿時間帯
                        </a>
                    </li> -->
                </ul>
            </div>
        </nav>

        <div class="card-body">
            <caption>ユーザー一覧</caption>
            <table id="fav-table" class="table table-bordered">
                <thead><tr><th>ID</th><th>NAME</th><th>MAIL</th><th>PASS</th><th>AGE</th></tr></thead>
                <?= $view ?>
            </table>
        </div>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
    feather.replace()
    </script>

    <!-- 削除機能の権限 -->
    <script>

    </script>

</body>
</html>