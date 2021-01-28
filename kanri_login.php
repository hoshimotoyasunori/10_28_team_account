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
    <title>ログイン画面</title>
</head>

<body>

    <header>
        <h1 class="title">管理者ログイン画面</h1>
    </header>
    <main>
        <form class="form-inline" action="kanri_login_act.php" method="POST">
            <div class="form-group">
                <label for="exampleInputName1"></label>
                <input type="text" class="form-control" id="exampleInputName1" placeholder="UserName" name="name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1"></label>
                <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Email" name="mail">
            </div>
            <div class="form-group">
                <label for="exampleInputteam1"></label>
                <input type="text" class="form-control" id="exampleInputteam1" placeholder="team" name="team">
            </div>
            <div class="form-group">
                <label for="exampleInputpass1"></label>
                <input type="password" class="form-control" id="exampleInputpass1" placeholder="password" name="password">
            </div>
            <div class="btn">
                <button class="btn btn-default">送信</button>
            </div>
            <a href="owner.php">top画面</a>
        </form>
    </main>

</body>

</html>