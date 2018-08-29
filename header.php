<nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
  <a class="navbar-brand mr-auto navbar-brand-center" href="#">Studio NAVI</a>
  <ul class="navbar-nav">
    <li class="nav-item d-none d-sm-block ">
      <a class="nav-link" href="signup.php">新規登録</a>
    </li>
    <li class="nav-item d-none d-sm-block">
      <a class="nav-link" href="signin.php">ログイン</a>
    </li>
    <li class="nav-item d-none d-sm-block">
      <a class="nav-link" href="#">ログアウト</a>
    </li>
    <li class="nav-item d-none d-sm-block">
      <a class="nav-link" href="#" data-toggle="modal" data-target="#search-studio"><i class="fas fa-search"></i></a>
    </li>
  </ul>
  </nav>

  <div class="modal fade" id="search-studio" tabindex="-1" role="dialog" aria-labelledby="serach-studioLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="serach-studioLabel">条件でスタジオを探す</h5>
          <button class="close" data-dismiss="modal" aria-label="close"></button>
          <span aria-hidden="true">&times;</span>
        </div>
        <div class="modal-body">
          <form action="result.php" method="GET">
            <!-- 利用可能日時はこのサイトのUU数が増えるまでは利用しない -->
            <!-- <div class="form-group">
              <label for="message-text" class="col-form-label">利用日時</label>
              <input type="text" class="form-control" name="use-time" id="use-time">
            </div> -->
            <div class="form-group">
              <label for="message-text" class="col-form-label">利用人数</label>
              <input type="number" class="form-control" name="number_of_users" id="number-of-users" placeholder="例）10">
              <small class="form-text text-muted">必ず半角の数字で入力してください</small>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">1時間あたりの料金</label>
              <select class="custom-select" id="inputGroupSelect01" name="price">
                <option selected>指定しない</option>
                <option value="1000">〜1000円</option>
                <option value="2000">1001〜2000円</option>
                <option value="3000">2001〜3000円</option>
                <option value="4000">3001〜4000円</option>
                <option value="5000">4001〜5000円</option>
                <option value="6000">5000円以上</option>
              </select>
            </div>
            <div class="form-group">
              <label for="message-text" class="col-form-label">エリア</label>
              <select class="custom-select" id="inputGroupSelect02" name="area">
                <option selected>指定しない</option>
                <option value="shinjuku">新宿・渋谷エリア</option>
                <option value="ikebukuro">池袋エリア</option>
                <option value="ueno">上野・秋葉原エリア</option>
                <option value="yotsuya">四ツ谷エリア</option>
                <option value="nishitokyo">西東京エリア</option>
                <option value="saitama">埼玉エリア</option>
                <option value="chiba">千葉エリア</option>
                <option value="kanagawa">神奈川エリア</option>
                <option value="sonota">その他のエリア</option>
              </select>
            </div>
            <div class="submit-center">
              <input type="submit" value="検索する" name="" class="btn btn-lg submit-color">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>