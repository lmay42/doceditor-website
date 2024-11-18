<?php

	$filename = isset($_GET["view"]) ? $_GET["view"] : die("Please give me a view id lol.");
	$docinfo = get_document_info(PATH_DOCS . $filename . ".txt");
	$paragraphs = preg_split("/\n\n|\r\n\r\n/", $docinfo["content"]); // splits string either at "\n\n" OR "\r\n\r\n" (2 ways to write double new line)

?>

<div>

	<h2 class="text-xl text-center p-8 text-slate-900 dark:text-slate-200"><?php echo $docinfo["title"]; ?></h2>
	<h4 class="text-lg text-center text-slate-500 dark:text-slate-400"><?php echo $docinfo["description"]; ?></h4>

	<div class="p-4 flex flex-wrap flex-row justify-center align-center space-x-4">
	<?php foreach($docinfo["tags"] as $tag) : ?>
		<p class="text-md w-fit h-fit px-2 py-0.5 bg-slate-100 rounded-xl shadow-md"><?php echo $tag; ?></p>
	<?php endforeach; ?>
	</div>

	<?php if($_SESSION["editauth"]) : ?>
	<a href="/?edit=<?php echo $filename; ?>" class="h-8 w-8 p-16">
		<img class="h-8 w-8 mx-auto" src="/src/images/pencilicon.png">
	</a>
	<?php endif; ?>

	<article class="px-4 py-16 md:px-16 max-w-5xl mx-auto text-slate-800 dark:text-slate-100 text-xl">

		<?php foreach($paragraphs as $line) : ?>
			<p class="py-4 indent-12 text-inherit"> <?php echo $line; ?> </p>
		<?php endforeach; ?>
	</article>


</div
