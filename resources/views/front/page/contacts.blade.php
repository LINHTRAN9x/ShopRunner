@extends("front.layout.master")
@section('title', 'Contact')
@section("body")

    <!-- Map Begin -->
    <div id="map">

    </div>
    <script>
        function initMap() {
  var mapOpts = {
      center: {lat: 21.028401, lng: 105.782418},
      zoom: 16,
      mapTypeId: google.maps.MapTypeId.TERRAIN,
      styles:
      [
        {
          "featureType": "road.local",
          "stylers": [
            {
              "weight": 4.5
            }
          ]
        }
      ]
  };

  var map = new google.maps.Map(document.getElementById('map'), mapOpts);

  var bicyclayer = new google.maps.BicyclingLayer();
  bicyclayer.setMap(map);

  var infowincontent = '<div style="width:200px">CONTENT</div>';

  // Airplane Road Marker
  var marker2 = new google.maps.Marker({
    position: {lat: 21.028401, lng: 105.782418},
    map: map,
    title: '8a,Tôn Thất Thuyết',
    animation: google.maps.Animation.DROP
  });

  var infowindow2 = new google.maps.InfoWindow({
    content: infowincontent.replace('CONTENT',
      '  <b>Detech Building</b> <br>8  Tôn Thất Thuyết <br> Mỹ Đình <br> Nam Từ Liêm <br> Hà Nội, Việt Nam <br> <a href="https://www.google.com/maps/place/8a+T%C3%B4n+Th%E1%BA%A5t+Thuy%E1%BA%BFt,+M%E1%BB%B9+%C4%90%C3%ACnh,+C%E1%BA%A7u+Gi%E1%BA%A5y,+H%C3%A0+N%E1%BB%99i+100000,+Vi%E1%BB%87t+Nam/@21.0288015,105.7797143,17z/data=!3m1!4b1!4m6!3m5!1s0x313454b32b842a37:0xe91a56573e7f9a11!8m2!3d21.0288015!4d105.7822892!16s%2Fg%2F11hz0g55hn?hl=vi-VN&entry=ttu" target="_blank">Xem trên Google Maps</a>  ')
  });

  marker2.addListener('click', function() {
    infowindow2.open(map, marker2);
  });
}
    </script>
    <!-- Map End -->

    <!-- Contact Section Begin -->
    <section class="contact spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="contact__text">
                        <div class="section-title">
                            <span>Information</span>
                            <h2>Contact Us</h2>
                            <p>As you might expect of a company that began as a high-end interiors contractor, we pay
                                strict attention.</p>
                        </div>
                        <ul>
                            <li>
                                <h4>Viet Nam</h4>
                                <p>8a Tôn Thất Thuyết, Mỹ Đình, Cầu Giấy, Hà Nội <br />+84 92-314-0958</p>
                            </li>
                            <li>
                                <h4>France</h4>
                                <p>109 Avenue Léon, 63 Clermont-Ferrand <br />+12 345-423-9893</p>
                            </li>
                            <li>
                                <h4>Social media</h4>
                                <p>
                                    <a href="#"><img style="margin: 0" src="front/img/icon/facebook.svg" width="30" alt=""></a>
                                    <a href="#"><img style="margin: 0" src="front/img/icon/instagram.svg" width="30" alt=""></a>
                                    <a href="#"><img style="margin: 0" src="front/img/icon/x.svg" width="30" alt=""></a>
                                    <a href="#"><img style="margin: 0" src="front/img/icon/youtube.svg" width="30" alt=""></a>
                                    <a href="#"><img style="margin: 0" src="front/img/icon/in.svg" width="30" alt=""></a>
                                </p>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="contact__form">
                        <form action="#">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email">
                                </div>
                                <div class="col-lg-12">
                                    <textarea placeholder="Message"></textarea>
                                    <button type="submit" class="site-btn">Send Message</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Contact Section End -->
@endsection
