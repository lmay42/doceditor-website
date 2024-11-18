<?php

define("PATH_DOCS", "/opt/bitnami/projects/doceditor/html/files/");

// returns all the documents there are
function get_documents() {
	$glob = glob(PATH_DOCS . "*.txt");

	$docinfolist = [];
	foreach ($glob as $filepath) {
		$pathinfo = pathinfo($filepath); // get info on the file, like name
		$docinfo = get_document_info($filepath, true);
		$docinfo["filename"] = $pathinfo["filename"];
		$docinfo["basename"] = $pathinfo["basename"];
		$docinfo["path"] = $filepath;
		$docinfo["datecreated"] = filectime($filepath);
		$docinfolist[] = $docinfo;
	}

	usort($docinfolist, cmp_datecreated);

	return $docinfolist;
}

// sorts by most recently changed/modified to the top
function cmp_datecreated($a, $b) {
	// if ($a["datecreated"] == $b["datecreated"]) return 0;
	return $a["datecreated"] > $b["datecreated"] ? -1 : 1;
}

// takes  in the filepath to a document.txt
// formula goes like this:
// Line 1 is the title
// Line 2 is the description
// The rest of the document is the content
function get_document_info($filepath, $skip_content = false) {
	if(!file_exists($filepath)) {
		return false;
	}

	$docinfo = [];
	$file = fopen($filepath, "r");
	$docinfo["title"] = fgets($file);
	$docinfo["description"] = fgets($file);
	$docinfo["tags"] = explode(" ", fgets($file));
	if($skip_content) {
		$docinfo["content"] = "No content.";
	}
	else {
		//fgets($file);
		$docinfo["content"] = fread($file, filesize($filepath));
	}

	return $docinfo;
}

function save_document($filename, $title, $description, $tags, $content) {
	// verify data
	if(empty($filename)) return "NO_FILENAME";
	if(empty($title)) return "NO_TITLE";
	if(empty($description)) return "NO_DESCRIPTION";
	if(empty($content)) return "NO_CONTENT";

	// do the save
	$data = $title . "\n" . $description . "\n" . $tags . "\n" . $content;
	$savepath = PATH_DOCS . $filename . ".txt";
	if(!is_writable($savepath)) return "CANT_WRITE_TO_FILE: $savepath";
	if(!$file = fopen($savepath, 'w')) return "CANT_OPEN_FILE";
	if(fwrite($file, $data) === false) return "CANT_WRITE_FILE";
	fclose($file);

	return 0;
}


?>
