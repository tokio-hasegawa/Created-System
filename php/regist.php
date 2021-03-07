<!-- 新規アカウント登録入力画面 -->

<?php
 session_start();
//  ログイン、管理者確認。
 $message_array = array();
 if(isset($_SESSION["error_keys"])) {
    $message_array = $_SESSION["error_keys"];
 }
 $true_array = array();
 if(isset($_SESSION["true_keys"])) {
    $true_array = $_SESSION["true_keys"];
 }
 if($_SESSION['authority']=="1"){
}else{
    header('Location:index.php');
}
// ログインしていない場合、ログイン画面へ遷移
if(isset($_SESSION['login'])==false){
    print 'ログインされていません';
    header('Location:login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>アカウント登録画面</title>
        <link rel="stylesheet" href="../css/style_regist.css">
    </head>
    <body>
        <div class="header">
            <!-- HPへ遷移 -->
            <p><a href="index.php"><img src="../img/login.png"></a></p>
            <div class="process">
                <ul>
                    <li class="selected">入力画面</li>
                    <li>確認画面</li>
                    <li>登録完了</li>
                </ul>
            </div>
        </div>

        <!-- 文字入力＋入力規制＋規制表現 -->
        <!-- 入力値が不正だった場合、各項目に不正エラーを出力する -->
        <div class="main">
            <form method="post" name="check_form" action="regist_controll.php">
                <dl>
                    <dt>名前（姓）</dt>
                    <dd><input type="text" name="family_name" maxlength="10" size="20" pattern="[\u4E00-\u9FFF\u3040-\u309F]*"
                    value="<?php if(isset($true_array['family_name'])){
                        echo $true_array['family_name'];
                    }  ?>"><br>
                    <?php if(in_array("family_name", $message_array)){ echo '名前（性）が未入力です。';} ?></dd>
                    <dt>名前（名）</dt>
                    <dd><input type="text" name="last_name" maxlength="10" size="20" pattern="[\u4E00-\u9FFF\u3040-\u309F]*"
                    value="<?php if(isset($true_array['last_name'])){
                        echo $true_array['last_name'];
                    }  ?>"><br>
                    <?php if(in_array("last_name", $message_array)){ echo '名前（性）が未入力です。';} ?></dd>
                    <dt>カナ（姓）</dt>
                    <dd><input type="text" name="family_name_kana" maxlength="10" size="20" pattern="[\u30A1-\u30F6]*"
                    value="<?php if(isset($true_array['family_name_kana'])){
                        echo $true_array['family_name_kana'];
                    }  ?>"><br>
                    <?php if(in_array("family_name_kana",$message_array)){ echo 'カナ（性）が未入力です。';} ?></dd>
                    <dt>カナ（名）</dt>
                    <dd><input type="text" name="last_name_kana" maxlength="10" size="20" pattern="[\u30A1-\u30F6]*"
                    value="<?php if(isset($true_array['last_name_kana'])){
                        echo $true_array['last_name_kana'];
                    }  ?>"><br>
                    <?php if(in_array("last_name_kana", $message_array)){ echo 'カナ（名）が未入力です。';} ?></dd>
                    <dt>メールアドレス</dt>
                    <dd><input type="email" name="mail" maxlength="100" size="20" pattern="[a-z0-9]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                    value="<?php if(isset($true_array['mail'])){
                        echo $true_array['mail'];
                    }  ?>"><br>

                    <?php if(in_array("mail",$message_array)){ echo 'メールアドレスが未入力です。';} ?></dd>
                    <dt>パスワード</dt>
                    <dd><input type="text" name="password" maxlength="10" size="20" pattern="^[0-9a-z]+$"
                    value="<?php if(isset($true_array['password'])){
                        echo $true_array['password'];
                    }  ?>"><br>
                    <?php if(in_array("password", $message_array)){ echo 'パスワードが未入力です。';} ?></dd>
                    <dt>性別</dt>
                    <dd><input type="radio" name="gender" id="male" 
                    value="0"<?php if(isset($true_array['gender']) == '0') { ?> checked<?php }else{ ?> checked<?php } ?>>
                        <label for="male">男</label>
                    <input type="radio" name="gender" id="female" 
                    value="1"<?php if(isset($true_array['gender']) == '1') { ?> checked<?php } ?>>
                        <label for="female">女</label><br>
                    <dt>郵便番号</dt>
                    <dd><input type="text" name="postal_code" maxlength="7" size="10" pattern="\d{3}-?\d{4}"
                    value="<?php if(isset($true_array['postal_code'])){
                        echo $true_array['postal_code'];
                    }  ?>"><br>

                    <?php if(in_array("postal_code",$message_array)){ echo '郵便番号が未入力です。';} ?></dd>
                    <dt>住所（都道府県）</dt>
                    <dd>
                        <select name="prefecture">
                        <?php                         
                        $number = array (
                            "",
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
                    // 初期空白
                        foreach ( $number as $value ) {
                        $selected = '';
                        if ($true_array['prefecture'] == $value) {
                        $selected = 'selected'; 
                        }
                        echo '<option value="'. $value . '"'. $selected .'>'. $value . '</option>';
                    }?>
                        </select>
                    <br>
                    <?php if(in_array("prefecture",$message_array)){echo "都道府県が未入力です。";} ?></dd>
                    <dt>住所（市区町村）</dt>
                    <dd><input type="text" name="address_1" size="20" maxlength="10"
                        pattern="[-ぁ-んァ-ンヴゔ一-龥0-9０-９ーｧ-ﾝﾞﾟ\s]*"
                        value="<?php if(isset($true_array['address_1'])){
                        echo $true_array['address_1'];
                    }  ?>"><br>

                    <?php if(in_array("address_1", $message_array)){echo "住所（市区町村）が未入力です。";} ?></dd>
                    <dt>住所（番地）</dt>
                    <dd><input type="text" name="address_2" size="20" maxlength="100"
                        pattern="[-ぁ-んァ-ンヴゔ一-龥0-9０-９ーｧ-ﾝﾞﾟ\s]*"
                        value="<?php if(isset($true_array['address_2'])){
                        echo $true_array['address_2'];
                    }  ?>"><br>

                    <?php if(in_array("address_2", $message_array)){echo "住所（番地）が未入力です。";} ?></dd>
                    <dt>アカウント権限</dt>
                    <dd><select name="authority">
                            <option value="0"<?php echo array_key_exists('authority', $true_array) && $true_array['authority'] == '0' ? 'selected' : ''; ?>>一般</option>
                            <option value="1"<?php echo array_key_exists('authority', $true_array) && $true_array['authority'] == '1' ? 'selected' : ''; ?>>管理者</option>
                        </select>
                    <br>
                </dl>
                <div class="submit">
                    <input type="submit" name="regist" class="button1" value="確認する">
                </div>
            </form>
        </div>
        <!-- 入力チェックへ遷移 -->
        <?php unset($_SESSION["error_keys"]); ?>
        <?php unset($_SESSION['regist_controll']); ?>
    </body>
    <div class="footer">
        <p>Programming　Portfolio</p>
    </div>
</html>
