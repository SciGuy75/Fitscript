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
require_once 'session_check.php';
require_once 'User.php';
$user_class = new user($_SESSION['username']);
$user_class->GetInfo($user_class->UserName, $_SESSION['pswd_token']);

$user_to_delete = "";
$delete_successful = 0;
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['userdelete'])){
    $user_to_delete = $_POST['userdelete'];
    require 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error)
        die($conn->connect_error);

    $query = "DELETE FROM `Users`
                WHERE `Users`.`UserName` = '$user_to_delete'";

    $results = $conn->query($query);
    if (!$results) die ("Database access failed: " . $conn->error);
    $conn->close();

    if($results){
        $delete_successful = 1;
    }

}

?>
<!-- Page Container -->
<div class="w3-container w3-content" style="max-width:1400px;margin-top:80px">
    <!-- Middle Column -->

      <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
        <!-- <img src="#" alt="Avatar" class="w3-left w3-circle w3-margin-right" style="width:60px"> -->
        <span class="w3-right w3-opacity"></span>
        <h3><b>
            <?php echo  '<div style="text-align:center">Welcome to the the Admin page,  ' .$user_class->UserName. "</div>"; ?>
        </b></h3>
        <div class="w3-container w3-card w3-white w3-round w3-margin"><br>
  		<p>Enter username of account to delete.</p>
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


    <!-- End Middle Column -->
    </div>
  </div>
</div>






</body>
</html>
