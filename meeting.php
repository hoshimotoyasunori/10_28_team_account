<?php
session_start();
include("functions.php");
check_session_id();
// DB接続
$pdo = connect_to_db();
$sql = 'SELECT team FROM users';

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
        $output .= "{$record["team"]}";
        // $output .= "<div>{$record["username"]}<br>{$record["mail"]}<br>{$record["password"]}<br><a href='edit.php?id={$record["id"]}'>編集</a>・<a href='delete.php?id={$record["id"]}'>消去</a><br></div>";
    }
    unset($value);
}

?>


<!doctype html>
<html lang="ja">

<head>

    <link rel="stylesheet" href="_shared/style.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSSの読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>TEAM-Meeting</title>
</head>

<body style="background-color:#e3f2fd;">
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light mb-2 bg-dark text-white">
            <a class=" navbar-brand  text-white" href="#">TEAM-Meeting</a>
            <div class="dropdown float-right">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    menu
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <a class="nav-link text-dark" href="owner.php">TOP</a>
                    <a class="nav-link text-dark" href="all_member.php">選手ページ</a>
                    <a class="nav-link text-dark" href="sample.php">月間スケジュール</a>
                    <a class="nav-link text-dark" href="logout.php">ログアウト</a>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <h1 class="heading">Room</h1>
            <p class="note">
                Change Room mode (before join in a room):
                <a href="#">mesh</a> / <a href="#sfu">sfu</a>
            </p>
            <div class="room">
                <div>
                    <video id="js-local-stream"></video>
                    <span id="js-room-mode"></span>:
                    <input type="text" placeholder="Room Name" id="js-room-id">
                    <button id="js-join-trigger">入室</button>
                    <button id="js-leave-trigger">退室</button>
                </div>

                <div class="remote-streams" id="js-remote-streams"></div>

                <div>
                    text-chat
                    <pre class="messages" id="js-messages"></pre>
                    <input type="text" id="js-local-text">
                    <button id="js-send-trigger">送信</button>
                </div>
            </div>
            <p class="meta" id="js-meta"></p>
        </div>
        <script src="//cdn.webrtc.ecl.ntt.com/skyway-4.3.0.js"></script>
        <script src="_shared/key.js"></script>
        <script src="_shared/script.js"></script>
    </main>
    <!-- skyway -->
    <footer class="bottom"></footer>
    <!-- フッター -->
    <footer class="text-center bg-dark text-white fixed-bottom">
        <a href="index.php">
            <p class="py-3">© 2012-2021_8PoS.Lab</p>
        </a>
    </footer>
    <footer>　　</footer>
    <footer>　　</footer>
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, Popper.js, Bootstrap JSの順番に読み込む -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>