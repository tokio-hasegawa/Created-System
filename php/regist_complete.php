<?php
 session_start();
 
 $message_array = array();
 if(isset($_SESSION["true_keys"])) {
    //echo 'aaaa';
    $message_array = $_SESSION["true_keys"];
     //print_r($message_array);
 }
//  array_key_exists('' , $message_array)

// ログインされていない場合ログイン画面へ遷移
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
if(isset($_SESSION['true_keys'])==false){
    header('Location:index.php');
    exit;
}
 ?>

<?php
// DBへ新規登録をする
mb_internal_encoding("utf-8");
try {
    $pdo = new PDO("mysql:dbname=regaccount;host=localhost;", "root", "");
} catch (PDOException $e){
    exit('エラーが発生したためアカウント登録できません。' . $e->getMessage());
} 
$count = $pdo ->exec("insert into regaccount(family_name,
                                    last_name,
                                    family_name_kana,
                                    last_name_kana,
                                    mail,
                                    password,
                                    gender,
                                    postal_code,
                                    prefecture,
                                    address_1,
                                    address_2,
                                    authority,
                                    registered_time,
                                    update_time)
            values('".$message_array['family_name']."',
                    '".$message_array['last_name']."',
                    '".$message_array['family_name_kana']."',
                    '".$message_array['last_name_kana']."',
                    '".$message_array['mail']."',
                    '".md5($message_array['password'])."',
                    '".$message_array['gender']."',
                    '".$message_array['postal_code']."',
                    '".$message_array['prefecture']."',
                    '".$message_array['address_1']."',
                    '".$message_array['address_2']."',
                    '".$message_array['authority']."',
                    NOW(),
                    NOW())");
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
            <h2>登録完了しました</h2>
            <form action="index.php">
                <div class="submit">
                    <input type="submit" class="button3" value="TOPページへ戻る">
                </div>
            </form>
        </div>

        <div class="footer">
           <p>Programming　Portfolio</p>
    </div>
        <!-- 入力チェックへ遷移 -->
        <?php unset($_SESSION['true_keys']); ?>
    </body>
    
</html>