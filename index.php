<!DOCTYPE html>
<html>
<title>Landing Page</title>
<meta charset="UTF-8">
<?php require_once 'stylesheets.php' ?>
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Lato", sans-serif}
.w3-bar,h1,button {font-family: "Montserrat", sans-serif}
.fa-heartbeat,.fa-coffee {font-size:200px}
</style>
<body>

<!-- Navbar -->
<?php require_once 'navbar.php' ?>

<!-- Header -->
<header class="w3-container w3-red w3-center" style="padding:128px 16px">
  <h1 class="w3-margin w3-jumbo">FITSCRIPT</h1>
</header>

<!-- First Grid -->
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>About Fitscript</h1>
      <h5 class="w3-padding-32">Fitscript is a webapp that allows members to log and track their fitness, and nutritional information.</h5>

      <p class="w3-text-grey">Once you register with us, you can view your current fitness statistics, and invite friends to weekly challenges for fun! You can set your personal fitness goals, such as weight or daily step count. We like to reward our members' hardwork, so a "Script Store" is available. Members can collect points over time, and redeem them at the store.</p>
    </div>

    <div class="w3-third w3-center">
      <i class="fa fa-heartbeat w3-padding-64 w3-text-red"></i>
    </div>
  </div>
</div>


<div class="w3-container w3-black w3-center w3-opacity w3-padding-64">
    <h1 class="w3-margin w3-xlarge">Quote of the day:  Live Life</h1>
</div>


<script>
// Used to toggle the menu on small screens when clicking on the menu button
function myFunction() {
    var x = document.getElementById("navDemo");
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>
</body>
</html>
