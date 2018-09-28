<?php
session_start();
require('dbconnect.php');
$errors = [];

$room_id = (int)$_GET['rm'];
$studio_id = (int)$_GET['std'];


if(!empty($_POST)) {
    $content = $_POST['content'];
    if($content == '') {
        $errors['content'] = 'blank';
    }
    $content = $_POST['content'];
    $user_id = $_SESSION['id'];


    if(empty($errors)){
        $sql = 'INSERT INTO `reviews` (`content`, `user_id`, `room_id`, `studio_id`, `created`) VALUES (?, ?, ?, ?,NOW())';
        $data = [$content, $user_id, $room_id, $studio_id];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        header('Location: reviews-list.php?std=' . $studio_id . '&rm=' . $room_id);
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

<div class="main-body container review-post">
  <div class="row">
    <div class="col-md-8 offset-md-2 reserve-body">
      <div class="col-md-12">
        <div class="form-title">
          <h1>
            ー口コミを投稿するー
          </h1>
          <p>
            匿名でスタジオの口コミを投稿することができます
          </p>
        </div>
      </div>
        <form action="review-post.php?std=<?= $studio_id; ?>&rm=<?= $room_id; ?>" method="POST">
          <div class="form-group">
            <label for="comment">口コミ内容</label>
            <textarea class="form-control" rows="5" cols="50" name="content"></textarea>
            <?php if(isset($errors['content']) && $errors['content'] == 'blank'): ?>
              <p class="error_message">口コミが入力されていません</p>
            <?php endif; ?>
            <input type="submit" name="" value="投稿する" class="btn btn-lg submit-color" id="review-submit">
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