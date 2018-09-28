// 検索画面のGoogleMapApiに関する処理

var map;

function initMap() {
  map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 35.6648099, lng: 139.6408946} ,
    zoom: 12
  });


  var marker = [];


  var data = [];

  for (var i = 0; i < studioData.length; i++) {
    data.push(studioData[i]);
    studioData[i].lat = Number(studioData[i].lat);
    studioData[i].lng = Number(studioData[i].lng);
  }


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
    var content =
    '<div class="info"><h2>' +
    data[i].studio_name +
    '</h2><div class="img-center"><img src="img/';
    if(data[i].rooms[0].room_img == '') {
      content += 'no_image.jpg';
    } else {
      content += data[i].rooms[0].room_img;
    }
    content +=
    '"></div>';
    for(var j = 0; j < data[i].rooms.length; j++){
      content +=
      '<a class="body-link" href="detail.php?std=' +
      data[i].studio_id +
      '&rm=' +
      data[i].rooms[j].room_id +
      '"><div><h3>' +
      data[i].rooms[j].room_name +
      '</h3><table><tr><td>値段： </td><td>' +
      data[i].rooms[j].price_per_hour +
      '円/h</td></tr><tr><td>広さ: </td><td>' +
      data[i].rooms[j].long_wide +
      '</td></tr></table></div></a>';
    };

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
