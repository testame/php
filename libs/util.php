<?php
// legge da un array Associativo senza errori, al limite stringa vuota 
function getArr($A,$index){
   $ret="";
   if( isset( $A[$index] ) ) 
	   $ret=$A[$index];
   return $ret;
}
function checkLogin(){
   $userid = getArr($_SESSION,'id');
   $user = getArr($_SESSION, 'username');
   if ($userid=="" || $user=="")
      header("Location: index.php");
}
function isLogin(){
   $user = getArr($_SESSION, 'username');
   return ($user!="");
}

?>
