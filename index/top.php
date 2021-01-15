<?php
$done = 0;
$monthly = [];
$VIEW = "";

function check() {
    require_once('dbc.php');
    connect();
    $dbh = connect();
    // userCountに同じ日のデータがあるか確認
    $sql = "SELECT * FROM userCount WHERE date = CURDATE()";
    $stmt = $dbh->prepare($sql);
    $status = $stmt->execute();

    if ($status==false) {
        $error = $stmt->errorInfo();
        exit("ErrorMessage:".$error[2]);
        } else {
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($result) {
                $done = 1;
            }
        }

        if (date('d') == 15 && $done == 0) {
            // login2から、ユーザー数をとってくる
            $sql = "SELECT * FROM login2";
            $stmt = $dbh->prepare($sql);
            $status = $stmt->execute();

            if ($status == false) {
                $error = $stmt->errorInfo();
                exit("ErrorQuery:".$error[2]);
            } else {
                while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $userCount = $userCount + 1;
                }
            }

            $SQL = "INSERT INTO userCount(id, date, number) VALUES(NULL, sysdate(), :number)";
            $STMT = $dbh->prepare($SQL);
            $STMT->bindValue(':number', $userCount, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
            $STATUS = $STMT->execute();
            if ($STATUS==false) {
            $error = $STMT->errorInfo();
            exit("ErrorMessage:".$error[2]);
            } else {
            }
        }
}

check();

function read() {
    require_once('dbc.php');
    connect();
    $dbh = connect();
    $sql = "SELECT * FROM userCount";
    $stmt = $dbh->prepare($sql);
    $status = $stmt->execute();

    if ($status == false) {
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
    } else {
        global $monthly;
        global $VIEW;
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($monthly, $result['number']);
            $VIEW .=
                '<tr><td>' .  h($result['date']) . '</td><td>' . h($result['number']) . 
                '</td></tr>';
        }
    }
}

read();

$dataCount = count($monthly);

$monthly0 = $monthly[$dataCount - 7];
$monthly1 = $monthly[$dataCount - 6];
$monthly2 = $monthly[$dataCount - 5];
$monthly3 = $monthly[$dataCount - 4];
$monthly4 = $monthly[$dataCount - 3];
$monthly5 = $monthly[$dataCount - 2];
$monthly6 = $monthly[$dataCount - 1];

?>


<!doctype html>
<html lang="ja" >

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
    
    <!-- 共通パーツ読み込み -->
    <script>
        $(function() {
            $("#header").load("header.php");
        });
    </script>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <title>Hello, world!</title>
</head>

<body >
<div id="header"></div>

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

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <!-- <h1 class="h2">Dashboard</h1> -->
                <h1 class="h2">ユーザー数</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Share</button> -->
                        <button type="button" class="btn btn-sm btn-outline-secondary">共有</button>
                        <!-- <button type="button" class="btn btn-sm btn-outline-secondary">Export</button> -->
                        <button type="button" class="btn btn-sm btn-outline-secondary">出力</button>
                    </div>
                    <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        <!-- This week -->
                        今週
                    </button>
                </div>
            </div>

            <canvas class="my-4 w-100" id="myChart" width="900" height="380"></canvas>

            <!-- <h2>Section title</h2> -->
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                <thead><tr><th>年月日</th><th>人数</th></tr></thead>
                <tbody><?= $VIEW ?></tbody>
                </table>
            </div>
        </main>
    </div>
</div>

<!-- Graphs -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
<script>
    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
        labels: ["6ヶ月前", "5ヶ月前", "4ヶ月前", "3ヶ月前", "2ヶ月前", "1ヶ月前", "当月"],
        datasets: [{
            data: [<?= $monthly0 ?>, <?= $monthly1 ?>, <?= $monthly2 ?>, <?= $monthly3 ?>, <?= $monthly4 ?>, <?= $monthly5 ?>, <?= $monthly6 ?>],
            lineTension: 0,
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            borderWidth: 4,
            pointBackgroundColor: '#007bff'
        }]
        },
        options: {
        scales: {
            yAxes: [{
            ticks: {
                beginAtZero: false
            }
            }]
        },
        legend: {
            display: false,
        }
        }
    });
</script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
    feather.replace()
    </script>

    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

</body>
</html>
