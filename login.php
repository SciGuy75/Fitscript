<?php
if (dirname(__FILE__) == 'C:\aaa_master_sync\DCSP\LAB\Fitscritpt'  ){
    $hn = 'localhost';
    $db = 'dcsp01'; // your NetID
    $un = 'root';  // your NetID
    $pw = ''; // your MySQL password on pluto

}
else{
    $hn = 'localhost';
    $db = 'dcsp01'; // your NetID
    $un = 'dcsp01';  // your NetID
    $pw = 'ab1234!'; // your MySQL password on pluto
    echo dirname(__FILE__);

}
?>
