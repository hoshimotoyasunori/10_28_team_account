<?php
session_start();
include("functions.php");
check_session_id();
// DB接続
$pdo = connect_to_db();
$sql = 'SELECT * FROM team_member_table';

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
        $output .= "<option>{$record["username"]}</option>";
    }
    unset($value);
}

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
        $output1 .= "<option >{$record["username"]}</option>";
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
        $output2 .= "<option >{$record["username"]}</option>";
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
        $output3 .= "<option >{$record["username"]}</option>";
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
        $output4 .= "<option >{$record["username"]}</option>";
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
        $output5 .= "<option >{$record["username"]}</option>";
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
        $output6 .= "<option >{$record["username"]}</option>";
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
        $output7 .= "<option >{$record["username"]}</option>";
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
        $output8 .= "<option >{$record["username"]}</option>";
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
        $output9 .= "<option >{$record["username"]}</option>";
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
        $output10 .= "<option >{$record["username"]}</option>";
    }
    unset($record);
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
                <div>試合メンバー </div>
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
        <form class="form-inline" action="login_act.php" method="POST">
            <div>FW
                <div class="form-group">
                    01.<select name="pr" id="">
                        <?= $output1 ?>
                    </select>
                </div>
                <div class="form-group">
                    02.<select name="ho" id="">
                        <?= $output2 ?>
                    </select>
                </div>
                <div class="form-group">
                    03.<select name="pr" id="">
                        <?= $output1 ?>
                    </select>
                </div>
                <div class="form-group">
                    04.<select name="lo" id="">
                        <?= $output3 ?>
                    </select>
                </div>
                <div class="form-group">
                    05.<select name="lo" id="">
                        <?= $output3 ?>
                    </select>
                </div>
                <div class="form-group">
                    06.<select name="fr" id="">
                        <?= $output4 ?>
                    </select>
                </div>
                <div class="form-group">
                    07.<select name="fl" id="">
                        <?= $output4 ?>
                    </select>
                </div>
                <div class="form-group">
                    08.<select name="no8" id="">
                        <?= $output5 ?>
                    </select>
                </div>
            </div><br>
            <div>BK
                <div class="form-group">
                    09.<select name="sh" id="">
                        <?= $output6 ?>
                    </select>
                </div>
                <div class="form-group">
                    10.<select name="so" id="">
                        <?= $output7 ?>
                    </select>
                </div>
                <div class="form-group">
                    11.<select name="wtb" id="">
                        <?= $output9 ?>
                    </select>
                </div>
                <div class="form-group">
                    12.<select name="cb" id="">
                        <?= $output8 ?>
                    </select>
                </div>
                <div class="form-group">
                    13.<select name="cb" id="">
                        <?= $output8 ?>
                    </select>
                </div>
                <div class="form-group">
                    14.<select name="wtb" id="">
                        <?= $output9 ?>
                    </select>
                </div>
                <div class="form-group">
                    15.<select name="fb" id="">
                        <?= $output10 ?>
                    </select>
                </div>
            </div><br>
            <div>RESERVE
                <div class="form-group">
                    16.<select name="reserve16" id="">
                        <?= $output1 ?>
                    </select>
                </div>
                <div class="form-group">
                    17.<select name="reserve17" id="">
                        <?= $output2 ?>
                    </select>
                </div>
                <div class="form-group">
                    18.<select name="reserve18" id="">
                        <?= $output1 ?>
                    </select>
                </div>
                <div class="form-group">
                    19.<select name="reserve19" id="">
                        <?= $output3 ?>
                    </select>
                </div>
                <div class="form-group">
                    20.<select name="reserve20" id="">
                        <?= $output4 ?>
                    </select>
                </div>
                <div class="form-group">
                    21.<select name="reserve21" id="">
                        <?= $output7 ?>
                    </select>
                </div>
                <div class="form-group">
                    22.<select name="reserve22" id="">
                        <?= $output8 ?>
                    </select>
                </div>
                <div class="form-group">
                    23.<select name="reserve23" id="">
                        <?= $output9 ?>
                    </select>
                </div>
                <div class="form-group">
                    24.<select name="reserve24" id="">
                        <?= $output10 ?>
                    </select>
                </div>
            </div>

            </div>
            <div class="btn">
                <button class="btn btn-default">送信</button>
            </div>
            <a href="owner.php">top画面</a>
        </form>
    </main>
    <footer>

    </footer>
</body>

</html>