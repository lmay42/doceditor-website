
<?php

define("PASSWORD_FILE", "passwords.txt");

session_start();

$bIsDenied = false;
$bHasSubmitted = isset($_POST["submit"]);

$file = fopen(PASSWORD_FILE, "r");
$password = trim(fgets($file)); // first line is regular access key
$password_edit = trim(fgets($file)); // second line is the edit access key
fclose($file);

if($password_edit === false) {
	$_SESSION["auth"] = 1;
	$_SESSION["editauth"] = 1;
}

if($bHasSubmitted) {
	if ($_POST["password"] == $password_edit) {
		$_SESSION["auth"] = 1;
		$_SESSION["editauth"] = 1;
		die("<meta http-equiv=\"Refresh\" content=\"0; url='https://docedit.shwitter.ca/'\"  />");
	}
	else if ($_POST["password"] == $password) {
		$_SESSION["auth"] = 1;
		$_SESSION["editauth"] = 0;
		echo "logged in";
		die("<meta http-equiv=\"Refresh\" content=\"0; url='https://docedit.shwitter.ca/'\"  />");
	} else {
		//usleep(random_int(1.5, 2.5) * 100000);
		sleep(1);
		$bIsDenied = true;
	}
}

if(isset($_POST["logout"])) {
	echo "logged out.";
	session_unset();
}

?>

<html>

	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>
  <body class="bg-slate-50 dark:bg-slate-800">

  	<nav class="bg-slate-300 text-slate-800 dark:bg-slate-600 dark:text-slate-100  shadow-lg flex flex-row-reverse align-center text-right w-full h-12">
			<div class="grow"></div>
			<a href="/">
				<div class="p-2 flex flex-row flex-nowrap space-x-2 items-center">
					<img class="h-10 w-10 rounded-md shadow-xl" src="/favicon.ico">
					<p class="text-lg text-slate-900">Pogo Articles</p>
				</div>
  		</a>
  	</nav>

		<div class="py-16 px-auto text-center">
			<h1 class="p-16 text-xl text-slate-900 dark:text-slate-100">Login</h1>

			<?php if (isset($_SESSION["auth"])) : ?>
			<p class="p-8 text-lg text-slate-200 dark:text-slate-200"">Currently Logged In.</p>
				<form method="POST">
					<input class="p-4 rounded-sm shadow-lg bg-slate-100 dark:bg-slate-500" type="submit" name="logout" id="logout" value="logout">
				</form>
			<?php else : ?>
			<form class="text-xl md:text-lg" method="POST">
				<label class="p-2 text-slate-800 dark:text-slate-100" for="password">Password</label><br>
				<input class="px-2 py-0.5 rounded-md shadow-md bg-sky-50 hover:bg-sky-150" type="password" name="password" id="password">
				<input class="px-2 py-0.5 rounded-md shadow-md bg-slate-200 hover:bg-slate-100 active:bg-slate-400" type="submit" name="submit" id="submit" value="Submit">
			</form>

			<?php if ($bIsDenied) : ?>
			<p class="text-lg text-pink-500 text-shadow-lg"> incorrect..</p>
			<?php endif; ?>

			<?php endif; ?>
		</div>
	</body>

</html>
