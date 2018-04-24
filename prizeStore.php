<!DOCTYPE html>
<html>
<head>
<title>Prize Store</title></head>

<?php

    require_once 'stylesheets.php';
    require_once 'session_check.php';
    require_once 'navbar.php';
    require_once 'login.php';
    $conn = new mysqli($hn, $un, $pw, $db);

    if ($conn->connect_error)
        die($conn->connect_error);
    $query = "SELECT
                p.Price,
                p.color
            FROM Prizes p";

    $results = $conn->query($query);
    if (!$results) die ("Database access failed: " . $conn->error);
    $conn->close();
    $result = $results->fetch_array(MYSQLI_ASSOC);
?>

<body class = "w3-theme">
<div style="padding-top: 50px; padding-left: 16px">

  <h2 align = center>Script Store</h2>
  <p align = center>Earned a prize? Redeem it here!!</p>
</div>
<table class= "w3-theme-l5" border = 5 height = 900 width = 900 align = 'center'>
<tr>
<td><i class="fa fa-certificate" style="font-size:200px;color:
    <?php
        echo $result['color'];

    ?>
    " align = 'center'></i><br><input type="button" value="Click Me  to buy for
    <?php
        echo $result['Price'];
        $result = $results->fetch_array(MYSQLI_ASSOC);
    ?> points
"></td>
<td><i class="fa fa-certificate" style="font-size:200px;color:
    <?php
        echo $result['color'];

    ?>
    " align = 'center'></i><br><input type="button" value="Click Me  to buy for
    <?php
        echo $result['Price'];
        $result = $results->fetch_array(MYSQLI_ASSOC);
    ?> points
"></td>
</tr>
<tr>
    <td><i class="fa fa-certificate" style="font-size:200px;color:
        <?php
            echo $result['color'];

        ?>
        " align = 'center'></i><br><input type="button" value="Click Me  to buy for
        <?php
            echo $result['Price'];
            $result = $results->fetch_array(MYSQLI_ASSOC);
        ?> points
    "></td>
    <td><i class="fa fa-certificate" style="font-size:200px;color:
        <?php
            echo $result['color'];

        ?>
        " align = 'center'></i><br><input type="button" value="Click Me  to buy for
        <?php
            echo $result['Price'];
        ?> points
    "></td>
</tr>
</table>
</body>
</html>
