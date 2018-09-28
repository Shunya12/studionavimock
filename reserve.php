<?php
  session_start();
  require('dbconnect.php');
  $errors = [];


  $users = '';
  if(isset($_SESSION['id'])) {
    $sql = 'SELECT `users`.`name`,`users`.`user_mail` FROM `users` WHERE `user_id` = ?';
    $data = [$_SESSION['id']];
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    $user_info = $stmt->fetch(PDO::FETCH_ASSOC);
    $user_name = $user_info['name'];
    $user_email = $user_info['user_mail'];
  } else {
    $user_name = '';
    $user_email = '';
  }


  // 戻るボタンで戻って来た際の処理
  if(isset($_GET['action']) && $_GET['action'] == 'rewrite') {
    $_POST['date'] = $_SESSION['reserve']['date'];
    $_POST['user_name'] = $_SESSION['reserve']['user_name'];
    $_POST['user_email'] = $_SESSION['reserve']['user_email'];
    $_POST['users'] = $_SESSION['reserve']['users'];
    $_POST['start_time'] = $_SESSION['reserve']['start_time'];
    $_POST['fin_time'] = $_SESSION['reserve']['fin_time'];

    $errors['rewrite'] = true;
  }


  if (!empty($_POST)) {
    $date = $_POST['date'];
    $start = $_POST['start_time'];
    $fin = $_POST['fin_time'];
    $users = $_POST['users'];
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    if ($date == '') {
      $errors['date'] = 'blank';
    }
    if ($users == '') {
      $errors['users'] = 'blank';
    }
    if ($user_name == '') {
      $errors['user_name'] = 'blank';
    }
    if ($user_email == '') {
      $errors['user_email'] = 'blank';
    }
    $start_datetime = strtotime($date . ' ' . $start);
    $fin_datetime = strtotime($date . ' ' . $fin);
    if (!isset($_POST['night_use']) && $start_datetime >= $fin_datetime) {
      $errors['datetime'] = 'incorrect';
    }

    // エラーがなかった場合確認ページへ遷移
    if(empty($errors)) {
      if(isset($_POST['night_use']) && $_POST['night_use'] == 'on'){
        $_SESSION['reserve']['date'] = $date;
        $_SESSION['reserve']['use_style'] = 'night_use';
        $_SESSION['reserve']['start_time'] = $start;
        $_SESSION['reserve']['fin_time'] = $fin;
        $_SESSION['reserve']['users'] = $users;
        $_SESSION['reserve']['user_name'] = $user_name;
        $_SESSION['reserve']['user_email'] = $user_email;
      } else {
        $_SESSION['reserve']['date'] = $date;
        $_SESSION['reserve']['use_style'] = 'day_use';
        $_SESSION['reserve']['start_time'] = $start;
        $_SESSION['reserve']['fin_time'] = $fin;
        $_SESSION['reserve']['users'] = $users;
        $_SESSION['reserve']['user_name'] = $user_name;
        $_SESSION['reserve']['user_email'] = $user_email;
      }

      header('Location: check.php');
      exit();
    }

  }


// セレクトボックス用の配列を生成
$select_times = [];
$start = strtotime('06:00');
$end = strtotime('23:30');

while($start <= $end) {
  $time = date('G:i', $start);
  $select_times[] = $time;
  $start = strtotime('+30 minute' , $start);
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
              ー予約情報入力画面ー
            </h1>
            <p>
              全て必須項目です
            </p>
          </div>
        </div>
          <form action="reserve.php" method="POST">
            <div class="form-group">
              <label>希望利用日</label>
              <input type="date" name="date" class="form-control" min="<?= date('Y-m-d') ?>" value="<?= $date; ?>">
              <?php if(isset($errors['date']) && $errors['date'] == 'blank'): ?>
                <?php echo '<p class="error_message">日付を入力してください</p>'; ?>
              <?php endif; ?>
            </div>
            <?php if($_SESSION['reserve']['night_price'] != 0): ?>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="night-check" name="night_use">
                <label class="form-check-label" for="night-check">深夜レンタルをご希望の場合はこちらにチェックを入れてください</label>
              </div>
            <?php endif; ?>
            <div class="form-row" id="use-time">
              <div class="form-group col-md-6">
                <label>希望開始時間</label>
                <select class="custom-select" id="inputGroupSelect01" name="start_time">
                  <?php foreach($select_times as $select_time): ?>
                    <option value="<?= $select_time ?>"><?= $select_time ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>希望終了時間</label>
                <select class="custom-select" id="inputGroupSelect02" name="fin_time">
                   <?php foreach($select_times as $select_time): ?>
                    <option value="<?= $select_time ?>"><?= $select_time ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
              <?php if(isset($errors['datetime']) && $errors['datetime'] == 'incorrect'): ?>
                <p class="error_message">開始時間が終了時間よりも遅いか同じ時刻になっています</p>
              <?php endif; ?>
            </div>
            <div class="form-group">
              <label>利用人数</label>
              <input type="number" name="users" class="form-control" placeholder="例）20" min="1" max="100" value="<?= $users; ?>">
              <?php if(isset($errors['users']) && $errors['users'] == 'blank'): ?>
                <?php echo '<p class="error_message">人数を入力してください</p>'; ?>
              <?php endif; ?>
            </div>
            <?php if(isset($_SESSION['id'])): ?>
              <table class="table detail-info">
                  <tr>
                    <td>お名前</td>
                    <td><?= htmlspecialchars($user_name); ?></td>
                  </tr>
                  <tr>
                    <td>メールアドレス</td>
                    <td><?= htmlspecialchars($user_email); ?></td>
                  </tr>
              </table>
              <div class="form-group">
                <input type="hidden" name="user_name" class="form-control" value="<?= $user_name; ?>">
              </div>
              <div class="form-group">
                <input type="hidden" name="user_email" class="form-control" value="<?= $user_email; ?>">
              </div>
            <?php else: ?>
              <div class="form-group">
              <label>名前</label>
              <input type="text" name="user_name" class="form-control"  placeholder="例）鈴木　太郎" value="<?= $user_name ?>">
                <?php if(isset($errors['user_name']) && $errors['user_name'] == 'blank'): ?>
                  <?php echo '<p class="error_message">名前を入力してください</p>'; ?>
                <?php endif; ?>
              </div>
              <div class="form-group">
                <label>メールアドレス</label>
                <input type="email" name="user_email" class="form-control" placeholder="例）dancedance@studionavi.com" value="<?= $user_email ?>">
                <?php if(isset($errors['user_email']) && $errors['user_email'] == 'blank'): ?>
                  <?php echo '<p class="error_message">メールアドレスを入力してください</p>'; ?>
                <?php endif; ?>
                <small class="form-text text-muted">予約の確認メールをお送りするので間違えないようにお気をつけください。</small>
              </div>
            <?php endif; ?>
            <div class="submit-center">
              <input type="submit" name="" value="予約確認へ進む" class="btn btn-lg submit-color">
            </div>
          </form>
      </div>
    </div>
  </div>


  <?php require('footer.php'); ?>

</body>
</html>