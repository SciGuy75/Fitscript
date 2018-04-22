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
    $UserNameTaken = 0;
    $isnewUsersSignedup = 0;
    $emptyfield = 0;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        if(isset($_REQUEST['fname']) && isset($_REQUEST['lname']) && isset($_REQUEST['username']) &&
            isset($_REQUEST['password'])  && isset($_REQUEST['gender']) &&  $_REQUEST['birthday'] != null &&
            isset($_REQUEST['phonenumber']) && isset($_REQUEST['heightFeet']) && isset($_REQUEST['heightInches']) &&
            isset($_REQUEST['weight']))
        {

            $username = sanitizeString($_REQUEST['username']);
            $newUser = new user($username);
            if($newUser->CheckUserName())
            {
                $newUser->FirstName = sanitizeString($_REQUEST['fname']);
                $newUser->LastName = sanitizeString($_REQUEST['lname']);
                $newUser->UserName = sanitizeString($_REQUEST['username']);
                $newUser->PasswordToken = SaltPswd(sanitizeString($_REQUEST['password']));
                $newUser->Birthday = sanitizeString($_REQUEST['birthday']);
                $newUser->Gender = strtoupper(sanitizeString($_REQUEST['gender']));
                $newUser->Phone = sanitizeString($_REQUEST['phonenumber']);
                $newUser->Height = sanitizeString($_REQUEST['heightFeet']).".".sanitizeString($_REQUEST['heightInches']);
                $newUser->Weight = sanitizeString($_POST['weight']);
                $isnewUsersSignedup = $newUser->CreateAccount();

                $_SESSION['username'] = $newUser->UserName;
                $_SESSION['pswd_token'] = $newUser->PasswordToken;//$token;
                $_SESSION['FirstName'] = $newUser->FirstName;
                $_SESSION['LastName'] = $newUser->LastName;
                $_SESSION['isAdmin'] = 0;
                if(isset($_SESSION['isAdmin']))
                {
                    routeUser();
                }
            }
            else{
                $UserNameTaken = True;
            }
        }
        else{
            $emptyfield = 1;
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
                    <td><input type="text" size="20" maxlength=10 name="phonenumber" value=<?php $Phone ?>> </td>
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
            <div class="w3-container">
                <h5><?php
                        if ($UserNameTaken){
                            echo '<div class="w3-container w3-red">Username taken please try another</div>';
                        }
                        if ($emptyfield){
                            echo '<div class="w3-container w3-red">Please fill out all fields</div>';
                        }
                    ?>
                </h5>
            </div>

        </p></p>
        <p class="w3-text-grey"><p style="font-style:italic">
            Placeholder for "forgot password" link<br><br>
            Placeholder for "create account" link<br><br>
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
