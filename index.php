<?php 
header('Cache-control: max-age='.(60*60*24*365));
header('Expires: '.gmdate(DATE_RFC1123,time()+60*60*24*365));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dota2 Predictioner</title>

	<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="static/css/index.css">
	<link rel="stylesheet" type="text/css" href="static/css/sweetalert2.min.css">

</head>
<body>


<input type="text" id="given_chars" disabled hidden>


<div class="container-fluid">

	<div id="title">
     	DOTA PREDICTIONER v0.2-beta
    </div>

	<div class="row default" style="text-align: center;">
		<div class="col-md-2">
			<div class="selected_hero_container" id="selected_heroes_1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
		</div>
		<div class="col-md-8" id="hero_holder" style="margin:0; padding:0;">
			<?php 

				$ch = curl_init("https://dota-ruap.herokuapp.com/heroes");
				curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");  
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);                                                                                                                                     
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				  
				curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
				    'Content-Type: application/json',
				    'Accept: application/json'                                                                     
				));  

				$data = curl_exec($ch);

				$heroes = json_decode($data);

				foreach ($heroes as $hero) {
					echo '<div class="hero_container">';
				    echo '<img src="static/img/heroes/'.$hero->name.'_lg.png" data-name="'.$hero->localizedName.'" data-id="'.$hero->heroId.'" data-src="static/img/heroes/'.$hero->name.'_lg.png" class="hero_pic" draggable ondragstart="drag(event)">';
				    echo '<img data-id="'.$hero->id.'" class="hero_placeholder">';
				    echo '</div>';
				}

			?>
		</div>
		<div class="col-md-2">
			<div class="selected_hero_container" id="selected_heroes_2" ondrop="drop1(event)" ondragover="allowDrop(event)"></div>
		</div>
	</div>

	<center>
		<button type="button" class="btn btn-default" id="btn-predict" disabled>Predict</button>
	</center>
	<footer style="padding-top:20px;"></footer>
</div>

<div id="divLoading" class="" style="z-index:9999; display:none;">
    <div class="loader-content">
        <img src="static/img/loader.svg" width="100"><br>
        <div id="divLoading-text">
        	PREDICTING..
        </div>
    </div>
</div>

<script type="text/javascript" src="static/js/jquery.min.js"></script>
<script type="text/javascript" src="static/js/bootstrap.min.js"></script>
<script type="text/javascript" src="static/js/sweetalert2.min.js"></script>
<script type="text/javascript" src="static/js/index.js"></script>

</body>
</html>