<?php
session_start();

// print_r($_SESSION);

if(!isset($_SESSION["auth"])){
	echo "you are NOT allowed.";
	// print_r($_SESSION);
	echo "<meta http-equiv=\"Refresh\" content=\"0; url='https://docedit.shwitter.ca/login.php'\" />";

	die("");
}

//<meta http-equiv="Refresh content="0; url='https://docedit.shwitter.ca/login.php'" />

function gamer() {
	return "Hello World!";
}


?>
