<?php
class Challengers
{
    private $ChallengeID;
    public $ChallengerID;
    public $uName;
    public $fName;
    public $lName; 
    public $status;
    public $Steps;

    function __construct($ChallengeID, $ChallengerID, $uName, $fName, $lName, $status, $Steps)
    {
        $this->ChallengeID = $ChallengeID;
        $this->ChallengerID = $ChallengerID;
        $this->uName = $uName;
        $this->fName = $fName;
        $this->lName = $lName;
        $this->status = $status;
        $this->Steps = $Steps != null ? $Steps : "";
    }
    
    function AddChallenger($ChallengeID, $ChallengerID)
    {
        $query = "INSERT INTO 
                    `ChallengeGroups`(
                        `ChallengeID`, 
                        `UserID`) 
                    VALUES ('$ChallengeID','$ChallengerID')";
    }

    function GetChallengers($ChallengeID)
    {
        require 'login.php';
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error)
            die($conn->connect_error);

        $query = "SELECT 
                        u.UserID,
                        u.FirstName,
                        u.LastName,
                        u.UserName,
                        g.Status,
                        sum(s.Steps) as Steps,
                        g.ChallengeID
                    FROM 
                        `challengegroups` g
                    JOIN 
                        Challenges c on c.ChallengeID = g.ChallengeID
                    left join 
                        Steps s on s.UserID = g.UserID
                    JOIN Users u on u.UserID = g.ChallengeID
                    WHERE 
                        g.ChallengeID = $ChallengeID
                    and s.CreatedOn >= c.StartDate";

        $results = $conn->query($query);    

        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
            $Challengers[] = new Challengers($ChallengeID,
                                             $result['UserID'],
                                             $result['UserName'], 
                                             $result['FirstName'], 
                                             $result['LastName'], 
                                             $result['Status'],
                                             $result['steps']);
        }
        if (!$results) die ("Database access failed: " . $conn->error);    
        $results->close();
        $conn->close();
        return $Challengers;
    }
}
?>
