<?php
	$html = urldecode($_POST['html']);
	if ($html != "") {
		$document = new DOMDocument();
		$document->loadHTML($html);
		$elementList = $document->getElementsByTagName('b');
		foreach($elementList as $element) {
			$uuidStripper = str_replace("Uuid32", $_POST['name'], file_get_contents('elements/' . $element->textContent . '.html'));
			$html = str_replace("<b>" . $element->textContent . "</b>", $uuidStripper, $html);
		}
	}
	$data = "<link rel='stylesheet' type='text/css' href='uploads/uploads.css'>"
	. "<div id='background'><img src='uploads/" . $_POST['image'] . "' class='stretch' alt='' /></div>"
	. $html;
	file_put_contents("uploads/" . $_POST['name'] . ".html", $data);
	echo "File Successfully Created!";
?>