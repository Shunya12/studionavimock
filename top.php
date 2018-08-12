<!DOCTYPE html>
<html>
<head>
  <title>東京のレンタルスタジオならStudioNAVI</title>
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

  <div class="container-fluid main-body">
    <div class="row">
      <div class="col-md-4 main-menu">
        <a href="#" data-toggle="modal" data-target="#search-studio">
          <div class="filter">
            <img src="img/menu1.jpg">
            <p>条件から<br>スタジオを探す</p>
          </div>
        </a>
      </div>
      <div class="col-md-4 main-menu">
        <a href="#">
          <div class="filter">
            <img src="img/menu2.jpg">
            <p>エリアから<br>スタジオを探す</p>
          </div>
        </a>
      </div>
      <div class="col-md-4 main-menu">
        <a href="#">
          <div class="filter">
            <img src="img/menu3.jpg">
            <p>予約確認</p>
          </div>
        </a>
      </div>
    </div>
  </div>

  <div class="modal fade" id="search-studio" tabindex="-1" role="dialog" aria-labelledby="serach-studioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="serach-studioLabel">条件でスタジオを探す</h5>
          <button class="close" data-dismiss="modal" aria-label="close"></button>
          <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body">
          <form>
            <!-- 利用日時はこのサイトがプラットフォームとして成り立つまで利用しない -->
            <!-- <div class="form-group">
              <label for="message-text" class="col-form-label">利用日時</label>
              <input type="text" class="form-control" name="use-time" id="use-time">
            </div> -->
            <div class="form-group">
              <label for="message-text" class="col-form-label">利用人数</label>
              <input type="text" class="form-control" name="number-of-users" id="number-of-users">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">1時間あたりの料金</label>
              <input type="text" class="form-control" name="price-per-hour" id="price-per-hour">
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">エリア</label>
              <input type="text" class="form-control" name="area" id="area">
            </div>
            <div class="submit-center">
              <input type="submit" value="検索する" name="" class="btn btn-lg submit-color">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


  <footer>
    <a href="#">プライバシーポリシー</a>
    <p>&copy; 2018 -Studio NAVI -</p>
  </footer>

  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>