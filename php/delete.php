<!-- レコード削除画面 -->
<!-- DBからレコード出力 -->
<?php
$id = filter_input(INPUT_POST, 'id');
mb_internal_encoding("utf-8");
$pdo = new PDO("mysql:dbname=regaccount;hot=localhost;","root","");
$stmt = $pdo->prepare("select * from regaccount where id= ?");
$stmt->bindvalue(1, $id, PDO::PARAM_STR);
$stmt->execute();
$row = $stmt->fetch();    

// ログインチェック
session_start();
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
if(isset($row['id'])==false){
    header('Location:index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>アカウント削除画面</title>
        <link rel="stylesheet" href="../css/style_delete.css">
    </head>
    <body>
        <div class="header">
        <!-- HPへ遷移 -->
            <p><a href="index.php"><img src="../img/login.png"></a></p>
            <div class="process">
                <ul>
                    <li class="selected">確認画面</li>
                    <li>削除完了</li>
                </ul>
            </div>
        </div>
        <!-- レコード出力 -->
        <div class="main">
        <!-- <form method="post" action="delete_complete.php"> -->

            <form method="post" name="check_form" action="delete_complete.php">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <div class="confirm">
                <dt>名前（姓）</dt>
                <dd><?php echo $row['family_name']; ?></dd>
                <dt>名前（名）</dt>
                <dd><?php echo $row['last_name']; ?></dd>
                <dt>カナ（姓）</dt>
                <dd><?php echo $row['family_name_kana']; ?></dd>
                <dt>カナ（名）</dt>
                <dd><?php echo $row['last_name_kana']; ?></dd>
                <dt>メールアドレス</dt>
                <dd><?php echo $row['mail']; ?></dd>
                <dt>パスワード</dt>
                <dd><?php   echo '非表示';
                            str_repeat("●",mb_strlen($row['password'],"UTF-8")); ?></dd>
                <dt>性別</dt>
                <dd><?php if($row['gender'] == 0){
                                                echo "男";
                                            }else{
                                                echo "女";
                                            }?></dd>
                <dt>郵便番号 </dt>
                <dd><?php echo $row['postal_code'];?></dd>
                <dt>住所（都道府県）</dt>
                <dd><?php echo $row['prefecture'];?></dd>
                <dt>住所（市区町村）</dt>
                <dd><?php echo $row['address_1'];?></dd>
                <dt>住所（番地）</dt>
                <dd><?php echo $row['address_2'];?></dd>
                <dt>アカウント権限</dt>
                <dd><?php if($row['authority']=1){
                                                echo "一般";
                                            }else{
                                                echo "管理者";
                                            };?></dd>
                <div class="submit">
                    <input type="submit" name="delete" class="button1" value="確認する">
                </div>
            </form>
        </div>
    </body>
    <div class="footer">
       <p>Programming　Portfolio</p>
    </div>
</html>