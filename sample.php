<?php
session_start();
include("functions.php");
check_session_id();
//引数の日付けが祝日であれば、一行改行して、祝日名を表示する関数 
//※引数1は日付"2017-05-14"の"Y-m-d"型、引数に2は祝日の配列データこのメソッドを呼ぶときは下のgetHolidays()関数を使って祝日データ配列を作る必要があります。
function display_to_Holidays($date, $Holidays_array)
{
    //祝日データ配列の中に、引数の日付がキーのデータが入ってるか調べます
    if (array_key_exists($date, $Holidays_array)) {
        //引数の日付がキーのデータが入っていたら
        $holidays = "<br/>" . $Holidays_array[$date]; //一行改行、祝日名を代入
        return $holidays;
    }
}

//GoogleカレンダーAPIから祝日を取得
function getHolidays($year)
{

    $api_key = 'AIzaSyAitUXK-67E7MJd1HiMdcGe-JHp3TmV7n8';
    $holidays = array();
    $holidays_id = 'japanese__ja@holiday.calendar.google.com'; // Google 公式版日本語
    //$holidays_id = 'japanese@holiday.calendar.google.com'; // Google 公式版英語
    $url = sprintf(
        'https://www.googleapis.com/calendar/v3/calendars/%s/events?' .
            'key=%s&timeMin=%s&timeMax=%s&maxResults=%d&orderBy=startTime&singleEvents=true',
        $holidays_id,
        $api_key,
        $year . '-01-01T00:00:00Z', // 取得開始日
        $year . '-12-31T00:00:00Z', // 取得終了日
        150 // 最大取得数
    );

    if ($results = file_get_contents($url, true)) {
        //JSON形式で取得した情報を配列に格納
        $results = json_decode($results);
        //年月日をキー、祝日名を配列に格納
        foreach ($results->items as $item) {
            $date = strtotime((string) $item->start->date);
            $title = (string) $item->summary;
            $holidays[date('Y-m-d', $date)] = $title;
        }
        //祝日の配列を並び替え
        ksort($holidays);
    }
    return $holidays;
}

//曜日取得関数 引数は int 曜日の数字
function week_cquisition_int($week)
{
    if ($week == "0") {
        $week_string = "(日)";
    } else if ($week == "1") {
        $week_string = "(月)";
    } else if ($week == "2") {
        $week_string = "(火)";
    } else if ($week == "3") {
        $week_string = "(水)";
    } else if ($week == "4") {
        $week_string = "(木)";
    } else if ($week == "5") {
        $week_string = "(金)";
    } else if ($week == "6") {
        $week_string = "(土)";
    }
    return $week_string;
}

//ページ読込前の設定部分

///////////////////////////////////
//$display_date の日付を変えるとその日のページに変わる & 変数初期化・設定
//////////////////////////////////
$get_display_date = $_GET['first_day_of_month'];
if ($get_display_date == null) {
    //$_GET['first_day_of_month'];がnullだった場合は本日の日付
    $display_date = date("Y-m-01"); //表示日時　ページを開いた時に表示される月の最初の日付 例：2017-05-01 必ずその月の1日が指定される。このページは月で管理していているので、ページを開いた当日の日付ではなく、当日の月の1日を入れる。じゃないと3月31から1ヶ月引くと3月2日になるバグが発生するから
} else {
    //$_GET['first_day_of_month']入ってた場合はその日付
    $display_date = $get_display_date;
}
//表示されている月の初めの日から一週間の曜日を、数値で配列化 表示されてる日が、$week_int_array[0] 次の日が $week_int_array[1]
//文字、例:日 月 火 水 木 金 土 というように配列化 $week_strings_array[] //カレンダーに曜日を表示するときに使う
//表示されている日から一週間を、Ymd例（20170508）こういった型で出力する $week_display_date_Ymd_array 　htmeタグのid属性やname属性で使う
$week_d = $display_date;
$week_int_array = array();
$week_strings_array = array();
$week_display_date_Ymd_array = array();
for ($i = 0; $i < 7; $i++) {
    array_push($week_int_array, date("w", strtotime($week_d))); //配列に追加
    array_push($week_strings_array, mb_substr(week_cquisition_int($i), 1, 1)); //配列に追加　mb_substr()メソッドは文字を置き換えたり抜出するPHPの関数 参考サイト：http://cms.helog.jp/php/substr-multi-byte/
    array_push($week_display_date_Ymd_array, date("Ymd", strtotime($week_d))); //配列に追加

    $week_d = date("Y-m-d", strtotime($week_d . ' +1 day')); //while文で回す為に$week_d変数を、１日インクリメントする
}
$display_day_array = array(); //カレンダーに日を出力するための配列を初期化、表示されてる月の正確な日付が入ってます
$display_year = date("Y", strtotime($display_date)); //ページを開いた時の年を代入 違う月のカレンダーを見ている場合はその年を代入
$display_month = date("m", strtotime($display_date)); //ページを開いた時の月を代入 違う月のカレンダーを見ている場合はその月を代入
$display_day = date("j", strtotime($display_date)); //月の最初である日付、1を代入
// checkdate()関数でその月の性格な日数を求める、参考サイト：https://php1st.com/1001/
while (checkdate($display_month, $display_day, $display_year)) {
    array_push($display_day_array, $display_day);
    $display_day++; //日付変数をインクリメント
}
//カレンダーのname属性を変わって表示させる配列を初期化　0行目の「水」と記載されてるとこなら、「name03」1行目の日曜日なら「name10」2行目の土曜日なら「name26」3行目の月曜日なら「name31」というふうに「"name" 行数 曜日の数値型」で配列に代入します。
$display_tb_name_array = array();
$lines = 0; //下記while文で使うカレンダーの行数を入れる変数
$w = 0; //下記while文で使う曜日の数値化型インクリメント用変数
for ($i = 0; $i < 52; $i++) { //縦7、横7のデザインのカレンダーだから多めに繰り返して作っておく
    if ($i == 7 or $i == 14 or $i == 21 or $i == 28 or $i == 35 or $i == 42 or $i == 49) { //行数は7回ずつくりかえした時に+1してインクリメントする
        $lines++;
        $w = 0;
    }
    array_push($display_tb_name_array, "name" . $lines . $w);
    $w++; //曜日数値をインクリメント
}
$Holidays_array = getHolidays($display_year); //今年の祝日データ配列を作成

//tbタグのid属性を設定する配列を初期化　命名規則は、「
//命名規則は、「"topcalendar_" "line" カレンダーの行数 "_week" 曜日数字 "_holiday" 祝日だったら1、祝日ではなければ0」とします。
$display_tb_id_array = array();
$lines = 0; //下記while文で使うカレンダーの行数を入れる変数
$i = 0;
$month_fast_day_week = date("w", strtotime($display_date)); //月の最初の日の曜日を求める
$month_fast_day_week_int = $month_fast_day_week + 7; //カレンダーの一行目は曜日を出力してるだけだから7を足して、それ以降、祝日のときは1とする。
$w = 0; //下記while文で使う曜日の数値化型インクリメント用変数
$ii = 0;
while ($i < count($display_tb_name_array)) { //上で作ったtbのname属性の配列の数分繰り返す

    if ($ii == 7 or $ii == 14 or $ii == 21 or $ii == 28 or $ii == 35 or $ii == 42 or $ii == 49) { //行数は7回ずつくりかえした時に+1してインクリメントする
        $lines++;
    }

    $display_tb_id = "topcalendar_line" . $lines . "_week" . $w . "_holiday";
    //もし月の初めの日まで何日かあるようなら、そこまでの祝日の命名規則は0にする
    if ($month_fast_day_week_int != 0) {
        $display_tb_id .= "0";
        $month_fast_day_week_int--; //月の初めの日までは祝日を入れない判断に使うのでデクリメント
    } else {
        if (array_key_exists(date("Y-m-d", strtotime($display_year . "-" . $display_month . "-" . $display_day_array[$i])), $Holidays_array)) {
            //祝日配列の日に、その日が入っていれば、1を文字列に追加、入っていなければ0を追加
            $display_tb_id .= "1";
        } else {
            $display_tb_id .= "0";
        }
        $i++;
    }
    array_push($display_tb_id_array, $display_tb_id);

    $ii++;
    $w++;
    //曜日数字用インメント変数なので、7になるまで増えたら、0を代入する
    if ($w == 7) {
        $w = 0;
    }
}
?>

<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSSの読み込み -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <LINK rel="stylesheet" href="css/default.css" type="text/css">
</head>

<body>
    <header class="sticky-top">
        <nav class="navbar navbar-expand-lg navbar-light mb-2 bg-dark text-white">
            <a class=" navbar-brand  text-white" href="#">月間スケジュール</a>
            <div class="dropdown float-right">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    menu
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu1">
                    <a class="nav-link text-dark" href="owner.php">TOP</a>
                    <a class="nav-link text-dark" href="kanri_login.php">管理者画面</a>
                    <a class="nav-link text-dark" href="all_member.php">メンバー</a>
                    <a class="nav-link text-dark" href="meeting.php">ミーティング</a>
                    <a class="nav-link text-dark" href="logout.php">ログアウト</a><br>
                </div>
            </div>
        </nav>
    </header>
    <div>

        <!-- 何月を表示 -->
        <!-- 一ヶ月前のページへのリンク -->
        <a href="sample.php?first_day_of_month=<?php echo date('Y-m-01', strtotime("-1 month", strtotime($display_date))); ?>">
            <<</a> <!-- /一ヶ月前のページへのリンク -->
                <?php echo date('Y-n', strtotime($display_date)); ?>
                <!-- 一ヶ月後のページへのリンク -->
                <a href="sample.php?first_day_of_month=<?php echo date('Y-m-01', strtotime("+1 month", strtotime($display_date))); ?>">>></a>
                <!-- /一ヶ月後のページへのリンク -->
                <br />

                <!-- カレンダー部分 -->


                <table class="topcalendar" border="1">
                    <!-- 曜日表示部分 -->
                    <!-- $week_strings_array[]配列は、[]内に0～6の数値入れることで曜日を出力する配列、このファイル内で定義してる配列 -->
                    <?php $i = 0; ?>
                    <tr>
                        <td class="sun" name=<?php echo $display_tb_name_array[$i]; ?> id=<?php echo $display_tb_id_array[$i];
                                                                                            $i++; ?>><?php echo $week_strings_array[0]; ?></td>
                        <td name=<?php echo $display_tb_name_array[$i]; ?> id=<?php echo $display_tb_id_array[$i];
                                                                                $i++; ?>><?php echo $week_strings_array[1]; ?></td>
                        <td name=<?php echo $display_tb_name_array[$i]; ?> id=<?php echo $display_tb_id_array[$i];
                                                                                $i++; ?>><?php echo $week_strings_array[2]; ?></td>
                        <td name=<?php echo $display_tb_name_array[$i]; ?> id=<?php echo $display_tb_id_array[$i];
                                                                                $i++; ?>><?php echo $week_strings_array[3]; ?></td>
                        <td name=<?php echo $display_tb_name_array[$i]; ?> id=<?php echo $display_tb_id_array[$i];
                                                                                $i++; ?>><?php echo $week_strings_array[4]; ?></td>
                        <td name=<?php echo $display_tb_name_array[$i]; ?> id=<?php echo $display_tb_id_array[$i];
                                                                                $i++; ?>><?php echo $week_strings_array[5]; ?></td>
                        <td class="sat" name=<?php echo $display_tb_name_array[$i]; ?> id=<?php echo $display_tb_id_array[$i];
                                                                                            $i++; ?>><?php echo $week_strings_array[6]; ?></td>
                    </tr>
                    <!-- 日付表示部分 -->
                    <?php
                    //日付はどうやって出力してるかというと、tbのname属性の命名規則は「"name" カレンダーの行数 曜日数字」だから、
                    //初日1日は一行目に出したいから、「"name1" 初日1日の曜日数値」を比較して合ってたら日付を入れてる。
                    //ここを編集するときはインクリメントとか細かいところに注意する事。
                    //それで一回入れたらフラグを立ててそれ以降はフラグで判断して日付を入れてる

                    $ii = 0; //下記のカレンダー日付出力で使うインクリメント変数
                    $display_calendar_flag = 0; //下記のカレンダー日付出力で使うフラグ変数初期化　※月の初日1日目より前をを表示させない為だけに使う変数
                    for ($iii = 0; $iii < 5; $iii++) {
                    ?>
                        <tr>
                            <?php
                            for ($iiii = 0; $iiii < 7; $iiii++) {
                            ?>
                                <td name=<?php echo $display_tb_name_array[$i]; //name属性付与 
                                            ?> id=<?php
                                                    echo $display_tb_id_array[$i]; //id属性付与
                                                    ?>>
                                    <?php
                                    if ($display_calendar_flag == 1) { //flagが1だったら、下記の処理を実行
                                        echo $display_day_array[$ii] //日付を表示
                                            . display_to_Holidays(date("Y-m-d", strtotime($display_year . "-" . $display_month . "-" . $display_day_array[$ii])), $Holidays_array); //祝日があれば一行改行して表示、function.phpの中の関数
                                        $i++;
                                        $ii++;
                                    } elseif ($display_calendar_flag == 0) { //flagが0だったら、下記の処理を実行
                                        if ($display_tb_name_array[$i] == "name1" . date("w", strtotime($display_date))) { //tbのタグのname属性が一緒だったら1日目を表示させる為、下記の処理を実行
                                            echo $display_day_array[$ii] //日付を表示
                                                . display_to_Holidays(date("Y-m-d", strtotime($display_year . "-" . $display_month . "-" . $display_day_array[$ii])), $Holidays_array); //祝日があれば一行改行して表示、function.phpの中の関数
                                            $display_calendar_flag = 1; //flagを1に変える
                                            $ii++;
                                        }
                                        $i++;
                                    }
                                    ?>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
                    <?php //表が縦7行必要な時は、行を追加します。
                    if ((count($display_day_array) == 30 and date("w", strtotime($display_date)) >= 6)
                        or ((count($display_day_array) >= 31 and date("w", strtotime($display_date)) >= 5))
                    ) { //月の日数が30日以上で、且つ、月の最初の1日が金曜か土曜から始まっていたら
                    ?>
                        <tr>
                            <?php
                            for ($iiii = 0; $iiii < 7; $iiii++) {
                            ?>
                                <td name=<?php echo $display_tb_name_array[$i]; //name属性付与 
                                            ?> id=<?php
                                                    echo $display_tb_id_array[$i]; //id属性付与
                                                    ?>>
                                    <?php
                                    if ($display_calendar_flag == 1) { //flagが1だったら、下記の処理を実行
                                        echo $display_day_array[$ii] //日付を表示
                                            . display_to_Holidays(date("Y-m-d", strtotime($display_year . "-" . $display_month . "-" . $display_day_array[$ii])), $Holidays_array); //祝日があれば一行改行して表示、function.phpの中の関数
                                        $i++;
                                        $ii++;
                                    } elseif ($display_calendar_flag == 0) { //flagが0だったら、下記の処理を実行
                                        if ($display_tb_name_array[$i] == "name1" . date("w", strtotime($display_date))) { //tbのタグのname属性が一緒だったら1日目を表示させる為、下記の処理を実行
                                            echo $display_day_array[$ii] //日付を表示
                                                . display_to_Holidays(date("Y-m-d", strtotime($display_year . "-" . $display_month . "-" . $display_day_array[$ii])), $Holidays_array); //祝日があれば一行改行して表示、function.phpの中の関数
                                            $display_calendar_flag = 1; //flagを1に変える
                                            $ii++;
                                        }
                                        $i++;
                                    }
                                    ?>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>
                    <?php
                    }
                    ?>
                    <!-- /日付表示部分 -->
                </table>

    </div>
    <!-- /カレンダー部分 -->

    <!-- Optional JavaScript -->
    <!-- jQuery first, Popper.js, Bootstrap JSの順番に読み込む -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <footer class="text-center bg-dark text-white fixed-bottom">
        <a href="index.php">
            <p class="py-3">© 2012-2021_8PoS.Lab</p>
        </a>
    </footer>
    <footer>　　</footer>
    <footer>　　</footer>
</body>

</html>