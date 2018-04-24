<?php
session_start();
require_once 'Steps.php';
require_once 'Points.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_REQUEST["StatusChange"] == "Steps")
    {
        $Steps = new Steps("","");
        $Points = new Points();
        $Steps->Steps($_SESSION['userID'],$_REQUEST["StepCount"]);
        $Points->UpdatePointsWithSteps($_REQUEST["StepCount"],$_SESSION['userID'],$_REQUEST["TodaySteps"]);
        echo "Updated Steps";
    }
    
    // else if($_REQUEST["StatusChange"] == "Decline")
    // {
    //     if(isset($_REQUEST["AddedFriend"]))
    //     {
    //         $friend = new Friend(-1,"","",-1,0);
    //         $result = $friend->DeclineFriendRequest($_REQUEST["AddedFriend"],$_SESSION['userID']);
    //         echo "Declined ".$_REQUEST["AddedFriend"]."'s Friend Request";
    //     }
    // }
}  

?>