<!-- 管理リスト検索・修正画面 -->

<?php
    // 管理者の場合画面遷移
    session_start();
    mb_internal_encoding("utf-8");
    $pdo = new PDO("mysql:dbname=regaccount;hot=localhost;","root","");
    $stmt = $pdo->query("select * from regaccount order by id desc");
    if($_SESSION['authority']=="1"){
    }else{
        header('Location:index.php');
        exit;
    }
    // ログインしていなかった場合の画面遷移
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
        <title>アカウント管理</title>
        <link rel="stylesheet" href="../css/style_list.css">
    </head>
    <body>
        <div class="header">
            <!-- HPへ遷移 -->
            <p><a href="index.php"><img src="../img/login.png"></a></p>
        </div>
        <div class="main">
            <div class="account">
                <p>アカウント検索</p>
            </div>

        <!-- 絞り込み検索、入力項目 -->
        <form method="post" name="search" action="list.php">
            <div class="search">
                <tr>検索<br>
                    <td>名前（姓）</td>
                    <td><input type="text" name="family_name_code" 
                    value="<?php if( !empty($_POST['family_name_code'])){ echo $_POST["family_name_code"];} ?>"></td>    
                    <td>名前（名）</td>
                    <td><input type="text" name="last_name_code"
                    value="<?php if( !empty($_POST['last_name_code'])){ echo $_POST["last_name_code"];} ?>"></td><br>
                    <td>カナ（姓）</td>
                    <td><input type="text" name="family_name_kana_code"
                    value="<?php if( !empty($_POST['family_name_kana_code'])){ echo $_POST["family_name_kana_code"];} ?>"></td>
                    <td>カナ（名）</td>
                    <td><input type="text" name="last_name_kana_code"
                    value="<?php if( !empty($_POST['last_name_kana_code'])){ echo $_POST["last_name_kana_code"];} ?>"></td><br>
                    <td>メールアドレス</td>
                    <td><input type="text" name="mail_code"
                    value="<?php if( !empty($_POST['mail_code'])){ echo $_POST["mail_code"];} ?>"></td>
                    <td>性別</td>
                    <td><input type="radio" name="gender_code" 
                    value=""<?php if(isset($_POST['gender_code']) && $_POST['gender_code'] == "") { ?> checked<?php }else{ ?> checked<?php }?>>
                        <label for="no_gender">選択しない</label>
                    <input type="radio" name="gender_code" id="male" 
                    value="0"<?php if(isset($_POST['gender_code']) && $_POST['gender_code'] == "0") { ?> checked<?php }?>>
                        <label for="male">男</label>
                        <input type="radio" name="gender_code" id="female" 
                    value="1"<?php if(isset($_POST['gender_code']) && $_POST['gender_code'] == "1") { ?> checked<?php } ?>></td>
                        <label for="female">女</label><br>
                    <td>アカウント権限</td>
                    <td><select name="authority_code">
                            <option value=""<?php echo array_key_exists('authority_code', $_POST) && $_POST['authority_code'] == '' ? 'selected' : ''; ?>>選択しない</option>
                            <option value="0"<?php echo array_key_exists('authority_code', $_POST) && $_POST['authority_code'] == '0' ? 'selected' : ''; ?>>一般</option>
                            <option value="1"<?php echo array_key_exists('authority_code', $_POST) && $_POST['authority_code'] == '1' ? 'selected' : ''; ?>>管理者</option>
                        </select>
                    </td>
                </tr>
                <input type="submit" name="search" value="検索">
            </div>
        </form>
        <table border="1" style="border-collapse: collapse">
            <tr>
                <th>ID</th>
                <th>名前（姓）</th>
                <th>名前（名）</th>
                <th>カナ（姓）</th>
                <th>カナ（名）</th>
                <th>メールアドレス</th>
                <th>性別</th>
                <th>アカウント権限</th>
                <th>削除フラグ</th>
                <th>登録日時</th>
                <th>更新日時</th>
                <th>操作</th>
            </tr>
        <!-- DBへ確認 -->
        <div class="consequent">
            <?php
            try{
                // foreach ($_POST as $key => $value){
                if (isset($_POST['search'])) {
                    $family_name_code = $_POST['family_name_code'];
                    $last_name_code = $_POST['last_name_code'];
                    $family_name_kana_code = $_POST['family_name_kana_code'];
                    $last_name_kana_code = $_POST['last_name_kana_code'];
                    $mail_code =$_POST['mail_code'];
                    $gender_code =$_POST{'gender_code'};
                    $authority_code = $_POST['authority_code'];


                    $family_name_code = htmlspecialchars($family_name_code, ENT_QUOTES, 'UTF-8');
                    $last_name_code = htmlspecialchars($last_name_code, ENT_QUOTES, 'UTF-8');
                    $family_name_kana_code = htmlspecialchars($family_name_kana_code, ENT_QUOTES, 'UTF-8');
                    $last_name_kana_code = htmlspecialchars($last_name_kana_code, ENT_QUOTES, 'UTF-8');
                    $mail_code = htmlspecialchars($mail_code, ENT_QUOTES, 'UTF-8');
                    $gender_code = htmlspecialchars($gender_code, ENT_QUOTES, 'UTF-8');
                    $authority_code = htmlspecialchars($authority_code, ENT_QUOTES, 'UTF-8');

                
                    $dsn ='mysql:dbname=regaccount;host=localhost';
                    $user='root';
                    $password="";
                    $dbh = new PDO($dsn, $user, $password);
                    $dbh -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                    // 部分一致確認
                    $sql = 'SELECT * from regaccount where family_name like "%'.$family_name_code.'%" 
                    AND last_name like "%'.$last_name_code.'%"
                    AND family_name_kana like "%'.$family_name_kana_code.'%"
                    AND last_name_kana like "%'.$last_name_kana_code.'%"
                    AND mail like "%'.$mail_code.'%"
                    AND gender like "%'.$gender_code.'%"
                    AND authority like "%'.$authority_code.'%" order by id desc'; 
                    $stmt = $dbh->prepare($sql);
                    
                    $data[] = $family_name_code;
                    $data[] = $last_name_code;
                    $data[] = $family_name_kana_code;
                    $data[] = $last_name_kana_code;
                    $data[] = $mail_code;
                    $data[] = $gender_code;
                    $data[] = $authority_code;
                    $stmt->execute($data);
                
                
                    $dbh = null;

                    // 結果全表示
                    while ($rec = $stmt->fetch(PDO::FETCH_ASSOC)) {?>
                    <?php 
                        if ($rec == true) {
                            
                            ?><?php
                            $_SESSION['true']=1;
                            $_SESSION['family_name_code']=$family_name_code;
                            $_SESSION['id']=$rec['id'];
                            ?>
                            <tr>
                            <td><?php echo $_SESSION['id'];?></td>
                            <td><?php echo $rec['family_name'];?></td>
                            <td><?php echo $rec['last_name'];?></td>
                            <td><?php echo $rec['family_name_kana'];?></td>
                            <td><?php echo $rec['last_name_kana'];?></td>
                            <td><?php echo $rec['mail'];?></td>
                            <td><?php if($rec['gender']==0){
                                            echo "男";
                                        }else{
                                            echo "女";
                                        } ?></td>
                            <td><?php if($rec['authority']==0){
                                            echo "一般";
                                        }else{
                                            echo "管理者";
                                        } ?></td>
                            <td><?php if($rec['delete_flag']==0){
                            echo "有効";
                        }else{
                            echo "無効";
                        } ?></td>
                            <td><?php echo date('Y/m/d',strtotime($rec['registered_time']));?></td>
                            <td><?php echo date('Y/m/d',strtotime($rec['update_time']));?></td>

                            <!-- レコード変更ボタン -->
                            <td><form action="update.php" method="post"><input type="hidden" name="id" value="<?php echo$rec['id'];?>" /><input type="submit" value="更新" /></form>
                                <form action="delete.php" method="post"><input type="hidden" name="id" value="<?php echo$rec['id'];?>" /><input type="submit" value="削除" /></form></td>
                        <?php
                         } else{
                            echo "エラーです";
                            //  exit;
                        }
                        }
                }
            }catch(Exception $e){
                print 'dberror';
                exit;
            }?>
        </div>
        </table>
        </div>
        <div class="footer">
            <p>Programming　Portfolio</p>
        </div>
        <!-- クッキー対策 -->
        <?php unset($_SESSION["error_keys"]);?>
        <?php unset($_SESSION["update_keys"]);?>
        <?php unset($_SESSION["error"]); ?>
        <?php unset($_SESSION["true"]); ?>
    </body>
</html>