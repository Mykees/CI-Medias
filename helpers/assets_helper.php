<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if( !function_exists('css_url') ){
	function css_url( $name ){
		return site_url() . 'css/' . $name . '.css';
	}	
}

if( !function_exists('js_url') ){
	function js_url( $name ){
		return site_url() . 'js/' . $name . '.js';
	}
}
if( !function_exists('img_url') ){
	function img_url( $name ){
		return site_url() . 'img/' . $name;
	}
}
if( !function_exists('img') ){
	function img( $name, $options = array() ){
		$img = '<img src="' . site_url($name) . '"';
		foreach ($options as $k => $v) {
			$img.= $k.'="'.$v.'"';
		}
		$img .= '>';
		return $img;
	}
}