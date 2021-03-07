<?php

try{

// 変数
$address_code = $_POST['mail'];
$pass_code = $_POST['password'];

$address_code = htmlspecialchars($address_code,ENT_QUOTES,'UTF-8');
$pass_code = htmlspecialchars($pass_code,ENT_QUOTES,'UTF-8');

// sqlコネクト
$pass_code = md5($pass_code);
$dsn ='mysql:dbname=regaccount;host=localhost';
$user='root';
$password="";
$dbh = new PDO($dsn,$user,$password);
$dbh -> setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

//sql判定
$sql = "select * from regaccount WHERE delete_flag=0 AND mail= ? AND password= ?";
$stmt = $dbh->prepare($sql);
$data[] = $address_code;
$data[] = $pass_code;
// $data[] = $_POST['authority'];
$stmt->execute($data);

$dbh = null;
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

// メールアドレス・パスワード不一致
if($rec==false){
    session_start();
    $_SESSION['error']=1;
    $_SESSION['address_code']=$address_code;
    header("Location:login.php");
}else{
    session_start();
    //権限値も送信する　　DB接続->特定の値を送信
    // メールアドレス・パスワード一致時
    $_SESSION['login']=1;
    $_SESSION['address_code']=$address_code;
    $_SESSION['pass_code']=$pass_code;
    $_SESSION['authority'] = $rec['authority'];
    header('Location:index.php');
    exit;
}
}catch(Exception $e){
    print 'db接続エラー';
    exit;
}
?>