$(function(){
    var uploader = new qq.FileUploader({
        // pass the dom node (ex. $(selector)[0] for jQuery users)
        element: document.getElementById('accessories-uploader'),
        // path to server-side upload script
        action: '/looks/upload',
        multiple: true,
	    // additional data to send, name-value pairs
	    params: {},
	    
	    // validation    
	    // ex. ['jpg', 'jpeg', 'png', 'gif'] or []
	    allowedExtensions: ['jpg', 'jpeg', 'png', 'gif'],
	    // each file size limit in bytes
	    // this option isn't supported in all browsers
	    sizeLimit: 0, // max size   
	    minSizeLimit: 0, // min size
	    
	    // define 
	    template: '<div class="qq-uploader">' + 
        '<div class="qq-upload-drop-area"><span>Drop files here to upload</span></div>' +
        '<div class="qq-upload-accessory-button">点击上传相关饰品照片....</div>' +
        '<ul class="qq-upload-list"></ul>' + 
        '</div>',

		// template for one item in file list
		fileTemplate: '<li>' +
		        '<span class="qq-upload-file"></span>' +
		        '<span class="qq-upload-spinner"></span>' +
		        '<span class="qq-upload-size"></span>' +
		        '<a class="qq-upload-cancel" href="#">Cancel</a>' +
		        '<span class="qq-upload-failed-text">Failed</span>' +
		    '</li>',        
		
		classes: {
		    // used to get elements from templates
		    button: 'qq-upload-accessory-button',
		    drop: 'qq-upload-drop-area',
		    dropActive: 'qq-upload-drop-area-active',
		    list: 'qq-upload-list',
		                
		    file: 'qq-upload-file',
		    spinner: 'qq-upload-spinner',
		    size: 'qq-upload-size',
		    cancel: 'qq-upload-cancel',
		
		    // added to list item when upload completes
		    // used in css to hide progress spinner
		    success: 'qq-upload-success',
		    fail: 'qq-upload-fail'
		},
	    
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
	    	//
	    	var newAccessory = $('#choumei_looksbundle_lookstype_accessories').attr('data-prototype');
	    	$('#accessories-uploader').append(newAccessory.replace(/\$\$name\$\$/g, id));
	    	$('#choumei_looksbundle_lookstype_accessories_'+id+'_url').val(responseJSON.img_url+fileName);
	    },
	    
	    onCancel: function(id, fileName){},
	    
	    messages: {
	        // error messages, see qq.FileUploaderBasic for content            
	    },
	    showMessage: function(message){ alert(message); }        
	  });
	    
});