<?php

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



NowSMSDListAddMember ("127.0.0.1", "8800", "aa", "909", "school", "1234567890");
?>