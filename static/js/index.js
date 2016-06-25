$(document).ready(function() {
	var selected_heroes = [];

	$("#given_chars").val("");

	$(".hero_pic").click(function() {

		if(!$(this).hasClass("negative")) {
			var selected_id = $(this).attr("data-id");
			var selected_src = $(this).attr("src");
			var selected_name = $(this).attr("data-name");

			if(selected_heroes.indexOf(selected_id) == -1 && selected_heroes.length < 10) {
				selected_heroes.push(selected_id);
				add_hero(selected_id, selected_src, selected_name, selected_heroes);
			}
		}
	
	});

	$("body").delegate(".removable", "click", function() {

		var hero_id = $(this).attr("data-id");
		var index = selected_heroes.indexOf(hero_id);
		if (index > -1)
		    selected_heroes.splice(index, 1);
		$(".removable[data-id='"+hero_id+"']").parent().remove();
	});

	$("#btn-predict").on("click", function(){
		
		var heroes = [];
		if(selected_heroes.length == 10) {
			var heroes = selected_heroes.slice();
				heroes.push("true");
			$.ajax({
				url: "https://dota-ruap.herokuapp.com/predict", 
				type: "POST",
				data: JSON.stringify(heroes),
				success: function(result){
					console.log(result);
		    	}
			});
		}

	});
});

$(document).keydown(function(e) {

	if(e.keyCode == 8) {
		$("#given_chars").val($("#given_chars").val().slice(0,-1));
	}

	if((e.keyCode >= 60 && e.keyCode <= 90) || e.keyCode == 0) {
		$("#given_chars").val($("#given_chars").val()+e.key.toLowerCase());
	}

	if($("#given_chars").val() != "") {
		$("#given_chars").show();
	} else {
		$("#given_chars").hide();
	}

	updatePictures();
	if(e.keyCode == 8) {
		return false;
	}
});

function updatePictures() {
	var value = $("#given_chars").val();
	var value_length = value.length;

	$(".hero_pic").each(function() {
		if(value_length > 0) {
			hero_name = $(this).attr("data-name").toLowerCase();
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

function add_hero(hero_id, pic_src, hero_name, selected_heroes) {

	console.log(selected_heroes.length);

	var append_div = "<div class='hero_select'><img class='removable' src='"+pic_src+"' data-id='"+hero_id+"'/><div class='hero_name'><p class='hero_name_text'>"+hero_name+"</p></div></div>";

	if(selected_heroes.length <= 5) {
		$("#selected_heroes_1").append(append_div);
	} else {
		$("#selected_heroes_2").append(append_div);
	}

	
}