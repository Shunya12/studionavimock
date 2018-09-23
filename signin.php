<?php
  session_start();
  require('dbconnect.php');

  if(isset($_SESSION['id'])) {
    header('Location: top.php?from=login');
    exit();
  }

  $errors = [];

  $ref = $_SERVER['HTTP_REFERER'];
  $email = '';


  if(!empty($_POST)) {
    $email = $_POST['input_email'];
    $password = $_POST['input_password'];
    $referer = $_POST['ref'];

    if($email == '' || $password == '') {
      $errors['signin'] = 'blank';
    } else {
      $sql = 'SELECT * FROM `users` WHERE `user_mail` = ?';
      $data = [$email];
      $stmt = $dbh->prepare($sql);
      $stmt->execute($data);
      $rec = $stmt->fetch(PDO::FETCH_ASSOC);

      if($rec == false) {
        $errors['signin'] = 'no-exist';
      } else {
        if(password_verify($password, $rec['password'])) {
        $_SESSION['id'] = $rec['user_id'];

        // リファラーのパラメータを削除して再代入することで、無限にパラメータがつく現象を回避
        if(strpos($referer, '?') !== false){
          $referer = strstr($referer,'?',true);
        }


        // ログイン前のページへ遷移
        header("Location: $referer" . "?from=login");
        exit();

        } else {
          $errors['signin'] = 'failed';
        }
      }
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
          <?php if(isset($_GET['from']) && $_GET['from'] == 'mypage'): ?>
            <div class="alert alert-info"><p class="alert-msg">ログインすることでマイページの情報を確認することができます</p></div>
          <?php endif; ?>
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
            <input type="email" name="input_email" id="email" class="form-control" placeholder="例）dancedance@studionavi.com" value="<?php echo htmlspecialchars($email); ?>">
          </div>
          <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="input_password" class="form-control" id="password" placeholder="4〜16文字のパスワード">
            <small class="form-text text-muted"><a href="inquiry.php" class="body-link">- パスワードを忘れた方はこちら -</a></small>
          </div>
          <?php if(isset($errors['signin']) && $errors['signin'] == 'blank'): ?>
            <p class="error_message">メールアドレスとパスワードを入力してください</p>
          <?php endif; ?>
          <?php if(isset($errors['signin']) && $errors['signin'] == 'no-exist'): ?>
            <p class="error_message">登録されていないメールアドレスです</p>
          <?php endif; ?>
          <?php if(isset($errors['signin']) && $errors['signin'] == 'failed'): ?>
            <p class="error_message">パスワードが違います</p>
          <?php endif; ?>
          <input type="hidden" name="ref" value="<?= $ref ?>">
          <div class="submit-center">
            <input type="submit" name="" value="ログインする" class="btn btn-lg submit-color">
          </div>
        </form>
        <div class="center-link">
          <small>
            <a href="signup.php" class="body-link">- 登録がお済みでない方はこちら -</a>
          </small>
        </div>
    </div>
  </div>
</div>

<?php
  include('footer.php');
?>
</body>
</html>