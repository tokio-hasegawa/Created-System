<?php
$message_array = array();
session_start();

// ログインされていない時、自動的にログイン画面へ遷移する
if(isset($_SESSION['login'])==false){
    print 'ログインされていません';
    header('Location:login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <title>ホームページ</title>
        <link rel="stylesheet" href="../css/style_index.css">
    </head>
    <body>
        <header>
            <div class="wrapper">
                <p><a href="index.php"><img src="../img/login.png"></a></p>
                <div class="logo">
                 <ul>
                    <li>トップ</li>
                    <li>プロフィール</li>
                    <li>登録フォーム</li>
                    <li>問い合わせ</li>
                    <li>その他</li>
                    <!-- 管理者ログインのみ項目がでる -->
                    <?php if($_SESSION['authority']=="1"){  ?>
                            <li><a href="list.php">アカウント管理</a></li>
                            <li><a href="regist.php">アカウント登録</a></li>
                    <?php } ?>
                    <li><a href="logout.php">ログアウト</a></li>
                 </ul>
                </div>
            </div>
        </header>
            <main>
                <h1>プログラミングに役立つ書籍</h1>
                <p class="date">2017年1月15日</p>
                <p><img src="../img/bookstore.jpg" class="picture"></p>
                <p class="desc">テスト画面</p>

                <div id="article">
                    <p>関連記事</p>
                </div>
                
                <div class="box">
                    <div class="one">
                        <img src="../img/pic1.jpg">
                        <p>ドメイン取得方法</p>
                    </div>
                    <div class="one">
                        <img src="../img/pic2.jpg">
                        <p>快適な職場環境</p>
                    </div>
                    <div class="one">
                        <img src="../img/pic3.jpg">
                        <p>Linuxの基礎</p>
                    </div>
                    <div class="one">
                        <img src="../img/pic4.jpg">
                        <p>マーケティング入門</p>
                    </div>
                </div>
                <div class="double">
                    <div class="two">
                        <img src="../img/pic5.jpg">
                        <p>アクティブラーニング</p>
                    </div>

                    <div class="two">
                        <img src="../img/pic6.jpg">
                        <p>CSSの効率的な勉強方法</p>
                    </div>

                    <div class="two">
                        <img src="../img/pic7.jpg">
                        <p>リーダブルコードとは</p>
                    </div>

                    <div class="two">
                        <img src="../img/pic8.jpg">
                        <p>HTML5の可能性</p>
                    </div>
                </div>                
            </main>

            <sub>
                <div class="famous">
                    <h2>人気の記事</h2>
                    <ul>
                        <li>PHPオススメ本</li>
                        <li>PHP　MyAdminの使い方</li>
                        <li>いま人気のエディタTops</li>
                        <li>HTMLの基礎</li>
                    </ul>
                </div>
                <div class="recog">
                    <h2>オススメリンク</h2>
                    <ul>
                        <li>XAMPPのダウンロード</li>
                        <li>Eclipseのダウンロード</li>
                        <li>Braketsのダウンロード</li>
                    </ul>
                </div>
                <div class="categ">
                    <h2>カテゴリ</h2>
                    <ul>
                        <li>HTML</li>
                        <li>PHP</li>
                        <li>MySQL</li>
                        <li>javaScript</li>
                    </ul>
                </div>
            </sub>
        <footer>
            <p>Programming　Portfolio</p>
        </footer>
    </body>
    <?php unset($_SESSION["true_keys"]);?>
    <?php unset($_SESSION['id']);?>
    <?php unset($_SESSION["error_keys"]);?>
    <?php unset($_SESSION["update_keys"]);?>
    <?php unset($_SESSION['regist_controll']); ?>

</html>