function initCropResize(image_source, imgWidth, imgHeight)
{
  var cropzoom = $('#image_source').cropzoom({
    width:348,
    height:581,
    bgColor: '#CCC',
    overlayColor: '#CCC',
    enableRotation:true,
    enableZoom:true,
    zoomSteps:10,
    rotationSteps:10,
   selector:{
      centered:true,
      w:290,
      h:484,
      borderColor:'blue',
      borderColorHover:'yellow',
      aspectRatio: true
    },
    image:{
        source: image_source,
        width: imgWidth,
        height:imgHeight,
        minZoom:50,
        maxZoom:200,
        startZoom:100,
        useStartZoomAsMinZoom:true,
        snapToContainer:true,
    }
  });
  
}

function doCropResize(cropZone)
{
	//alert('do crop here.');
	//TODO: remove app_dev.php on produc env
	cropZone.send('/app_dev.php/looks/crop', 'POST', {}, function(data){ 
		$('#choumei_looksbundle_lookstype_url').val(data);
		//$('#create_looks_form').prepend($('<img id="outfit_img"/>').attr('src', data));
		$('#outfit_img_wrapper').append($('<img id="outfit_img" style="z-index:50;"/>').attr('src', data));
		$('#create_looks_form').show();
		$('#image_source').hide();
		$('#do_crop_button').hide();
	});
	
}
function addAccessoryElement()
{
	var indexCount = $('#test_prot input').length;
	$('#test_prot').append($('#choumei_looksbundle_lookstype_accessories').attr('data-prototype').replace(/\$\$name\$\$/g, indexCount+1));
}