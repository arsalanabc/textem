<?php
session_start();
$_SESSION['asd']=false;
include('../config.inc');

// NowSMSDListExists - Returns true if distribution list exists, otherwise false.
// Parameters:
//  $nowsmsIP - IP Address or host name of NowSMS server (127.0.0.1 for local host)
//  $nowsmsPort - Web interface port number of NowSMS server (8800 for default configuration)
//  $nowsmsUser & $nowsmsPassword - user name and password for account defined under "SMS Users"
//  $dlistName - Distribution list name

function NowSMSDListExists ($nowsmsIP, $nowsmsPort, $nowsmsUser, $nowsmsPassword, $dlistName) {

   $urlString = "http://" . $nowsmsIP . ":" . $nowsmsPort . "/DLists?";
   if (!is_null($nowsmsUser) && ($nowsmsUser != "")) {
      $urlString = $urlString . "User=" . urlencode($nowsmsUser) . "&Password=" . urlencode($nowsmsPassword) . "&";
   }
   $urlString = $urlString . "DListAction=List&DListName=" . urlencode($dlistName);
   $response = file_get_contents($urlString);
   if (!strncasecmp ($response, "OK", 2)) return true;
   else return false;
}


// NowSMSDListCheckMember - Returns true if member of distribution list, otherwise false.
// Parameters:
//  $nowsmsIP - IP Address or host name of NowSMS server (127.0.0.1 for local host)
//  $nowsmsPort - Web interface port number of NowSMS server (8800 for default configuration)
//  $nowsmsUser & $nowsmsPassword - user name and password for account defined under "SMS Users"
//  $dlistName - Distribution list name
//  $dlistMember - Distribution list member phone number

function NowSMSDListCheckMember ($nowsmsIP, $nowsmsPort, $nowsmsUser, $nowsmsPassword, $dlistName, $dlistMember) {

   $urlString = "http://" . $nowsmsIP . ":" . $nowsmsPort . "/DLists?";
   if (!is_null($nowsmsUser) && ($nowsmsUser != "")) {
      $urlString = $urlString . "User=" . urlencode($nowsmsUser) . "&Password=" . urlencode($nowsmsPassword) . "&";
   }
   $urlString = $urlString . "DListAction=List&DListName=" . urlencode($dlistName);
   $response = file_get_contents($urlString);

   $memberArray = explode("\r\n",$response); 

   for ($i = 1; $i < count($memberArray); $i++) {
      $idxDash = strpos ($memberArray[$i], " -");
      if ($idxDash !== false) {
         $memberArray[$i] = substr ($memberArray[$i], 0, $idxDash);
      }
      if (!strcasecmp ($memberArray[$i], $dlistMember)) return true;
   }

   return false;

}

// NowSMSDListAddMember - Add member to distribution list
// Parameters:
//  $nowsmsIP - IP Address or host name of NowSMS server (127.0.0.1 for local host)
//  $nowsmsPort - Web interface port number of NowSMS server (8800 for default configuration)
//  $nowsmsUser & $nowsmsPassword - user name and password for account defined under "SMS Users"
//  $dlistName - Distribution list name
//  $dlistMember - Distribution list member phone number

function NowSMSDListAddMember ($nowsmsIP, $nowsmsPort, $nowsmsUser, $nowsmsPassword, $dlistName, $dlistMember) {

   $urlString = "http://" . $nowsmsIP . ":" . $nowsmsPort . "/DLists?";
   if (!is_null($nowsmsUser) && ($nowsmsUser != "")) {
      $urlString = $urlString . "User=" . urlencode($nowsmsUser) . "&Password=" . urlencode($nowsmsPassword) . "&";
   }
   $urlString = $urlString . "DListMemberAction=Add&DListName=" . urlencode($dlistName) . "&DListMember=" . urlencode($dlistMember);
   $response = file_get_contents($urlString);

}

// NowSMSDListDeleteMember - Delete member from distribution list
// Parameters:
//  $nowsmsIP - IP Address or host name of NowSMS server (127.0.0.1 for local host)
//  $nowsmsPort - Web interface port number of NowSMS server (8800 for default configuration)
//  $nowsmsUser & $nowsmsPassword - user name and password for account defined under "SMS Users"
//  $dlistName - Distribution list name
//  $dlistMember - Distribution list member phone number

function NowSMSDListDeleteMember ($nowsmsIP, $nowsmsPort, $nowsmsUser, $nowsmsPassword, $dlistName, $dlistMember) {

   $urlString = "http://" . $nowsmsIP . ":" . $nowsmsPort . "/DLists?";
   if (!is_null($nowsmsUser) && ($nowsmsUser != "")) {
      $urlString = $urlString . "User=" . urlencode($nowsmsUser) . "&Password=" . urlencode($nowsmsPassword) . "&";
   }
   $urlString = $urlString . "DListMemberAction=Delete&DListName=" . urlencode($dlistName) . "&DListMember=" . urlencode($dlistMember);
   $response = file_get_contents($urlString);

}

// NowSMSDListDeleteMemberAllLists - Scan all distribution lists and remove member
// Parameters:
//  $nowsmsIP - IP Address or host name of NowSMS server (127.0.0.1 for local host)
//  $nowsmsPort - Web interface port number of NowSMS server (8800 for default configuration)
//  $nowsmsUser & $nowsmsPassword - user name and password for account defined under "SMS Users"
//   $dlistMember - Distribution list member phone number

function NowSMSDListDeleteMemberAllLists ($nowsmsIP, $nowsmsPort, $nowsmsUser, $nowsmsPassword, $dlistMember) {

   $urlString = "http://" . $nowsmsIP . ":" . $nowsmsPort . "/DLists?";
   if (!is_null($nowsmsUser) && ($nowsmsUser != "")) {
      $urlString = $urlString . "User=" . urlencode($nowsmsUser) . "&Password=" . urlencode($nowsmsPassword) . "&";
   }
   $urlString = $urlString . "DListAction=List";
   $response = file_get_contents($urlString);

   $dlistArray = explode("\r\n",$response); 
   
   $service_lst = array();

   // Loop through all distribution lists and remove member
   for ($i = 0; $i < count($dlistArray); $i++) {
      if ($dlistArray[$i] != "") {
         if (NowSMSDListCheckMember ($nowsmsIP, $nowsmsPort, $nowsmsUser, $nowsmsPassword, $dlistArray[$i], $dlistMember)) {
          // NowSMSDListDeleteMember ($nowsmsIP, $nowsmsPort, $nowsmsUser, $nowsmsPassword, $dlistArray[$i], $dlistMember);
		   $service_lst[$i]=$dlistArray[$i];
		  
			}
      }
   }
   $_SESSION['ser_lst']=$service_lst;
   
   if(!sizeof($service_lst) == 0){
   return true;
   }
   else{return false;}

}

// NowSMSDListSendSMS - Send an SMS text message to a distribution list
// Parameters:
//  $nowsmsIP - IP Address or host name of NowSMS server (127.0.0.1 for local host)
//  $nowsmsPort - Web interface port number of NowSMS server (8800 for default configuration)
//  $nowsmsUser & $nowsmsPassword - user name and password for account defined under "SMS Users"
//  $dlistName - Distribution list name

function NowSMSDListSendSMS ($nowsmsIP, $nowsmsPort, $nowsmsUser, $nowsmsPassword, $dlistName, $smsText) {

   $urlString = "http://" . $nowsmsIP . ":" . $nowsmsPort . "/?";
   if (!is_null($nowsmsUser) && ($nowsmsUser != "")) {
      $urlString = $urlString . "User=" . urlencode($nowsmsUser) . "&Password=" . urlencode($nowsmsPassword) . "&";
   }
   $urlString = $urlString . "PhoneNumber=" . urlencode($dlistName) . "&Text=" . urlencode($smsText);
   $response = file_get_contents($urlString);
   if (strpos ($response, "MessageID=") === false) return false;
   else return true;
}




/* Parameters:
    $host - IP address or host name of the NowSMS server
    $port - "Port number for the web interface" of the NowSMS Server
    $username - "SMS Users" account on the NowSMS server
    $password - Password defined for the "SMS Users" account on the NowSMS Server
    $phoneNoRecip - One or more phone numbers (comma delimited) to receive the text message
    $msgText - Text of the message
*/
function SendSMS ($host, $port, $username, $password, $phoneNoRecip, $msgText) { 
 
    $fp = fsockopen($host, $port, $errno, $errstr);
    if (!$fp) {
        echo "errno: $errno \n";
        echo "errstr: $errstr\n";
        return $result;
    }


    
    fwrite($fp, "GET /?Phone=" . rawurlencode($phoneNoRecip) . "&Text=" . rawurlencode($msgText) . " HTTP/1.0\n");
    if ($username != "") {
       $auth = $username . ":" . $password;
       $auth = base64_encode($auth);
       fwrite($fp, "Authorization: Basic " . $auth . "\n");
    }
    fwrite($fp, "\n");
  
    $res = "";
 
    while(!feof($fp)) {
        $res .= fread($fp,1);
    }
    fclose($fp);

    return $res;
    

}


function add_to_mysql(){
$db = "textem";
$table = "users";
$n = $_SESSION['name'];
$e = $_SESSION['email'];
$p = $_SESSION['phone'];
$sc = $_SESSION['school'];

//$ser = serialize($_POST['service']); // use unserialize to retrieve it back.
//$row= mysql_fetch_array($query);
//$ar = unserialize($row['service']);

mysql_select_db($db) or die('error'.$mysql_error());

//$del = mysql_query("TRUNCATE TABLE ".$table);   // to delete everything from $table
//mySql_query($del)or die('error'.mysql_error());

$query = "INSERT INTO users (id, name, email, phone, school) VALUES ( 'null', '$n', '$e', '$p', '$sc')";
mysql_query($query);
}





// read in action
//========================================================================================================================
//\-\/-/\-\/-/\-\/-/\-\/-/\-\/-/\-\/-/\-\/-/\-\/-/\-\/-/\-\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//\\//
//========================================================================================================================
$action = $_POST['what_do'];



switch ($action) {
    
case "SMS_to_dlist":

	$dlist =$_POST['dlist'];// $_SESSION['school']."/".
	$text = $_POST['text'];
	$school = str_replace(" ", "",$_SESSION['school']); // replace space from $_SESSION['school']
	$dlist_name= $school.'-'.$dlist;
	
if(NowSMSDListExists ("127.0.0.1", "8800", "aa", "909", $dlist_name) ){
        NowSMSDListSendSMS ("127.0.0.1", "8800", "aa", "909", $dlist_name, $text);
		$_SESSION['result']="your message have been sent :)";
		header('Location: ../securedpages/added.php');
		break;
}
else {
	$_SESSION['result']="There is no Distribution list :(";
		header('Location: ../securedpages/added.php');
	break;}

case "add_to_dlist":
echo add_to_mysql();
		
	$mem_ph = $_SESSION['phone'];
	$dlist = $_POST['things'];
	$mem_name = $_SESSION['name'];
$school = str_replace(" ", "",$_SESSION['school']); // replace space from $_SESSION['school']

if(NowSMSDListDeleteMemberAllLists ("127.0.0.1", "8800", "aa", "909", $mem_ph))
{
	SendSMS ("127.0.0.1", 8800, "aa", "909", $mem_ph, "Welcome to TeXTeM! Please save this number as \"TeXTem\" and don't text/call to this number. Thank you for signing up and HAVE A WONDERFUL DAY!");	
	// add to university list
	NowSMSDListAddMember ("127.0.0.1", "8800", "aa", "909", $school."-all", $mem_ph);
	}
	
for($i=0;$i<sizeof($dlist);$i++)
				{
if(!NowSMSDListCheckMember ("127.0.0.1", "8800", "aa", "909", $school."-".$dlist[$i], $mem_ph))
		{
	NowSMSDListAddMember ("127.0.0.1", "8800", "aa", "909", $school."-".$dlist[$i], $mem_ph);
		}//end if

else{
	
	//break;
    }
				}// end for
	
			
$_SESSION['result']=$mem_name.", you are registered :) ";
header('Location: ../securedpages/added.php');
break;

case "show_dlist":
$mem_ph = $_POST['phone'];
$_SESSION['mem'] = $_POST['phone'];
NowSMSDListDeleteMemberAllLists ("127.0.0.1", "8800", "aa", "909", $mem_ph);

//echo sizeof ($_SESSION['ser_lst']);
//break;
if (sizeof ($_SESSION['ser_lst'])==0)
	{	
	$_SESSION['result']=" You are not in any of the Textem distribution lists. Head over to home page to sign up :) ";
	header('Location: ../securedpages/added.php');
	break;
	}	
$_SESSION['result']=" filler"; // if left empty it would not go to service page
header('Location:../securedpages/service.php');
break;
// end delete

case "delete":
$dlists = $_POST['service'];
$mem = $_POST['mem'];


// echo $_SESSION['mem'];//$_SESSION['mem'];
if (!isset($_POST['mem'])){
	 echo "<script type=\"text/javascript\">";
	 echo "var t = prompt(\"Please enter your number\",\"\");";
	 echo " <?php  $mem ?> = t;";
     echo "</script>";
	}

for($q=0;$q<sizeof($dlists);$q++)
				{					
NowSMSDListDeleteMember ("127.0.0.1", "8800", "aa", "909", $dlists[$q], $mem);}

$_SESSION['result']= "you are deleted from the selected Textem distribution lists. If you are interested you can always sign up again :)";
header('Location: ../securedpages/added.php');
break;


case "share-event":

$mem_ph = $_POST['phone'];
$text = $_POST['text'];
$school = str_replace(" ", "",$_POST['school']); // replace space from 
$dlist_name= $school.'_'.'all';


if(NowSMSDListExists ("127.0.0.1", "8800", "aa", "909", $dlist_name))
{

if(!NowSMSDListCheckMember ("127.0.0.1", "8800", "aa", "909", $dlist_name, $mem_ph))
		{
SendSMS ("127.0.0.1", 8800, "aa", "909", $mem_ph, "You are not in TeXTeM's database. Please sign up \"www.textem.ca\" for free to avoid this message in the future and receive notifications from other students!");
		}//end if
}// end NowSMSDLISTEXISTS

else{
$_SESSION['result']= "Sorry, you school does not use TeXTeM at the moment :(";
header('Location: ../securedpages/added.php');
break;
}

SendSMS ("127.0.0.1", 8800, "aa", "909", "1234567890", $text);


$_SESSION['result']= "your message has been submitted :)";
header('Location: ../securedpages/added.php');

break;

}// end switch

?> 