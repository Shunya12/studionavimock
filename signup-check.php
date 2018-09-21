<?php
  session_start();
  require('dbconnect.php');

  if(!isset($_SESSION['register'])) {
    header('Location: signup.php');
    exit();
  }
  $name = $_SESSION['register']['name'];
  $email = $_SESSION['register']['email'];
  $password = $_SESSION['register']['password'];

  if(!empty($_POST)) {
    $sql = 'INSERT INTO `users` SET `name` = ?, `user_mail` = ?, `password` = ?,`created`=NOW()';
    $data = array($name, $email, password_hash($password, PASSWORD_DEFAULT));
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    unset($_SESSION['register']);
    header('Location: signup-fin.php');
    exit();
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
  require('header.php');
  ?>

<div class="main-body container">
  <div class="row">
    <div class="col-md-8 offset-md-2 reserve-body">
      <div class="row">
        <div class="col-md-12">
          <div class="form-title">
            <h1>
              ー会員登録情報確認ー
            </h1>
            <p>
              以下の内容でを会員登録します
            </p>
          </div>
        </div>
        <div class="col-md-12">
          <table class="table table-striped table-propotion">
            <caption>登録内容</caption>
              <tr>
                <td>お名前</td>
                <td><?php echo htmlspecialchars($name); ?></td>
              </tr>
              <tr>
                <td>メールアドレス</td>
                <td><?php echo htmlspecialchars($email); ?></td>
              </tr>
              <tr>
                <td>パスワード</td>
                <td>*************</td>
              </tr>
          </table>
        </div>
        <div class="col-md-12 check-go">
          <form method="POST" action="">
            <a href="signup.php?action=rewrite" class="btn btn-secondary btn-lg">戻る</a>
            <input type="hidden" name="action" value="submit">
            <input type="submit" value="登録する" class="btn btn-lg submit-color">
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

  <?php
  require('footer.php');
  ?>

</body>
</html>