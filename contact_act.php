<?php

include('functions.php');

// データ受け取り
$team = $_POST["team"];
$name = $_POST["name"];
$mail = $_POST["mail"];
$password = $_POST["password"];
$radio = $_POST["radio"];
$message = $_POST["message"];

// DB接続関数
$pdo = connect_to_db();

$sql = 'INSERT INTO users(id, team, name, mail, password, radio, message, created_at) VALUES(NULL,:team, :name, :mail, :password, :radio, :message, sysdate())';

// SQL準備&実行
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':team', $team, PDO::PARAM_STR);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$stmt->bindValue(':radio', $radio, PDO::PARAM_STR);
$stmt->bindValue(':message', $message, PDO::PARAM_STR);

// var_dump($_POST);
// exit();
$status = $stmt->execute();

// データ登録処理後
if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    // 正常にSQLが実行された場合は入力ページファイルに移動し，入力ページの処理を実行する
    header("Location:index.php");
    exit();
}
