<html>
	<head>
		<title>Show Creator</title>
		<link rel="stylesheet" type="text/css" href="resources/jquery/jquery-ui.css">
		<script src="resources/jquery/jquery-1.9.1.min.js"></script>
		<script src="resources/jquery/jquery-ui.min.js"></script>
		<style>
			ul { position:relative; top:12%; list-style-type: none; float: left; margin-right: 10px; padding: 5px; min-height: 170px;}
			li { margin: 5px; padding: 5px; font-size: 1.2em; width: 200px; height: 150px; display:block; float:left;}
			p {text-align: center; width:200px}
			ul.blue { background: #7D82A3; width: 40%;}
			ul.red { background: #D86464; width: 15%;}
		</style>
	</head>
	<body>
		<div>
		<input type="button" value="Create Slide" onclick="location.href='uploadImage.php';">
		<input type="button" value="Resume Show" onclick="location.href='/';">
		</div>
		<div style="position:absolute; left:0%; width:40%; display:block; text-align:center;"><h2>Pages Available</h2></div>
		<div style="position:absolute; left:40%; width:40%; display:block; text-align:center;"><h2>Pages in Show</h2>Page Display Time (minutes):<input type="number" id="time" name="time" min="1" max="20" value="5"><input type=button name="btnSubmit" value="Update Show" onclick="updateShow()"></div>
		<div style="position:absolute; left:80%; width:20%; display:block; text-align:center;"><h2>Delete</h2><input type=button name="btnDelete" value="Delete Now" onclick="deleteNow()"></div>
		<?php
			$files = glob('uploads/*.{jpg,jpeg,gif,png,tif,JPG,JPEG,GIF,PNG,TIF}', GLOB_BRACE);
			echo "<ul id='images' class='sortable blue'>";
			foreach($files as $file) {
				$name = preg_replace("/\\.[^.\\s]{3,4}$/", "",basename($file));
				if (file_exists("uploads/" . $name . ".html")) {
				echo "<li id='" . basename($file) . "'><img src='uploads/" . basename($file) . "' style='width:200px !important; height:112px !important;' alt='" . basename($file) . "'><p>" . $name . "</p></li>";
				}
			}
			echo "</ul>";
		?>
		
		<ul id="newShow" class="sortable blue"></ul>
		<ul id="delete" class="sortable red"></ul>
		
		
		<script type="text/javascript">
			$(".sortable").sortable({
				connectWith: "ul",
				dropOnEmpty: true
			});
			
			function deleteNow() {
				$.post( "deleteSlides.php", { deleteSlides: $("#delete").sortable('toArray') } )
					.done(function(data) {
						alert(data);
						document.location.href = "showCreator.php";
					});
			}
			
			function updateShow() {
				$.post( "updateShow.php", { newShow: $("#newShow").sortable('toArray'), minutes: $("#time").val() } )
					.done(function(data) {
						alert(data);
						document.location.href = "./index.html";
					});
			}
		</script>
	</body>
</html>