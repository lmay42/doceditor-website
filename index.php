<?php
	set_include_path("php");
	require "auth.php";
	require "functions.php";

  //session_start();
?>

<html>
  <head>
    <title>Document Editor</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body class="bg-slate-50 dark:bg-slate-700">

	<nav class="bg-slate-300 text-slate-800 dark:bg-slate-600 dark:text-slate-100 shadow-lg flex flex-row-reverse align-baseline text-right w-full h-12">
			<form method="POST" action="/login.php" class="m-0">
				<input type="submit" name="logout" id="logout" value="Logout" class="bg-slate-100 dark:bg-slate-700 px-2 py-0.5 m-1.5 rounded-sm shadow-sm hover:bg-sky-100">
			</form>
			<?php if ($_SESSION["editauth"]) : ?>
				<button class="bg-slate-100 m-0 h-fit w-fit dark:bg-slate-700 px-2 py-0.5 m-1.5 rounded-sm shadow-sm hover:bg-sky-100" onclick="togglecreatepanel();">Create New Doc</button>
				<script defer src="src/js/createpanel.js"></script>
				<div class="hidden bg-slate-200 dark:text-slate-800 p-16 max-w-md fixed top-16 right-4 rounded-lg shadow-lg" id="createpanel">
					<h3 class="text-lg text-slate-900 text-center">Create New Document</h3>
					<p class="text-sm text-slate-600 text-center p-4">Enter the filename of the new document (no extension)</p>
					<input class="w-full px-2 py-2 my-4 bg-slate-50 shadow-sm rounded-md hover:bg-slate-200" type="text" name="newdocname" id="newdocname">
					<button class="text-lg bg-slate-50 w-full sm:w-100 shadow-sm rounded-md px-4 py-0.5" onclick="create_doc(document.getElementById('newdocname').value)">Create</button>
				</div>
				<p>*Edit Auth</p>
			<?php endif; ?>
			<div class="grow"></div>
			<a href="/">
				<div class="p-2 flex flex-row flex-nowrap space-x-2 items-center">
					<img class="h-10 w-10 rounded-md shadow-xl" src="/favicon.ico">
					<p class="text-lg text-slate-900">Article Editor</p>
				</div>
  		</a>
  	</nav>

		<?php
			if (isset($_GET["view"])) require("pages/viewdoc.php");
			else if (isset($_GET["edit"])) require("pages/editdoc.php");
			else require("pages/doclist.php");
		?>

  </body>
</html>

