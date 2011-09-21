$(function(){
	$('.vote_action').mouseover(function(e){
		$(this).html('臭美+1');
	});
	$('.vote_action').mouseout(function(e){
		$(this).html('臭美');
	});
	$('.vote_action').click(function(){
		alert('kkk');
	});

});