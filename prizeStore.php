<!DOCTYPE html>
<html>
<head>
<title>Prize Store</title></head>

<?php
session_start();
require_once 'navbar.php';
require_once 'stylesheets.php';
require_once 'session_check.php'; ?>

<body class = "w3-theme">
<div style="padding-top: 50px; padding-left: 16px">

  <h2 align = center>Script Store</h2>
  <p align = center>Earned a prize? Redeem it here!!</p>
</div>
<table class= "w3-theme-l5" border = 5 height = 900 width = 900 align = 'center'>
<tr>
<td><i class="fa fa-certificate" style="font-size:200px;color:yellow" align = 'center'></i><br><input type="button" value="Click Me"></td>
<td><i class="fa fa-certificate" style="font-size:200px;color:red"></i><br><input type="button" value="Click Me"></td>
</tr>
<tr>
<td><i class="fa fa-certificate" style="font-size:200px;color:blue"></i><br><input type="button" value="Click Me"></td>
<td><i class="fa fa-certificate" style="font-size:200px;color:green"></i><br><input type="button" value="Click Me"></td>
</tr>
</table>
</body>
</html>
