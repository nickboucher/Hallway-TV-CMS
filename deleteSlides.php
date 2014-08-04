<?php
	foreach ($_POST['deleteSlides'] as $slide) {
		$name = preg_replace("/\\.[^.\\s]{3,4}$/", "",$slide);
		if (unlink("uploads/" . $slide) && unlink("uploads/" . $name . ".html")) {
			echo $name . " deleted successfully\n";
		} else {
			echo "Error deleting " . $name . "\n";
		}
	}
?>