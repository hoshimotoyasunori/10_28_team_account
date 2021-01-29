</html>

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

    <link rel="stylesheet" href="css/login.css">
    <title>登録画面</title>
</head>

<body>

    <header>
        <h1 class="title">メンバー追加</h1>
    </header>
    <main>
        <form class="form-inline" action="register_act.php" method="POST">
            <div class="form-group">
                <label for="exampleInputName1"></label>
                <input type="text" class="form-control" id="exampleInputName1" placeholder="UserName" name="username">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"></label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email" name="mail">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1"></label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
            </div>
            <div class="form-group">
                <label for="exampleInputposition1"></label>
                ポジション：<select name="position" id="">
                    <option value="pr">pr</option>
                    <option value="ho">ho</option>
                    <option value="lo">lo</option>
                    <option value="fl">fl</option>
                    <option value="no8">no8</option>
                    <option value="sh">sh</option>
                    <option value="so">so</option>
                    <option value="cb">cb</option>
                    <option value="wtb">wtb</option>
                    <option value="fb">fb</option>
                    <option value="--">--</option>
                </select>
            </div>
            <div class="btn">
                <button class="btn btn-default">送信</button>
            </div>
            <a href="owner.php">top画面</a>　 　<a href="login.php"> ログイン</a>
        </form>
    </main>

</body>

</html>