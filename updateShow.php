<?php
	$html = "<html><head><title>Villa Madonna Academy</title><meta http-equiv='pragma' content='no-cache' />
<meta http-equiv='cache-control' content='no-cache' /><script src='resources/jquery/jquery-1.9.1.min.js'></script><link rel='stylesheet' type='text/css' href='uploads/uploads.css'></head><body>" ;
	$id = 0;
	foreach ($_POST['newShow'] as $slide) {
		$name = preg_replace("/\\.[^.\\s]{3,4}$/", "", $slide);
		$html .= "<div id='" . ++$id . "' class='frame' style='position:absolute; top:0; left:0; width:100%; height:100%;'>";
		$html .= file_get_contents("uploads/" . $name . ".html");
		$html .= "</div>";
	}
	$html .= '<div id="loading"><div id="circleG"><div id="circleG_1" class="circleG"></div><div id="circleG_2" class="circleG"></div><div id="circleG_3" class="circleG"></div><p><b>Loading...</b></p></div></div><div id="hoverForLink"><div id="editorLink"><a href="showCreator.php" target="_self"><h2>Editor</h2></a></div></div>';
	$html .= "<script type='text/javascript'>";
	$html .= '$("#hoverForLink").mouseenter(function(){$("#editorLink").animate({top: "33%"});}); $("#hoverForLink").mouseleave(function(){$("#editorLink").animate({top: "100%"});});';
	$html .= "var totalFrames = " . $id .";";
	$html .= 'var visibleFrame = 1; setTimeout(function() { for (i=1; i<=totalFrames; i++) { $("#" + i).css("display", "none"); }';
	$html .= "setInterval(switchFrame, " . ($_POST['minutes'] * 60 * 1000) . ");";
	$html .= '$("#1").css("display", "block"); $("#loading").css("display", "none");},5000); function switchFrame() { $("#" + visibleFrame).css("display", "none"); if (visibleFrame == totalFrames) { visibleFrame = 1; } else { visibleFrame++; } $("#" + visibleFrame).css("display", "block"); }';
	$html .= "</script></body></html>";
	file_put_contents("index.html", $html);
	echo "Show Created Successfully!";
?>