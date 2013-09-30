<div id="plupload" class="plupload">
	<div id="droparea" class="droparea">
		<p class="dragtext">Déposer vos fichier</p>
		<p class="or">Ou</p>
		<a href="#" class="browse" id="browse">Parcourir</a>
	</div>
	<div id="filelist" class="filelist">
		<?php foreach ($medias as $media): ?>
			<?php require('medias.php'); ?>
		<?php endforeach ?>
	</div>
</div>


<?php $this->script->scriptstart(); ?>

var uploader = new plupload.Uploader({

	runtimes : 'html5,flash',
	container : "plupload",
	browse_button : 'browse',
	drop_element: "droparea",
	url : '<?php echo site_url('admin/medias/upload/'.$model.'/'.$model_id); ?>',
	flash_swf_url : '<?php echo js_url('plupload/plupload.flash'); ?>',
	multipart : true,
	urlstream_upload : true,
	multipart_params : {directory: 'text'}

});
uploader.init();


uploader.bind('FilesAdded', function(up, files){
	var filelist = $('#filelist');
	for(var i in files){
		var file = files[i];
		filelist.prepend('<div id="'+ file.id +'" class="file"><div class="line"><span class="image"><img src="http://placekitten.com/g/65/65" alt=""></span><span class="filename">'+ file.name + ' <span class="weight">('+ plupload.formatSize(file.size) +')</span> </span><div class="actions"><div class="progressbar"><div class="progress"></div></div></div></div></div>' ); 
	}
	$("#droparea").removeClass('active');
	uploader.start();
	uploader.refresh();
});

uploader.bind('UploadProgress', function( up, file ){
	$("#"+file.id).find('.progress').css('width', file.percent+'%');
});


uploader.bind('FileUploaded', function( up, file, response ){
	
	var data = jQuery.parseJSON(response.response);
	if(data.error){
		alert(data.message);
		$('#'+file.id).remove();
	}else{
		$('#'+file.id).replaceWith(data.html);
	}

});


jQuery(function($){
	$("#droparea").bind({
		dragover : function(e){
			$(this).addClass('active');
		},
		dragleave : function(e){
			$(this).removeClass('active');
		}
	});
	$('body').on('click','.main', function(	e ){
		e.preventDefault();
		var el = $(this);
		var media_id = el.data('mid');
		var model = el.data('model');
		var url = el.attr('href');
		$.get(url,{model: model,media_id: media_id}, function(){
			location.reload();
		});
	});
	$('body').on('click','.delete', function(	e ){
		e.preventDefault();
		var el = $(this);
		var media_id = el.data('mid');
		var url = el.attr('href');
		$.get(url,{media_id: media_id}, function(){
			el.parent().parent().slideUp('fast');
		});
	});

});


<?php $this->script->scriptend(); ?>
