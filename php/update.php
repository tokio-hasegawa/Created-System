<!-- レコード編集画面 -->

<?php
 session_start();
 mb_internal_encoding("utf-8");
 $row = array();
 $message_array = array();// エラーの時に使う

//  正誤関わらずデータ保持状態にする
if (isset($_SESSION['error_keys'])) {
    $message_array = $_SESSION['error_keys'];
    $row = $_SESSION['error_keys'];
}else{
    $id = filter_input(INPUT_POST, 'id');
    $pdo = new PDO("mysql:dbname=regaccount;hot=localhost;","root","");
    $stmt = $pdo->prepare("select * from regaccount where id= ?");
    $stmt->bindvalue(1, $id, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
}
if(isset($_SESSION["update_keys"])) {
    $row = $_SESSION["update_keys"];
}else{
    $id = filter_input(INPUT_POST, 'id');
    $pdo = new PDO("mysql:dbname=regaccount;hot=localhost;","root","");
    $stmt = $pdo->prepare("select * from regaccount where id= ?");
    $stmt->bindvalue(1, $id, PDO::PARAM_STR);
    $stmt->execute();
    $row = $stmt->fetch();
}

// 管理者権限含むログインされていない場合ログイン画面へ遷移
if($_SESSION['authority']=="1"){
}else{
    header('Location:index.php');
    exit;
}
if(isset($_SESSION['login'])==false){
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
        <title>アカウント更新画面</title>
        <link rel="stylesheet" href="../css/style_regist.css">
    </head>
    <body>
        <div class="header">
            <p><a href="index.php"><img src="../img/login.png"></a></p>
            <div class="process">
                <ul>
                    <li class="selected">入力画面</li>
                    <li>確認画面</li>
                    <li>登録完了</li>
                </ul>
            </div>
        </div>
        <div class="main">
        <!-- データ入力、IDで管理 -->
        <!-- 入力時同様規制表現・エラーメッセージを入れる -->
            <form method="post" name="update_form" action="update_registcontroll.php">
                <dl>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                    <dt>名前（姓）</dt>
                    <dd><input type="text" name="family_name" maxlength="10" size="20" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" 
                    value="<?php if(in_array("family_name", $message_array)){echo "";}else{echo $row['family_name'];} ?>"><br>
                    <?php if(in_array("family_name", $message_array)){ echo '名前（性）が未入力です。';} ?></dd>
                    <dt>名前（名）</dt>
                    <dd><input type="text" name="last_name" maxlength="10" size="20" pattern="[\u4E00-\u9FFF\u3040-\u309Fー]*" 
                    value="<?php if(in_array("last_name", $message_array)){echo "";}else{echo $row['last_name'];} ?>"><br>
                    <?php if(in_array("last_name", $message_array)){ echo '名前（名）が未入力です。'; } ?></dd>
                    <dt>カナ（姓）</dt>
                    <dd><input type="text" name="family_name_kana" maxlength="10" size="20" pattern="[\u30A1-\u30F6]*" 
                    value="<?php if(in_array("family_name_kana", $message_array)){echo "";}else{echo $row['family_name_kana'];} ?>"><br>
                    <?php if(in_array("family_name_kana",$message_array)){ echo 'カナ（性）が未入力です。';} ?></dd>
                    <dt>カナ（名）</dt>
                    <dd><input type="text" name="last_name_kana" maxlength="10" size="20" pattern="[\u30A1-\u30F6]*" 
                    value="<?php if(in_array("last_name_kana", $message_array)){echo "";}else{echo $row['last_name_kana'];} ?>"><br>
                    <?php if(in_array("last_name_kana", $message_array)){ echo 'カナ（名）が未入力です。';} ?></dd>
                    <dt>メールアドレス</dt>
                    <dd><input type="email" name="mail" maxlength="100" size="20" pattern="[a-z0-9]+@[a-z0-9.-]+\.[a-z]{2,3}$" 
                    value="<?php if(in_array("mail", $message_array)){echo "";}else{echo $row['mail'];} ?>"><br>
                    <?php if(in_array("mail",$message_array)){ echo 'メールアドレスが未入力です。';} ?></dd>
                    <dt>パスワード</dt>
                    <dd><input type="text" name="password" maxlength="10" size="20" pattern="^[0-9a-z]+$"><br>
                    <?php if(in_array("password", $message_array)){ echo 'パスワードが未入力です。';} ?></dd>
                    <dt>性別</dt>
                    <dd><input type="radio" name="gender" id="male" 
                    value="0"<?php if($row['gender'] == '0') { ?> checked<?php } ?>>
                        <label for="male">男</label>
                    <input type="radio" name="gender" id="female" 
                    value="1"<?php if($row['gender'] == '1') { ?> checked<?php } ?>>
                        <label for="female">女</label></dd>
                    <dt>郵便番号</dt>
                    <dd><input type="text" name="postal_code" maxlength="7" size="10" pattern="\d{3}-?\d{4}" 
                    value="<?php if(in_array("postal_code", $message_array)){echo "";}else{echo $row['postal_code'];} ?>"><br>
                    <?php if(in_array("postal_code",$message_array)){ echo '郵便番号が未入力です。';} ?></dd>
                    <dt>住所（都道府県）</dt>
                    <dd>
                        <select name="prefecture" >
                        <?php
                        $number = array (
                        "北海道",
                        "青森県",
                        "岩手県",
                        "宮城県",
                        "秋田県",
                        "山形県",
                        "福島県",
                        "茨城県",
                        "栃木県",
                        "群馬県",
                        "埼玉県",
                        "千葉県",
                        "東京都",
                        "神奈川県",
                        "新潟県",
                        "富山県",
                        "石川県",
                        "福井県",
                        "山梨県",
                        "長野県",
                        "岐阜県",
                        "静岡県",
                        "愛知県",
                        "三重県",
                        "滋賀県",
                        "京都府",
                        "大阪府",
                        "兵庫県",
                        "奈良県",
                        "和歌山県",
                        "鳥取県",
                        "島根県",
                        "岡山県",
                        "広島県",
                        "山口県",
                        "徳島県",
                        "香川県",
                        "愛媛県",
                        "高知県",
                        "福岡県",
                        "佐賀県",
                        "長崎県",
                        "熊本県",
                        "大分県",
                        "宮崎県",
                        "鹿児島県",
                        "沖縄県"
                    );
                    foreach ( $number as $value ) {
                        $selected = '';
                        if ($row['prefecture'] == $value) {
                        $selected = ' selected'; 
                        }
                        echo '<option value="'. $value . '"'. $selected .'>'. $value . '</option>';
                    }
                    ?>
                    </select>
                    <br><?php if(in_array("prefecture",$message_array)){echo "都道府県が未入力です。";} ?>
                    </dd>
                    <dt>住所（市区町村）</dt>
                    <dd><input type="text" name="address_1" size="20" maxlength="10"
                        pattern="[-ぁ-んァ-ンヴゔ一-龥0-9０-９ーｧ-ﾝﾞﾟ\s]*" 
                        value=<?php if(in_array('address_1', $message_array)){ echo ' ';}else{echo $row['address_1'];} ?>><br>
                        <?php if(in_array("address_1", $message_array)){echo "住所（市区町村）が未入力です。";} ?></dd>
                    <dt>住所（番地）</dt>
                    <dd><input type="text" name="address_2" size="20" maxlength="100"
                        pattern="[-ぁ-んァ-ンヴゔ一-龥0-9０-９ーｧ-ﾝﾞﾟ\s]*" 
                        value="<?php if(in_array("address_2", $message_array)){echo "";}else{echo $row['address_2'];} ?>"><br>
                        <?php if(in_array("address_2", $message_array)){echo "住所（番地）が未入力です。";} ?></dd>
                    <dt>アカウント権限</dt>
                    <dd><select name="authority">
                            <?php
                            $authority = array(
                                "一般",
                                "管理者"
                            );
                            foreach($authority as $value) {
                                $selected = "";
                                if($row['authority'] == $value){
                                    $selected = "selected";
                                }
                                echo '<option value="'. $value . '"'. $selected .'>'. $value . '</option>';
                            }
                            ?>
                        </select>
                    </dd> 
                </dl>
                <div class="submit">
                    <input type="submit" class="button1" value="確認する">
                </div>
            </form>
        </div>
        <!-- 入力チェックへ遷移 -->
        <?php unset($_SESSION['update_registcontroll']); ?>
    </body>
    <div class="footer">
       <p>Programming　Portfolio</p>
    </div>
</html>