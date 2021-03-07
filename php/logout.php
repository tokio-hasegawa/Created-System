<!-- ログアウト設定 -->
<?php
session_start();
$_SESSION=array();
if(isset($_COOKIE[session_name()])==true){
    setcookie(session_name(),'',time()-42000,'/');
    header("Location:login.php");
}
session_destroy();
?>