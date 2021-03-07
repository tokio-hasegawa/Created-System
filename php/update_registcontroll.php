<?php 
session_start();
$array = array();
$row = array();
$message_array = array();
$true_array = array();

//　入力項目の数を数える
foreach ($_POST as $key => $value){
    if (empty($value)){
        array_push($array, $key);
    }
    if(isset($value) && $value != ''){
        $true_array = $true_array + array($key => $value);
        //array($true_array, $key = $value);
    }
  }
//　整合が合わない場合、入力値の保存をした状態で入力画面へ遷移する（戻る）
if (count($array) > 0) {
    $_SESSION['update_keys'] = $true_array;
    $_SESSION['error_keys'] = $array;
    // echo $_SESSION['error_keys'];
    $emptyback = "update.php";
    header("Location:{$emptyback}");
}
// 整合が合っていた場合、確認画面へ遷移する
if(count($true_array) ==13){
    $confirm = "update_confirm.php";
    $_SESSION['update_keys'] = $true_array;
    $_SESSION['error_keys'] = $array;
    $_SESSION['update_registcontroll']=1;
    header("Location:{$confirm}");
    exit;
}

// ログイン情報確認（不正の場合ログイン画面やHPへ遷移する
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
if(isset($_POST['id']) ==false){
    header('Location:index.php');
    exit;
}
?>

