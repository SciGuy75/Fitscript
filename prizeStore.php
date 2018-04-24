<!DOCTYPE html>
<html>
<head>
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
<title>Prize Store</title>

<?php
    require_once 'Prizes.php';
    require_once 'stylesheets.php';
    require_once 'session_check.php';
    require_once 'navbar.php';
    //require_once 'login.php';
    //$conn = new mysqli($hn, $un, $pw, $db);

    // if ($conn->connect_error)
    //     die($conn->connect_error);
    // $query = "SELECT
    //             p.Price,
    //             p.color
    //         FROM Prizes p";

    // $results = $conn->query($query);
    // if (!$results) die ("Database access failed: " . $conn->error);
    // $conn->close();
    // $result = $results->fetch_array(MYSQLI_ASSOC);
?>
</head>
<body class = "w3-theme">
<div class="w3-container w3-content" style="max-width:700px;margin-top:80px">
<div class="w3-container w3-card w3-white w3-round w3-margin"><br>
  <h2 align = center>Script Store</h2>
  <p align = center>Earned a prize? Redeem it here!!</p>

<div class="w3-container w3-card w3-white w3-round w3-margin"><br>

            <?php 
                $Prizes = new Prizes("","","","","");
                $ActivePrizeList = $Prizes->GetAllActivePrizes();
                if(count($ActivePrizeList) > 0)
                {
                    foreach(array_slice($ActivePrizeList,1) as $f)
                    {
                        echo "<div class='accordion'>
                                    ".$f->prizeName.": ".$f->price."
                                    <button class='w3-button w3-green'>buy prize</button>
                              </div>
                              <div class='panel'>".$f->prizeDesc."</div>";
                    }
                }
                else echo "-";
            ?>    
</div></div>
</body>
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
  xhttp.open("POST", "PrizeStoreAjax.php?name="+name+"&desc="+desc+"&price="+price, true);
  xhttp.send();
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
