<?php
	$filename = $_FILES['pic']['name'];
	$ext = pathinfo($filename, PATHINFO_EXTENSION);
	$imagename = $_POST['name'].".".$ext;
    $imageerror = $_FILES['pic']['error'];
    $imagetemp = $_FILES['pic']['tmp_name'];

    //The path you wish to upload the image to
    $imagePath = "uploads/";

    if(is_uploaded_file($imagetemp)) {
        if(move_uploaded_file($imagetemp, $imagePath . $imagename)) {
            $uploadMessage = "Successfully uploaded your image.";
        }
        else {
            $uploadMessage = "Failed to move your image.";
        }
    }
    else {
        $uploadMessage = "Failed to upload your image.";
    }
?>
<html>
    <head>
	    <title>Student Council TV Editor</title>
		<link rel="stylesheet" type="text/css" href="main.css">
		<link rel="stylesheet" type="text/css" href="resources/jquery/jquery-ui.css">
		<script src="resources/jquery/jquery-1.9.1.min.js"></script>
		<script src="resources/jquery/jquery-ui.min.js"></script>
    </head>
    <body>
		<div id="background">
			<img src='<?php echo "uploads/".$imagename; ?>' class="stretch" alt="" />
		</div>
        <script type="text/javascript">
			
			function checkBox(element) {
				if($("#" + element + "CheckBox").is(":checked")) {
					$("#designer").append("<div id='" + element + "' class='resizable draggable colored " + element + "_<?php echo $_POST['name']; ?>' style='overflow:auto;width:150px; height:25px;'><b>" + element + '</b><div class="remove"><br><input type="checkbox" id="BackgroundCheckBox">Background, color=<input type="text" id="color"><br><input type="checkbox" id="RoundedCheckBox">Rounded Corners<br><input type="checkbox" id="PaddingCheckBox">Padding</div></div>');
					$("#" + element).resizable();
					$("#" + element).draggable();
				} else {
					$("#" + element).remove();
				}
			}
			
			function percentage(element) {
				$(element).css("width",parseInt($(element).css("width")) / $(window).width() * 100 + "%");
				$(element).css("height",parseInt($(element).css("height")) / $(window).height() * 100 + "%");
				$(element).css("left",parseInt($(element).css("left")) / $(window).width() * 100 + "%");
				$(element).css("top",parseInt($(element).css("top")) / $(window).height() * 100 + "%");
				if ($(element + " > div > #BackgroundCheckBox").is(":checked")) $(element).css("background-color", $(element + " > div > #color").val());
				if ($(element + " > div > #RoundedCheckBox").is(":checked")) $(element).css("border-radius", "15px");
				if ($(element + " > div > #PaddingCheckBox").is(":checked")) $(element).css("padding", "10px");
				$(element + "> .remove").remove();
			}
			
			function submitContent() {
				var output = "";
				<?php
					$files = glob('elements/*.{html}', GLOB_BRACE);
					foreach($files as $file) {
						$name = preg_replace("/\\.[^.\\s]{3,4}$/", "",basename($file));
						echo 'if ($("#' . $name . '")) {percentage("#' . $name . '");output += $("<div>").append($("#' . $name . '").clone()).html();}';
					}
				?>

				$.post( "saveHTML.php", { name: "<?php echo $_POST['name']; ?>", image: "<?php echo $imagename; ?>", html: encodeURI(output) } )
					.done(function(data) {
						alert(data);
						document.location.href = "showCreator.php";
					});
			}

        </script>
		

		<div style="background: rgba(255, 255, 255, 0.8); display:inline;">
			
			<?php
				echo $uploadMessage;
				foreach($files as $file) {
					$name = preg_replace("/\\.[^.\\s]{3,4}$/", "",basename($file));
					echo '<input type="checkbox" id="' . $name . 'CheckBox" onclick="checkBox(' . "'" . $name . "'" . ')">' . ucwords($name);
				}
			?>
			<input type="button" id="btnSubmit" value="submit" onclick="submitContent()"><div id="hidden_form_container"></div>
		</div>
		<div id="designer"></div>
    </body>
</html>
