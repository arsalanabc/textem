<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<link  rel="stylesheet" href="temp.css" />

<?php 

// Inialize session
session_start();

include ('../config.inc');

// Check, if username session is NOT set then this page will jump to login page
if (!$_SESSION['result']) {header('Location: ../test1.html');}

?>

<script>

function validate(){
var service=document.getElementsByName("service[]");
var r=0;
for($i=0;$i<service.length;$i++)
	{
	if(service[$i].checked) {
		r++;				}	
	}// end for
if(r==0){
		alert("select a service!");
		return false;
		}

}

/////////////////////////////////////////////////////////////////

</script>
<link rel="stylesheet" href="../pages/temp.css"
</head>


<body>
<div id="bg">

<div id="top">
<img src="../images/Untitled logo.png" border="10" align="left">
<img src="../images/Untitled3.png" align="right" >
</div> <!-- end top-->

<div id="bar" align="center">
<a href="../test1.html"> <button type="submit" id="home" value="Submit" style="width:120; height:30"><strong>Home</strong></button></a>
<a href="../pages/contact.html">
<button type="submit" value="Submit" style="width:120; height:30"><strong>Contact</strong></button></a>
</div><!-- end bar button -->
<br>
<br>
<br>

<div id=form>
<!-- <h1><?php echo $_SESSION['result']; ?> </h1>  --> 
<h2> You are part of the following clubs/services:</br></h2>
<h4>Please check the ones you no longer want to receive notifications from.</h4>
<form method="post" action="../php/nowsmsdlist-php.php"  onSubmit="return validate()" >
<p>  <?php
// loop through the session array with foreach
foreach($_SESSION['ser_lst'] as $key=>$value)
    {
    // and print out the values
   // echo 'You are in  $_SESSION['."'".$key."'".'] is '."'".$value."'".' <br/>';
   echo "<input type=\"checkbox\" name=\"service[]\" value=\"$value\"/>".$value."</br>";
    }
 /*
$w=1;
//echo $_SESSION['t'][0];
while(isset ($_SESSION['ser_lst'][$w])){
	//echo $_SESSION[$w];
	echo $_SESSION['ser_lst'][0]."\n";
	echo "\n";
	$w++ ;
	}//end while
	*/ ?>
	</p>
<input type="hidden" value="<?php echo $_SESSION['mem'] ?>" name="mem"/>
    <input type="hidden" name="what_do" value="delete" />
    <input type="submit" name="submit" />
    
    </form>
<a href="../test1.html"><button name="home" onclick="<?php session_destroy();?>">Go back to home page!</button>
</div>

</body>
</html>
