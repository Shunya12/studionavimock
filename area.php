<?php
session_start();
require('dbconnect.php');
$studio_recs = [];
echo "git練習";

// スタジオ情報とルーム情報を取得
$sql = 'SELECT * FROM `rooms` AS `r` LEFT JOIN `studios` AS `s` ON `r`.`studio_id` = `s`.`studio_id`';
$stmt = $dbh->prepare($sql);
$stmt->execute();
while (true) {
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    if($rec == false){
        break;
    }
    $studio_recs[] = $rec;
}

// ルームが重複した場合のみスタジオに配列を追加する
$result = [];
// 配列をforで回して、配列を操作する
for ($i = 0; $i < count($studio_recs); $i++) {
    $tmp_room = $studio_recs[$i];
    $a_studio = [];
    $not_exist = true;
    $studio_index = 0;
    // スタジオ情報が今まで回した内容と被っていた場合に、データを再利用する
    for ($j = 0; $j < count($result); $j++) {
        $pre_result = $result[$j];
        if ($pre_result['studio_id'] == $tmp_room['studio_id']) {
          $a_studio = $pre_result;
          $not_exist = false;
          $studio_index = $j;
          break;
        }
    }
    // $resultにそのスタジオ情報がまだなければ追加する。
    if ($not_exist) {
        $a_studio = [
            'studio_id' => $tmp_room['studio_id'],
            'studio_name' => $tmp_room['studio_name'],
            'lat' => $tmp_room['lat'],
            'lng' => $tmp_room['lng'],
            'rooms' => []
        ];
    }
    // ルーム情報はスタジオがあってもなくても追加するので
    $a_studio['rooms'][] = [
        'room_id' => $tmp_room['room_id'],
        'room_name' => $tmp_room['room_name'],
        'long_wide' => $tmp_room['long_wide'],
        'capacity' => $tmp_room['capacity'],
        'price_per_hour' => $tmp_room['price_per_hour'],
        'night_price' => $tmp_room['night_price'],
        'room_img' => $tmp_room['room_img']
    ];

    // スタジオ情報が被っていなければ、$resultにそのままスタジオ情報を代入。被っていたら前回とった結果に上書きする（room情報だけが増えているので）
    if ($not_exist) {
      $result[] = $a_studio;
    } else {
      $result[$studio_index] = $a_studio;
    }

}

$json_studio_data = json_encode($result);

?>

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
  <script>
    // 外部のJSファイルに値を渡すために代入
    var studioData = <?php print_r($json_studio_data); ?>;
  </script>

</head>
<body>
<?php require('header.php'); ?>

  <div class="container-fluid main-body">
    <div class="row">
      <div class="col-md-12">
        <div id="map"></div>
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
  <script async defer src="//maps.googleapis.com/maps/api/js?key=AIzaSyAi4Vo4tOI2jSFLf-QaEL7lF2BrOzHzWsQ&callback=initMap"></script>
  <script src="js/main.js"></script>
</body>
</html>
