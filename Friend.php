<?php
class Friend
{
    private $FriendUserID;
    public $FriendUserName;
    public $FriendFirstName;
    public $FriendLastName;
    public $Steps;

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
        $userID = $_SESSION['userID'];
        $query  = "SELECT
                        u.UserName,
                        f.FriendID,
                        u.FirstName,
                        u.LastName,
                        sum(s.Steps) as steps
                    FROM `Friends` f
                        join Users u on u.UserID = f.FriendID
                        left join Steps s on s.UserID = u.UserID
                    WHERE
                        f.UserID = '$userID' AND
                        f.status = 'Accepted' AND
                        (s.DateUpdated BETWEEN date_sub(now(), INTERVAL 7 day) AND now() OR
                        s.DateUpdated is null)";
       
        $results = $this->SubmitQuery($query);
        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
            $FriendList[] = new Friend($result['FriendID'], $result['UserName'], $result['FirstName'], $result['LastName'], $result['steps']);
        }
        $results->close();
        
        return $FriendList;
    }

    function PendingFriends()
    {
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
            $results = $this->SubmitQuery($query);
            while($result = $results->fetch_array(MYSQLI_ASSOC))
            {
                $PendingFriendsList[] = new Friend($result['FriendID'], $result['UserName'], $result['FirstName'], $result['LastName'], $result['steps']);
            }
            $results->close();
        return $PendingFriendsList;
    }

    function FindFriend($UserName)
    {
        $query  = "Select
                        f.UserID,
                        u.UserName,
                        f.FriendID,
                        u.FirstName
                    from Friends f
                    join
                        Users u on u.UserID = f.FriendID
                    where u.UserName = $UserName";
          $results =  $this->SubmitQuery($query);
          if(mysql_num_rows($results) > 0)
          {
                while($result = $results->fetch_array(MYSQLI_ASSOC))
                {
                    $FoundFriend = new Friend($result['FriendID'], $result['UserName'], $result['FirstName'], $result['LastName'], $result['steps']);
                }
                return $FoundFriend;
          }
          $results->close();
          return null;
    }
    function SendFriendRequest($userID, $FriendID)
    {
        $query = "INSERT INTO `friends`(`UserID`, `FriendID`)
                  VALUES ($userID, $FriendID)";
        $results = $this->SubmitQuery($query);
        return;
    }

    function AcceptFriendRequest($userID, $FriendID)
    {
        $query = "UPDATE `friends`
                  SET `Status`='Accepted',`UpatedOn`= CURRENT_TIMESTAMP
                  WHERE `UserID` = $userID and `FriendID` = $FriendID";
        $results = $this->SubmitQuery($query);
        $results->close();
        return;
    }

    function DeclineFriendRequest()
    {
        $query = "UPDATE `friends`
                  SET `Status`='Declined',`UpatedOn`= CURRENT_TIMESTAMP
                  WHERE `UserID` = $userID and `FriendID` = $FriendID";
        $results = $this->SubmitQuery($query);
        $results->close();
        return;
    }

    function DeleteFriend()
    {
        $query = "UPDATE `friends`
                  SET `Status`='Removed',`UpatedOn`= CURRENT_TIMESTAMP
                  WHERE `UserID` = $userID and `FriendID` = $FriendID";
        $results = $this->SubmitQuery($query);
        $results->close();
        return;
    }

    function SubmitQuery($query)
    {
        require 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error)
            die($conn->connect_error);
        $results = $conn->query($query);
        if (!$results) die ("Database access failed: " . $conn->error);
        $conn->close();
         return $results;
    }
}

?>
