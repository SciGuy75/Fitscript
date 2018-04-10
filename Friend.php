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
//djfkdjkjd
    function Friends()
    {
        require_once 'login.php'; 
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) 
            die($conn->connect_error);
        
        $query  = "Select f.UserID, f.FriendID, u.FirstName, u.LastName, sum(s.Steps) as steps from friends f
                    join users u on u.UserID = f.FriendID
                    left join steps s on s.UserID = u.UserID
                    WHERE 
                    f.UserID = 5 AND
                    f.status = 'Accepted' AND
                    (s.DateUpdated BETWEEN date_sub(now(), INTERVAL 7 day) and now())";

        $results = $conn->query($query);     
        if (!$results) die ("Database access failed: " . $conn->error);
        
        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {   
            echo "<p>".$result['FirstName']." ".$result['LastName']."</p>";
            echo "<p>".$result['steps']."</p>";    
        }
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