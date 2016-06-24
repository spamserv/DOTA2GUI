<?php 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dota2 Predictioner</title>

	<link rel="stylesheet" type="text/css" href="static/css/index.css">
</head>
<body>

<input type="text" id="given_chars" disabled="">
<br>
<img src="static/img/a.png" data-name="aa" height="100" width="100" class="hero_pic">
<img src="static/img/a.png" data-name="aab" height="100" width="100" class="hero_pic">
<img src="static/img/a.png" data-name="ab" height="100" width="100" class="hero_pic">
<img src="static/img/a.png" data-name="bb" height="100" width="100" class="hero_pic">
<img src="static/img/a.png" data-name="bba" height="100" width="100" class="hero_pic">
<img src="static/img/a.png" data-name="ba" height="100" width="100" class="hero_pic">



<script type="text/javascript" src="static/js/jquery.min.js"></script>
<script type="text/javascript" src="static/js/bootstrap.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	$("#given_chars").val("");
});

$(document).keydown(function(e) {
	console.log(e.keyCode);
	if(e.keyCode == 8) {
		$("#given_chars").val($("#given_chars").val().slice(0,-1));
		return false;
	}

	if(e.charCode != 32)
		$("#given_chars").val($("#given_chars").val()+e.key);

	updatePictures();

});

function updatePictures() {
	var value = $("#given_chars").val();
	var value_length = value.length;

	$(".hero_pic").each(function() {
		if(value_length > 0) {
			hero_name = $(this).attr("data-name");
			console.log("Value : "+value+" = "+hero_name.substring(0, value_length));
			if(value == hero_name.substring(0, value_length)) {
				$(this).removeClass("negative");
				$(this).addClass("positive");
			} else {
				$(this).removeClass("positive");
				$(this).addClass("negative");
			}
		} else {
			$(this).removeClass("positive");
			$(this).removeClass("negative");
		}
	});
}

</script>

</body>
</html>