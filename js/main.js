// 検索画面のGoogleMapApiに関する処理

var map;

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 35.6648099, lng: 139.6408946} ,
    zoom: 12
  });


  var marker = [];
  var data = [
  {
    name: '新宿マイスタジオ',
    lat: 35.694554,
    lng: 139.695937,
    desc: 'このスタジオは常にチキンナゲットのニオイがします'
  }, {
    name: 'エンスタジオ 渋谷スクランブル',
    lat: 35.6609577,
    lng: 139.6961136,
    desc: 'このスタジオにはワキガの相撲取りがよく来ます'
  }, {
    name: '新宿ソニズ',
    lat: 35.697028,
    lng: 139.694416,
    desc: 'このスタジオはスイッチを押すとファミマに入った時の音がでます'
  }
  ];

  var infowindow = [];

  var openInfowindow;


  for (var i = 0; i < data.length; i++) {
    markerLatLng = {lat: data[i]['lat'], lng: data[i]['lng']};
    marker[i] = new google.maps.Marker({
      position: markerLatLng,
      map: map
    });
  }

  function markerClick(n) {
    marker[n].addListener('click', function() {
      if(openInfowindow){
        openInfowindow.close();
      }
      openInfowindow = infowindow[n];
      infowindow[n].open(map, marker[n]);
    });
  }


  for(var i = 0; i < data.length; i++){
    var content = '<div class="info"><h2><a href="detail.php" class="result-a">' + data[i].name + '</h2><p>' + data[i].desc + '</a></p></div>';
    infowindow[i] = new google.maps.InfoWindow({
      content: content,
      maxWidth: 200
    });

    markerClick(i);
  }
}


// フラッシュメッセージ
// URLのパラメータを取得
var urlParam = location.search.substring(1);

// URLにパラメータが存在する場合
if(urlParam) {
  // 「&」が含まれている場合は「&」で分割
  var param = urlParam.split('&');

  // パラメータを格納する用の配列を用意
  var paramArray = [];

  // 用意した配列にパラメータを格納
  for (i = 0; i < param.length; i++) {
    var paramItem = param[i].split('=');
    paramArray[paramItem[0]] = paramItem[1];
  }



  // パラメータによってメッセージを出し分ける
  if (paramArray.from == 'logout') {
    $(document).ready(function(){
      $('.fls-msg-none').append('<div>ログアウトしました</div>').addClass('fls-msg').removeClass('fls-msg-none').fadeOut(5000, "swing");
    });
  } else if(paramArray.from == 'login') {
    $(document).ready(function(){
      $('.fls-msg-none').append('<div>ログインしました</div>').addClass('fls-msg').removeClass('fls-msg-none').fadeOut(5000, "swing");
    });
  } else if(paramArray.from == 'changed') {
    $(document).ready(function(){
      $('.fls-msg-none').append('<div>会員情報を更新しました</div>').addClass('fls-msg').removeClass('fls-msg-none').fadeOut(5000, "swing");
    });
  } else if(paramArray.from == 'pwchanged') {
    $(document).ready(function(){
      $('.fls-msg-none').append('<div>パスワードを更新しました</div>').addClass('fls-msg').removeClass('fls-msg-none').fadeOut(5000, "swing");
    });
  }
}


// 予約画面｜チェックボックスにチェックが入った際に希望利用時間をなくす
$(function(){
  $('input[name="night_use"]').change(function(){
    var is = $('#night-check').is(':checked');
    if(is){
      $('#use-time').hide('slow');
    } else {
      $('#use-time').show('slow');
    }
  });
});
