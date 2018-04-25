<?php
 
session_start();
require_once 'Prizes.php';
require_once 'Points.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_REQUEST["method"] == "AddPrize")
    {
        $Priz = new Prizes("","","","","");
        //function AddPrize($name, $description, $price, $userID)
        $Priz->AddPrize($_REQUEST["name"],$_REQUEST["desc"],$_REQUEST["price"], $_SESSION['userID']);
        echo "Updated Prizes";
    }

    if($_REQUEST["method"] == "BuyPrize")
    {
        $points = new Points();
        //function DeletePoints($Points, $userID)
        $response = $points->DeletePoints($_REQUEST["price"], $_SESSION['userID']);
        echo $response;
    }
}
 
?>
 