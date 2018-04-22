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
	public $Points = 0;
	public $Gender = "";
	public $Height = 0;
    public $Weight = 0;
	public $isAdmin = false;

	function __construct($foundUserName)
	{
		$this->UserName = $foundUserName;
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
                        `Password`
                        `Phone`
                    )
                  VALUES (
                      '$this->UserName',
                      '$this->FirstName',
                      '$this->LastName',
                      '$this->Birthday',
                      '$this->Gender',
                      '$this->Height',
                      '$this->PasswordToken'
                      '$this->Phone'
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
    function GetInfo($username,$pwtoken){
        require 'login.php';
        $mysqli = new mysqli($hn, $un, $pw, $db);
        if ($mysqli->connect_error) {
            die('Connect Error: ' . $mysqli->connect_error);
        }


        $query = "select *
               from Users
               where UserName = '$username' and
               Password = '$pwtoken'";
        //echo $query;
        $result = $mysqli->query($query);
        //echo $result;
        $row = $result->fetch_array(MYSQLI_ASSOC);


        if( $row["UserName"]!= "" && $row['Password']== $pwtoken)
        {
            $this->FirstName = $row["FirstName"];
            $this->LastName = $row["LastName"];
            $this->UserName = $row["UserName"];
            $this->PasswordToken = $row["Password"];
            $this->Birthday = $row["Birthday"];

            //$this->$JoinDate = $row["JoinDate"];
            //not sure why but date isnt working
            $this->Gender = $row["Gender"];

            $this->Phone = $row["Phone"];

            $this->Height = $row["Height"];
            $this->Weight = $row["Weight"];
            $this->Points = $row["Points"];
            $this->IsAdmin = $row["IsAdmin"];

            $result->close();
            $mysqli->close();
        }
        return;
    }
}
?>
