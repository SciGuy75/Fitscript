<?php
session_start();
require_once 'Friend.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_REQUEST["Change"] == "Add")
    {
        $friend = new Friend(-1,"","",-1,0);
        $result = $friend->FindFriend($_REQUEST["newFriend"]);
        if(count($result) > 0)
        {
            if($_SESSION['userID'] != $result->FriendUserID)
            {
                $friend->SendFriendRequest($_SESSION['userID'], $result->FriendUserID);
                echo "Friend Request Sent!".$result->FriendUserID;
            }
           else echo "You cant send a request to yourself!";
        }
    }
    if($_REQUEST["Change"] == "Delete")
    {
        $friend = new Friend(-1,"","",-1,0);
        $friend->DeleteFriend($_SESSION['userID'], $_REQUEST["DeleteFriendID"]);
        echo "Deleted Friend ";
    }
}
?>