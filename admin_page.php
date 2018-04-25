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
</style>
<body class="w3-theme-l5">

<?php
require_once 'navbar.php';
require_once 'session_check.php';
require_once 'User.php';

if (!$_SESSION['isAdmin']){
	header("Location: user_page.php");
}

$user_class = new user($_SESSION['username']);
$user_class->GetInfo($user_class->UserName, $_SESSION['pswd_token']);

$user_to_delete = "";
$delete_successful = 0;
$prize_update_successful = 0;
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userdelete'])){
    $user_to_delete = $_POST['userdelete'];
    require 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error)
        die($conn->connect_error);

    $query = "UPDATE `Users` SET `AccountStatus` = null WHERE `Users`.`UserName` = '$user_to_delete'";

    $results = $conn->query($query);
    if (!$results) die ("Database access failed: " . $conn->error);
    $conn->close();

    if($results){
        $delete_successful = 1;
    }

}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['PrizeNumber'])){
    require 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error)
        die($conn->connect_error);
    $points = $_POST['points'];
    $color = $_POST['color'];
    $PrizeNumber = $_POST['PrizeNumber'];
    $query = "UPDATE `Prizes`
            SET `Price` = '$points',
                `color` = '$color'
            WHERE `Prizes`.`PrizeID` = $PrizeNumber";


    $results = $conn->query($query);
    if (!$results) die ("Database access failed: " . $conn->error);
    $conn->close();

    if($results){
        $prize_update_successful = 1;
    }
}


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
                <input type="text" length="50" name='userdelete' value="<?php echo $user_to_delete; ?>"/>
                <input type="submit" value ="delete user" name="submit"/>
                <?php
                    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userdelete'])){
                        if($delete_successful){
                            echo "User successully deleted";
                        }
                        else{
                            echo "Could not delete user";
                        }

                    }
                ?>
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
          		<p><h3>Change a prize in the PrizeStore.</h3></p>
                <form method="post" action="admin_page.php">
                    <p class="ex1">
                        prize number:
                        <select name="PrizeNumber">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select><br><br>
                        prize points required: <input type="number" name='points' value="<?php echo $user_to_delete; ?>"/><br><br>
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
                        <input type="submit" value ="update prize" name="submit"/>
                        <br>
                        <?php
                            if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['color'])){
                                if($prize_update_successful){
                                    echo "prize updated";
                                }
                                else{
                                    echo "Could not updated prize";
                                }

                            }
                        ?>
                    </p>
                 </form>
                </div>
    </div>
  </div>
</div>

<script>

function AddPrize()
{
    var name = document.getElementById("newPrizeName").value;
    var desc = document.getElementById("newPrizeDesc").value;
    var price = document.getElementById("price").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        //location.reload();
      document.getElementById("Alerts").innerHTML =
      this.responseText;
        }
    };
  xhttp.open("POST", "PrizeStoreAjax.php?method=AddPrize&name="+name+"&desc="+desc+"&price="+price, true);
  xhttp.send();
}
</script>




</body>
</html>
