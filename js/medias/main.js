jQuery(function($){

	$('body').on('click','.insert',function(){
		var $el = $(this);
		var $parent = $el.parent().parent().next();
		if($parent.css('display') == 'none'){
			$el.parent().parent().next().slideDown("fast");	
			$el.text('Cacher');
		}else{
			$el.parent().parent().next().slideUp("fast");	
			$el.text('Afficher');
		}
		return false;
	});

});