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
		//database shit
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
	
	function Friends
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
		//retrieve challengers from database/
		//
		return;
	}
	
	function SendChallengeRequest(int challengersIDs, int ChallengeID, string userID)
	{
		//challenge friends using their IDs
		return;
	}
}

class Challenge
{
	private $ChallengeID;
	private $ChallengeType;
	private $status;
	private $eligible_for_pts;
	private $points_reward;
	
	function accept(int UserID, int ChallengeID)
	{
		return;
	}
	
	function decline(int UserID, string UserName, int $ChallengeID)
	{
		return;
	}
}

class Weight
{
	private weight;
	private date_to;
	
	function weights(int UserID)
	{
		
	}
	
	function addWeight()
	{
		
	}
	
}
?>