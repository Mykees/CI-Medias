<?php
/**
*	Add Tinymce 
*	@param string $name
*	@param string $label
*	@param array $option
**/
function wysiwyg_uploader( $name, $label=false, $options=array() ){
	$CI =& get_instance();
	$options['name'] = $name;
	$html  =  form_textarea($options);
	$html .= '<input type="hidden" id="explorer" data-css="'.css_url('medias/wysiwyg').'" value="' . site_url('admin/medias/index/'.$CI->uri->segment(2).'/'.$CI->uri->segment(4)).'">';
	return $html;
}

function iframe(){
}
/**
* 	get image info with resizeUrl() function
*	return an image resized
*	@param string $image
*	@param int $width
*	@param int $height
*	@param array $options
**/
function imageresize( $image, $width, $height, $options = array() ){
	return img(resizeUrl($image, $width, $height),$options);
}
/**
* 	get the orignal file and create an other with others dimensions
*	return an image resized
*	@param string $image
*	@param int $width
*	@param int $height
**/
function resizeUrl( $file, $width, $height ){
	$image 		= trim($file, '/');
	$pathinfo 	= pathinfo($image);
	$imagePath 	= realpath($file);
	$newfile	= sprintf(str_replace(".{$pathinfo['extension']}", '_%sx%s.jpg', $imagePath), $width, $height);
	$output 	= sprintf(str_replace(".{$pathinfo['extension']}", '_%sx%s.jpg', $file), $width, $height);
	

	if(!file_exists($newfile))  {
		require_once 'phar://' . APPPATH . 'libraries/imagine.phar';
		try{
			$imagine 	= new Imagine\Gd\Imagine();
			$imagine->open($imagePath)->thumbnail(new Imagine\Image\Box($width, $height), Imagine\Image\ImageInterface::THUMBNAIL_OUTBOUND)->save($newfile, array('quality' => 90));
		}catch(Imagine\Exception\Exception $e){
			debug($e);die();
		}
	}
	return $output;

}