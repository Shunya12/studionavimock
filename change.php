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
            ー登録情報を変更するー
          </h1>
        </div>
      </div>
        <form>
          <div class="form-group">
            <label>名前</label>
            <input type="text" name="name" class="form-control"  placeholder="例）徳川　家家">
          </div>
          <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="email" class="form-control" placeholder="例）dancedance@studionavi.com">
            <small class="form-text text-muted">予約時の確認メールの送信先となります。間違えないようにお気をつけください。</small>
          </div>
          <div class="form-group">
            <label>パスワード</label>
            <input type="password" name="password" class="form-control" placeholder="">
            <small class="form-text text-muted">半角英数4文字以上</small>
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