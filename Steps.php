<?php
class Steps
{
	private $Steps;
	private $date;
	
	function __construct(){
		
		require_once 'login.php'; 
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) 
            die($conn->connect_error);
	}
	
	function Steps($UserID, $steps)
	{
        $query = "INSERT INTO `Steps`(`UserID`, `Steps`) 
                    VALUES ($UserID, '$steps')";
        $this->SubmitQuery($query);
        return;
	}
	
	function AddSteps()
	{
		
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