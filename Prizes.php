<?php
class Prizes
{
    public $prizeID;
    public $prizeName;
    public $prizeDesc;
    public $price;
    public $status;

    function __construct($PrizeID,$PrizeName,$PrizeDesc,$Price,$Status)
    {
		$this->prizeID = $PrizeID;
        $this->prizeName = $PrizeName;
        $this->prizeDesc = $PrizeDesc;
        $this->price = $Price;
        $this->status = $Status;
    }
    function AddPrize($name, $description, $price, $userID)
    {
        $query = "INSERT INTO `Prizes`(
                    `Name`, 
                    `Description`, 
                    `Price`, 
                    `AddedBy`, 
                    `UpdatedBy`) 
                VALUES (
                    $name,
                    $description,
                    $price,
                    $userID,
                    $userID)";
        $this->SubmitQuery($query);
        return;
    }
    function DeactivatePrize($PrizeID,$userID)
    {
        $query = "UPDATE `Prizes` 
                    SET `Price`=Deactivated,`UpdatedBy`=$userID,`UpdatedOn`=CURRENT_TIMESTAMP
                    WHERE PrizeID =$PrizeID";
        $this->SubmitQuery($query);
        return;
    }

    function UpdatePrizePrize($PrizeID, $NewPrice, $userID)
    {
        $query = "UPDATE `Prizes` 
                    SET `Price`=Deactivated,`UpdatedBy`=$userID,`UpdatedOn`=CURRENT_TIMESTAMP
                    WHERE PrizeID =$PrizeID";
        $this->SubmitQuery($query);
        return;
    }
    function GetAllPrizes() 
    {
        $query = "SELECT * FROM `Prizes`";
        $results = $this->SubmitQuery($query);

        $PrizeList[] =  new Prizes("","","","","");
        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
            $PrizeList[] = new Prizes(
                            $result['PrizeID'], 
                            $result['Name'], 
                            $result['Description'], 
                            $result['Price'],
                            $result['Status']);
        }
        return $PrizeList;
    }
    function GetAllActivePrizes() 
    {
        $query = "SELECT * FROM `Prizes` WHERE Status = 'Active'";
        $results = $this->SubmitQuery($query);

        $PrizeList[] =  new Prizes("","","","","");
        while($result = $results->fetch_array(MYSQLI_ASSOC))
        {
            $PrizeList[] = new Prizes(
                            $result['PrizeID'], 
                            $result['Name'], 
                            $result['Description'], 
                            $result['Price'],
                            $result['Status']);
        }
        return $PrizeList;
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