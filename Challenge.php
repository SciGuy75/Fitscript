<?php
class Challenge
{
	private $ChallengeID;
	public $ChallengeType;
	public $status;
	public $StartDate;
	public $EndDate;
	private $eligible_for_pts;
	private $points_reward;
	 
	function __construct($ChallengeID, $ChallengeType, $status, $StartDate, $EndDate)
	{
		$this->ChallengeID = $ChallengeID;
		$this->ChallengeType = $ChallengeType;
		$this->status = $status;
		$this->StartDate = $StartDate;
		$this->EndDate = $EndDate;
	}
	function accept($UserID, $ChallengeID)
	{
		
		return;
	}
	
	function decline( $UserID,  $UserName, $ChallengeID)
	{
		return;
	}
	
	function GetAllChallenges($UserID)
	{
		require 'login.php';
		$conn = new mysqli($hn, $un, $pw, $db);
		if ($conn->connect_error)
			die($conn->connect_error);

		$query = "SELECT 
						* 
					FROM 
						`challengegroups` 
					join 
						`challenges` on challenges.ChallengeID = challengegroups.ChallengeID
					WHERE 
						challengegroups.UserID = $UserID
						and challenges.EndDate >= now()";

		$results = $conn->query($query);
		while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
			$Challenges[] = new Challenge($result['ChallengeID'], 
									 	  $result['ChallengeType'], 
										  $result['status'],
										  $result['StartDate'],
										  $result['EndDate']);
		}
		$results->close();
		$conn->close();
		return $Challenges;
	}
	function CreateChallenge($UserID, $Friends, $ChallengeType, $startDate)
	{
		if(count($Friends) > 0)
		{
			require 'login.php';
			$conn = new mysqli($hn, $un, $pw, $db);
			if ($conn->connect_error)
				die($conn->connect_error);
			$date = strtotime($startDate);
			$endDate = strotime("+7 day",$startDate);	
			$CreateChallenge = "INSERT INTO `challenges`( 
													`ChallengeType`, 
													`Creator`, 
													`EndDate`,
													`StartDate`) 
									VALUES ($ChallengeType,
											$UserID,
											$endDate,
											$startDate)";

			$results = $conn->query($CreateChallenge);
			if (!$results) die ("Database access failed: " . $conn->error);
			$challengeID = mysql_insert_id();
			$AddFriends = "";
			foreach($Friends as $f)
			{
				$AddFriends += "INSERT INTO `challengegroups`(
												`ChallengeID`, 
												`UserID`) 
									VALUES ($challengeID, $f->FriendUserID);";
			}
			if($AddFriends != "")
				$results = $conn->query($AddFriends);
			$results->close();
			$conn->close();
		}
		return;
	}
}


?>