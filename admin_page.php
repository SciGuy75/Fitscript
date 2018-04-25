<!DOCTYPE html>
<html>
<title>AdminPage</title>
<meta charset="UTF-8">
<?php
    session_start();
    require_once 'stylesheets.php'
?>

<style>
    html,body,h1,h2,h3,h4,h5 {font-family: "Open Sans", sans-serif}
    .height {
        height: 30px;
    }
</style>
<body class="w3-theme-l5">

<?php
require_once 'navbar.php';
//require_once 'session_check.php';
require_once 'User.php';
require_once 'Prizes.php';
if (!$_SESSION['isAdmin']){
	header("Location: user_page.php");
}

$user_class = new user($_SESSION['username']);
$user_class->GetInfo($user_class->UserName, $_SESSION['pswd_token']);
$priz = new Prizes("","","","","");
$user_to_delete = "";
$delete_successful = 0;
$prize_update_successful = 0;
?>
<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <!-- right Column -->

      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <!-- <img src="#" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px"> -->
        <span class="w3-right w3-opacity"></span>
        <h3><b>
            <?php echo '<div style="text-align:center">Welcome to the the Admin page,  ' .$user_class->UserName. "</div>"; ?>
        </b></h3>
        <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
  		<p><h3>Enter username of account to delete.</h3></p>
        <form method="post" action="admin_page.php">
            <p class="ex1">
                <input type="text" style="height:38px" length="50" id='userdelete' value="<?php echo $user_to_delete; ?>"/>
                <button onclick='DeleteUser()' class="w3-button w3-red">Delete</button>
                <span id="DeleteResult"></span>
            </p>
         </form>
        </div>
    <!-- End right Column -->
    </div>
    <div>
              <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                <!-- <img src="#" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px"> -->
                <span class="w3-right w3-opacity"></span>

                <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
          		<p><h3>Change a prize in the PrizeStore:</h3></p>
                <!-- <form method="post" action="admin_page.php"> -->
                    <p class="ex1">
                        Prize ID:
                        <select id="PrizeIDs" onchange="GetPrizeInfo()" name="PrizeNumber">
                            <?php 
                                $prizeList = $priz->GetAllPrizes();
                                echo "<option value='blank'> </option>";
                                foreach(array_slice($prizeList,1) as $p)
                                {
                                    echo "<option value='$p->prizeID'>$p->prizeID: $p->prizeName $p->price pts</option>";
                                }
                            ?>
                        </select><br><br>
                        Update Price To: <input type="number" id='newPrice'/><br><br>
                        select color of prize:
                         <select name="color">
                            <option value="red">red</option>
                            <option value="blue">blue</option>
                            <option value="orange">orange</option>
                            <option value="pink">pink</option>
                            <option value="yellow">yellow</option>
                            <option value="green">green<</option>
                        </select>
                        <br>
                        <button class="w3-button w3-green" onclick="UpdatePrizePrice()">Update</button>
                        <br>
                        <span id="UpdateID"></span>
                    </p>
                 </form>
                </div>
    </div>
    <div>
              <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
                <!-- <img src="#" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px"> -->
                <span class="w3-right w3-opacity"></span>

                <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
          		<p><h3>Add Prize To Store:</h3></p>
                <!-- <form method="post" action="admin_page.php"> -->
                    <p class="ex1">
                        Prize Name: <input type="text" id='newPrizeName'/>
                        Prize Description: <input type="text" length=60 id='newPrizeDesc'/><br><br>
                        Prize Price: <input type="number" id='newPrizePrice'/>
                        <br>
                        <button class="w3-button w3-green" onclick="AddPrize()">AddPrize</button>
                        <br>
                        <span id="AddPrize"></span>
                    </p>
                 </form>
                </div>
    </div>
  </div>
</div>

<script>
function DeleteUser()
{
    var userdelete = document.getElementById("userdelete").innerHTML;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) 
        {
            document.getElementById("DeleteResult").innerHTML = this.responseText;
        }
    };
    xhttp.open("POST", "AdminPageAjax.php?method=DeleteUser&UserToDelete="+userdelete, true);
    xhttp.send();
}
function AddPrize()
{
    var name = document.getElementById("newPrizeName").value;
    var desc = document.getElementById("newPrizeDesc").value;
    var price = document.getElementById("newPrizePrice").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
            location.reload();
            document.getElementById("AddPrize").innerHTML =
            this.responseText;
        }
    };
  xhttp.open("POST", "PrizeStoreAjax.php?method=AddPrize&name="+name+"&desc="+desc+"&price="+price, true);
  xhttp.send();
}
function UpdatePrizePrice()
{
    var prizeID = document.getElementById("PrizeIDs").value;
    var newPrice = document.getElementById("newPrice").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        location.reload();
        document.getElementById("UpdateID").innerHTML = this.responseText;
        }
    };
  xhttp.open("POST", "AdminPageAjax.php?method=UpdatePrizePrice&prizeID="+prizeID+"&newPrice="+newPrice, true);
  xhttp.send();

}
// function GetPrizeInfo(id)
// {
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//     if (this.readyState == 4 && this.status == 200) {
//         //location.reload();
//             document.getElementById("currentPrice").innerHTML =
//             this.responseText;
//         }
//     };
//   xhttp.open("POST", "AdminPageAjax.php?method=GetPrizeInfo&prizeID="+id, true);
//   xhttp.send();
// }
</script>

</body>
</html>
