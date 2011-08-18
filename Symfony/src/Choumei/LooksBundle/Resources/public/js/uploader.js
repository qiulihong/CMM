$(function(){
    var uploader = new qq.FileUploader({
        // pass the dom node (ex. $(selector)[0] for jQuery users)
        element: document.getElementById('file-uploader'),
        // path to server-side upload script
        action: '/looks/upload',
	    // additional data to send, name-value pairs
	    params: {},
	    
	    // validation    
	    // ex. ['jpg', 'jpeg', 'png', 'gif'] or []
	    allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
	    // each file size limit in bytes
	    // this option isn't supported in all browsers
	    sizeLimit: 0, // max size   
	    minSizeLimit: 0, // min size
	    
	    // set to true to output server response to console
	    debug: false,
	    
	    // events         
	    // you can return false to abort submit
	    onSubmit: function(id, fileName){},
	    onProgress: function(id, fileName, loaded, total){},
	    onComplete: function(id, fileName, responseJSON){
	    	//alert(responseJSON.img_url + fileName);
	    	//$('#file-uploader').append($('<div><img src="'+responseJSON.img_url+fileName+'" /></div>'));
	    	var img	= new Image();
	    	img.src= responseJSON.img_url + fileName;
	    	//alert(img.src);
	    	var imgHeight	= img.height;
	    	var imgWidth	= img.width;
	    	if(imgHeight < 484 || imgWidth < 290 ){
	    		alert('为了保证图片质量，请上传尺寸大于 290*484 照片 ^_^')
	    	}else{
	    		var cropZone	= initCropResize(responseJSON.img_url+fileName, imgWidth, imgHeight);
	    		$('#file-uploader').hide();
	    		$('#do_crop_button').show();
	    	}
	    	//$('#file-uploader').append();
	    },
	    onCancel: function(id, fileName){},
	    
	    messages: {
	        // error messages, see qq.FileUploaderBasic for content            
	    },
	    showMessage: function(message){ alert(message); }        
	  });
	    
});