<!-- レコード編集確認画面 -->

<?php
 session_start();
 $message_array = array();
 if(isset($_SESSION["update_keys"])) {
    $message_array = $_SESSION["update_keys"];
 }

// 管理者権限含むログインされていない場合ログイン画面へ遷移
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
if(isset($_SESSION['update_registcontroll'])==false){
    header('Location:index.php');
    exit;
}    
 ?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>アカウント更新確認画面</title>
        <link rel="stylesheet" href="../css/style_confirm.css">
    </head>
    <body>
        <div class="header">
            <p><a href="index.php"><img src="../img/login.png"></a></p>
            <div class="process">
                <ul>
                    <li>入力画面</li>
                    <li class="selected">確認画面</li>
                    <li>登録完了</li>
                </ul>
            </div>
        </div>
        <div class="main">
        <!-- 出力表示 -->
            <dt>名前（姓）</dt>
            <dd><?php echo $message_array['family_name']; ?></dd>
            <dt>名前（名）</dt>
            <dd><?php echo $message_array['last_name']; ?></dd>
            <dt>カナ（姓）</dt>
            <dd><?php echo $message_array['family_name_kana']; ?></dd>
            <dt>カナ（名）</dt>
            <dd><?php echo $message_array['last_name_kana']; ?></dd>
            <dt>メールアドレス</dt>
            <dd><?php echo $message_array['mail']; ?></dd>
            <dt>パスワード</dt>
            <dd><?php echo str_repeat("●",mb_strlen($message_array['password'],"UTF-8")); ?></dd>
            <dt>性別</dt>
            <dd><?php if($message_array['gender']==0){
                                            echo "男";
                                        }else{
                                            echo "女";
                                        }?></dd>
            <dt>郵便番号 </dt>
            <dd><?php echo $message_array['postal_code'];?></dd>
            <dt>住所（都道府県）</dt>
            <dd><?php echo $message_array['prefecture'];?></dd>
            <dt>住所（市区町村）</dt>
            <dd><?php echo $message_array['address_1'];?></dd>
            <dt>住所（番地）</dt>
            <dd><?php echo $message_array['address_2'];?></dd>
            <dt>アカウント権限</dt>
            <dd><?php if($message_array['authority']=1){
                                            echo "一般";
                                        }else{
                                            echo "管理者";
                                        };?></dd><br>
            <form action="update.php">
                <input type="submit" class="button1" value="前に戻る">
            </form>
            <form action="update_complete.php" method="post">
                <input type="submit" name="update_confirm" class="button1" value="更新する">
            </form>
        </div>
    <div class="footer">
        <p>Programming　Portfolio</p>
    </div>
        <!-- 入力チェックへ遷移 -->
        <?php unset($_SESSION['update_registcontroll']); ?>
    </body>
</html>