<?php 

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>EUFORIČNA DOTA</title>

	<style type="text/css">
		.positive {
			border: 5px solid red;
		}

		.negative {
			width: 90px;
			height: 90px;
			-webkit-filter: grayscale(100%); /* Chrome, Safari, Opera */
    		filter: grayscale(100%);
		}
	</style>
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
<script type="text/javascript">

$(document).ready(function() {
	$("#given_chars").val("");
});

$(document).keypress(function(e) {

	if(e.keyCode == 8) {
		$("#given_chars").val($("#given_chars").val().slice(0,-1));
	}

	if(e.keyCode == 0) {
		if(e.charCode != 32)
			$("#given_chars").val($("#given_chars").val()+e.key);
	}

	if(e.keyCode == 8 || e.keyCode == 0) {
		updatePictures();
	}

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