<?php
// Get page URL
function curPageURL() {
 $pageURL = 'http';
 if(isset($_SERVER['HTTPS'])) {
   if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
 }
 $pageURL .= "://";
 if ($_SERVER["SERVER_PORT"] != "80") {
  $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
 } else {
  $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

$page_url = curPageURL();

 
// Get Device
function detectDevice(){
  $userAgent = $_SERVER["HTTP_USER_AGENT"];
  $devicesTypes = array(
        "computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
        "tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
        "mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
        "bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
    );
  foreach($devicesTypes as $deviceType => $devices) {           
        foreach($devices as $device) {
            if(preg_match("/" . $device . "/i", $userAgent)) {
                $deviceName = $deviceType;
            }
        }
    }
    return ucfirst($deviceName);
  }

$device =  detectDevice();

// Get Referrer Url
$referrer_url = "-";
if(isset($_SERVER['HTTP_REFERER'])) {
  $referrer_url = $_SERVER['HTTP_REFERER'];
}

// Get all parameter from url
$url_parm = [];
if(isset($_GET)){
  foreach ($_GET as $key => $value) {
    $url_parm[ucfirst($key)] = $value;
  }
}
?>


<!doctype html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="width" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<title>The Great Next</title>
<!-- css section -->
<link rel="stylesheet" href="css/bootstrap.css" type="text/css" media="all">
<link rel="stylesheet" href="css/reset.css" type="text/css" media="all">
<link rel="stylesheet" href="css/fonts.css" type="text/css" media="all">
<link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" media="all">
<link rel="stylesheet" href="scss/main.css?v=<?php echo  rand(10,10000000);?>" type="text/css" media="all">
<link rel="stylesheet" href="css/responsive.css" type="text/css" media="all">
<link rel="icon" type="image/x-icon" href="images/favicon.ico" />
<!-- Google analytics Code -->

    <script>
       (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
       (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
       m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
       })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

      ga('create', 'UA-70707187-1', 'auto');
      ga('send', 'pageview');

    </script>
    <!-- Facebook Pixel Code -->
    <script>
      !function(f,b,e,v,n,t,s)
      {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
      n.callMethod.apply(n,arguments):n.queue.push(arguments)};
      if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
      n.queue=[];t=b.createElement(e);t.async=!0;
      t.src=v;s=b.getElementsByTagName(e)[0];
      s.parentNode.insertBefore(t,s)}(window, document,'script',
      'https://connect.facebook.net/en_US/fbevents.js');
      fbq('init', '753938278075117');
      fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
      src="https://www.facebook.com/tr?id=753938278075117&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    
</head>
<!-- body section -->
<body>
<!-- spotlight starts here -->
<section>
  <div class="bg-container">
    <div class="spotlight-container">
      <div class="left"> <a href="https://www.thegreatnext.com/" target="_blank"  class="desk"><img src="images/tgn-logo.png" alt="The Great Next" title="The Great Next"> </a> <a href="https://www.thegreatnext.com/" target="_blank"  class="mob"><img src="images/logo-Mobile.png" alt="The Great Next" title="The Great Next" ></a> </div>
      <div class="right"><a href="tel:+022 48971002" >022 48971002</a></div>
      <div class="text-box">
        <h1 class="h1">The Chadar Trek</h1>
        <p class="p">India's most EPIC trek. Pre-book your seat today.</p>
        <p class="with-bg">Starting @ Rs 19,999*Per Person. Everyday Departures.</p>
      </div>
    </div>
    <div class="form-container">
      <div class="form-box">
        <p class="header">MAIL US YOUR DETAILS & WE'LL GET BACK TO YOU. OR CALL US AT <b>022 48971002</b></p>
         <form class="form-email" data-success="Thanks for your interest, we will be in touch shortly." data-error="Please fill all fields correctly." success-redirect="thankyou.html">
          
        <div class="form-list">

         <ul class="clearfix">
            <li>
              <input type="text" id="name" name="name" class="signup-name-field validate-required" placeholder="Your Name">
            </li>
            <li>
              <input type="text" id="emailiD" name="email" class="validate-required validate-email signup-email-field" placeholder="Email Address">
            </li>
            <li>
              <input type="text" name="phone number" id="contact" class="signup-name-field validate-required" placeholder="Phone Number">
            </li>
            <li >
              <select class="form-control" required="required" name="city" id="city">
                  <option value = "" >City</option>
                      <?php
                      $cityArr = array('0' =>'Delhi','1' =>'Mumbai','2'=>'Thane','3' =>'Pune','4' =>'Bangalore','5'=>'Ahmedabad','6' =>'Chennai','7' =>'Hyderabad','8'=>'Lucknow','9' =>'Nagpur','10' =>'Haridwar','11'=>'Lonavala','12' =>'Rishikesh','12' =>'Chandigarh','14'=>'Kolkatta','15' =>'Gurgaon','16' =>'Jaipur','17'=>'Others');
                      foreach ($cityArr as $key => $vals) {
                          ?>
                          <option value="<?php echo $vals; ?>"><?php echo $vals; ?></option>
                          <?php
                      }
                      ?>
                </select>
            </li>
            <li>
              <select class="form-control" required="required" name="total_pax" id="total_pax">
                  <option value = "" >Group size</option>
                  <option value = "1.00" >1</option>
                  <option value = "2.00" >2</option>
                  <option value = "3.00" >3</option>
                  <option value = "4.00" >4</option>
                  <option value = "5.00" >5</option>
                  <option value = "6.00" >6</option>
                  <option value = "7.00" >7</option>
                  <option value = "8.00" >8</option>
                  <option value = "9.00" >9</option>
                  <option value = "10.00" >10+</option>
              </select>
            </li>
            <li>
             <input type="text" name="travel_date" class="signup-name-field validate-required" placeholder="Expected Travel Date" id="datepicker">
            </li>
            <li class="last">
              <select class="form-control" required="required" name="isPreviousTrekkingExperience" id="isPreviousTrekkingExperience">
                  <option value = "" >Previous Trekking Experience </option>
                  <option value = "Yes" >Yes</option>
                  <option value = "No" >No</option>
              </select>
            </li>

              <!--referal code-->
                <input type="hidden" name="page url" value="<?php echo $page_url;?>">
                <?php
                                 if(!empty($url_parm)){
                                  foreach ($url_parm as $key_url => $value_url) {
                                ?>
                <input type="hidden" name="<?php echo $key_url;?>" value="<?php echo $value_url;?>">
                <?php
                    }
                                  }
                ?>
                <input type="hidden" name="referral url" value="<?php echo $referrer_url;?>">
                <input type="hidden" name="device" value="<?php echo $device;?>">
                <!--referal code end-->
          </ul> 
          
        
        </div>
        
     
        <input type="submit" value="Submit" class="form-global-button">
       </form>
       </div>
      
      <div class="term"> * We don’t share your personal info with anyone. </div>
    </div>
  </div>
</section>
<!-- zanskar section starts here -->
<section>
<div class="custom-container">
    <div class="zanskar-trek">
      <div class="row">
        <div class="col-xs-12 col-sm-5">
          <h4 class="h4">ZANSKAR VALLEY, INDIA</h4>
          <h2 class="h2">About the frozen Zanskar river</h2>
        </div>
        <div class="col-xs-12 col-sm-7">
          <div class="sub-copy"> The magnificent Zanskar flows through the weather-bleached landscape of Ladakh, cutting gorges into the rocks and bringing fertility into the otherwise arid land. During the summer, the Zanskar river offers some of the most thrilling whitewater rafting in the country, but in the deepest winter, when the temperatures drop as low as -20 degrees, the river freezes over. </div>
        </div>
      </div>
    </div>
    <div class="upper-text-box">
      <div class="row">
        <div class="col-xs-12 col-sm-5">
          <h2 class="h2"> About the
            Chadar trek</h2>
        </div>
        <div class="col-xs-12 col-sm-7">
          <div class="sub-copy"> The Chadar trek takes you right onto the frozen Zanskar river, into the middle of an untamed winter wilderness. The only thing separating you from the icy depths of the river is a sheet of ice. You'll see waterfalls frozen in mid-flow, bubbles trapped under the ice, and trees with no leaves. You'll stop at the famous Tibb Cave to share a cup of hot buttered tea over a blazing fire, and camp at night in tents under starry skies. It's going to be an unforgettable experience! </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- departure section starts here -->
<section class="section-space">
  <div class="chadar-bg-container">
    <div class="custom-container">
      <div class="blk-bg-container">
        <div class="lower-text-box">
          <div class="row">
            <div class="col-xs-12">
              <div class="chadar-trek-box">
                <div class="sub-copy">
                  <p class="header">Departure dates</p>
                  <font class="white">Everyday departures from </font>
                  <p><font class="white">4th January 2020 to 12th February 2020.</font></p>
                  <p class="mb-20">Choose any date of your choice.</p>
                </div>
                <div class="sub-copy">
                  <p class="header">EARLY BIRD OFFER</p>
                  Prices starting from<font class="white"> Rs 19,999*</font> per person 
                  including taxes. Plus additional <font class="white">Rs 2,000 off</font> on your next trip*</div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- itinerary section starts here -->
<section>
  <div class="custom-container">
    <div class="row">
      <div class="col-xs-12">
        <h2 class="h2 text-center">Short Itinerary</h2>
      </div>
      <div class="col-xs-12">
        <div class="itinerary-box">
          <div class="itinerary-listing">
            <div class="right">
              <ul class="clearfix">
                <li>
                  <div class="copy"><span><img src="images/icon-4.png" alt="The Great Next" title="The Great Next"></span><b class="bold">Day 1 </b>- Reporting day at Leh.</div>
                </li>
              </ul>
            </div>
            <div class="left">
              <ul class="clearfix">
                <li>
                  <div class="copy"><span><img src="images/icon-1.png" alt="The Great Next" title="The Great Next"></span><b class="bold">Day 2 </b>- Acclimatization Day.</div>
                </li>
              </ul>
            </div>
            <div class="right">
              <ul class="clearfix">
                <li>
                  <div class="copy"><span><img src="images/icon-3.png" alt="The Great Next" title="The Great Next"></span><b class="bold">Day 3 </b>- Medical test Day.</div>
                </li>
              </ul>
            </div>
            <div class="left">
              <ul class="clearfix">
                <li>
                  <div class="copy"><span><img src="images/icon-2.png" alt="The Great Next" title="The Great Next"></span><b class="bold">Day 4 </b>- Leh to Shingra Koma then 
                    Trek to Tsomo Paldar.</div>
                </li>
              </ul>
            </div>
            <div class="right">
              <ul class="clearfix">
                <li>
                  <div class="copy"><span><img src="images/icon-2.png" alt="The Great Next" title="The Great Next"></span><b class="bold">Day 5 </b>- Tsomo Paldar to Tibb Cave.</div>
                </li>
              </ul>
            </div>
            <div class="left">
              <ul class="clearfix">
                <li>
                  <div class="copy"><span><img src="images/icon-2.png" alt="The Great Next" title="The Great Next"></span><b class="bold">Day 6 </b>- Tibb Cave to Nerak.</div>
                </li>
              </ul>
            </div>
            <div class="right">
              <ul class="clearfix">
                <li>
                  <div class="copy"><span><img src="images/icon-2.png"></span><b class="bold">Day 7 </b>- Nerak – Tibb Cave.</div>
                </li>
              </ul>
            </div>
            <div class="left">
              <ul class="clearfix">
                <li>
                  <div class="copy"><span><img src="images/icon-2.png" alt="The Great Next" title="The Great Next"></span><b class="bold">Day 8 </b>- Tibb Cave to Shingra Koma 
                    then Drive to Leh.</div>
                </li>
              </ul>
            </div>
            <div class="right">
              <ul class="clearfix">
                <li class="no-border">
                  <div class="copy"><span><img src="images/icon-4.png" alt="The Great Next" title="The Great Next"></span><b class="bold">Day 9 </b>- Trip ends after checkout.</div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 text-center" > 
          
          <a class="global-button hvr-skew-forward mb-20 fancybox" href="#routemap" data-fancybox-group="gallery" >See Chadar trek route map</a> 
          <a class="global-button hvr-skew-forward fancybox" href="#altitudemap" data-fancybox-group="gallery" >See Chadar trek altitude map</a> 
        
        </div>
    </div>
  </div>
    
  <div class="nodisplay" id="routemap"><img src="images/chadartrek-route-map.jpg" alt="" title="" /></div>  
  <div class="nodisplay" id="altitudemap">"<img src="images/chadartrek-altitude-map.jpg" alt="" title=""></div>  
    
</section>
<!-- gallery section starts here -->
<section>
  <div class="gallery-container">
    <div class="gallery-box">
      <div class="left">
        <div>
          <div class="hovereffect"> <img class="img-responsive" src="images/gallery-img-1.jpg" alt="The Great Next" title="The Great Next">
            <div class="overlay">
              <h5>The trail takes you through the barren landscape of Ladakh.</h5>
            </div>
          </div>
        </div>
        <div class="small-box">
          <div class="left">
            <div>
              <div class="hovereffect"> <img class="img-responsive" src="images/gallery-img-2.jpg" alt="The Great Next" title="The Great Next">
                <div class="overlay">
                  <h5>Take in views of frozen waterfalls.</h5>
                </div>
              </div>
            </div>
            <div>
              <div class="hovereffect"> <img class="img-responsive" src="images/gallery-img-3.jpg" alt="The Great Next" title="The Great Next">
                <div class="overlay">
                  <h5>Witness the phenomenon of a river frozen in mid-flow.</h5>
                </div>
              </div>
            </div>
          </div>
          <div class="right">
            <div>
              <div class="hovereffect"> <img class="img-responsive" src="images/gallery-img-4.jpg" alt="The Great Next" title="The Great Next">
                <div class="overlay">
                  <h5>The iconic Chadar trek.</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="right">
        <div>
          <div class="hovereffect"> <img class="img-responsive" src="images/gallery-img-5.jpg" alt="The Great Next" title="The Great Next">
            <div class="overlay">
              <h5>Enjoy the peaceful environs of the Chandratal lake.</h5>
            </div>
          </div>
        </div>
        <div>
          <div class="hovereffect"> <img class="img-responsive" src="images/gallery-img-6.jpg" alt="The Great Next" title="The Great Next">
            <div class="overlay">
              <h5>Take on one of the most iconic treks in the world.</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- condition section starts here -->
<section>
  <div class="condition-box">
    <div class="custom-container">
      <div class="row">
        <div class="col-xs-12">
          <div class="condition">
            <div class="header">*Conditions Early Bird Offer:</div>
            <div class="p">This offer is valid for the package of INR 20,400 per person, for 9 days. The Early Bird Offer allows you to book this trip for INR 19,999, which is the maximum discount that will be given. In addition, the traveler will receive a voucher worth INR 2000 to be used on the next booking.The voucher can only be redeemed after completion of/participation in the Chadar trek in 2020. If the customer does not report for the trek/cancels booking for any reason, the voucher is invalid. If the operator/authorities cancel the trek for reasons beyond their control, the voucher will be sent to the customer upon their return from Ladakh. The voucher can only be redeemed after completion of the Chadar trek in 2020. If the customer does not participate in the trek for any reason, they cannot redeem the voucher. If the customer cancels/does not participate in the trek, the refund amount will only be for the trip cost of INR 19,999, not the voucher cost. This offer is only valid on bookings made until 30th September 2019. This offer is only valid on bookings made and fully paid for by 30th September 2019. The Early Bird Offer is valid for the inclusions and exclusions of the trip. The customer is liable for any additional costs or charges, like ALTOA fees, etc.</div>
          </div>
        </div>
      </div>
    </div>
    <img src="images/condition-bg.jpg" alt="" title=""> </div>
</section>
<!-- visit TGN section starts here -->
<section>
  <div class="custom-container">
    <div class="row">
      <div class="col-xs-12">
        <h3 class="h3"> Want to go on more adventures?</h3>
        <div class="tgn-copy"> Choose from over 500 adventures in trekking, cycling, rafting, scuba diving, paragliding, snorkelling, camping and more.</div>
        <div class="visit-btn "> <a href="https://www.thegreatnext.com/" target="_blank" class="hvr-skew-forward">Visit us at www.thegreatnext.com</a> </div>
      </div>
    </div>
  </div>
</section>
<!-- footer section starts here -->
<section>
  <div class="social-bg"> <img src="images/footer-bg.png" alt=""  title="" > </div>
  <div class="social-box-content">
    <div class="custom-container">
      <div class="row">
        <div class="col-xs-12">
          <div class="social-box">
            <ul>
              <li>
                <div><a href="https://www.facebook.com/thegreatnext" target="_blank"><img src="images/fb.png" alt="facebook" title="facebook"></a></div>
                <div class="img-top"><a href="https://www.facebook.com/thegreatnext" target="_blank"><img src="images/fb-brown.png" alt="facebook" title="facebook"></a></div>
              </li>
              <li>
                <div><a href="https://www.facebook.com/thegreatnext" target="_blank"><img src="images/tt.png" alt="facebook" title="facebook"></a></div>
                <div class="img-top"><a href="https://www.facebook.com/thegreatnext" target="_blank"><img src="images/tt-brown.png" alt="facebook" title="facebook"></a></div>
              </li>
              <li>
                <div><a href="https://www.facebook.com/thegreatnext" target="_blank"><img src="images/insta.png" alt="facebook" title="facebook"></a></div>
                <div class="img-top"><a href="https://www.facebook.com/thegreatnext" target="_blank"><img src="images/insta-brown.png" alt="facebook" title="facebook"></a></div>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-xs-12">
          <div class="copyright">© Copyright 2017 <span><a href="https://www.thegreatnext.com/" target="_blank" >www.thegreatnext.com</a></span>- All Rights Reserved</div>
        </div>
      </div>
    </div>
  </div>
</section>
    <script src="js/jquery.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/TweenMax.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/latest/plugins/ScrollToPlugin.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/placeholders.min.js"></script>
    <script src="js/parallax.js"></script>
    <script src="js/scripts.js"></script>
    <link href="https://www.thegreatnext.com/campaigns/chadar-trek-2020/css/icons.min.css" rel="stylesheet" type="text/css" media="all" />
    <link rel="stylesheet" href="js/jquery-ui.css">
        <script src="js/jquery-ui.js"></script>

        <script type="text/javascript">
          $(document).ready(function(){
                var dateToday = new Date();
                $( function() {
            $( "#datepicker" ).datepicker({
              changeMonth: true,
              changeYear: true,
              dateFormat: 'yy-mm-dd',
              minDate: dateToday,
            });
          });
              
            });
        </script>
    
<script src="js/jquery.fancybox.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('.fancybox').fancybox();
	});	
</script>

</body>
<noscript><iframe src="//www.googletagmanager.com/ns.html?id=GTM-KJ9XL6" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

  <script type="text/javascript">(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':

  new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],

  j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:;j.async=true;j.src=

  '//www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);

  })(window,document,'script','dataLayer','GTM-KJ9XL6');</script>
</html>
