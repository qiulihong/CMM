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
		$('#file-uploader').append($('<img />').attr('src', data));
	});
	
}