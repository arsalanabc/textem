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
	
var name = document.getElementById("name");
var text = document.getElementById("text");


	if (!name.value)
        {
            alert("Please enter you name!");

            // Change the value back to the previous valid answer
            return false;
        }

	if (!text.value)
        {
            alert("Please enter the message. Do not send a empty text. It is a waste of a text!");

            // Change the value back to the previous valid answer
            return false;
        }
	
        //var field1 = document.getElementsByName("dlist");
		
        
        if (!dlst.value)
        {
            alert("No Distribution List Selected!");

            // Change the value back to the previous valid answer
            return false;
        }


       
    }


maxL=300;
var bName = navigator.appName;
function taLimit(taObj) {
	if (taObj.value.length==maxL) return false;
	return true;
}

function taCount(taObj,Cnt) { 
	objCnt=createObject(Cnt);
	objVal=taObj.value;
	if (objVal.length>maxL) objVal=objVal.substring(0,maxL);
	if (objCnt) {
		if(bName == "Netscape"){	
			objCnt.textContent=maxL-objVal.length;}
		else{objCnt.innerText=maxL-objVal.length;}
	}
	return true;
}
function createObject(objId) {
	if (document.getElementById) return document.getElementById(objId);
	else if (document.layers) return eval("document." + objId);
	else if (document.all) return eval("document.all." + objId);
	else return eval("document." + objId);
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
<a href="../../pages/contact.html"><button type="submit" value="Submit" ><strong>Contact</strong></button></a>
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
 <input type="int" id="name" name="name" size="60"> </br>
</td>
</tr>

<tr>
<td>
Message:
</td>

<td>
   
<font> Try to keep your message under 150 so it is a single text message.<br>
<textarea name="text" id="text" onKeyPress="return taLimit(this)" onKeyUp="return taCount(this,'myCounter')" name="Description" rows=7 wrap="physical" cols=44>
</textarea>
<br>
You have <B><SPAN id=myCounter>299</SPAN></B> characters remaining 
for your message.</font>

</td>
</tr>

<td>
Distribution list:
</td>

<td>   
<select size="1" name="dlist" style="width:auto">
     <option></option>
     <option value="Monday">Monday</option>
     <option value="Tuesday">Tuesday</option>
     <option value="Wednesday">Wednesday</option>
     <option value="Thursday">Thursday</option>
     <option value="Friday">Firday</option>
     <option value="Saturday">Saturday</option>
     <option value="Sunday">Sunday</option>
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