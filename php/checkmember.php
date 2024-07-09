<?php
session_start();



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

$mem_ph = $_POST['phone'];
echo $mem_ph;



if(NowSMSDListCheckMember ("127.0.0.1", "8800", "aa", "909", "a", $mem_ph))
{header('Location: ../pages/added.html');
}

?>