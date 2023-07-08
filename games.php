<!DOCTYPE html>
<html lang="en">
<head>
  <title>Redseed Game Studio</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="We are working on Niara: Rebellion Of the King Visual Novel RPG at the moment. Follow us to see how the development is going.">
  <meta name="keywords" content="Game, video games, mobile games, pc games, RPG, role playing games, visual novel rpg, visual novel games, visual novel">
  <link rel="shortcut icon" type="image/png" href="images/redseed_logo.png"/>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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

<!--Script for newsletter subscription-->
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

<script>
$(document).ready(function(){
  $("#overlayCloseButton").click(function(){
    $("#overlay").remove();
  });
});
</script>

</head>
    <body style = "background-image:url('images/niara_battle_composition_background.png'); background-repeat: no-repeat; background-attachment: fixed; background-position: center;">
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v5.0&appId=628153337695745&autoLogAppEvents=1"></script>
        <div class="container">
            <center>
                <br><br>
                <img src="images/redseed_logo.png" width=100 height=auto>
                <br><br>
                <h1 style="font-family:binary;color:red;">REDSEED GAME STUDIO</h1>
                <h4  style="text-shadow: 0 0 5px #FFFFFF;font-family:binary;">VISUAL NOVELS AND VISUAL NOVEL RPGs</h4>
                <br>
                <button type="button" onclick="location.href='https://store.steampowered.com/app/2280260/Koris_Fable_Visual_Novel/'" class="btn btn-danger">Kori's Fable Visual Novel (Steam)</button>
                <br><br>
                <button type="button" onclick="location.href='https://play.google.com/store/apps/details?id=cc.redseed.korisfable'" class="btn btn-danger">Kori's Fable Visual Novel (Google Play)</button>
                <br><br>
                <button type="button" onclick="location.href='https://store.steampowered.com/app/1082730/Niara_Rebellion_Of_the_King_Visual_Novel_RPG/'" class="btn btn-danger">Niara Rebellion Of The King <br> Visual Novel RPG (Steam)</button>
                <br><br>
                <button type="button" onclick="location.href='https://play.google.com/store/apps/details?id=cc.redseed.niararotk'" class="btn btn-danger">Niara Rebellion Of The King <br> Visual Novel RPG (Google Play)</button>
                <br><br>
            </center>
        </div>
    </body>
</html>
