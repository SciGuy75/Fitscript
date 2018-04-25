<!DOCTYPE html>
<html>
<head>
<style>
.accordion {
    background-color: #eee;
    color: #444;
    cursor: pointer;
    padding: 10px 10px 5px 10px;
    margin-bottom:10px;
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
.panel {
    padding: 5px;
    margin-bottom:10px;
    display: none;
    background-color: white;
    overflow: hidden;
}
</style>
<title>Prize Store</title>

<?php
    require_once 'Prizes.php';
    require_once 'User.php';
    require_once 'stylesheets.php';
    //require_once 'session_check.php';
    require_once 'navbar.php';
    $user_class = new user($_SESSION['username']);
    $user_class->GetInfo($user_class->UserName, $_SESSION['pswd_token']);
?>
</head>
<body class = "w3-theme">
<div class="w3-container w3-content" style="max-width:700px;margin-top:80px">
<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
  <h2 align = center>Script Store</h2>
  <p align = center>Points: <span id="Points"><?php echo $user_class->Points?></span></p>

<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
            <?php 
                $Prizes = new Prizes("","","","","");
                $ActivePrizeList = $Prizes->GetAllActivePrizes();
                if(count($ActivePrizeList) > 0)
                {
                    foreach(array_slice($ActivePrizeList,1) as $f)
                    {
                        echo "<div class='w3-container w3-round accordion'>
                                    <span style='margin-top:50px'>".$f->prizeName.": ".$f->price."</span>
                                    <span style='float:right'>
                                        <button onclick='BuyPrize($f->prizeID, $f->price)' class='w3-button w3-green'>buy</button>
                                    </span>
                              </div> 
                              <div class='panel'>&nbsp;&nbsp;&nbsp;&nbsp;".$f->prizeDesc."</div>";
                    }
                }
                else echo "-";
            ?>    
</div></div>
</body>
<script>
function BuyPrize(prizeID, price)
{
    var UsersPoints = document.getElementById("Points").innerHTML;
    if(UsersPoints < price)
    {
        alert("Not enough points! Go Walking!");
    }
    else{
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
  
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("Points").innerHTML = this.responseText;
            }
        };
        xhttp.open("POST", "PrizeStoreAjax.php?method=BuyPrize&price="+price, true);
        xhttp.send();
    }
}
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
