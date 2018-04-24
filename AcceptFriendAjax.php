<?php
session_start();
require_once 'Friend.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    if($_REQUEST["StatusChange"] == "Accept")
    {
        if(isset($_REQUEST["AddedFriend"]))
        {
            $friend = new Friend(-1,"","",-1,0);
            $result = $friend->AcceptFriendRequest($_REQUEST["AddedFriend"],$_SESSION['userID']);
            echo "Accepted ".$_REQUEST["AddedFriend"]."'s Friend Request";
            }
        }
    
    else if($_REQUEST["StatusChange"] == "Decline")
    {
        if(isset($_REQUEST["AddedFriend"]))
        {
            $friend = new Friend(-1,"","",-1,0);
            $result = $friend->DeclineFriendRequest($_REQUEST["AddedFriend"],$_SESSION['userID']);
            echo "Declined ".$_REQUEST["AddedFriend"]."'s Friend Request";
            }
        }
    }  

?>