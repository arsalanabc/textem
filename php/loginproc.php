<?php

// Inialize session
session_start();

// Include database connection settings
include('../config.inc');

//if(!isset($_SESSION['username'])){	header('Location: ../pages/use.html');	}


// Select the database
$db="logins";
mysql_select_db($db);

$table_name = 'login';
$user = $_POST['name'];
$pwd = $_POST['password'];
$_SESSION['school'] = $_POST['school'];
$school = $_SESSION['school'];









$securedpage = '..//securedpages/'.$school."/".urlencode($user).'.php';

$user = mysql_real_escape_string($user);
$pwd = mysql_real_escape_string(md5($pwd));



// Retrieve username and password from database according to user's input


$login = mysql_query("SELECT * FROM ".$table_name." WHERE (user = '".$user."') and (password = '".$pwd."')");

// Check username and password match
if (mysql_num_rows($login) == 1) {
// Set username session variable
$_SESSION['username'] = $user;

// Jump to secured page
header('Location: '.$securedpage);
}
else {
// Jump to login page


echo "<script type=\"text/javascript\">";
echo "alert(\"wrong\");";
echo "</script>";
header('Location: ../pages/use.html');
}

?>
