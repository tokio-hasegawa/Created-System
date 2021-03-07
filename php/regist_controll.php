<!-- 新規アカウント入力値チェック -->

<?php 
session_start();
$array = array();
$true_array = array();
foreach ($_POST as $key => $value){
    if (empty($value)) {
        array_push($array, $key);
    }
    if(isset($value) && $value != ''){
        $true_array = $true_array + array($key => $value);
    }
  }

//   入力項目数チェック（不正の場合）
if (count($array) > 0) {
    $emptyback = "regist.php";
    $_SESSION['error_keys'] = $array;
    $_SESSION['true_keys'] = $true_array;
    // echo $_SESSION['error_keys'];
    header("Location:{$emptyback}");
}
// 入力項目数チェック（正しい場合
if(count($true_array) ==13){
    $confirm = "regist_confirm.php";
    $_SESSION['true_keys'] = $true_array;
    $_SESSION['regist_controll']=1;
    header("Location:{$confirm}");
    exit;
}

// 未ログイン時に飛ばないように
if(isset($_SESSION['login'])==false){
    print 'ログインされていません';
    header('Location:login.php');
    exit;
}
if(isset($_POST['regist'])==false){
    header('Location:index.php');
    exit;
}
?>