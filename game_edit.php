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







$sql = 'SELECT * FROM team_member_table where position like "pr" ';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行を忘れずに

if ($status == false) {
    $error = $stmt->errorInfo(); //失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAllで全部取れる
    // var_dump($result);
    // exit();

    $output1 = "";
    foreach ($result as $record) {
        $output1 .= "<option value='{$record["username"]}'>{$record["username"]}</option>";
    }
    unset($record);
}
//データ参照SQL作成
$sql = 'SELECT * FROM team_member_table where position like "ho"';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行を忘れずに

if ($status == false) {
    $error = $stmt->errorInfo(); //失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAllで全部取れる
    // var_dump($result);
    // exit();

    $output2 = "";
    foreach ($result as $record) {
        $output2 .= "<option value='{$record["username"]}'>{$record["username"]}</option>";
    }
    unset($record);
}
// var_dump($_POST);
// exit();

//データ参照SQL作成
$sql = 'SELECT * FROM team_member_table where position like "lo" ';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行を忘れずに

if ($status == false) {
    $error = $stmt->errorInfo(); //失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAllで全部取れる
    // var_dump($result);
    // exit();

    $output3 = "";
    foreach ($result as $record) {
        $output3 .= "<option value='{$record["username"]}'>{$record["username"]}</option>";
    }
    unset($record);
}
$sql = 'SELECT * FROM team_member_table where position like "fl"';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行を忘れずに

if ($status == false) {
    $error = $stmt->errorInfo(); //失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAllで全部取れる
    // var_dump($result);
    // exit();

    $output4 = "";
    foreach ($result as $record) {
        $output4 .= "<option value='{$record["username"]}'>{$record["username"]}</option>";
    }
    unset($record);
}
$sql = 'SELECT * FROM team_member_table where position like "no8"';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行を忘れずに

if ($status == false) {
    $error = $stmt->errorInfo(); //失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAllで全部取れる
    // var_dump($result);
    // exit();

    $output5 = "";
    foreach ($result as $record) {
        $output5 .= "<option value='{$record["username"]}'>{$record["username"]}</option>";
    }
    unset($record);
}
$sql = 'SELECT * FROM team_member_table where position like "sh"';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行を忘れずに

if ($status == false) {
    $error = $stmt->errorInfo(); //失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAllで全部取れる
    // var_dump($result);
    // exit();

    $output6 = "";
    foreach ($result as $record) {
        $output6 .= "<option value='{$record["username"]}'>{$record["username"]}</option>";
    }
    unset($record);
}
$sql = 'SELECT * FROM team_member_table where position like "so"';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行を忘れずに

if ($status == false) {
    $error = $stmt->errorInfo(); //失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAllで全部取れる
    // var_dump($result);
    // exit();

    $output7 = "";
    foreach ($result as $record) {
        $output7 .= "<option value='{$record["username"]}'>{$record["username"]}</option>";
    }
    unset($record);
}
$sql = 'SELECT * FROM team_member_table where position like "cb"';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行を忘れずに

if ($status == false) {
    $error = $stmt->errorInfo(); //失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAllで全部取れる
    // var_dump($result);
    // exit();

    $output8 = "";
    foreach ($result as $record) {
        $output8 .= "<option value='{$record["username"]}'>{$record["username"]}</option>";
    }
    unset($record);
}
$sql = 'SELECT * FROM team_member_table where position like "wtb"';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行を忘れずに

if ($status == false) {
    $error = $stmt->errorInfo(); //失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAllで全部取れる
    // var_dump($result);
    // exit();

    $output9 = "";
    foreach ($result as $record) {
        $output9 .= "<option value='{$record["username"]}'>{$record["username"]}</option>";
    }
    unset($record);
}
$sql = 'SELECT * FROM team_member_table where position like "fb"';
$stmt = $pdo->prepare($sql);
$status = $stmt->execute(); //実行を忘れずに

if ($status == false) {
    $error = $stmt->errorInfo(); //失敗時はエラー出力
    exit('sqlError:' . $error[2]);
} else {
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAllで全部取れる
    // var_dump($result);
    // exit();

    $output10 = "";
    foreach ($result as $record) {
        $output10 .= "<option value='{$record["username"]}'>{$record["username"]}</option>";
    }
    unset($record);
}

// データ取得SQL作成
$sql = 'SELECT * FROM game_member_table WHERE id=:id';

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
    <title>（一覧画面）</title>
</head>

<body>
    <header>
        <fieldset>
            <legend> </legend>
            <legend class="top">
                <div><?= $record["enemy"] ?></div>
            </legend>
            <legend>
                <a href="owner.php">TOP</a>
                <a href="kanri.php">管理者画面</a>
                <a href="all_member.php">選手画面</a>
                <a href="sample.php">予定表</a>
                <a href="logout.php">ログアウト</a>
            </legend>
        </fieldset>
    </header>
    <main>
        <form class="form-inline" action="game_update.php" method="POST">

            <div class="form-group">
                <!-- 日程：<input type="date" name="gameday" placeholder="試合日"> -->
                <input type="text" name="enemy" class="form-control" id="exampleInputenemy1" value="<?= $record["enemy"] ?>">
                <br>
                メンバー表<br>
                01.<select name="pr1" id="">
                    <?= $output1 ?>
                </select>

                02.<select name="ho" id="">
                    <?= $output2 ?>
                </select>
                03.<select name="pr3" id="">
                    <?= $output1 ?>
                </select>
                <br>
                04.<select name="lo4" id="">
                    <?= $output3 ?>
                </select>
                05.<select name="lo5" id="">
                    <?= $output3 ?>
                </select>
                <br>
                06.<select name="fl6" id="">
                    <?= $output4 ?>
                </select>
                07.<select name="fl7" id="">
                    <?= $output4 ?>
                </select>
                08.<select name="no8" id="">
                    <?= $output5 ?>
                </select>
                <br>
                09.<select name="sh" id="">
                    <?= $output6 ?>
                </select>
                10.<select name="so" id="">
                    <?= $output7 ?>
                </select>
                <br>
                11.<select name="wtb11" id="">
                    <?= $output9 ?>
                </select>
                12.<select name="cb12" id="">
                    <?= $output8 ?>
                </select>
                13.<select name="cb13" id="">
                    <?= $output8 ?>
                </select>
                14.<select name="wtb14" id="">
                    <?= $output9 ?>
                </select>
                <br>
                15.<select name="fb" id="">
                    <?= $output10 ?>
                </select>
                <br>
                16.<select name="reserve16" id="">
                    <?= $output1 ?>
                </select>
                17.<select name="reserve17" id="">
                    <?= $output2 ?>
                </select>
                18.<select name="reserve18" id="">
                    <?= $output1 ?>
                </select>
                19.<select name="reserve19" id="">
                    <?= $output3 ?>
                </select>
                20.<select name="reserve20" id="">
                    <?= $output4 ?>
                </select>
                <br>
                21.<select name="reserve21" id="">
                    <?= $output7 ?>
                </select>
                22.<select name="reserve22" id="">
                    <?= $output8 ?>
                </select>
                23.<select name="reserve23" id="">
                    <?= $output9 ?>
                </select>
                24.<select name="reserve24" id="">
                    <?= $output10 ?>
                </select>


            </div>
            <div class="btn">
                <button class="btn btn-default">送信</button>
            </div>
            <input type="hidden" name="id" value="<?= $record["id"] ?>">

        </form>

        <div><?= $output ?></div>
    </main>
    <footer>

    </footer>
</body>

</html>