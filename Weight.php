<?php
class Weight
{
	private $weight;
	private $date;
	
	function __construct(){
		
	}
	
	function weights(int UserID)
	{
		
	}
	
	function AddWeight()
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