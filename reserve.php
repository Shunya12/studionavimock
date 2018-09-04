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
  <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <a class="navbar-brand mr-auto navbar-brand-center" href="#">Studio NAVI</a>
  <ul class="navbar-nav">
    <li class="nav-item d-none d-sm-block ">
      <a class="nav-link" href="#">新規登録</a>
    </li>
    <li class="nav-item d-none d-sm-block">
      <a class="nav-link" href="#">ログイン</a>
    </li>
    <li class="nav-item d-none d-sm-block">
      <a class="nav-link" href="#">ログアウト</a>
    </li>
    <li class="nav-item d-none d-sm-block">
      <a class="nav-link" href="#"><i class="fas fa-search"></i></a>
    </li>
  </ul>
  </nav>

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
        <form action="check.php">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label>希望開始日時</label>
              <input type="datetime-local" name="date-start" class="form-control" placeholder="例）7/10 22:00">
            </div>
            <div class="form-group col-md-6">
              <label>希望終了日時</label>
              <input type="datetime-local" name="date-fin" class="form-control" placeholder="例）7/11 6:00">
            </div>
          </div>
          <div class="form-group">
            <label>利用人数</label>
            <input type="text" name="users" class="form-control" placeholder="例）20">
          </div>
          <div class="form-group">
            <label>名前</label>
            <input type="text" name="name" class="form-control"  placeholder="例）徳川　家家">
          </div>
          <div class="form-group">
            <label>メールアドレス</label>
            <input type="email" name="email" class="form-control" placeholder="例）dancedance@studionavi.com">
            <small class="form-text text-muted">予約の確認メールをお送りするので間違えないようにお気をつけください。</small>
          </div>
          <div class="submit-center">
            <input type="submit" name="" value="予約確認へ進む" class="btn btn-lg submit-color">
          </div>
            
        </form>
    </div>
  </div>
</div>

 <footer>
    <a href="#">プライバシーポリシー</a>
    <p>&copy; 2018 -Studio NAVI -</p>
  </footer>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

</body>
</html>