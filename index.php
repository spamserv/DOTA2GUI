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

		.hero_pic {
			height: 75px; 
			width: 75px; 
		}
	</style>
</head>
<body>

<input type="text" id="given_chars" disabled="">

<br>

<?php 
$heroes = json_decode(file_get_contents("static/data/heroes.json"));
foreach($heroes as $hero)
{
    echo '<img src="static/img/heroes/'.$hero->name.'_lg.png" data-name="'.strtolower($hero->localized_name).'" data-id="'.$hero->id.'" class="hero_pic">';
}  

?>

<br>

<script type="text/javascript" src="static/js/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function() {
	$("#given_chars").val("");
});

$(document).keydown(function(e) {
	console.log(e.keyCode);
	if(e.keyCode == 8) {
		$("#given_chars").val($("#given_chars").val().slice(0,-1));
		updatePictures();
		return false
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