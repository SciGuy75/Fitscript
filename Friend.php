<?php
// class Friend 
// {
//     private $FriendUserID;
//     public $FriendName;
//     public $Steps;
//     //public $ListOfFriends;

//     function __construct($FriendID, $FriendFirstName, $FriendLastName, $Steps)
//     {
//         $this->FriendUserID = $FriendID;
//         $this->FriendName = $FriendFirstName + " " + $FriendLastName;
//         $this->Steps = $Steps;
//     }


    function Friends()
    {
        require_once 'login.php'; 
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) 
            die($conn->connect_error);
        $userID = $_SESSION['userID'];

        $query  = "Select 
                f.UserID,
                f.FriendID, 
                u.FirstName, 
                u.LastName, 
                sum(s.Steps) as steps 
            from Friends f
                join Users u on u.UserID = f.FriendID
                left join Steps s on s.UserID = u.UserID 
            WHERE 
                f.UserID = 4 AND
                f.status = 'Accepted' and 
                s.DateUpdated BETWEEN date_sub(now(), INTERVAL 7 day) and now() OR
                s.DateUpdated is null";
        $results = $conn->query($query); 
  

        if (!$results) die ("Database access failed: " . $conn->error);
        
        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {   
            echo "<p>".$result['FirstName']." ".$result['LastName']."</p>";
            echo "<p>".$result['steps']."</p>";    
        }
        $results->close();
        $conn->close();
        return;
    }

    function PendingFriends()
    {
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) 
            die($conn->connect_error);
        return;
    }
    
    function SendFriendRequest()
    {
        return;
    }

    function AcceptFriendRequest()
    {
        return;
    }

    function DeclineFriendRequest()
    {
        return;
    }
    
    function DeleteFriend()
    {
        return;
    }
//}

?>