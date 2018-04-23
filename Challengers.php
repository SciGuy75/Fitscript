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
    
    function GetChallengers($ChallengeID)
    {
        require 'login.php';
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error)
            die($conn->connect_error);

        $query = "SELECT 
                        users.UserID,
                        users.FirstName,
                        users.LastName,
                        users.UserName,
                        challengegroups.Status,
                        sum(steps.Steps) as Steps,
                        challengegroups.ChallengeID
                    FROM 
                        `challengegroups`
                    JOIN 
                        challenges on challenges.ChallengeID = challengegroups.ChallengeID
                    left join 
                        steps on steps.UserID = challengegroups.UserID
                    JOIN users on users.UserID = challengegroups.ChallengeID
                    WHERE 
                        challengegroups.ChallengeID = $ChallengeID
                    and steps.CreatedOn >= challenges.StartDate";

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
