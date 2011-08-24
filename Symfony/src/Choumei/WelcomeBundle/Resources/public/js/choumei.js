// twitter like scroller
$(function(){
  $(".twtr-tweets").hycustweetscroller({
	  startstop:true,
      limit:6,
      move:'down',
  });
  
  $('#outfit_img_wrapper').bind('click', function(e){
	  var offset = $('#outfit_img').offset();
	  var x	= e.pageX - offset.left;
	  var y	= e.pageY - offset.top;
	  //alert(x + ':' + y);
	  var tagDiv	= $('<div ></div>');
	  var tagIndex	= $('#outfit_img_wrapper > div').length;
	  
	  var tagId	= 'tag_' + tagIndex;
	  var tagFormId	= 'tag_form_' + tagIndex;
	  
	  var tagSpan	= $('<span class="tag_tag" id="' + tagId + '"></span><span id="' + tagFormId + '" class="tag_form"></span>');
	  tagDiv.attr('class','container tag_div');
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
	  $('span#' + tagId).html(tagIndex+1);
	  // add actions
	  var formContent	= $('#choumei_looksbundle_lookstype_tags').attr('data-prototype').replace('<label class=" required">\$\$name\$\$</label>', '');
	  $('span#' + tagFormId ).append(formContent.replace('/\$\$name\$\$/g', tagIndex+1));
	  $('span#' + tagFormId ).append('<a href="javascript:void(0);" id="close_form_"'+tagFormId+' onClick="javascript:$(this).parent().hide();$(\'.tag_div\').css(\'width\',0)">Close</a>');
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
  });
});