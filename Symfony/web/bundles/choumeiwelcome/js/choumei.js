// twitter like scroller
$(function(){
  $(".twtr-tweets").hycustweetscroller({
	  startstop:true,
      limit:6,
      move:'down',
  });
  
  $('#outfit_img_wrapper').bind('click', function(e){
	  var flag = false;
	  $('#outfit_img_wrapper .tag_form').each(function(index){
		  // TODO: here can be optimised later, if function() return true, can stop each
		  //       now I have no idea about skipping each loop
		  if( $(this).css('display') == 'block'){
			 flag = true;
			 return flag;
		  }
	  });
	  if(!flag){
	  var offset = $('#outfit_img').offset();
	  var x	= e.pageX - offset.left;
	  var y	= e.pageY - offset.top;
	  //alert(x + ':' + y);
	  var tagDiv	= $('<div ></div>');
	  var tagIndex	= $('#outfit_img_wrapper > div').length + 1;
	  
	  var tagId	= 'tag_' + tagIndex;
	  var tagFormId	= 'tag_form_' + tagIndex;
	  var tagDivId	= 'tag_div_' + tagIndex;
	  
	  var tagSpan	= $('<span class="tag_tag" id="' + tagId + '"></span><span id="' + tagFormId + '" class="tag_form"></span>');
	  tagDiv.attr('class','container tag_div');
	  tagDiv.attr('id', tagDivId);
	  tagDiv.css({
		'border': '1px solid #f00',
		'position':'absolute',
		'top':y,
		'left':x,
		'z-index':10000
	  });
	  /*
	  tagSpan.tag_tagcss({
		  'border':'1px solid #0f0'
	  });
	  tagForm.css({
		  'border':'1px solid #0ff'
	  });
	  */
	  //$('#outfit_img').html(tagDiv));
	  
	  // add tagSpan into tagDiv(including tag + form)
	  tagDiv.html(tagSpan);
	  $('#outfit_img_wrapper').append(tagDiv);
	  
	  // set up index
	  $('span#' + tagId).html(tagIndex);
	  // add actions
	  var formContent	= $('#choumei_looksbundle_lookstype_tags').attr('data-prototype').replace('<label class=" required">\$\$name\$\$</label>', '');
	  
	  // TODO: WHY  $$name$$ is not be replaced??
	  $('span#' + tagFormId ).append(formContent.replace(/\$\$name\$\$/g, tagIndex));
	  // TODO: set position here
	  $('span#' + tagFormId ).append('<a href="javascript:void(0);" id="close_form_"'+tagFormId+' rel="close_tag_window">关闭</a> <a href="javascript:void(0);" rel="add_tag">增加</a> <a href="javascript:void(0);" rel="remove_tag">删除</a> ');
	  // populate position
	  $('#choumei_looksbundle_lookstype_tags_'+ tagIndex +'_position').val('{"x":"' + x + '", "y":"' + y + '"}');
	  // set up css
	  $('span.tag_tag').css({
		  'display':'block',
		  'border':'1px solid #0f0'
	  });
	  $('span.tag_tag').attr('class','tag_tag column');
	  //$('span.tag_form').css({
	  $('span#' + tagFormId).css({
		  'display':'block',
		  'border':'1px solid #00f',
		  'background-color':'#FFFFFF',
		  'border-radius':'4px',
		  '-webkit-border-radius':'4px',
		  '-moz-border-radius':'4px',
		  'border':'1px solid #E4E4E4',
		  'width': '250px',
		  'height': '280px',
		  'position':'absolute',
		  'top':'-30px',
		  'left':'20px'
	  });
	  $('span.tag_form').attr('class','tag_form column last');
	  tagDiv.bind('click', function(e){e.stopPropagation();});
	 // bind actions button & prevent bubble event 
	  $('#' + tagDivId + ' a[rel="remove_tag"]').bind('click', function(e){
		 e.stopPropagation();
		 e.preventDefault();
		 removeTag(tagDivId);
		 // TODO: ajax submit remove request
	  });
	  $('#' + tagDivId + ' a[rel="add_tag"]').bind('click', function(e){
		 e.stopPropagation();
		 e.preventDefault();
		  // TODO: ajax submit add request
		 alert('Do add tag action here.');
	  });
	  $('#' + tagDivId + ' a[rel="close_tag_window"]').bind('click', function(){
		 e.stopPropagation();
		 e.preventDefault();
		 $(this).parent().hide();
		 $('.tag_div').css('width', 0);
	  });
  }// end if !flag
  });
});
  function removeTag(tagDivId){
	  $('#' + tagDivId).remove();
	  //alert(tagDivId);
	  // TODO re-order tag index
  }

function tmp(looks_id){
	$('#on_layer_' + looks_id ).show();
	// show on_layer
	$('#on_layer_' + looks_id + ' .on_marker_wrapper').each(function(index){
		$(this).hide();
		$(this).css('color','#f00');
	});
}
// bind relations between tag mark and tag detail
$(function(){
	$('.tag_detail').each(function(){
		$(this).bind('mouseover', function(event){
			var looks_id = $(this).attr('looks');
			$('#on_layer_' + looks_id ).show();
			// show on_layer
			$('#on_layer_' + looks_id + ' .on_marker_wrapper').each(function(index){
				$(this).hide();
				$(this).css('color','#f00');
			});
			// emphrase current tag
			$('.on_marker_wrapper[rel="' + $(this).attr('rel') + '"]').show();
			$('.on_marker_wrapper[rel="' + $(this).attr('rel') + '"] .on_marker').css('background-position', '0 -20px');
		});
		$(this).bind('mouseout', function(event){
			// show on_layer
			//$('.on_layer').hide();
			var looks_id = $(this).attr('looks');
			$('#on_layer_' + looks_id ).hide();
			// show on_layer
			$('#on_layer_' + looks_id + ' .on_marker_wrapper').each(function(index){
				$(this).show();
				$(this).css('color','#f00');
			});
			// emphrase current tag
			$('.on_marker_wrapper[rel="' + $(this).attr('rel') + '"]').css('background-color', '');
			$('.on_marker_wrapper[rel="' + $(this).attr('rel') + '"] .on_marker').attr('style', '');
		});
	})
});

// edit profile tabs;
	$(function() {
		$( "#tabs" ).tabs();
	});

function follow(user_id) {
	$.ajax({
		url: '/follow/'+user_id,
		type:'post',
		dataType: 'json',
		success: function(data){
			if(!data.success){
				alert(data.message);
			}else{
				$(this).html('kk');
			}
		}
	});
}