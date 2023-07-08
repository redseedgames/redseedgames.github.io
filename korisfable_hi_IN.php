<!DOCTYPE html>
<html lang="hi">
<head>
  <title>Kori's Fable</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="एक्शन, एडवेंचर और रोमांस विजुअल उपन्यास एवं टर्न बेस्ड गेम्स।">
  <meta name="keywords" content="Game, video games, mobile games, pc games, RPG, role playing games, visual novel rpg, visual novel games, visual novel">
  <link rel="shortcut icon" type="image/png" href="images/redseed_logo.png"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function(){
  // Add smooth scrolling to all links
  $("a").on('click', function(event) {

    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
});
</script>

<script>
$(document).ready(function(){
  $("#subscribeButton").click(function(){
    
	//Fetching email address from the input field
	var email = document.getElementById("usr").value;
	
	//Validating the fetched email address
	var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
	if(email.match(mailformat))
	{
		
		//Sending request to server
		$.post("subscribe.php",
		{
		email: email
		},
		function(data,status){
			var messageData = JSON.parse(data);
			document.getElementById("usr").value = "";
			document.getElementById("usr").placeholder = messageData["message"];
		});	
	}
	else
	{
		document.getElementById("usr").value = "";
		document.getElementById("usr").placeholder = "Please Enter Valid Email Address";
	}
	
  });
});
</script>

<script>
$(document).ready(function(){
  $("#closeButton").click(function(){
    $("#subscribeForm").remove();
  });
});
</script>

</head>
<body style = "background-image:url('images/koris_fable_shooting_pose_cover_background_compressed.jpg'); background-repeat: no-repeat; background-attachment: fixed; background-position: center;">
<nav class="navbar navbar-expand-md fixed-top">
  <a href = "index.php"><img src = "images/redseed_logo_edited_720p.png"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar" style = "color:white;">
    <img src = "images/toggler_icon.png">
	<!--<span class="navbar-toggler-icon"></span>-->
  </button>
  <div class="collapse navbar-collapse" id="collapsibleNavbar" style="margin-left:20px;">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" href="#home" data-toggle="collapse" data-target=".navbar-collapse.show" style="color:white;">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href = "#about" data-toggle="collapse" data-target=".navbar-collapse.show" style = "color:white;">About</a>
      </li>
     <li class="nav-item">
        <a class="nav-link" href="#screenshots" data-toggle="collapse" data-target=".navbar-collapse.show" style = "color:white;">Screenshots</a>
     </li>  
     <li class="nav-item">
        <a class="nav-link" href="#contactus" data-toggle="collapse" data-target=".navbar-collapse.show" style = "color:white;">Contact Us</a>
     </li>
	<!--<li class="nav-item" style = "float:right;">
        <a class="nav-link" href="https://spark.adobe.com/page/6b6RXxOKUIlIC/" style = "color:white;">Press kit</a>
     </li>-->
	 <li class="nav-item" style = "float:right;">
        <a class="nav-link" href="https://redseed.cc/blog" style = "color:white;">Blog</a>
     </li>
    </ul>
  </div>  
</nav>
<br>
<!--<div class="container-fluid" style="padding-top:10px;margin-top:30px;background-color:rgba(0,0,0,0.8);">
  <div class="row">
    <div class="col-sm-12">
	<center>
	<img src = "images/discord.png" class = "img-fluid" width = "48" height = "auto"/>
	<a href="https://discord.gg/qUYyMuM" style="color:white;">Join our discord server</a>
	</center>
	</div>
  </div>
</div>-->
<div class="container-fluid" style="margin-top:30px;">
	  <div class = "row">
	  <div class="col-sm-6">
	  <p id = "home"></p><br><br>
	  <img src = "images/koris_fable_text_hindi.png" class="img-fluid"><br><br>
	  <h2 style = "text-shadow: 0 0 5px #FFFFFF;font-family:binary;">अंधेरी जादुई शक्तियों एवं पीड़ा से भरी इस दुनिया में एक लड़की की कहानी।</h2>
	  <br><br>
	  <center>
	  <h2 style = "text-shadow: 0 0 5px #FFFFFF;font-family:binary;">डेमो उपलब्ध है</h2>
	  </center>
	  
	  <!--Google Play and Itch.io button images-->
	  <center>
	  <div class = "d-inline"><a href = "https://play.google.com/store/apps/details?id=cc.redseed.korisfablehindi"><img src = "images/google-play-badge.png" style = "margin-right:10px;margin-top:10px;width:300px;height:auto;"/></a>
	  <!--<a href = "https://redseedgames.itch.io/koris-fable"><img src = "images/itch_badge.png" style = "width:300px;height:auto;margin:10px;"/></a>-->
	  </div>
	  </center>
	  
	  </div>
	  
	  <div class = "col-sm-6">
	  <br>
	  <img src = "images/kori_angry_1_square.png" class = "img-fluid">
	  </div>
	  </div>
	  <hr style="border: 2px solid white;padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;">
	  <p id = "about"></p>
	  <h1 style="text-shadow: 0 0 10px white;font-family:binary;color:white;font-size:60px;">बारे में</h1>
	  <br><br>
	  <div class = "row">
	  <div class = "col-sm-6">
	  <img src = "images/seashore_scene_1_resized_compressed.jpg" class = "img-fluid">
	  </div>
	  <div class = "col-sm-6">
	  <h2 style = "text-shadow: 0 0 5px #FFFFFF;font-family:binary;">हाई बर्म महाद्वीप में पुजारियों के पास सर्वोच्च अधिकार थे । प्रगतिशील सोच और गतिविधियाँ निषिद्ध थीं और पुजारियों के कानून निश्चित थे। महाद्वीप के राज्य अपने उच्च पुजारियों से परामर्श लेकर शासन करते थे। समाज काफी हद तक रूढ़िवादी और पितृसत्तात्मक था और जो लोग इस सामाजिक संरचना का विरोध करने की कोशिश करते थे वे दंडित होते थे। इसके अलावा, अंधेरी दैवीय शक्तियों और टोना-टोटका के मेल ने इस भूमि में कई अंघेर मंत्रों और निषिद्ध कलाओं को पैदा कर दिया था, जिसने आम लोगों के जीवन को और भी कठिन बना दिया।</h2>
	  </div>
	  </div>
	  <hr style="border: 2px solid white;padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;">
	  <div class = "row">
	  <div class = "col-sm-8"><br>
	 <h1 style="text-shadow: 0 0 10px white;font-family:binary;color:white;font-size:60px;">स्क्रीनशॉट</h1>
	 <div id="screenshots" class="carousel slide" data-ride="carousel">
	 <br><br><br>
  <ol class="carousel-indicators">
    <li data-target="#screenshots" data-slide-to="0" class="active"></li>
    <li data-target="#screenshots" data-slide-to="1"></li>
    <li data-target="#screenshots" data-slide-to="2"></li>
	<li data-target="#screenshots" data-slide-to="3"></li>
	<li data-target="#screenshots" data-slide-to="4"></li>
	<li data-target="#screenshots" data-slide-to="5"></li>
	<li data-target="#screenshots" data-slide-to="6"></li>
  </ol>
  <div class="carousel-inner" role="listbox">
    <div class="carousel-item active">
      <img class="d-block img-fluid" src="images/koris_fable_screenshot_3_hindi_compressed.jpg">
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="images/koris_fable_screenshot_2_hindi_compressed.jpg">
    </div>
    <div class="carousel-item">
      <img class="d-block img-fluid" src="images/koris_fable_screenshot_1_hindi_compressed.jpg">
    </div>
	<div class="carousel-item">
      <img class="d-block img-fluid" src="images/koris_fable_screenshot_4_hindi_compressed.jpg">
    </div>
	<div class="carousel-item">
      <img class="d-block img-fluid" src="images/koris_fable_screenshot_5_hindi_compressed.jpg">
    </div>
	<div class="carousel-item">
      <img class="d-block img-fluid" src="images/koris_fable_screenshot_6_hindi_compressed.jpg">
    </div>
	<div class="carousel-item">
      <img class="d-block img-fluid" src="images/koris_fable_screenshot_7_hindi_compressed.jpg">
    </div>
 
	</div>
  <!--<a class="carousel-control-prev" href="#screenshots" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#screenshots" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>-->
</div>
</div>
<div class = "col-sm-4">
<br><br><br><br><br><br>
<h2 style = "text-shadow: 0 0 5px #FFFFFF;font-family:binary;">
इस सब के बीच कोरी नाम की एक प्यारी लड़की ने अपने माता-पिता को खो दिया जब उन्हें उसके राज्य द्वारा बंदी बना लिया गया। वह राज्य के चंगुल से बच गई, लेकिन अफसोस यह था कि वह एक मासूम लड़की थी, जो दुनिया के तरीकों और विश्वासघातों से अनजान थी। वह हमेशा अपने माता-पिता के प्यार और देखभाल में रही थी और अब अचानक वह भटक गई थी। वह जिस पर भरोसा कर सकती थी, वह एक चुड़ैल, उसका बेटा और अपने माता-पिता के साथ एकजुट होने की तीव्र इच्छा थी।

क्या आप कोरी का मार्गदर्शन करेंगे और उसके मिशन में उसकी मदद करेंगे?
</h2>
</div>
</div>
<hr style="border: 2px solid white;padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;">
 <p id = "contactus"></p><br><br>
	  <div class = "row">
	  <div class = "col-sm-4">
	  <h1 style="text-shadow: 0 0 10px white;font-family:binary;color:white;font-size:60px;">संपर्क करें</h1>
	  <br><br>
	  <h2 style = "text-shadow: 0 0 5px #FFFFFF;font-family:binary;">संपर्क करें यहाँ</h2>
	  <h2 style = "text-shadow: 0 0 5px #FFFFFF;font-family:binary;font-size:27px;">SUPPORT@REDSEED.CC</h2><br><br>
	  <h2 style = "text-shadow: 0 0 5px #FFFFFF;font-family:binary;">सोशल मीडिया पर हमारे साथ जुड़ें</h2>
	  <span>
<a href = "http://www.facebook.com/redseedgames"><img src = "https://ayushraj1024.files.wordpress.com/2019/01/if_facebook_circle_color_107175.png"/></a>
<a href = "http://www.instagram.com/redseedgames"><img src = "https://ayushraj1024.files.wordpress.com/2018/11/1cb40-if_25_social_2609558.png"/></a>
<a href = "http://www.twitter.com/redseedgames"><img src = "https://ayushraj1024.files.wordpress.com/2019/01/if_twitter_circle_color_107170.png"/></a>
<a href = "https://www.linkedin.com/company/redseedgames/"><img src = "https://ayushraj1024.files.wordpress.com/2019/01/if_linkedin_circle_color_107178.png"/></a>
<a href = "https://www.youtube.com/channel/UC-__kq1bWNFzPr2r5DlJ8ZA"><img src = "https://ayushraj1024.files.wordpress.com/2018/11/59648-if_youtube_317714.png"/></a>
<a href = "https://www.tumblr.com/blog/redseedgames"><img src = "https://ayushraj1024.files.wordpress.com/2019/03/if_tumblr_2308134.png"/></a>
</span><br><br>
	  </div>
	  
  </div>
  
  </div>
  
	  

<br><br><br><br>
<hr style="border: 2px solid white;padding-bottom:0px;margin-bottom:0px;padding-top:0px;margin-top:0px;">
 <!-- Footer -->
              <footer class="page-footer font-small blue pt-4">

                  <!-- Footer Links -->
                  <div class="container-fluid text-center text-md-left">

                    <!-- Grid row -->
                    <div class="row">

                      <!-- Grid column -->
                      <div class="col-md-6 mt-md-0 mt-3">

                        <!-- Content -->
                        <h5 class="text-uppercase">पहुँचें</h5>
                        प्रयागराज, उत्तर प्रदेश, भारत 211002
                      </div>
                      <!-- Grid column -->

                      <hr class="clearfix w-100 d-md-none pb-3">

                      <!-- Grid column -->
                      <div class="col-md-3 mb-md-0 mb-3">

                          <!-- Links -->
						  <h5 class="text-uppercase">लिंक</h5>
                          <ul class="list-unstyled">
                            <li>
                              <a href="terms_and_conditions.html">नियम और शर्तें</a>
                            </li>
                            <li>
                              <a href="privacy_policy.html">गोपनीयता नीति</a>
                            </li>
                          </ul>

                        </div>
                        <!-- Grid column -->

                        <!-- Grid column -->
                        <div class="col-md-3 mb-md-0 mb-3">

                          <!-- Links -->
                          <h5 class="text-uppercase">फाॅलो करें</h5>

                          <ul class="list-unstyled">
                            <li>
                              <span>
<a href = "http://www.facebook.com/redseedgames"><img src = "https://ayushraj1024.files.wordpress.com/2019/01/if_facebook_circle_color_107175.png"/></a>
<a href = "http://www.instagram.com/redseedgames"><img src = "https://ayushraj1024.files.wordpress.com/2018/11/1cb40-if_25_social_2609558.png"/></a>
<a href = "http://www.twitter.com/redseedgames"><img src = "https://ayushraj1024.files.wordpress.com/2019/01/if_twitter_circle_color_107170.png"/></a>
<a href = "https://www.linkedin.com/company/redseedgames"><img src = "https://ayushraj1024.files.wordpress.com/2019/01/if_linkedin_circle_color_107178.png"/></a>
<a href = "https://www.youtube.com/channel/UC-__kq1bWNFzPr2r5DlJ8ZA"><img src = "https://ayushraj1024.files.wordpress.com/2018/11/59648-if_youtube_317714.png"/></a>
<a href = "https://www.tumblr.com/blog/redseedgames"><img src = "https://ayushraj1024.files.wordpress.com/2019/03/if_tumblr_2308134.png"/></a>
</span>
                            </li>
                          </ul>

                        </div>
                        <!-- Grid column -->

                    </div>
                    <!-- Grid row -->

                  </div>
                  <!-- Footer Links -->

                  <!-- Copyright -->
                  <div class="footer-copyright text-center py-3">Copyright © <?php echo date("Y"); ?> Redseed Game Studio. All rights reserved.
                  </div>
                  <!-- Copyright -->

                </footer>
                <!-- Footer -->

<!--Newsletter and Updates Sign Up Floating Form-->
<div id="subscribeForm" class="container" style="margin-left:0px;margin-right:0px;padding-left:0px;padding-right:0px;position:fixed;bottom:0;float:center;">
	<div class = "row" style="background-color:rgba(0,0,0,0.9);border-top: 1px solid white;border-right: 1px solid white;">
		<div class="col-sm-6">
			<center>
				<h2 style = "text-shadow: 0 0 5px #FFFFFF;font-family:binary;">
				SUBSCRIBE TO OUR NEWSLETTER
				</h2>
			</center>
		</div>
		<div class="col-sm-3" style="padding-top:5px;">
				<center>
				<input type="text" class="form-control" id="usr" placeholder = "Enter Email" style="margin-left:10px;margin-right:10px;">
				</center>
		</div>
		<div class="col-sm-3" style="padding-top:5px;padding-bottom:5px;">
				<center>
				<button id="subscribeButton" class="btn btn-danger">Subscribe</button>
				<button style="margin-left:10px;" id="closeButton" class="btn btn-danger">Close</button>
        </center>
		</div>
	</div>
</div>

</body>
</html>
