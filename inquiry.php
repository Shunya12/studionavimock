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
            ーパスワードの問い合わせをするー
          </h1>
        </div>
      </div>
        <form>
          <div class="form-group">
            <label>登録したメールアドレス</label>
            <input type="email" name="email" class="form-control" placeholder="例）dancedance@studionavi.com">
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