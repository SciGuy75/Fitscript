<?php
class Challenge
{
	private $ChallengeID;
	private $ChallengeType;
	private $status;
	private $eligible_for_pts;
	private $points_reward;
	
	function accept( $UserID, $ChallengeID)
	{
		
		return;
	}
	
	function decline( $UserID,  $UserName, $ChallengeID)
	{
		return;
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
									VALUES ($challengeID, $f->FriendUserID)";
			}
			if($AddFriends != "")
				$results = $conn->query($AddFriends);
			$conn->close();
		}
		return;
	}
}


?>