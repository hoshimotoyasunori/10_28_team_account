<?php

function connect_to_db()
{

    // DB接続の設定
    $dbn = 'mysql:dbname=xxx;charset=utf8;port=3306;host=localhost';
    $user = 'root';
    $pwd = '';

    try {
        // ここでDB接続処理を実行する
        return new PDO($dbn, $user, $pwd);
    } catch (PDOException $e) {
        // DB接続に失敗した場合はここでエラーを出力し，以降の処理を中止する
        echo json_encode(["db error" => "{$e->getMessage()}"]);
        exit();
    }
}

// ログイン状態のチェック関数
function check_session_id()
{
    if (
        !isset($_SESSION['session_id']) ||      // session_idがない
        $_SESSION['session_id'] != session_id()   // idが一致しない 
    ) {
        header('Location: owner.php');
    } else {
        session_regenerate_id(true);
        $_SESSION['session_id'] = session_id();
    }
}
