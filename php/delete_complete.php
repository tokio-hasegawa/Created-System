<?php
        $id = filter_input(INPUT_POST, 'id');
        mb_internal_encoding("utf-8");
// DELETE文を変数に格納
$sql = "UPDATE regaccount set delete_flag=1 WHERE id = :id";
 
// 削除するレコードのIDは空のまま、SQL実行の準備をする
try {
        $pdo = new PDO("mysql:dbname=regaccount;host=localhost;", "root", "");
    } catch (PDOException $e){
        exit('エラーが発生したためアカウント登録できません。' . $e->getMessage());
    } 
$stmt = $pdo->prepare($sql);
 
// 削除するレコードのIDを配列に格納する
$params = array(':id'=>$id);
 
// 削除するレコードのIDが入った変数をexecuteにセットしてSQLを実行
$stmt->execute($params);
 
// 削除完了のメッセージ
echo '';

session_start();
// ログインチェック
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
if(isset($_POST['delete'])==false){
    header('Location:index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>アカウント削除完了画面</title>
        <link rel="stylesheet" href="../css/style_complete.css">
    </head>
    <body>
    <div class="header">
            <p><a href="index.php"><img src="../img/login.png"></a></p>
            <div class="process">
                <ul>
                    <li>確認画面</li>
                    <li class="selected">削除完了</li>
                </ul>
            </div>
        </div>
        <div class="main">
            <h2>削除しました</h2>
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