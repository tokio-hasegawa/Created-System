<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ログイン画面</title>
        <link rel="stylesheet" href="../css/style_login.css">
    </head>
    <body>
        <div class="header">
        <img src="../img/login.png">
        </div>
        <div class="main">
            <!-- ログインチェックへ遷移 -->
            <form method="post" name="login" action="login_check.php">

                <!-- 入力欄 -->
                <dl>
                    <dt> <p>メールアドレス</p></dt>
                    <dd><input type="text" name="mail" maxlength="100" size="20"></dd><br>
                    <dt>パスワード</dt>       
                    <dd><input type="text" name="password" maxlength="10" size="20"></dd><br>
                </dl>
                <div class="submit">
                    <input type="submit" class="button1" value="ログイン">
                </div>
            </form>
            <!-- エラー時発生 -->
            <div class="error">
                <?php
                    session_start();
                    if(isset($_SESSION['error'])){
                        echo '<p>エラーが発生したためログイン情報を取得できません。</p>';
                    }
                ?>
            </div>
        </div>
    </body>
    <div class="footer">
        <p>Programming　Portfolio</p>
    </div>
    <?php unset($_SESSION["error"]); ?>
</html>