<?php
class Points
{
    public $Points;

    function __construct(){
		
    }
    
    function AddPoints($Points, $userID)
    {
        $query = "SELECT Users.Points 
                    FROM `Users` 
                    where UserID = $userID";

        $results = $this->SubmitQuery($query);
        $TotalPoints = $results->fetch_array(MYSQLI_ASSOC);
        $newTotal = $Points + $TotalPoints['Points'];

        $query2 = "UPDATE `Users` SET `Points`='$newTotal' WHERE Users.UserID =$userID";
        $results2 = $this->SubmitQuery($query2);
        return;
    }
    function DeletePoints($Points, $userID)
    {
        $query = "SELECT Users.Points 
                    FROM `Users` 
                    where UserID = $userID";

        $results = $this->SubmitQuery($query);
        $TotalPoints = $results->fetch_array(MYSQLI_ASSOC);
        $newTotal = $TotalPoints['Points'] - $Points;

        $query2 = "UPDATE `Users` SET `Points`='$newTotal' WHERE Users.UserID =$userID";
        $results2 = $this->SubmitQuery($query2);
        return;
    }
    function UpdatePointsWithSteps($steps, $UserID, $todaysSteps)
    {
        if($todaysSteps <= 10000)
        {
            $points = $steps*.01;
            $this->AddPoints($points, $UserID);
        }
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