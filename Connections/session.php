<?php require_once("redirect.php");?>

<?php
if (!isset($_SESSION)) {
  session_start();
}
	
if (!isset($_SESSION['w3_username'])) {
  //redirect_to("../Help/main.php");
  redirect_to("../Connections/popup.php");
}	
?>