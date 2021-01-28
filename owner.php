<?php
session_start();
include("functions.php");
// check_session_id();
// DB接続
$pdo = connect_to_db();
$sql = 'SELECT team FROM users ';

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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSSの読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <title>TOP</title>
</head>

<body style="background-color:#e3f2fd;">
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light mb-2 bg-dark text-white">
            <a class=" navbar-brand  text-white" href="#">TOP</a>
            <div class="dropdown float-right">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    menu
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <a class="nav-link text-dark" href="introduction.php">企業情報</a>
                    <a class="nav-link text-dark" href="kanri_login.php">管理者ページ</a>
                    <a class="nav-link text-dark" href="login.php">選手ページ</a>
                    <a class="nav-link text-dark" href="meeting.php">ミーティング</a>
                    <a class="nav-link text-dark" href="sample.php">月間スケジュール</a>
                </div>
            </div>
        </nav>
    </header>
    <main>

        <!-- コンテンツ -->
        <div class="container py-4" id="Tool">
            <!-- ３つのコンテンツ説明 -->


            <div class="card-deck">
                <!-- チーム戦略分析 -->
                <div class="card">
                    <!-- <h5 class="card-title">Game Analysis</h5> -->
                    <button><img src="img/001.jpg" class="card-img-top" alt="..."></button>
                    <div class="card-body">
                        <h5 class="card-title">1.全体</h5>
                        <p class="card-text">
                            試合の映像や練習の動画を取り込み、相手チームの分析やチーム内に共通意識をつけるためのミーティングに最適です。</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <!-- ミーティングツール -->
                <div class="card">
                    <button><img src="img/sign.png" class="card-img-top" alt="..."></button>
                    <div class="card-body">
                        <h5 class="card-title">2.BK</h5>
                        <p class="card-text">
                            パソコンやスマホでの動画共有を行い、コメントの書き込み・吹き出しを作ることで選手の考えを共有することができます。</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
                <!-- 骨格検知分析 -->
                <div class="card">
                    <button><img src="img/scrum.jpg" class="card-img-top" alt="..."></button>
                    <div class="card-body">
                        <h5 class="card-title">3.FW</h5>
                        <p class="card-text">体の向きや効率的な体の使い方ができていたのかを確認することができ、より詳細な自身の動作確認を行うことができます。</p>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                    </div>
                </div>
            </div>
        </div>

    </main>
    <footer class="bottom"></footer>
    <!-- フッター -->
    <footer class="text-center bg-dark text-white fixed-bottom">
        <a href="index.php">
            <p class="py-3">© 2012-2021_8PoS.Lab</p>
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