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

<?php 
$heroes = json_decode(file_get_contents("static/data/heroes.json"));
foreach($heroes as $hero)
{
    echo '<img src="static/img/heroes/'.$hero->name.'_lg.png" data-name="'.strtolower($hero->localized_name).'" data-id="'.$hero->id.'" class="hero_pic">';
}  

?>

<script type="text/javascript" src="static/js/jquery.min.js"></script>
<script type="text/javascript" src="static/js/bootstrap.min.js"></script>
<script type="text/javascript" src="static/js/index.js"></script>

</body>
</html>