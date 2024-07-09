<?php


include('../php/nowsmsdlist-php.php');
//$_SESSION[''] = $_POST[''];

?>
<!DOCTYPE html>
<html>
<head>
<title>Untitled Document</title>
<link  rel="stylesheet" href="temp.css" />
</head>

<script>

function validate(){
var service=document.getElementsByName("things[]");
alert(service.length);

var r=0;

for($i=0;$i<service.length;$i++){
	
	if(service[$i].checked){
		$r++;
		}	
	}// end for
if($r==0){
		alert("select a service!");
		return false;}

}

/////////////////////////////////////////////////////////////////

</script>



<body>


<div id="top">
<img src="../images/Untitled logo.png" border="10" align="left">
<img src="../images/Untitled3.png" align="right" >
</div> <!-- end top-->

<div id="bar" align="center">
<a href="../test1.html"> <button type="submit" id="home" value="Submit" style="width:120; height:30">Home</button></a>
<button type="submit" value="Submit" style="width:120; height:30"><strong>contact</strong></button>
</div><!-- end bar button -->
<br>
<br>
<br>



<p>&nbsp;</p>
<div id="form" align="center">
<form name="form1" method="post" action="../php/goto.php" onSubmit="return validate()" >

<table border="0">
<tr>
<td>
<input type="checkbox" value="a" name="things[]">sdasd</input><br>
<input type="checkbox" value="a" name="things[]">sdasd</input><br>
<input type="checkbox" value="a" name="things[]">sdasd</input><br>
<input type="checkbox" value="a" name="things[]">sdasd</input><br>
<input type="checkbox" value="a" name="things[]">sdasd</input><br>
<input type="checkbox" value="a" name="things[]">sdasd</input><br>
<input type="checkbox" value="a" name="things[]">sdasd</input><br>
<input type="checkbox" value="a" name="things[]">sdasd</input><br>
</td></tr>
</table>
<input type="hidden" name="what_do" value="add_to_dlist"/>
<input type="submit"  value="submit" name="submit"/>
</form>



 
</body>
</html>

