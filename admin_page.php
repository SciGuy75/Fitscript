<!DOCTYPE html>
<html>
<title>AdminPage</title>
<meta charset="UTF-8">
<?php
    session_start();
    require_once 'stylesheets.php'
?>
 <style>
.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 10px 10px 5px 10px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
    transition: 0.4s;
}

.active, .accordion:hover {
    background-color: #ccc;
}
.myButton{
    height:30px;
    width:50px;
}
.panel {
    padding: 0 0 18px 0;

    display: none;
    background-color: white;
    overflow: hidden;
}
</style>
<style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
</style>
<body class="w3-theme-l5">

<?php
require_once 'navbar.php';
require_once 'Friend.php';
require_once 'User.php';
require_once 'Challenge.php';
require_once 'session_check.php';
$user_class = new user($_SESSION['username']);
$user_class->GetInfo($user_class->UserName, $_SESSION['pswd_token']);
?>
<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <!-- Middle Column -->

      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <!-- <img src="#" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px"> -->
        <span class="w3-right w3-opacity"></span>
        <h3><b>
                <?php //echo  $_SESSION['FirstName'] . " " . $_SESSION['LastName'] ?>
                <?php echo  '<div style="text-align:center">Welcome to the the Admin page,  ' .$user_class->UserName. "</div>"; ?>
    <!-- End Middle Column -->
    </div>
  </div>
</div>






</body>
</html>
