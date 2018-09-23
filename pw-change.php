<?php
session_start();
require('dbconnect.php');

if(!isset($_SESSION['id'])) {
    header('Location: top.php');
    exit();
}

$user_id = $_SESSION['id'];
$errors = [];
$pre_pw = '';
$new_pw = '';
$check_pw = '';

// 現在のパスワードと照合するためにユーザー情報を取得
$get_user_sql = 'SELECT * FROM `users` WHERE `user_id` = ?';
$get_user_data = [$user_id];
$stmt = $dbh->prepare($get_user_sql);
$stmt->execute($get_user_data);
$user_info = $stmt->fetch(PDO::FETCH_ASSOC);




if(!empty($_POST)) {
    $new_pw = $_POST['new_password'];
    $pre_pw = $_POST['pre_password'];
    $check_pw = $_POST['check_password'];
    $new_count = strlen($new_pw);
    $pre_count = strlen($pre_pw);
    $check_count = strlen($check_pw);
    // エラーチェック
    if($new_pw == '') {
        $errors['new_pw'] = 'blank';
    } else if($new_count < 4 || $new_count > 20) {
        $errors['new_pw'] = 'length';
    }

    if($pre_pw == '') {
        $errors['pre_pw'] = 'blank';
    } else if($pre_count < 4 || $pre_count > 20) {
        $errors['pre_pw'] = 'length';
    } else if(!password_verify($pre_pw, $user_info['password'])) {
        $errors['pre_pw'] = 'failed';
    }

     if($check_pw == '') {
        $errors['check_pw'] = 'blank';
    } else if($check_count < 4 || $check_count > 20) {
        $errors['check_pw'] = 'length';
    }

    if($new_pw != $check_pw) {
        $errors['check_pw'] = 'differ';
    }



    if(empty($errors)) {
        $pw_sql = 'UPDATE `users` SET `password` = ?';
        $pw_data = array(password_hash($new_pw, PASSWORD_DEFAULT));
        $pw_stmt = $dbh->prepare($pw_sql);
        $pw_stmt->execute($pw_data);
        header('Location: mypage.php?from=pwchanged');
        exit();
    }

}



?>

<!DOCTYPE html>
<html>
<head>
  <title></title>
  <meta charset="utf-8">
  <meta discription="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
  <?php require('header.php'); ?>

<div class="main-body container">
  <div class="row">
    <div class="col-md-8 offset-md-2 reserve-body">
      <div class="col-md-12">
        <div class="form-title">
          <h1>
            ーパスワードを変更するー
          </h1>
          <p>
            現在のパスワードと新しいパスワードを入力してください
          </p>
        </div>
      </div>
        <form action="pw-change.php" method="POST">
          <div class="form-group">
            <label>現在のパスワード</label>
            <input type="password" name="pre_password" class="form-control" value="<?php if(!isset($errors['pre_pw'])){ echo $pre_pw; } ?>" max="20" min="4">
            <?php if(isset($errors['pre_pw']) && $errors['pre_pw'] == 'blank'): ?>
              <p class="error_message">現在のパスワードが入力されていません</p>
            <?php elseif(isset($errors['pre_pw']) && $errors['pre_pw'] == 'length'): ?>
              <p class="error_message">パスワードは4文字以上20文字以下で入力してください</p>
            <?php elseif(isset($errors['pre_pw']) && $errors['pre_pw'] == 'failed'): ?>
              <p class="error_message">パスワードが間違っています</p>
            <?php endif; ?>
            <small class="form-text text-muted">半角英数4文字以上</small>
          </div>
          <div class="form-group">
            <label>新しいパスワード</label>
            <input type="password" name="new_password" class="form-control" value="<?php if(isset($errors['new_pw']) || isset($errors['check_pw']) && $errors['check_pw'] == 'differ'){ echo '';}else{ echo $new_pw; } ?>" max="20" min="4">
            <?php if(isset($errors['new_pw']) && $errors['new_pw'] == 'blank'): ?>
              <p class="error_message">新しいパスワードが入力されていません</p>
            <?php elseif(isset($errors['new_pw']) && $errors['new_pw'] == 'length'): ?>
              <p class="error_message">パスワードは4文字以上20文字以下で入力してください</p>
            <?php endif; ?>
            <small class="form-text text-muted">半角英数4文字以上</small>
          </div>
          <div class="form-group">
            <label>確認用パスワード</label>
            <input type="password" name="check_password" class="form-control" value="<?php if(!isset($errors['check_pw']) && !isset($errors['new_pw'])){ echo $check_pw; } ?>" max="20" min="4">
            <?php if(isset($errors['check_pw']) && $errors['check_pw'] == 'blank'): ?>
              <p class="error_message">確認用パスワードが入力されていません</p>
            <?php elseif(isset($errors['check_pw']) && $errors['check_pw'] == 'length'): ?>
              <p class="error_message">パスワードは4文字以上20文字以下で入力してください</p>
            <?php elseif(isset($errors['check_pw']) && $errors['check_pw'] == 'differ'): ?>
              <p class="error_message">パスワードが一致しません</p>
            <?php endif; ?>
            <small class="form-text text-muted">確認用に新しいパスワードを再度入力してください</small>
          </div>
          <div class="submit-center">
            <input type="submit" name="" value="変更を保存する" class="btn btn-lg submit-color">
          </div>
        </form>
    </div>
  </div>
</div>

  <?php require('footer.php'); ?>

</body>
</html>