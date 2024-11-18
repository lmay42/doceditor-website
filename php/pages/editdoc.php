<?php
	if(!$_SESSION["editauth"]) die("<p class=\"text-xl text-center py-32\">UNAUTHORIZED!!!</p>");
	$filename = isset($_GET["edit"]) ? $_GET["edit"] : die("Please provide the filename to edit lol.");
	$docpath = PATH_DOCS . $filename . ".txt";
	if(!file_exists($docpath)) {
		if(!touch($docpath)) die("Unable to create text file.");
	}
	$has_submitted = isset($_POST["submit"]);
	$savestatus = -1;


	if($has_submitted) {
		$savestatus = save_document($_POST["filename"], $_POST["title"], $_POST["description"], $_POST["tags"], $_POST["content"]);
	}

	$docinfo = get_document_info(PATH_DOCS . $filename . ".txt");
	$is_new_document = $docinfo == false;
	// print_r($docinfo);

?>

<div>

	<div class="bg-slate-200 dark:bg-slate-700 shadow-md p-16">
		<h1 class="text-xl text-center">Edit Document</h1>
	</div>

	<div class="p-4 md:p-16 max-w-full m-auto md:max-w-5xl">

		<?php if(!($savestatus === -1)) : ?>
		<div class="bg-sky-400 text-sky-950 dark:bg-sky-300 max-w-sm rounded-xl shadow-lg p-4 text-center empty:display-none">
			<p>
				<?php
				if($savestatus === -1) echo "";
				else if($savestatus === 0) echo "Successfully saved changes.";
				else echo $savestatus;
				?>
			</p>
		</div>
		<?php endif; ?>

		<form method="POST">
			<div class="py-2">
				<label class="text-lg dark:text-slate-300" for="filename">Text File: </label>
				<input class="text-lg w-full bg-slate-200 sm:w-100 shadow-md rounded-md px-4 py-0.5" disabled type="text" value="<?php echo $filename; ?>.txt">
				<input type="hidden" name="filename" id="filename" value="<?php echo $filename; ?>">
				<p class="text-md text-slate-600 dark:text-slate-300">The name of the text file to edit. If this is a new document, set this to something unique to not overwrite an existing document.</p>
				<?php if ($is_new_document) : ?>
					<p class="text-md text-sky-700 dark:text-sky-300">Creating new document</p>
				<?php endif; ?>
			</div>
			<div class="py-2">
				<label class="text-lg dark:text-slate-300" for="filename">Title: </label>
				<input class="text-lg w-full sm:w-100 shadow-md rounded-md px-4 py-0.5" type="text" name="title" id="title" value="<?php echo $docinfo["title"]; ?>">
				<p class="text-md text-slate-600 dark:text-slate-300">The name of the text file to edit. If this is a new document, set this to something unique to not overwrite an existing document.</p>
			</div>
			<div class="py-2">
				<label class="text-lg dark:text-slate-300" for="filename">Description: </label>
				<input class="text-lg w-full h-fit text-wrap max-h-40 sm:w-100 shadow-md rounded-md px-4 py-0.5" type="text" name="description" id="description" value="<?php echo $docinfo["description"]; ?>">
				<p class="text-md text-slate-600 dark:text-slate-300">Provide a brief description of what the document's contents pertain to.</p>
			</div>
			<div class="py-2">
				<label class="text-lg dark:text-slate-300" for="filename">Tags: </label>
				<input class="text-lg w-full h-fit text-wrap max-h-40 sm:w-100 shadow-md rounded-md px-4 py-0.5" type="text" name="tags" id="tags" value="<?php echo implode(" ", $docinfo["tags"]); ?>">
				<p class="text-md text-slate-600 dark:text-slate-300">Give a list of tags, seperated by spaces, to define the type of document. Can be left blank for no tags. Purely cosmetic (for now).</p>
			</div>
			<div class="py-2">
				<label class="text-lg dark:text-slate-300" for="filename">Content: </label>
				<p class="text-md text-slate-600 dark:text-slate-300">This is where you write the actual content for the file.</p>
				<p class="text-md text-slate-600 dark:text-slate-300">A few tricks to use for writing:</p>
				<ul class="text-md text-slate-600 dark:text-slate-300 py-2 list-disc list-inside">
					<li>HTML tags work. Try using: <b>&lt;b&gt;bold&lt;/b&gt;</b> <i>&lt;i&gt;italic&lt;/i&gt;</i> or <q>&lt;q&gt;quote&lt;/q&gt;</q> tags</li>
					<li>A single enter press will be ignored and interpreted as continuing the last line. Double enter presses (one line between paragraphs) are converted to paragraphs with indents automatically.</li>
					<li>You can upload and use images. Upload the image <a class="text-blue-400 text-underline" href="/upload.php">here</a> and use it with &lt;img&gt; tags (css tags work on it too. try using tailwindcss tags too!)</li>
				</ul>
				<textarea class="text-md w-full h-128 text-wrap shadow-md rounded-md p-4" rows=25 name="content" id="content"><?php echo $docinfo["content"]; ?></textarea>
			</div>
			<div class="py-2">
				<input class="bg-slate-50 px-2 py-0.5 hover:bg-slate-200 transition-color rounded-lg shadow-lg" type="submit" name="submit" id="submit" value="Save Changes">
			</div>
		</form>
	</div>


</div>
