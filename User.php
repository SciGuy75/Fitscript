<?php
class user
{
    public $FirstName = "";
    public $LastName = "";
    public $UserName = "";
    public $PasswordToken;
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
        require "login.php";
        $conn = new mysqli($hn, $un, $pw, $db);
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $query  = "SELECT UserName FROM users where UserName = '$this->username'";
        $results = $conn->query($query);
        if(mysqli_num_rows($results) == 0){
            $returnResult = true; //no other users with that name
            //$results->close();
            $conn->close();
            return  $returnResult;
        }
        else {
            $conn->error;
            $returnResult = false; //there is already username in use
        }
        $results->close();
        $conn->close();

        return  $returnResult;
    }
    function CreateAccount()
	{
        require 'login.php';
        $conn = new mysqli($hn, $un, $pw, $db);
        if (!$conn) {

            die("Connection failed: " . mysqli_connect_error());
        }
        $query = "INSERT INTO `Users`
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
                      '$this->UserName',
                      '$this->FirstName',
                      '$this->LastName',
                      '$this->Birthday',
                      '$this->Gender',
                      '$this->Height',
                      '$this->PasswordToken'
                        )";
        if ($conn->query($query) == True){
            $returnResult = true; //no other users with that name
        }
        else{
            $returnResult = false;
            return $returnResult;

        }
        $conn->close();

		return $returnResult;
	}
}
?>
