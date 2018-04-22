<?php
class Friend
{
    private $FriendUserID;
    public $FriendUserName;
    public $FriendFirstName;
    public $FriendLastName;
    public $Steps;
    //public $ListOfFriends;

    function __construct($FriendID, $FriendUserName, $FriendFirstName, $FriendLastName, $Steps)
    {
        $this->FriendUserID = $FriendID;
        $this->FriendUserName = $FriendUserName;
        $this->FriendFirstName = $FriendFirstName;
        $this->FriendLastName = $FriendLastName;
        $this->Steps = $Steps != null ? $Steps : "";
    }
    function Friends()
    {
        require 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);
        $userID = $_SESSION['userID'];

        $query  = "Select
                f.UserID,
                u.UserName,
                f.FriendID,
                u.FirstName,
                u.LastName,
                sum(s.Steps) as steps
            from Friends f
                join Users u on u.UserID = f.FriendID
                left join Steps s on s.UserID = u.UserID
            WHERE
                f.UserID = $userID AND
                f.status = 'Accepted' and
                s.DateUpdated BETWEEN date_sub(now(), INTERVAL 7 day) and now() OR
                s.DateUpdated is null";
        $results = $conn->query($query);
        if (!$results) die ("Database access failed: " . $conn->error);

        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
            $FriendList[] = new Friend($result['FriendID'], $result['UserName'], $result['FirstName'], $result['LastName'], $result['steps']);
        }
        $results->close();
        $conn->close();
        return $FriendList;
    }

    function PendingFriends()
    {
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);
            $query  = "Select
                            f.UserID,
                            u.UserName,
                            f.FriendID,
                            u.FirstName
                        from Friends f
                        join
                            Users u on u.UserID = f.FriendID
                        where
                            f.status = 'Pending'";

            $results = $conn->query($query);
            if (!$results) die ("Database access failed: " . $conn->error);

            while($result = $results->fetch_array(MYSQLI_ASSOC))
            {
                $PendingFriendsList[] = new Friend($result['FriendID'], $result['UserName'], $result['FirstName'], $result['LastName'], $result['steps']);
            }
        return $PendingFriendsList;
    }

    function FindFriend($UserName)
    {
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);
        $query  = "Select
                        f.UserID,
                        u.UserName,
                        f.FriendID,
                        u.FirstName
                    from Friends f
                    join
                        Users u on u.UserID = f.FriendID
                    where u.UserName = $UserName";
          $results = $conn->query($query);
          if(mysql_num_rows($results) > 0)
          {
                while($result = $results->fetch_array(MYSQLI_ASSOC))
                {
                    $FoundFriend = new Friend($result['FriendID'], $result['UserName'], $result['FirstName'], $result['LastName'], $result['steps']);
                }
                return $FoundFriend;
          }
          return null;
    }
    function SendFriendRequest($userID, $FriendID)
    {
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);
        $query = "INSERT INTO `friends`(`UserID`, `FriendID`)
                  VALUES ($userID, $FriendID)";
        $results = $conn->query($query);
        return;
    }

    function AcceptFriendRequest($userID, $FriendID)
    {
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);
        $query = "UPDATE `friends`
                  SET `Status`='Accepted',`UpatedOn`= CURRENT_TIMESTAMP
                  WHERE `UserID` = $userID and `FriendID` = $FriendID";
        $results = $conn->query($query);
        return;
    }

    function DeclineFriendRequest()
    {
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);
        $query = "UPDATE `friends`
                  SET `Status`='Declined',`UpatedOn`= CURRENT_TIMESTAMP
                  WHERE `UserID` = $userID and `FriendID` = $FriendID";
        $results = $conn->query($query);
        return;
    }

    function DeleteFriend()
    {
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);
        $query = "UPDATE `friends`
                  SET `Status`='Removed',`UpatedOn`= CURRENT_TIMESTAMP
                  WHERE `UserID` = $userID and `FriendID` = $FriendID";
        $results = $conn->query($query);
        return;
    }
}

?>
