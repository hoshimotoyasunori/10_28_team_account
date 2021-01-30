<?php
// 送信データのチェック
// var_dump($_GET);
// exit();
$id = $_GET["id"];

// 関数ファイルの読み込み
session_start();
include("functions.php");
check_session_id();

$pdo = connect_to_db();

// データ取得SQL作成
$sql = 'SELECT * FROM team_member_table WHERE id=:id';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は指定の11レコードを取得
    // fetch()関数でSQLで取得したレコードを取得できる
    $record = $stmt->fetch(PDO::FETCH_ASSOC);
    // var_dump($record);
    // exit();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BootstrapのCSS読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <!-- jQuery読み込み -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/login.css">
    <title>（編集画面）</title>
</head>

<body>
    <main>
        <form class="form-inline" action="update.php" method="POST">
            <div class="form-group">
                <label for="exampleInputName1"></label>
                <input type="text" class="form-control" id="exampleInputName1" placeholder="<?= $record["username"] ?>" name="username">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"></label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="<?= $record["mail"] ?>" name="mail">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"></label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="<?= $record["password"] ?>" name="password">
            </div>
            <div class="form-group">
                <label for="exampleInputposition1"></label>
                ポジション：<select name="position" id="">
                    <option value="pr">pr</option>
                    <option value="ho">ho</option>
                    <option value="lo">lo</option>
                    <option value="fl">fl</option>
                    <option value="no8">no8</option>
                    <option value="sh">sh</option>
                    <option value="so">so</option>
                    <option value="cb">cb</option>
                    <option value="wtb">wtb</option>
                    <option value="fb">fb</option>
                    <option value="--">--</option>
                </select>
            </div>
            <input type="hidden" name="id" value="<?= $record["id"] ?>">
            <div class="btn">
                <button class="btn btn-default">更新</button>
            </div>
            <!-- <a href="owner.php">top画面</a>　 　<a href="login.php"> ログイン</a> -->
        </form>

    </main>
</body>

</html>