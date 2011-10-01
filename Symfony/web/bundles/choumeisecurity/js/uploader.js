$(function(){
    var uploader = new qq.FileUploader({
        // pass the dom node (ex. $(selector)[0] for jQuery users)
        element: document.getElementById('avatar-uploader'),
        // path to server-side upload script
        action: '/app_dev.php/avatar/edit',
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
	    	img.src= responseJSON.result.img_path_url + '/' + fileName;
	    	var imgWidth = img.width;
	    	var imgHeight = img.height;
	    	//$('#avatar_img').attr('src', responseJSON.result.img_path_url+'/'+responseJSON.result.avatar_file_name);
	    	var cropAvatarZone	= initCropResizeAvatar(responseJSON.result.img_path_url+'/' + fileName, imgWidth, imgHeight);
    		$('#avatar-uploader').hide();
    		$('#crop_avatar_button').show();
	    },
	    onCancel: function(id, fileName){},
	    
	    messages: {
	        // error messages, see qq.FileUploaderBasic for content            
	    },
	    showMessage: function(message){ alert(message); }        
	  });
	    
});