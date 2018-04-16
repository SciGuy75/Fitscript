<?php
//session_start();
if(isset($_SESSION['username']))
{
echo <<<_end
<div class="w3-top">
 <div class="w3-bar w3-theme-d2 w3-left-align w3-large">
  <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2" href="javascript:void(0);" onclick="openNav()"><i class="fa fa-bars"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4"><i class="fa fa-home w3-margin-right"></i>Logo</a>
  <a href="prizeStore.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Store"><i class="fa fa-credit-card"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Messages"><i class="fa fa-envelope"></i></a>
  <a href="#" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="Account Settings"><i class="fa fa-user"></i></a>
  <a href="logout.php" class="w3-bar-item w3-button w3-hide-small w3-right w3-padding-large w3-hover-white" title="LogOut"><i class="fa fa-remove"></i></a>
 </div>
</div>

<!-- Navbar on small screens -->
<div id="navDemo" class="w3-bar-block w3-theme-d2 w3-hide w3-hide-large w3-hide-medium w3-large">
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Store</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Messages</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">Account Settings</a>
  <a href="#" class="w3-bar-item w3-button w3-padding-large">My Profile</a>
</div>
_end;
}

else {
  $currentPage = basename($_SERVER['PHP_SELF']);
  if($currentPage == "sign_up.php")
  {
    $homeColor = "w3-hide-small w3-hover-white";
    $loginColor = "w3-hide-small w3-hover-white";
    $signUpColor = "w3-white";
  }
  else if($currentPage == "login_page.php")
      {
          $homeColor = "w3-hide-small w3-hover-white";
          $loginColor = "w3-white";
          $signUpColor = "w3-hide-small w3-hover-white";
      }
      else 
      {
          $homeColor = "w3-white";
          $loginColor = "w3-hide-small w3-hover-white";
          $signUpColor = "w3-hide-small w3-hover-white";
      }
    echo <<< _end
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>
    <a href="landingpage.php" class="w3-bar-item w3-button w3-padding-large $homeColor">Home</a>
    <a href="login_page.php"  class="w3-bar-item w3-button w3-padding-large $loginColor">Login</a>
    <a href="sign_up.php"     class="w3-bar-item w3-button w3-padding-large $signUpColor">Signup</a>
  </div>

  <!-- Navbar on small screens -->
  <div id="navDemo" class="w3-bar-block w3-white w3-hide w3-hide-large w3-hide-medium w3-large">
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 1</a>
    <a href="#" class="w3-bar-item w3-button w3-padding-large">Link 2</a>
  </div>
</div>
_end;
}
?>
