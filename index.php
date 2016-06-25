<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Dota2 Predictioner</title>

	<link rel="stylesheet" type="text/css" href="static/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="static/css/index.css">

	<style type="text/css">

	#given_chars {
		position: fixed;
		z-index: 1;
		right: 0;
		margin: 20px;
		height: 40px;
		width: 200px;
		background-color: whitesmoke;
		margin-top: 15px;
		border: solid 3px #b8b8b8;
		font-size: 20px;
		padding: 5px;
	}

	#title {
	    height: 55px;
	    margin-bottom: 25px;
	    margin-left: -15px;
	    margin-right: -15px;
	    text-align: center;
	    font-size: 30px;
	    padding-top: 20px;
	    padding-bottom: 85px;
	  }
	</style>

</head>
<body>


<input type="text" id="given_chars" disabled hidden>


<div class="container-fluid">

	<div id="title">
     	DOTA PREDICTIONER
    </div>

	<div class="row default" style="text-align: center;">
		<div class="col-md-2">
			<div class="selected_hero_container" id="selected_heroes_1" ondrop="drop(event)" ondragover="allowDrop(event)"></div>
		</div>
		<div class="col-md-8" id="hero_holder">
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

	<button type="button" class="btn btn-default" id="btn-predict">Predict</button>
	
</div>



<script type="text/javascript" src="static/js/jquery.min.js"></script>
<script type="text/javascript" src="static/js/bootstrap.min.js"></script>
<script type="text/javascript" src="static/js/index.js"></script>

</body>
</html>