<?php
session_start();
require_once 'User.php';
require_once 'Prizes.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_REQUEST["method"] == "DeleteUser")
    {
        if(isset($_REQUEST["UserToDelete"]))
        {
            $user = new User("");
            // DeleteAccount($UserToBeRemoved)
            $result = $user->DeleteAccount($_REQUEST["UserToDelete"]);
            echo $result;
        }
    }
    if($_REQUEST["method"] == "GetPrizeInfo")
    {
        $p = new Prizes("","","","","");
        $response = $p->GetPrizeInfo($_REQUEST["prizeID"]);
        echo $response;
    }
    if($_REQUEST["method"] == "UpdatePrizePrice")
    {
        $p = new Prizes("","","","","");
        //function UpdatePrizePrize($PrizeID, $NewPrice, $userID)
        $response = $p->UpdatePrizePrize($_REQUEST["prizeID"], $_REQUEST["newPrice"],$_SESSION['userID']);
        echo $response;
    }
      //else if($_REQUEST[""] == "")
    // {
    //     if(isset($_REQUEST[""]))
    //     {
    //         $friend = new Friend(-1,"","",-1,0);
    //         $result = $friend->DeclineFriendRequest($_REQUEST["AddedFriend"],$_SESSION['userID']);
    //         echo "Declined ".$_REQUEST["AddedFriend"]."'s Friend Request";
    //         }
    //     }
}  
?>