<!DOCTYPE html>
<html>
<title>UserPage</title>
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
                    foreach(array_slice($FriendList,1) as $f)
                    {
                      echo "<button class='accordion'>".$f->FriendFirstName." ".$f->FriendLastName."</button>
                      <div class='panel'>
                            <div class='w3-half'>
                                <button class='w3-button w3-block w3-section' title='Steps'>$f->Steps</button>
                            </div>
                           
                            <div class='w3-half'>
                                <button class='w3-button w3-block w3-red w3-section' title='Delete'>Delete</button>
                            </div>
                      </div>";
                    }
                }
               else echo "-";
            ?>
            <hr>
            <h4><p><b>Friend Request</b></p></h4>
            <hr>
            <?php $friend = new Friend(-1,"","",-1,0);
                $PendingFriendList = $friend->PendingFriends($user_class->UserID);
                if(count($PendingFriendList) > 0)
                {
                    foreach(array_slice($PendingFriendList,1) as $f)
                    {
                      echo "<button class='accordion'>".$f->FriendFirstName." ".$f->FriendLastName."</button>
                            <div class='panel'>
                                    <div class='w3-half'>
                                    <button class='w3-button w3-block w3-green w3-section' onclick='AcceptFriendRequest($f->FriendUserID);' title='Accept'><i class='fa fa-plus'></i></button>
                                    </div>
                                
                                    <div class='w3-half'>
                                        <button class='w3-button w3-block w3-red w3-section' onclick='DeclineFriendRequest($f->FriendUserID)' title='Delete'><i class='fa fa-remove'></i></button>
                                    </div>
                            </div>";
                    }
                }
               else echo "-";
            ?>
            <div class="w3-row w3-opacity">
                <div>
                  <button class="w3-button w3-block w3-green w3-section accordion" title="Add">Add Friends</button>
                  <div class='panel'>
                        <table>
                        <tr>
                        <td>
                        <input type="text" id="newFriend" size="17"></td>
                        <td><button class="w3-button myButton" onclick="AddNewFriend()" title="addFriendButton"><i class="fa fa-plus"></i></button>
                        </td></tr>
                        </table>
                  </div>
                </div>
                <!-- <div class="w3-half">
                    <button class="w3-button w3-block w3-red w3-section" title="Decline"><i class="fa fa-remove"></i></button>
                </div> -->
            </div>
        </div>
    </div>
      <!-- Alert Box -->
      <div class="w3-container w3-display-container w3-round w3-theme-l4 w3-border w3-theme-border w3-margin-bottom w3-hide-small">
        <span onclick="this.parentElement.style.display='none'" class="w3-button w3-theme-l3 w3-display-topright">
          <i class="fa fa-remove"></i>
        </span>
        <p><strong>Alerts</strong></p>
        <p id="Alerts">Alerts go here</p>
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
        <p>Today's Steps: </p>
		<p>Total Steps: </p>
        Update Today's steps<input type="number" name="steps" min="0" max="15000" /> <input type="submit" value ="Update Steps" name="submit"/>
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
                    {
                        echo "<button class='accordion'>".$c->ChallengeID." ".$f->status." ".$c->StartDate." ".$c->EndDate."</button>
                        <div class='panel'>filler</div>";
                    }       
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
        x.previousElementSibling.className = "";
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
function AcceptFriendRequest(fuserID)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        location.reload();
      document.getElementById("Alerts").innerHTML =
      this.responseText;
        }
    };
  xhttp.open("POST", "AcceptFriendAjax.php?AddedFriend="+fuserID+"&StatusChange=Accept", true);
  //xhttp.open("POST", "AddFriendAjax.php?newFriend="+x+"&StatusChange=Accept",true);
  xhttp.send();
}
function DeclineFriendRequest(fuserID)
{
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        location.reload();
      document.getElementById("Alerts").innerHTML =
      this.responseText;
        }
    };
  xhttp.open("POST", "AcceptFriendAjax.php?AddedFriend="+fuserID+"&StatusChange=Decline", true);
  //xhttp.open("POST", "AddFriendAjax.php?newFriend="+x+"&StatusChange=Accept",true);
  xhttp.send();
}
function AddNewFriend()
{
    var x = document.getElementById("newFriend").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("Alerts").innerHTML =
      this.responseText;
        }
    };
  xhttp.open("POST", "AddFriendAjax.php?newFriend="+x, true);
  xhttp.send();
}
//document.getElementByTag("Button").style.margin = "25px";
var acc = document.getElementsByClassName("accordion");
var i;

for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function() {
        this.classList.toggle("active");
        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}
</script>

</body>
</html>
