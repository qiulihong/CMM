$(function(){
	$('.vote_action').mouseover(function(e){
		$(this).html('臭美+1');
	});
	$('.vote_action').mouseout(function(e){
		$(this).html('臭美');
	});
	/*
	$('.vote_action').click(function(){
		alert($(this).attr('data-looks_id'));
	});
	*/
});

function doVote(user_id, looks_id){
	//alert(user_id + ':' + looks_id);
	$.ajax({
		url: '/app_dev.php/looks/vote',
		data: 'user_id=' + user_id + '&looks_id=' + looks_id,
		type: 'post',
		dataType: 'json',
		success: function(data){
			if(data.success){
				$('#looks_vote_count_' + looks_id).text(data.count);
			}
			alert(data.message);
		}
	});
}