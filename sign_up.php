<?php
$error = $userName = $password = "";
require_once 'login.php';
require_once 'User.php';
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(isset($_SESSION['isAdmin']))
{
    routeUser();
}
$userName = "bb";
$newUser = new User($userName);
if($_SERVER["REQUEST_METHOD"] == "POST")
{          
    //if(isset($_GET['username'])) $username = sanitizeString($_GET['username']);
    //if(isset($_GET['password'])) $password = sanitizeString($_GET['password']);
        
    //$token = SaltPswd($password);
    //$user = ExecuteQuery($token, $username);

    //  if($user['password']== $token) 
    //  {              
    //      //session_start();
    //      $_SESSION['username'] = $username;
    //      $_SESSION['userID'] = $user['UserID'];
    //      $_SESSION['pswd_token'] = $user['password'];//$token;
    //      $_SESSION['FirstName'] = $user['FirstName'];
    //      $_SESSION['LastName'] = $user['LastName'];
    //      $_SESSION['isAdmin'] = $user['IsAdmin'];
    //      routeUser();                  
    //  }
    //  else
    //  {
    //      $error = "The username / password combination is not correct.";
    //  }
    if(isset($_GET['fname']) && isset($_GET['lname']) && isset($_GET['username']) &&
         isset($_GET['password']) && isset($_GET['birthday']) && isset($_GET['gender']) &&
         isset($_GET['phone']) && isset($_GET['heightFeet']) && isset($_GET['heightInches']) &&
         isset($_GET['weight']))
    {
        $username = sanitizeString($_GET['username']);
        $newUser = new User($username);
        if($newUser->CheckUserName())
        {
            $newUser->FirstName = sanitizeString($_GET['fname']);
            $newUser->LastName = sanitizeString($_GET['lname']);
            $newUser->UserName = sanitizeString($_GET['username']);
            $newUser->PasswordToken = SaltPswd(sanitizeString($_GET['password']));
            $newUser->Birthday = sanitizeString($_GET['birthday']);
            $newUser->Gender = sanitizeString($_GET['gender']);
            $newUser->Phone = sanitizeString($_GET['Phone']);
            $newUser->Height = sanitizeString($_GET['heightFeet']).".".sanitizeString($_GET['heightInches']);
            $newUser->Weight = sanitizeString($_GET['weight']);
            $newUser->CreateAccount();
        }
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
table td { 
  display: table-cell;
  vertical-align: baseline; 
}
</style>
<body>

<!-- Navbar -->
<?php require_once 'navbar.php' ?>

<!-- First Grid -->
<form method="post" action="sign_up.php">
<div class="w3-row-padding w3-padding-64 w3-container">
  <div class="w3-content">
    <div class="w3-twothird">
      <h1>Sign Up<?php $error ?></h1>
      <h5 class="w3-padding-32">
          <table class="w3-table">
                <tr>
                    <td><label>First Name: </label></td>
                    <td><input type="text" name="fname" value="<?php $newUser->FirstName ?>"></td>
                </tr>
                <tr>
                    <td><label>Last Name: </label></td>
                    <td><input type="text" name="lname" value=<?php  $newUser->LastName ?>></td>
                </tr>
                <tr>
                    <td><label>Username: </label></td>
                    <td><input type="text" name="username" value="<?php echo $newUser->UserName; ?>"></td>
                </tr>
                <tr>
                    <td><label>Password: </label></td>
                    <td><input type="password" name="password" value=<?php $password ?>></td>
                </tr>
                <tr>
                    <td><label>Birthday: </label></td>
                    <td><input type="date" name="birthday" value=<?php $birthday ?>></td>
                </tr>
                <tr>
                    <td><label>Gender: </label></td>
                    <td><input type="radio" name="gender" value="m" checked> Male &nbsp; &nbsp; &nbsp; &nbsp;
                    <input type="radio" name="gender" value="f"> Female
                    </td>
                </tr>
                <tr>
                    <td><label>Phone: </label></td>
                    <td><input type="text" size="20" maxlength=10 name="phone" value=<?php $phone ?>> </td>
                </tr>
                <tr>
                    <td><label>Height: </label></td>
                    <td><input type="text" size=3 maxlength=1 max=7 name="heightFeet" value=<?php $heightFeet ?>> ' <input type="text" max=12 size=3 maxlength=2 name="heightInches"> "</td>
                </tr>
                <tr>
                    <td><label>Weight: </label></td>
                    <td><input type="text" size=5 maxlength=4 name="weight" value=<?php $weight ?>> lbs </td>
                </tr>
            </table>
            <p><input class="w3-button w3-red" type="submit" value="Sign Up"></p>
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
    //$user = "";
    // if($n != "")
    // {
    //     $db_connect = new mysqli($hn, $un, $pw, $db);
    //     if($db_connect -> connect_error) die($db_connect -> connect_error);    
        
    //     $query = "select * 
    //             from users 
    //             where username = '$n' and
    //             password = '$t'";

    //     $result = $db_connect->query($query);
    //     $user1 = $result->fetch_array(MYSQLI_ASSOC);
    //     $result->close();
    //     $db_connect->close();
    //     return $user1;
    // }
    // return null;
}
?>
