var team_1 = [];
var team_2 = [];
var selected_heroes = [];

$(document).ready(function() {

	$("#given_chars").val("");

	$(".hero_pic").click(function() {

		if(!$(this).hasClass("negative")) {
			var selected_id = $(this).attr("data-id");
			var selected_src = $(this).attr("src");
			var selected_name = $(this).attr("data-name");

			addHeroToList(selected_id, selected_src, selected_name);
		}
	
	});

	$("body").delegate(".removable", "click", function() {

		var hero_id = $(this).attr("data-id");
		var index = selected_heroes.indexOf(hero_id);
		if (index > -1)
		    selected_heroes.splice(index, 1);

		var index = team_1.indexOf(hero_id);
		if (index > -1)
		    team_1.splice(index, 1);

		var index = team_2.indexOf(hero_id);
		if (index > -1)
		    team_2.splice(index, 1);

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

function add_hero(hero_id, pic_src, hero_name, team_id) {

	var append_div = "<div class='hero_select' draggable='false'><img class='removable' src='"+pic_src+"' data-id='"+hero_id+"'/><div class='hero_name'><p class='hero_name_text'>"+hero_name+"</p></div></div>";

	if(team_id == 1) {
		$("#selected_heroes_1").append(append_div);
	} else {
		$("#selected_heroes_2").append(append_div);
	}

}

function drag(ev) {
    ev.dataTransfer.setData("data-id", ev.target.dataset.id);
    ev.dataTransfer.setData("data-name", ev.target.dataset.name);
    ev.dataTransfer.setData("data-src", ev.target.dataset.src);
} 

function allowDrop(event) {
	event.preventDefault();
}

function drop(ev) {
    ev.preventDefault();
    addHeroToList(ev.dataTransfer.getData("data-id"), ev.dataTransfer.getData("data-src"), ev.dataTransfer.getData("data-name"), 1);
}

function drop1(ev) {
    ev.preventDefault();
    addHeroToList(ev.dataTransfer.getData("data-id"), ev.dataTransfer.getData("data-src"), ev.dataTransfer.getData("data-name"), 2);
}

function addHeroToList(hero_id, pic_src, hero_name, team) {

	var push_to_team = team;
	var check_team = [];
	if(team == 1)
		check_team = team_1;
	else if(team == 2)
		check_team = team_2;

	if(team != undefined) {
		if(check_team.length >= 5) {
			return false;
		}
	}

	if(team == undefined) {
		if(team_1.length < 5) {
			if(team_1.indexOf(hero_id) != -1 || selected_heroes.indexOf(hero_id) != -1)
				return false;
			team_1.push(hero_id);
			push_to_team = 1;
		} else if(team_2.length < 5) {
			if(team_2.indexOf(hero_id) != -1 || selected_heroes.indexOf(hero_id) != -1)
				return false;
			team_2.push(hero_id);
			push_to_team = 2;
		}
	} else {
		if(check_team.indexOf(hero_id) != -1 || selected_heroes.indexOf(hero_id) != -1)
			return false;
		check_team.push(hero_id);
	}

	if(push_to_team != undefined) {
		selected_heroes.push(hero_id);
		add_hero(hero_id, pic_src, hero_name, push_to_team);
	}

	
}