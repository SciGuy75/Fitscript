<?php
class user
{
    public $FirstName = "";
    public $LastName = "";
    public $UserName = "";
    private $PasswordToken;
	public $UserID = 0;
    public $Age = 0;
    public $Birthday = "";
    public $JoinDate = "";
    public $Phone = "";
    public $weight = "";
	public $points = 0;
	public $Gender = "";
	public $Height = "";
	public $isAdmin = false;

	function __construct($foundUserName)
	{
		$this->username = $foundUserName;		
	}
    
    function CheckUserName()
    {
        require_once 'login.php'; 
        $conn = new mysqli($hn, $un, $pw, $db);
        if ($conn->connect_error) 
            die($conn->connect_error);
        $query  = "SELECT UserName FROM users where UserName = '$this->username'";
        $results = $conn->query($query); 
        if(mysql_num_rows($result) == 0)
            $returnResult = true; //no other users with that name
        else $returnResult = false; //there is already username in use
        $results->close();
        $conn->close();

        return  $returnResult;        
    }
    function CreateAccount()
	{
        $query = "INSERT INTO `users`
                    (
                        `UserName`, 
                        `FirstName`, 
                        `LastName`, 
                        `Birthday`, 
                        `Gender`, 
                        `Height`, 
                        `password`
                    ) 
                  VALUES (
                      $this->UserName,
                      $this->FirstName,
                      $this->LastName,
                      $this->Birthday,
                      $this->Gender,
                      $this->Height,
                      $this->PasswordToken
                        )";
		return;
	}
}
?>