<?php
// var_dump($_POST);
// exit();
// 送信データのチェック
// 送信データ受け取り
$id = $_POST['id'];
// $gameday = $_POST['gameday'];
$enemy = $_POST['enemy'];
$pr1 = $_POST['pr1'];
$ho = $_POST['ho'];
$pr3 = $_POST['pr3'];
$lo4 = $_POST['lo4'];
$lo5 = $_POST['lo5'];
$fl6 = $_POST['fl6'];
$fl7 = $_POST['fl7'];
$no8 = $_POST['no8'];
$sh = $_POST['sh'];
$so = $_POST['so'];
$wtb11 = $_POST['wtb11'];
$cb12 = $_POST['cb12'];
$cb13 = $_POST['cb13'];
$wtb14 = $_POST['wtb14'];
$fb = $_POST['fb'];
$reserve16 = $_POST['reserve16'];
$reserve17 = $_POST['reserve17'];
$reserve18 = $_POST['reserve18'];
$reserve19 = $_POST['reserve19'];
$reserve20 = $_POST['reserve20'];
$reserve21 = $_POST['reserve21'];
$reserve22 = $_POST['reserve22'];
$reserve23 = $_POST['reserve23'];
$reserve24 = $_POST['reserve24'];

// 関数ファイルの読み込み
session_start();
include("functions.php");
check_session_id();

// DB接続
$pdo = connect_to_db();

// UPDATE文を作成&実行
$sql = 'UPDATE game_member_table SET enemy=:enemy, pr1=:pr1, ho=:ho, pr3=:pr3, lo4=:lo4, lo5=:lo5, fl6=:fl6, fl7=:fl7, no8=:no8, sh=:sh, so=:so, wtb11=:wtb11, cb12=:cb12, cb13=:cb13, wtb14=:wtb14, fb=:fb, reserve16=:reserve16, reserve17=:reserve17, reserve18=:reserve18, reserve19=:reserve19, reserve20=:reserve20, reserve21=:reserve21, reserve22=:reserve22, reserve23=:reserve23, reserve24=:reserve24, updated_at=sysdate()  WHERE id =:id';

$stmt = $pdo->prepare($sql);
// $stmt->bindValue(':name', $name, PDO::PARAM_STR);
// $stmt->bindValue(':gameday', $gameday, PDO::PARAM_STR);
$stmt->bindValue(':enemy', $enemy, PDO::PARAM_STR);
$stmt->bindValue(':pr1', $pr1, PDO::PARAM_STR);
$stmt->bindValue(':ho', $ho, PDO::PARAM_STR);
$stmt->bindValue(':pr3', $pr3, PDO::PARAM_STR);
$stmt->bindValue(':lo4', $lo4, PDO::PARAM_STR);
$stmt->bindValue(':lo5', $lo5, PDO::PARAM_STR);
$stmt->bindValue(':fl6', $fl6, PDO::PARAM_STR);
$stmt->bindValue(':fl7', $fl7, PDO::PARAM_STR);
$stmt->bindValue(':no8', $no8, PDO::PARAM_STR);
$stmt->bindValue(':sh', $sh, PDO::PARAM_STR);
$stmt->bindValue(':so', $so, PDO::PARAM_STR);
$stmt->bindValue(':wtb11', $wtb11, PDO::PARAM_STR);
$stmt->bindValue(':cb12', $cb12, PDO::PARAM_STR);
$stmt->bindValue(':cb13', $cb13, PDO::PARAM_STR);
$stmt->bindValue(':wtb14', $wtb14, PDO::PARAM_STR);
$stmt->bindValue(':fb', $fb, PDO::PARAM_STR);
$stmt->bindValue(':reserve16', $reserve16, PDO::PARAM_STR);
$stmt->bindValue(':reserve17', $reserve17, PDO::PARAM_STR);
$stmt->bindValue(':reserve18', $reserve18, PDO::PARAM_STR);
$stmt->bindValue(':reserve19', $reserve19, PDO::PARAM_STR);
$stmt->bindValue(':reserve20', $reserve20, PDO::PARAM_STR);
$stmt->bindValue(':reserve21', $reserve21, PDO::PARAM_STR);
$stmt->bindValue(':reserve22', $reserve22, PDO::PARAM_STR);
$stmt->bindValue(':reserve23', $reserve23, PDO::PARAM_STR);
$stmt->bindValue(':reserve24', $reserve24, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();
// var_dump($_POST);
// exit();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は一覧ページファイルに移動し，一覧ページの処理を実行する
    header("Location:game.php");
    exit();
}
