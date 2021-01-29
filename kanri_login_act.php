<?php
// var_dump($_POST);
// exit();

session_start();
include('functions.php');
// check_session_id();
$pdo = connect_to_db();


$team = $_POST['team'];
$name = $_POST['name'];
$mail = $_POST['mail'];
$password = $_POST['password'];

// var_dump($_POST);
// exit();


$sql = 'SELECT * FROM users
    WHERE name=:name
    AND mail=:mail
    AND team=:team
    AND password=:password
    -- AND is_created = 0';
// var_dump($_POST);
// exit();
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);
$stmt->bindValue(':mail', $mail, PDO::PARAM_STR);
$stmt->bindValue(':team', $team, PDO::PARAM_STR);
$stmt->bindValue(':password', $password, PDO::PARAM_STR);
$status = $stmt->execute();
// var_dump($_POST);
// exit();






if ($status == false) {
    // SQL実行に失敗した場合はここでエラーを出力し，以降の処理を中止する
    $error = $stmt->errorInfo();
    echo json_encode(["error_msg" => "{$error[2]}"]);
    exit();
} else {
    //成功パターン
    $val = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$val) {   // 該当データがないときはログインページへのリンクを表示
        echo "<p>ログイン情報に誤りがあります.</p>";
        echo '<a href="kanri_login.php">ログイン</a><br>';
        echo '<a href="owner.php">Top画面</a><br>';
        exit();
    } else {
        $_SESSION = array(); // セッション変数を空にする 
        $_SESSION["session_id"] = session_id();
        $_SESSION["is_admin"] = $val["is_admin"];
        $_SESSION["name"] = $val["name"];
        header("Location:kanri.php"); // 一覧ページへ移動 
        exit();
    }
}
