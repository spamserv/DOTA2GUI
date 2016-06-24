$(document).ready(function() {
	$("#given_chars").val("");
});

$(document).keydown(function(e) {

	if(e.keyCode == 8) {
		$("#given_chars").val($("#given_chars").val().slice(0,-1));
		updatePictures();
		return false;
	}

	if((e.keyCode >= 60 && e.keyCode <= 90) || e.keyCode == 0) {
		$("#given_chars").val($("#given_chars").val()+e.key.toLowerCase());
		updatePictures();
	}

	console.log(e.keyCode);

});

function updatePictures() {
	var value = $("#given_chars").val();
	var value_length = value.length;

	$(".hero_pic").each(function() {
		if(value_length > 0) {
			hero_name = $(this).attr("data-name");
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