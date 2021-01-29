<?php
session_start();
include('functions.php');
check_session_id();

$user_id = $_GET['user_id'];
$team_member_id = $_GET['team_member_id'];

// var_dump($_GET);
// exit();


$pdo = connect_to_db();

$sql = 'SELECT COUNT(*) FROM like_table WHERE user_id=:user_id AND team_member_id=:team_member_id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
$stmt->bindValue(':team_member_id', $team_member_id, PDO::PARAM_INT);
$status = $stmt->execute();

if ($status == false) {
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
    // エラー処理 
} else {
    $like_count = $stmt->fetch();
    // var_dump($like_count[0]);
    // exit();
    if ($like_count[0] != 0) {
        $sql = 'DELETE FROM like_table WHERE user_id=:user_id AND team_member_id=:team_member_id';
    } else {
        $sql =
            'INSERT INTO like_table(id, user_id, team_member_id, created_at) VALUES(NULL, :user_id, :team_member_id, sysdate())';
    }

    // SQL作成
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':team_member_id', $team_member_id, PDO::PARAM_INT);
    $status = $stmt->execute();

    if ($status == false) {
        // エラー処理 
        $error = $stmt->errorInfo();
        echo json_encode(["error_msg" => "{$error[2]}"]);
        exit();
    } else {
        header('Location:kanri.php');
        exit();
    }
}
