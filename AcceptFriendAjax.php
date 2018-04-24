<?php
session_start();
require_once 'Friend.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if(isset($_REQUEST["AddedFriend"]))
    {
        $friend = new Friend(-1,"","",-1,0);
        $result = $friend->AcceptFriendRequest($_REQUEST["AddedFriend"],$_SESSION['userID']);
        echo "Accepted ".$_REQUEST["AddedFriend"]."'s Friend Request";
        }
    }

?>