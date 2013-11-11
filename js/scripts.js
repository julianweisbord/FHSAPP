/*function add_club_input() {
	
}

function delete_club_input() {

}*/
function initTable() {
	var docHeight = $(window).height();
	$(".category_wrapper, .table_wrapper").css("height", docHeight - 40);
}

function initTitles() {
	var titleHeight = $(".category_title").height();
	$(".category_buttons, .anno_table").css("margin-top", titleHeight);
}

function init_delete_clubs() { 
	$(".delete_club").each( 
		function() {
			$(this).unbind("click");
			$(this).click(
				function(e) {
					e.preventDefault();
					//*Make the hidden input to delete
					var club_id = $(this).prev().val();
					if(club_id != "") {
						$("form").append("<input name='cdelete[]' type='hidden' value='"+ club_id +"' />");
					}
					
					//*Removes the input
					$(this).parent().remove();
					//console.log("Clicked and removed.");
				} 
			);
		}
	);
}

function init_delete_sports() { 
	$(".delete_sports").each( 
		function() {
			$(this).unbind("click");
			$(this).click(
				function(e) {
					e.preventDefault();
					//*Make the hidden input to delete
					var sports_id = $(this).prev().val();
					if(sports_id != "") {
						$("form").append("<input name='sdelete[]' type='hidden' value='"+ sports_id +"' />");
					}
					
					//*Removes the input
					$(this).parent().remove();
					//console.log("Clicked and removed.");
				} 
			);
		}
	);
}

$(document).ready( function() {
	init_delete_clubs();
	init_delete_sports();
	//var club_counter = 0;
	//Making clubs
	$("#add_club").click(
		function(e) {
			e.preventDefault();
			$("#clubs_info").append("<div class='club_wrapper'><label>New Club:</label><input class='cnew' name='cname[]' type='text' value='' /><input name='cid[]' type='hidden' value=''/><a href='#' class='delete_club'>X</a><br /></div>");
			init_delete_clubs();
		}
	);
	
	$("#add_sports").click(
		function(e) {
			e.preventDefault();
			$("#sports_info").append("<div class='sports_wrapper'><label>New Sport:</label><input class='snew' name='sname[]' type='text' value='' /><input name='sid[]' type='hidden' value=''/><a href='#' class='delete_sports'>X</a><br /></div>");
			init_delete_sports();
		}
	);
});