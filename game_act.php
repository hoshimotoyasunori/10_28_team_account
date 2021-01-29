<?php
// var_dump($_POST);
// exit();

session_start();
include('functions.php');
check_session_id();

$pdo = connect_to_db();


$gameday = $_POST['gameday'];
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

// var_dump($_POST);
// exit();

// $sql = 'SELECT * FROM game_member_table
//     WHERE pr1=:pr1
//     AND ho=:ho
//     AND pr3=:pr3
//     AND lo4=:lo4
//     AND lo5=:lo5
//     AND fl6=:fl6
//     AND fl7=:fl7
//     AND no8=:no8
//     AND sh=:sh
//     AND so=:so
//     AND wtb11=:wtb11
//     AND cb12=:cb12
//     AND cb13=:cb13
//     AND wtb14=:wtb14
//     AND fb=:fb
//     AND reserve16=:reserve16
//     AND reserve17=:reserve17
//     AND reserve18=:reserve18
//     AND reserve19=:reserve19
//     AND reserve20=:reserve20
//     AND reserve21=:reserve21
//     AND reserve22=:reserve22
//     AND reserve23=:reserve23
//     AND reserve24=:reserve24
//     -- AND is_created = 0';

$sql = 'INSERT INTO game_member_table(id, gameday, enemy, pr1, ho, pr3, lo4, lo5, fl6, fl7, no8, sh, so, wtb11, cb12, cb13, wtb14, fb, reserve16, reserve17, reserve18, reserve19, reserve20, reserve21, reserve22, reserve23, reserve24, created_at) VALUES(NULL, :gameday, :enemy, :pr1, :ho, :pr3, :lo4, :lo5, :fl6, :fl7, :no8, :sh, :so, :wtb11, :cb12, :cb13, :wtb14, :fb, :reserve16, :reserve17, :reserve18, :reserve19, :reserve20, :reserve21, :reserve22, :reserve23, :reserve24, sysdate())';


// var_dump($_POST);
// exit();
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':gameday', $gameday, PDO::PARAM_STR);
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


$status = $stmt->execute();
// var_dump($_POST);
// exit();







if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:game.php");
    exit();
}
