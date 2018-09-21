<?php
session_start();
require('dbconnect.php');
$errors = [];

if(!empty($_POST)) {
  $email = $_POST['email'];
  $confirm_number = $_POST['confirm_number'];

  // 空チェック
  if($email == '') {
    $errors['email'] = 'blank';
  }
  if($confirm_number == '') {
    $errors['confirm_number'] = 'blank';
  }

  $sql = 'SELECT * FROM `reservations` WHERE `conf_email` = ? AND `confirm_number` = ?';
  $data = [$email, $confirm_number];
  $stmt = $dbh->prepare($sql);
  $stmt->execute($data);
  $reservation = $stmt->fetch(PDO::FETCH_ASSOC);
  if(empty($reservation)) {
    $errors['exist'] = 'no-exist';
  }



  if(empty($errors)) {
    $_SESSION['confirm']['email'] = $email;
    $_SESSION['confirm']['confirm_number'] = $confirm_number;
    header('Location: confirm.php');
    exit();
  }
}



?>

<!DOCTYPE html>
<html>
<head>
 <meta charset="utf-8">
  <meta discription="">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
  <?php include('header.php'); ?>

  <div class="main-body container">
  <div class="row">
    <div class="col-md-8 offset-md-2 reserve-body">
      <div class="col-md-12">
        <div class="form-title">
          <h1>
            ー予約内容を確認するー
          </h1>
          <p>
            ログインすると予約情報を確認できます。
          </p>
          <form action="reserve-check.php" method="POST">
            <div class="form-group">
              <label>メールアドレス</label>
              <input type="email" name="email" class="form-control" placeholder="例）dancedance@studionavi.com">
              <small class="form-text text-muted">予約の際に利用したメールアドレスを入力してください</small>
              <?php if(isset($errors['email']) && $errors['email'] == 'blank'): ?>
                <p class="error_message text-left">メールアドレスを入力してください</p>
              <?php endif; ?>

            </div>
            <div class="form-group">
              <label>予約番号</label>
              <input type="number" name="confirm_number" class="form-control"  placeholder="0000" min="1000" max="9999">
              <small class="form-text text-muted">予約時に発行した4桁の数字を入力してください</small>
              <?php if(isset($errors['confirm_number']) && $errors['confirm_number'] == 'blank'): ?>
                <p class="error_message text-left">予約番号を入力してください</p>
              <?php endif; ?>

            </div>
              <?php if(isset($errors['exist']) && $errors['exist'] == 'no-exist'): ?>
                <p class="error_message text-left">予約情報が存在しません</p>
              <?php endif; ?>
            <div class="submit-center">
              <input type="submit" name="" value="予約内容を確認する" class="btn btn-lg submit-color">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('footer.php'); ?>

</body>
</html>
