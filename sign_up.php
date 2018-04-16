<?php
$error = $userName = $password = "";
require_once 'login.php';
session_start();// uncommented this out as it is needed to check $_SESSION
if(isset($_SESSION['isAdmin']))
{
    routeUser();
}

if($_SERVER["REQUEST_METHOD"] == "GET")
{          
    if(isset($_GET['username'])) $username = sanitizeString($_GET['username']);
    if(isset($_GET['password'])) $password = sanitizeString($_GET['password']);
        
    $token = SaltPswd($password);
    $user = ExecuteQuery($token, $username);

     if($user['password']== $token) 
     {              
         //session_start();
         $_SESSION['username'] = $username;
         $_SESSION['userID'] = $user['UserID'];
         $_SESSION['pswd_token'] = $user['password'];//$token;
         $_SESSION['FirstName'] = $user['FirstName'];
         $_SESSION['LastName'] = $user['LastName'];
         $_SESSION['isAdmin'] = $user['IsAdmin'];
         routeUser();                  
     }
     else
     {
         $error = "The username / password combination is not correct.";
     }
}

function sanitizeString($var)
  {
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
  }
function routeUser()
{
    //session_start();
    if(isset($_SESSION['isAdmin'] ))
    {
        header('Location: user_page.php');
        exit();
    }    
}

function SaltPswd($p)
{
    $salt1 = "qm&h*";
    $salt2 = "pg!@";
    return hash('ripemd128', "$salt1$p$salt2");
}

?>

<!DOCTYPE html>
<html>
<title>Sign Up Page</title>
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

<!-- First Grid -->
<form method="get" action="sign_up.php">
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>Sign Up<?php $error ?></h1>
      <h5 class="w3-padding-32">
          <table>
          <tr>
          <td><p><label>First Name: </label></td>
            <td><input type="text" name="fname" value=<?php $firstname ?>> <br></p></td></tr>
            <tr><td><p><label>Last Name: </label></td>
            <td><input type="text" name="lname" value=<?php $lastname ?>> <br></p></td></tr>
            <tr><td><p><label>Username: </label></td>
            <td><input type="text" name="username" value=<?php $username ?>> <br></p></td></tr>
            <tr><td><p><label>Password: </label></td>
            <td><input type="password" name="password" value=<?php $password ?>> <br></p></td></tr>
            <tr><td><p><label>Birthday: </label></td>
            <td><input type="date" name="birthday" value=<?php $birthday ?>> <br></p></td></tr>
            <tr><td><p><label>Gender: </label></td>
	    <td><input type="radio" name="gender" value="male" checked> Male
            <input type="radio" name="gender" value="female"> Female
            <input type="radio" name="gender" value="other"> Other<br></p></td></tr>
            <tr><td><p><label>Phone: </label></td>
            <td><input type="text" size="10" name="phone" value=<?php $phone ?>> <br></p></td></tr>
            <tr><td><p><label>Height: </label></td>
            <td><input type="text" name="height" value=<?php $height ?>>(in inches) <br></p></td></tr>
            <tr><td><p><label>Weight: </label></td>
            <td><input type="text" name="weight" value=<?php $weight ?>>(in lbs) <br></p></td></tr></table>
            <tr><td><p><input type="submit" value="Sign Up"></p>
        </h5>

      <p class="w3-text-grey"><p style="font-style:italic">
            Placeholder for "forgot password" link<br><br>
            Placeholder for "create account" link
        </p></p>
    </div>

    <div class="w3-third w3-center">
      <i class="fa fa-heartbeat w3-padding-64 w3-text-red"></i>
    </div>
  </div>
</div>
</form>

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
<?php
function ExecuteQuery($t,$n)
{
    $user = "";
    if($username != "")
    {
    
    $db_connect = new mysqli($hn, $un, $pw, $db);
    if($db_connect -> connect_error) die($db_connect -> connect_error);    
    
    $query = "select * 
              from users 
              where username = '$n' and
              password = '$t'";

    $result = $db_connect->query($query);
    $user = $result->fetch_array(MYSQLI_ASSOC);
    $result->close();
    $db_connect->close();
    }
    return $user;
}
?>
