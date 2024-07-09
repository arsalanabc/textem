<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

<?php 

// Inialize session
session_start();

include ('../../config.inc');
//$_SESSION['school'];


// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
	header('Location: ../../pages/use.html');
}
?>


<script type="text/javascript">
    function validate(dlst)
    {
		
        //var field1 = document.getElementsByName("dlist");
		
        
        if (!dlst.value)
        {
            alert("No Distribution List Selected!");

            // Change the value back to the previous valid answer
            return false;
        }

       
    }
	
	
</script>

<link rel="stylesheet" href="../../pages/temp.css"

</head>

<body>
<div id="bg">

<div id="top">
<img src="../../images/Untitled logo.png" border="10" align="left">
<img src="../../images/Untitled3.png" align="right" >
</div> 
<!-- end top-->

<div id="bar" align="center">
<a  href="../../test1.html"> <button type="submit" id="home" value="Submit" style="width:120; height:30"><strong>Home</strong></button></a>
<a href="../../pages/contact.html">
<button type="submit" value="Submit" ><strong>Contact</strong></button></a>
<button name="btnSubmit" value="logout" onClick="window.location='../../php/logout.php'"><strong>Logout</strong></button>

</form>

</div><!-- end bar button -->
<br>
<br>
<br>

<div id="sms">
<form name="myform" method="post" action="../../php/nowsmsdlist-php.php"  
onSubmit="return validate(document.myform.dlist)"> 
<table border="0">
<tr>
<td>
Name:
</td>
<td>
 <input type="int" name="name" size="59"> </br>
</td>
</tr>

<tr>
<td>
Message:
</td>

<td>   
<textarea wrap name="text" rows=10 cols=46></textarea>
</td>
</tr>

<td>
Distribution list:
</td>

<td>   
<select size="1" name="dlist" style="width:auto">
     <option></option>
     <option value="Red"> Red</option>
     <option value="White"> White</option>
     <option value="Black"> Black</option>
     </select>
</td>
</tr>

<tr>
<input type="hidden"  name="what_do" value="SMS_to_dlist"/>

<td>
</td>
<td>
<input type=submit name="submit" value="SUBMIT">
</td>
</tr>


</form>
</div>

</div>
</body>
</html>