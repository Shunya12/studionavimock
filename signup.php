<?php
  session_start();
  $errors = array();


  if(isset($_GET['action']) && $_GET['action'] == 'rewrite') {
    $_POST['input_name'] = $_SESSION['register']['name'];
    $_POST['input_email'] = $_SESSION['register']['email'];
    $_POST['input_password'] = $_SESSION['register']['password'];

    $errors['rewrite'] = true;
  }

  $name = '';
  $email = '';
//以下、入力チェック

  if(!empty($_POST)) {
    $name = $_POST['input_name'];
    $email = $_POST['input_email'];
    $password = $_POST['input_password'];
    $count = strlen($password);
    if($name == '') {
      $errors['name'] = 'blank';
    }
    if($email == '') {
      $errors['email'] = 'blank';
    }
    if($password == '') {
      $errors['password'] = 'blank';
  } else if($count < 4 || $count > 20) {
      $errors['password'] = 'length';
  }
  // 入力チェックでエラーがなかった場合、確認ページへ遷移
  if(empty($errors)) {
    $_SESSION['register']['name'] = $_POST['input_name'];
    $_SESSION['register']['email'] = $_POST['input_email'];
    $_SESSION['register']['password'] = $_POST['input_password'];

    header('Location:signup-check.php');
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
  <?php
    include('header.php');
   ?>

<div class="main-body container">
  <div class="row">
    <div class="col-md-8 offset-md-2 reserve-body">
      <div class="col-md-12">
        <div class="form-title">
          <h1>
            ー会員登録ー
          </h1>
          <p>
            会員登録でスタジオ予約をもっとスムーズに
          </p>
        </div>
      </div>
        <form method="POST" action="signup.php">
          <div class="form-group">
            <label>名前</label>
            <input type="text" name="input_name" class="form-control"  placeholder="例）鈴木　一郎" value="<?php echo htmlspecialchars($name); ?>">
            <?php if(isset($errors['name']) && $errors['name'] == 'blank'): ?>
              <?php echo '<p class="error_message">名前を入力してください</p>'; ?>
            <?php endif; ?>
            <small class="form-text text-muted">スタジオに予約メールを送信する際に使用することがあるため、本名でご入力ください。</small>
          </div>
          <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="input_email" class="form-control" placeholder="例）dancedance@studionavi.com" value="<?php echo htmlspecialchars($email); ?>">
            <?php if(isset($errors['email']) && $errors['email'] == 'blank'): ?>
              <p class="error_message">メールアドレスを入力してください</p>
            <?php endif; ?>
            <small class="form-text text-muted">予約時の確認メールの送信先となります。間違えないようにお気をつけください。</small>
          </div>
          <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="input_password" class="form-control" placeholder="" maxlength="20">
            <?php if(isset($errors['password']) && $errors['password'] == 'blank'): ?>
              <p class="error_message">パスワードを入力してください</p>
            <?php elseif(isset($errors['password']) && $errors['password'] == 'length'): ?>
              <p class="error_message">パスワードは4文字以上20文字以下で入力してください</p>
            <?php endif; ?>
            <?php if(!empty($errors) && !isset($errors['password'])): ?>
              <p class="error_message">パスワードを再設定してください</p>
            <?php endif; ?>
            <small class="form-text text-muted">半角英数4文字以上20文字以下</small>
          </div>
          <div class="submit-center">
            <input type="submit" name="" value="確認画面へ" class="btn btn-lg submit-color">
          </div>
        </form>
    </div>
  </div>
</div>

   <?php
    include('footer.php');
   ?>

</body>
</html>