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

    $ten = 0;
    $twenty = 0;
    $thirty = 0;
    $forty = 0;
    $fifty = 0;
    $otherage = 0;
    $total = 0;
    $Percentage_ten = 0;
    $Percentage_twenty = 0;
    $Percentage_thirty = 0;
    $Percentage_forty = 0;
    $Percentage_fifty = 0;
    

    if ($status==false) {
        //execute（SQL実行時にエラーがある場合）
        $error = $stmt->errorInfo();
        exit("ErrorQuery:".$error[2]);
    } else {
        while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
                // ageを代入する
                if ( 10 <= $result['age'] && $result['age'] < 20 ) {
                    $ten = $ten + 1;
                } else if (20 <= $result['age'] && $result['age'] < 30) {
                    $twenty = $twenty + 1;
                } else if (30 <= $result['age'] && $result['age'] < 40) {
                    $thirty = $thirty + 1;
                } else if (40 <= $result['age'] && $result['age'] < 50) {
                    $forty = $forty + 1;
                } else if (50 <= $result['age'] && $result['age'] < 60) {
                    $fifty = $fifty + 1;
                } else {
                    $otherage = $otherage + 1;
                }
            }
            $total = $ten + $twenty + $thirty + $forty + $fifty + $otherage;
            $Percentage_ten = round($ten / $total * 100, 2);
            $Percentage_twenty = round($twenty / $total * 100, 2);
            $Percentage_thirty = round($thirty / $total * 100, 2);
            $Percentage_forty = round($forty / $total * 100, 2);
            $Percentage_fifty = round($fifty / $total * 100, 2);
            $Percentage_other = round($otherage / $total * 100, 2);

    }

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ユーザー年齢層</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/0.2.0/Chart.min.js" type="text/javascript"></script>
    <!-- 共通パーツ読み込み -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
    <script>
    $(function() {
        $("#header").load("header.php");
    });
    </script>
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

    <div>
        <h1>ユーザー年齢層</h1>
        <canvas id="countries" width="600" height="400"></canvas>
    </div>
    <table class="table table-striped table-sm">
                <thead>
                    <tr>
                    <th>年齢</th>
                    <th>人数</th>
                    <th>割合</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td>10代</td>
                    <td><?= $ten ?></td>
                    <td><?= $Percentage_ten ?></td>
                    </tr>
                    <tr>
                    <td>20代</td>
                    <td><?= $twenty ?></td>
                    <td><?= $Percentage_twenty ?></td>
                    </tr>
                    <tr>
                    <td>30代</td>
                    <td><?= $thirty ?></td>
                    <td><?= $Percentage_thirty ?></td>
                    </tr>
                    <tr>
                    <td>40代</td>
                    <td><?= $forty ?></td>
                    <td><?= $Percentage_forty ?></td>
                    </tr>
                    <tr>
                    <td>50代</td>
                    <td><?= $fifty ?></td>
                    <td><?= $Percentage_fifty ?></td>
                    </tr>
                    <tr>
                    <td>その他</td>
                    <td><?= $otherage ?></td>
                    <td><?= $Percentage_other ?></td>
                    </tr>
                </tbody>
                </table>

    </main>
</div>    
</div>
    
    <script>
        var pieData = [
            {
                // 10代
                value: <?= $ten ?>,
                color:"#878BB6"
            },
            {
                // 20代
                value : <?= $twenty ?>,
                color : "#4ACAB4"
            },
            {
                // 30代
                value : <?= $thirty ?>,
                color : "#FF8153"
            },
            {
                // 40代
                value : <?= $forty ?>,
                color : "#FFEA88"
            },
            {
                // 50代
                value : <?= $fifty ?>,
                color : "black"
            },
            {
                // その他
                value : <?= $otherage ?>,
                color : "gray"
            }
        ];

    // Get the context of the canvas element we want to select
    var countries= document.getElementById("countries").getContext("2d");
    new Chart(countries).Pie(pieData);
    </script>

    <!-- Icons -->
<script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
<script>
feather.replace()
</script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>