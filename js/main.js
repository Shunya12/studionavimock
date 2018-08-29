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



