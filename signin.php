<?php

  require('dbconnect.php');
  $errors = [];

  if(!empty($_POST)) {
    $email = $_POST['input_email'];
    $password = $_POST['input_password'];

    if($email == '' || $password == '') {
      $errors['signin'] = 'blank';
    } else {
      $sql = 'SELECT * FROM `users` WHERE `user_mail` = ?';
      $data = [$email];
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);
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
            ーログインー
          </h1>
          <p>
            メールアドレスとパスワードを入力してください
          </p>
        </div>
      </div>
        <form action="" method="POST">
          <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="input_email" id="email" class="form-control" placeholder="例）dancedance@studionavi.com">
          </div>
          <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="input_password" class="form-control" id="password" placeholder="4〜16文字のパスワード">
            <small class="form-text text-muted">- パスワードを忘れた方はこちら -</small>
          </div>
          <?php if(isset($errors['signin']) && $errors['signin'] == 'blank'): ?>
            <p class="error_message">メールアドレスとパスワードを入力してください</p>
          <?php endif; ?>
          <div class="submit-center">
            <input type="submit" name="" value="ログインする" class="btn btn-lg submit-color">
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