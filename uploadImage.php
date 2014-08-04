<html>
<head>
<title>Select Picture</title>
<script src='resources/jquery/jquery-1.9.1.min.js'></script>
</head>
<body>
Please Select a background Picture.<br>
<form action="designer.php" enctype="multipart/form-data" method="post" onsubmit="return validateForm()"><br>
Select Picture: <input type="file" accept="image/*" name="pic" id="uploadPic"><br>
Name*: <input type="text" name="name" id="textBoxName"><br>
<input type="submit" id="btnSubmit" value="Upload File">
<input type="button" value="Cancel" onclick="location.href='showCreator.php';"
</form>
<br>
<br>
<p>* Name must be unique, duplicate names will be overridden with newest version.</p>
<p>
<b>Slides currently on Server:</b>
<ul>
<?php
	$files = glob('uploads/*.{jpg,jpeg,gif,png,tif,JPG,JPEG,GIF,PNG,TIF}', GLOB_BRACE);
	foreach($files as $file) {
		echo "<li>" . preg_replace("/\\.[^.\\s]{3,4}$/", "",basename($file)) . "</li>";
	}	
?>
</ul>
</p>
<script type="text/javascript">
	document.getElementById('textBoxName').onkeydown = function(event) {
		var event = event || window.event;
		var key = event.keyCode || event.which;
		if (key == 32) {
			if (event.preventDefault) event.preventDefault();
			event.returnValue = false;
		}
	};
	
	function validateForm() {
		if ($("#textBoxName").val() == "" || $("#uploadPic").val() == "") {
			alert("You must upload a background image AND specify a name");
			return false;
		}
	}
</script>
</body>
</html>