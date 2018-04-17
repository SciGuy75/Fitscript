<?php
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


?>