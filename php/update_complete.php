<?php
 session_start();
 $message_array = array();

//  データ引き継ぎ
 if(isset($_SESSION["update_keys"])) {
    //echo 'aaaa';
    $message_array = $_SESSION["update_keys"];
 }

//  正しくログインされているか確認
if($_SESSION['authority']=="1"){
}else{
    header('Location:index.php');
    exit;
}
if(isset($_SESSION['login'])==false){
    print 'ログインされていません';
    header('Location:login.php');
    exit;
}
if(isset($_POST['update_confirm'])==false){
    header('Location:index.php');
    exit;
}
?>
<?php
mb_internal_encoding("utf-8");

?>
<?php
try {
    $pdo = new PDO("mysql:dbname=regaccount;host=localhost;", "root", "");
} catch (PDOException $e){
    exit('エラーが発生したためアカウント更新できません。' . $e->getMessage());
} 
// DBの更新を行う
$pdo ->exec("UPDATE regaccount set family_name = '".$message_array['family_name']."',
                                    last_name = '".$message_array['last_name']."',
                                    family_name_kana = '".$message_array['family_name_kana']."',
                                    last_name_kana = '".$message_array['last_name_kana']."',
                                    mail = '".$message_array['mail']."',
                                    password = '".md5($message_array['password'])."',
                                    gender =  '".$message_array['gender']."',
                                    postal_code = '".$message_array['postal_code']."',
                                    prefecture = '".$message_array['prefecture']."',
                                    address_1 = '".$message_array['address_1']."',
                                    address_2 = '".$message_array['address_2']."',
                                    authority = '".$message_array['authority']."',
                                    update_time = NOW()
            where id = '".$message_array['id']."'");
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>アカウント登録完了画面</title>
        <link rel="stylesheet" href="../css/style_complete.css">
    </head>
    <body>
        <div class="header">
        <!-- ボタン押下時HPへ遷移する -->
            <p><a href="index.php"><img src="../img/login.png"></a></p>
            <div class="process">
                <ul>
                    <li>入力画面</li>
                    <li>確認画面</li>
                    <li class="selected">登録完了</li>
                </ul>
            </div>
        </div>
        <div class="main">
            <h2>更新完了しました</h2>
            <form action="index.php">
                <div class="submit">
                    <input type="submit" class="button3" value="TOPページへ戻る">
                </div>
            </form>
        </div>
        <div class="footer">
            <p>Programming　Portfolio</p>
        </div>
    </body> 
</html>