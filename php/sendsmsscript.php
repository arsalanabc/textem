<?php

function SendSMS ($host, $port, $username, $password, $phoneNoRecip, $msgText) { 

/* Parameters:
    $host - IP address or host name of the NowSMS server
    $port - "Port number for the web interface" of the NowSMS Server
    $username - "SMS Users" account on the NowSMS server
    $password - Password defined for the "SMS Users" account on the NowSMS Server
    $phoneNoRecip - One or more phone numbers (comma delimited) to receive the text message
    $msgText - Text of the message
*/

 
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


/* This code provides an example of how you would call the SendSMS function from within
   a PHP script to send a message.  The response from the NowSMS server is echoed back from the script.
 
$x   = SendSMS("127.0.0.1", 8800, "username", "password", "+44999999999", "Test Message");
echo $x;

*/

/*
   Second, here's the PHP script that would parse the parameters from the form posting, and then call
   the SendSMS function to submit the message.
*/



// $rec = $_REQUEST['@@SENDER@@'];
// echo $rec;

$pn = $_REQUEST['phone'];
$msg = $_REQUEST['text'];
$name = $_REQUEST['name'];


function work($message)
   {
 
	$result;

	if($message == 'abc')
	{
 		$result= 'xyz';
	}

 	elseif($message == 'time')
	{
		return date('Y-M-D-d');
	}
	
	else 
	{
	$result = 'fail';
	}


    	return $result;
   }

if (isset($pn)) { 
   if (isset($msg)) { 

// this for sending date
//====================
//	$a = work($msg); // calling the func work
//	$today_is = 'Today is ';
//echo $today_is.$a;  //show text on screen
//	$new_msg = $today_is.$a;
//	echo $new_msg;
//=============================

$msg = $msg." ".$name;

$x = SendSMS("127.0.0.1", 8800, "aa", "909", $pn, $msg); 
echo $x;


	
//to add the phone and text to mysql
mysql_connect("127.0.0.1", "root") or die ("couldn't connect. ".mysql_error());
mysql_select_db("test2");


$query = "INSERT INTO d1 (ID, pn, msg) VALUES ('NULL', '$pn', '$msg')";
mysql_query($query) or die ('not added to mysql '.mysql_error());

 
   } 

   else { 
      echo "ERROR : Message not sent -- Text parameter is missing!\r\n"; 
   } 

}
else { 
   echo "ERROR : Message not sent -- Phone parameter is missing!\r\n"; 
}




 
?>