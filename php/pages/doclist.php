<?php
	$doclist = get_documents();
?>

<div class="bg-zinc-100 dark:bg-slate-700 dark:text-slate-200 space-x-4 shadow-sm text-center">
  <h1 class="text-xl text-center py-4 text-slate-900 dark:text-slate-100"> Articles </h1>
  <h3 class="text-md text-center py-4"> Select an article below </h3>
</div>


<div class="max-w-fill w-fill md:max-w-900 p-4 m-0">
	<p class="text-md text-slate-600 dark:text-slate-200 p-4 mx-sm"> <?php echo count($doclist); ?> Articles </p>

	<div class="flex flex-wrap justify-center items-center items-baseline space-x-0 sm:space-x-4 space-y-4">
		<?php foreach($doclist as $docinfo) : ?>

				<div class="p-6 max-w-sm bg-white rounded-xl shadow-md space-x-4 flex flex-row flex-nowrap justify-between w-full max-w-full text-xl sm:max-w-sm sm:w-fit hover:bg-sky-50 transition-color">

					<div class="">
						<a href="/?view=<?php echo $docinfo["filename"]; ?>" class="max-w-sm">
							<p class="text-xl font-medium text-black"><?php echo $docinfo["title"]; ?></p>
							<p class="text-slate-500"><?php echo $docinfo["description"]; ?></p>
								<div class="py-2 px-0 flex flex-wrap flex-row overflow-hidden justify-left align-center space-x-4">
								<?php foreach($docinfo["tags"] as $tag) : ?>
									<p class="text-sm w-fit h-fit px-2 py-0.5 bg-slate-50 rounded-xl shadow-md"><?php echo $tag; ?></p>
								<?php endforeach; ?>
								</div>
						</a>
					</div>
					<?php if($_SESSION["editauth"]) : ?>
					<a href="/?edit=<?php echo $docinfo["filename"]; ?>" class="h-8 w-8">
						<img src="/src/images/pencilicon.png">
					</a>
					<?php endif; ?>

		  	</div>


		<?php endforeach; ?>
	</div>
</div>
