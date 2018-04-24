<?php
class Steps
{
	private $Steps;
	private $date;
	public $TodayTotal;
	function __construct(){
		
	}
	
	function Steps($UserID, $steps)
	{
        $query = "INSERT INTO `Steps`(`UserID`, `Steps`) 
                    VALUES ($UserID, '$steps')";
        $this->SubmitQuery($query);
        return;
	}
	
	function GetAllSteps($UserID)
	{
		$query = "SELECT 
                        sum(Steps.Steps) as StepsTotal 
                    FROM 
                        `Steps` 
                    WHERE 
                        Steps.UserID = $UserID";
        $results = $this->SubmitQuery($query);
        $stepsTotal = $results->fetch_array(MYSQLI_ASSOC);
        return $stepsTotal['StepsTotal'];
    }
    
    function GetTodaySteps($UserID)
    {
        $query = "SELECT 
                        sum(Steps.Steps) as StepsTotal 
                    FROM 
                        `Steps` 
                    WHERE 
                        Steps.UserID = $UserID and 
                        Steps.DateUpdated >= NOW() - INTERVAL 1 DAY";
        $results = $this->SubmitQuery($query);
        $TodaySteps = $results->fetch_array(MYSQLI_ASSOC);
        $this->TodayTotal = $TodaySteps['StepsTotal'];
        return $TodaySteps['StepsTotal'];
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