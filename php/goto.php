<?php

session_start();
include('../config.inc');




$_SESSION['email'] = $_POST['email'];
$_SESSION['phone']=$_POST['phone'];
$_SESSION['name']=$_POST['name'];
$_SESSION['school']=$_POST['school'];

/*if($where=="delete"){
	$_SESSION['what_do'] = "delete";
	header('Location: ../php/nowsmsdlist-php.php');
	break;
	}//end if
*/

$school = str_replace(" ", "", $_POST['school']);
$goto = "../pages/".$school.".html";
header('Location: '.$goto);

?>

