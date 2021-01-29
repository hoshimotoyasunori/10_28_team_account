<?php
session_start();
include("functions.php");
check_session_id();
// DB接続
$pdo = connect_to_db();


$sql = 'SELECT * FROM game_member_table order by gameday desc';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    // fetchAll()関数でSQLで取得したレコードを配列で取得できる
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
    $output = "";

    foreach ($result as $record) {
        // $output .= "<td>{$record["team"]}</td>";
        $output .= "<div><h3>{$record["gameday"]}{$record["enemy"]}</h3><br>FW<br>1.{$record["pr1"]}2.{$record["ho"]}3.{$record["pr3"]}<br>6.{$record["fl6"]}4.{$record["lo4"]}5.{$record["lo5"]}7.{$record["fl7"]}<br>8.{$record["no8"]}<br>BK<br>9.{$record["sh"]}10.{$record["so"]}<br>11.{$record["wtb11"]}12.{$record["cb12"]}13.{$record["cb13"]}14.{$record["wtb14"]}<br>15.{$record["fb"]}<br>reserve<br>16.{$record["reserve16"]}17.{$record["reserve17"]}18.{$record["reserve18"]}19.{$record["reserve19"]}20.{$record["reserve20"]}21.{$record["reserve21"]}22.{$record["reserve22"]}23.{$record["reserve23"]}24.{$record["reserve24"]}</div>";
    }
    unset($value);
}



?>

<!doctype html>
<html lang="ja">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSSの読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>∞PoS.Lab</title>
</head>

<body style="background-color:#e3f2fd;">
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light mb-2 bg-dark text-white">
            <a class=" navbar-brand  text-white" href=introduction.php>
                8PoS.Lab</a>
            <div class="dropdown float-right">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    menu
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <a class="nav-link text-dark" href="all_member.php">選手画面</a>
                    <a class="nav-link text-dark" href="logout.php">ログアウト</a>
                </div>
            </div>

        </nav>
    </header>
    <main>
        <div><?= $output ?></div>
    </main>
    <footer class="bottom"></footer>
    <!-- フッター -->
    <footer class="text-center bg-dark text-white fixed-bottom">
        <a href="introduction.php">
            <p class="py-3">© 2012-2021_∞PoS.Lab</p>
        </a>
    </footer>
    <footer>　　</footer>
    <footer>　　</footer>

    <!-- Optional JavaScript -->
    <!-- jQuery first, Popper.js, Bootstrap JSの順番に読み込む -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>