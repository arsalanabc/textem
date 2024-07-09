<?php
function NowSMSDListAddMember ($nowsmsIP, $nowsmsPort, $nowsmsUser, $nowsmsPassword, $dlistName, $dlistMember) {

   $urlString = "http://" . $nowsmsIP . ":" . $nowsmsPort . "/DLists?";
   if (!is_null($nowsmsUser) && ($nowsmsUser != "")) {
      $urlString = $urlString . "User=" . urlencode($nowsmsUser) . "&Password=" . urlencode($nowsmsPassword) . "&";
   }
   $urlString = $urlString . "DListMemberAction=Add&DListName=" . urlencode($dlistName) . "&DListMember=" . urlencode($dlistMember);
   $response = file_get_contents($urlString);

}





function add_to_sql($my_db){

// Create database
if (mysql_query("CREATE DATABASE ".$my_db))
  {
  echo "Database created";
  }
else
  {
  echo "Error creating database: " . mysql_error();
  }

// Create table
mysql_select_db("my_db", $con);
$sql = "CREATE TABLE Persons
(
Id int NOT NULL AUTO_INCREMENT,
Primary Key(Id),
Name varchar(15),	
Email varchar(60),
Phone number varchar(11),	
School varchar(15),	
Services varchar(95);
)";

			   }

?>