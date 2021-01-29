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
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <!-- jQuery読み込み -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- BootstrapのJS読み込み -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

    <title>（編集画面）</title>
</head>

<body>
    <form action="update.php" method="POST">
        <fieldset>
            <legend>（編集画面）</legend>


            <div>
                username:<input type="text" name="username" value="<?= $record["username"] ?>">
            </div>
            <div>
                mail:<input type="text" name="mail" value="<?= $record["mail"] ?>">
            </div>
            <div>
                password:<input type="text" name="password" value="<?= $record["password"] ?>">
            </div>
            <div>
                position:<select name="position" id="">

                    <!-- <option value=""><?= $record["position"] ?></option> -->
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
                </select>
            </div>
            <div>
                <button>更新</button>
            </div>
            <input type="hidden" name="id" value="<?= $record["id"] ?>">
        </fieldset>

    </form>

</body>

</html>