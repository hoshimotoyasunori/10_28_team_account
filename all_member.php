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
        $output .= "<div>{$record["username"]}</div>";
    }
    unset($value);
}




try {
    $user = "root";
    $pass = "";
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=xxx;charset=utf8", $user, $pass);

    //ファイルアップロードがあったとき
    if (isset($_FILES['upfile']['error']) && is_int($_FILES['upfile']['error']) && $_FILES["upfile"]["name"] !== "") {
        //エラーチェック
        switch ($_FILES['upfile']['error']) {
            case UPLOAD_ERR_OK: // OK
                break;
            case UPLOAD_ERR_NO_FILE:   // 未選択
                throw new RuntimeException('ファイルが選択されていません', 400);
            case UPLOAD_ERR_INI_SIZE:  // php.ini定義の最大サイズ超過
                throw new RuntimeException('ファイルサイズが大きすぎます', 400);
            default:
                throw new RuntimeException('その他のエラーが発生しました', 500);
        }

        //画像・動画をバイナリデータにする．
        $raw_data = file_get_contents($_FILES['upfile']['tmp_name']);

        //拡張子を見る
        $tmp = pathinfo($_FILES["upfile"]["name"]);
        $extension = $tmp["extension"];
        if ($extension === "jpg" || $extension === "jpeg" || $extension === "JPG" || $extension === "JPEG") {
            $extension = "jpeg";
        } elseif ($extension === "png" || $extension === "PNG") {
            $extension = "png";
        } elseif ($extension === "gif" || $extension === "GIF") {
            $extension = "gif";
        } elseif ($extension === "mp4" || $extension === "MP4") {
            $extension = "mp4";
        } else {
            echo "非対応ファイルです．<br/>";
            echo ("<a href=\"all_member.php\">戻る</a><br/>");
            exit(1);
        }

        //DBに格納するファイルネーム設定
        //サーバー側の一時的なファイルネームと取得時刻を結合した文字列にsha256をかける．
        $date = getdate();
        $fname = $_FILES["upfile"]["tmp_name"] . $date["year"] . $date["mon"] . $date["mday"] . $date["hours"] . $date["minutes"] . $date["seconds"];
        $fname = hash("sha256", $fname);

        //画像・動画をDBに格納．
        $sql = "INSERT INTO media(fname, extension, raw_data) VALUES (:fname, :extension, :raw_data);";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(":fname", $fname, PDO::PARAM_STR);
        $stmt->bindValue(":extension", $extension, PDO::PARAM_STR);
        $stmt->bindValue(":raw_data", $raw_data, PDO::PARAM_STR);
        $stmt->execute();
    }
} catch (PDOException $e) {
    echo ("<p>500 Inertnal Server Error</p>");
    exit($e->getMessage());
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
    <link rel="stylesheet" href="css/style.css">
    <title>（一覧画面）</title>
</head>

<body>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light mb-2 bg-dark text-white">
            <a class=" navbar-brand  text-white" href="#">ALL-MEMBER</a>
            <div class="dropdown float-right">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    menu
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <a class="nav-link text-dark" href="owner.php">TOP</a>
                    <a class="nav-link text-dark" href="sample.php">予定表</a>
                    <a class="nav-link text-dark" href="meeting.php">ミーティング</a>
                    <a class="nav-link text-dark" href="mom.php">MOM投票</a>
                    <a class="nav-link text-dark" href="logout.php">ログアウト</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- <header>
        <fieldset>
            <legend> </legend>
            <legend class="top">
                <div>ALL-MEMBER</div>
                <div>
                    <a href="owner.php">TOP</a>
                    <a href="sample.php">予定表</a>
                    <a href="meeting.php">ミーティング</a>
                    <a href="mom.php">MOM投票</a>
                    <a href="logout.php">ログアウト</a>
                </div>
            </legend>
        </fieldset>
    </header> -->
    <main>
        <fieldset>
            <legend>
                メンバーリスト
            </legend>
            <div class="box">
                <?= $output ?>
            </div>
        </fieldset>
        <fieldset>
            <legend> </legend>
            <form action="all_member.php" enctype="multipart/form-data" method="post">
                <label>画像/動画アップロード</label>
                <input type="file" name="upfile">
                <br>
                ※画像はjpeg方式，png方式，gif方式に対応しています．動画はmp4方式のみ対応しています．<br>
                <input type="submit" value="アップロード">
            </form>
        </fieldset>
        <fieldset>
            <legend> </legend>
            <?php
            //DBから取得して表示する．
            $sql = "SELECT * FROM media ORDER BY id;";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // echo ($row["id"] . "<br>");
                //動画と画像で場合分け
                $target = $row["fname"];
                if ($row["extension"] == "mp4") {
                    echo ("<video src=\"import_media.php?target=$target\" width=\"426\" height=\"240\" controls></video>");
                } elseif ($row["extension"] == "jpeg" || $row["extension"] == "png" || $row["extension"] == "gif") {
                    echo ("<img src='import_media.php?target=$target'>");
                }
                // echo ("<br><br/>");
            }
            ?>
        </fieldset>
    </main>
    <footer class="bottom"></footer>
    <!-- フッター -->
    <footer class="text-center bg-dark text-white fixed-bottom">
        <a href="index.php">
            <p class="py-3">© 2012-2021_8PoS.Lab</p>
        </a>
    </footer>
    <footer>　　</footer><br>
    <footer>　　</footer>
</body>

</html>