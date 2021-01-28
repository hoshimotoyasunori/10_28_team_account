<?php
if (isset($_GET["target"]) && $_GET["target"] !== "") {
    $target = $_GET["target"];
} else {
    header("Location: all_member.php");
}
$MIMETypes = array(
    'png' => 'image/png',
    'jpeg' => 'image/jpeg',
    'gif' => 'image/gif',
    'mp4' => 'video/mp4'
);
try {
    $user = "root";
    $pass = "";
    $pdo = new PDO("mysql:host=127.0.0.1;dbname=xxx;charset=utf8", $user, $pass);
    $sql = "SELECT * FROM media WHERE fname = :target;";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":target", $target, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    header("Content-Type: " . $MIMETypes[$row["extension"]]);
    echo ($row["raw_data"]);
} catch (PDOException $e) {
    echo ("<p>500 Inertnal Server Error</p>");
    exit($e->getMessage());
}
