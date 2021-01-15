<?php
// 検索処理
    require_once('dbc.php');
    connect();
    $dbh = connect();
    $searchWord = $_POST["inputWord"];

    $button = '<input type="button" value="feel good">';
    $button2 = '<input type="button" value="削除">';

    session_start();
    $username = $_SESSION['name'];

    // メールアドレスで一致するものを検索
    $sql = "SELECT * FROM toukou WHERE text LIKE '%$searchWord%'";
    $stmt = $dbh->prepare($sql);
    $status = $stmt->execute();

    $view="";
    if ($status==false) {
        //execute（SQL実行時にエラーがある場合）
        $view = "検索結果は存在しません。";
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
    } else {
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            if ( $result ==false) {
                $view = '検索結果は存在しません。';
            } else {
                if ($result) {
                $view .= 
                '<div class="d-flex text-muted pt-3">' .  
                    '<svg class="bd-placeholder-img flex-shrink-0 me-2 rounded" width="32" height="32" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 32x32" preserveAspectRatio="xMidYMid slice" focusable="false">' . 
                        '<title>Placeholder</title>' . 
                        '<rect width="100%" height="100%" fill="#6f42c1"/>' . 
                        '<text x="50%" y="50%" fill="#6f42c1" dy=".3em">32x32</text>' . 
                    '</svg>' . 
                    '<p class="pb-3 mb-0 small lh-sm border-bottom">' . 
                        '<strong class="d-block text-gray-dark">' . h($result['name']) . '</strong>' . h($result['text']) . 
                    '</p>' . 
                '</div>';
                } else {
                    $view = '検索結果は存在しません。';
                }
                var_dump($result);
            }   
        }
    }

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" href="../style/main.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        //共通パーツ読み込み
        $(function() {
            $("#header").load("header.php");
        });
    </script>
    <title>Document</title>
</head>

<body>
    <div id="header">
    </div>

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

        <main class="container">
            <div class="my-3 p-3 bg-white rounded shadow-sm">
                <h6 class="border-bottom pb-2 mb-0">Search Result</h6>
                <div>
                    <?= $view ?>
                </div>
            </div>
        </main>
    </div>
</div>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
    feather.replace()
    </script>

</body>
</html>