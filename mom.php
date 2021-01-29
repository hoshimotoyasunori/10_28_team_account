<?php
session_start();
include("functions.php");
check_session_id();

$user_id = $_SESSION['session_id'];
// var_dump($_SESSION);
// var_dump($user_id);
// exit();
//// idが入ってない
// DB接続
$pdo = connect_to_db();
$sql = 'SELECT * FROM team_member_table LEFT OUTER JOIN (SELECT team_member_id, COUNT(id) AS cnt
        FROM like_table GROUP BY team_member_id) AS likes
        ON team_member_table.id = likes.team_member_id';
// SQL準備&実行
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
// データ登録処理後
// var_dump($_POST);
// exit();
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
        $output .= "<div>{$record["username"]}<a href='like_create.php?user_id={$user_id}&team_member_id={$record["id"]}'>like{$record["cnt"]}</a><br></div>";
    }
    unset($value);
}


$sql = 'SELECT team_member_id, COUNT(id) as cnt from like_table group by team_member_id asc limit 5';

$stmt = $pdo->prepare($sql);
$status = $stmt->execute();
// データ登録処理後
// var_dump($_POST);
// exit();
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    // fetchAll()関数でSQLで取得したレコードを配列で取得できる
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);  // データの出力用変数（初期値は空文字）を設定
    $output1 = "";

    foreach ($result as $record) {
        $output1 .= "<td>{$record["cnt"]}</td>";
        // $output1 .= "<div>{$record["username"]}<a href='like_create.php?user_id={$user_id}&team_member_id={$record["id"]}'>like{$record["cnt"]}</a><br></div>";
    }
    unset($value);
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BootstrapのCSS読み込み -->
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- jQuery読み込み -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <title>（一覧画面）</title>
</head>

<body>
    <header>
        <fieldset>
            <legend> </legend>
            <legend class="top">
                <div>MOM </div>
            </legend>
            <legend>
                <a href="owner.php">TOP</a>
                <a href="all_member.php">選手画面</a>
                <a href="sample.php">予定表</a>
                <a href="game.php">試合メンバー</a>
                <a href="logout.php">ログアウト</a>
            </legend>
        </fieldset>
    </header>
    <main>

        <?= $output ?>
    </main>
    <br><br>
    <div>MON of THE MATCH</div><br>
    <?= $output1 ?>
    <footer>

    </footer>
</body>

</html>