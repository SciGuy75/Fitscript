<!DOCTYPE html>
<html>
<title>UserPage</title>
<meta charset="UTF-8">
<?php
    session_start();
    require_once 'stylesheets.php'
?>

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
  <!-- The Grid -->
  <div class="w3-row">
    <!-- Left Column -->
    <div class="w3-col m3">
      <!-- Profile -->
      <div class="w3-card w3-round w3-white">
        <div class="w3-container">
            <h4 class="w3-center">My Profile</h4>
            <!-- <p class="w3-center"><img src="/w3images/avatar3.png" class="w3-circle" style="height:106px;width:106px" alt="Avatar"></p> -->
            <hr>
            <p><i class="fa fa-user fa-fw w3-margin-right w3-text-theme"></i>
                <?php echo ucwords($_SESSION['FirstName']) . " "
                    . ucwords($_SESSION['LastName']);
                ?>
            </p>
            <p><i class="fa fa-home fa-fw w3-margin-right w3-text-theme"></i> Location</p>
            <p><i class="fa fa-birthday-cake fa-fw w3-margin-right w3-text-theme"></i>
            <?php
                $Date = new DateTime($user_class->Birthday);
                echo $Date->format('m-d-Y');
            ?>
            </p>
        </div>
      </div>
      <br>

      <!-- Alert Box -->
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>Alerts</strong></p>
        <p>Alerts go here</p>
      </div>

    <!-- End Left Column -->
    </div>

    <!-- Middle Column -->
    <div class="w3-col m7">

      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <!-- <img src="#" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px"> -->
        <span class="w3-right w3-opacity"></span>
        <h3><b>
                <?php //echo  $_SESSION['FirstName'] . " " . $_SESSION['LastName'] ?>
                <?php echo  "Hi, ".$user_class->UserName; ?>
        <b></h3>
        <p>Current Updates + Graphs go here</p>
        <button type="button" class="w3-button w3-theme-d1 w3-margin-bottom"><i class="fa fa-thumbs-up"></i>  Like</button>
        <button type="button" class="w3-button w3-theme-d2 w3-margin-bottom"><i class="fa fa-comment"></i>  Comment</button>
      </div>
    <!-- End Middle Column -->
    </div>

    <!-- Right Column -->
    <div class="w3-col m2">
      <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container">
          <p><h4>Current Challenges</h4></p>
          <hr>
          <?php $Challenge = new Challenge(-1,"","",-1,0);
                $Challenges = $Challenge->GetAllChallenges($user_class->UserID);
                if(count($Challenges) > 0)
                foreach($Challenges as $c)
                {
                    if($c->status == 'Accepted')
                        echo "<p>".$c->ChallengeID." ".$f->status." ".$c->StartDate." ".$c->EndDate."</p>";
                }
            ?>
          <p><strong>Pending Challenges</strong></p>
          <?php foreach($Challenges as $c)
                {
                    if($c->status == 'Pending')
                        echo "<p>".$c->ChallengeID." ".$f->status." ".$c->StartDate." ".$c->EndDate."</p>";
                }
            ?>
          <p>Challenge</p>
          <hr>
          <p><button class="w3-button w3-block w3-theme-l4">more</button></p>
        </div>
      </div>
      <br>

    <div class="w3-card w3-round w3-white w3-center">
        <div class="w3-container"> <span><h3><b>Friends<b></h3></span>
            <!-- <table>
                <tr>
                    <td>
                        <span><h3><b>Friends<b></h3></span>
                    </td>
                    <td>
                        <button class="w3-button w3-white fa-border"><i class="fa fa-plus"></i></button>
                    </td>
                </tr>
            </table> -->
            <!-- <img src="#" alt="friendslistAvatar" style="width:50%"><br> -->
            
            <?php $friend = new Friend(-1,"","",-1,0);
                $FriendList = $friend->Friends();
                if(count($FriendList) > 0)
                {
                    foreach($FriendList as $f)
                    {
                      echo "<p>".$f->FriendFirstName." ".$f->FriendLastName." ".$f->Steps."</p>";
                    }
                }
               else echo "-";
            ?>
            <hr>
            <h4><p><b>Friend Request</b></p></h4>
            <hr>

            <div class="w3-row w3-opacity">
                <div class="w3-half">
                  <button class="w3-button w3-block w3-green w3-section" title="Accept"><i class="fa fa-check"></i></button>
                </div>
                <div class="w3-half">
                    <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- End Right Column -->
    </div>
  <!-- End Grid -->
  </div>
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

<script>
// Accordion
function myFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
        x.previousElementSibling.className += " w3-theme-d1";
    } else {
        x.className = x.className.replace("w3-show", "");
        x.previousElementSibling.className =
        x.previousElementSibling.className.replace(" w3-theme-d1", "");
    }
}

// Used to toggle the menu on smaller screens when clicking on the menu button
function openNav() {
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
