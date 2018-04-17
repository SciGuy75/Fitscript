<?php
class user
{
	private $Name = "";
	private $username = "";
	private $UserID = 0;
	private $Age = 0;
	private $JoinDate = "";
	private $points = 0;
	private %gender = "";
	private $height = 0;
	private $isAdmin = false;
	
	function __construct(string $foundUserName)
	{
		this->$username = $foundUserName;
		
		require_once 'login.php'; 
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) 
            die($conn->connect_error);
		
		return;
	}
	
	function CreateAccount(string name, string $gender, float $height, $int birthday)
	{
		//more database shit
		return;
	}
}

class friend
{
	$name;
	$FriendUserID;
	$steps;
	
	function __construct(){
		
		require_once 'login.php'; 
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) 
            die($conn->connect_error);
		
	}
	
	function Friends()
	{
		//retreieved Friend's usernames
		//Store all friend user names in array
		//return
		return;
	}
	
}

class challenger
{
	private $challenger;
	private $steps;
	private $challengeID;
	
	function __construct($ChallengeID){
		
		require_once 'login.php'; 
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) 
            die($conn->connect_error);
		//
		return;
	}
	
	function SendChallengeRequest(int challengersIDs, int ChallengeID, string userID)
	{
		//challenge friends using their IDs
		
		
		return;
	}
}


class Weight
{
	private weight;
	private date_to;
	
	function __construct(){
		
		require_once 'login.php'; 
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) 
            die($conn->connect_error);
	}
	
	function weights(int UserID)
	{
		
	}
	
	function addWeight()
	{
		
	}
	
}
?>