<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( !function_exists('site_url') ) {

	function site_url( $uri='' ){
		if( !is_array($uri) ){
			$uri = func_get_args();
		}
		$CI = get_instance();
		return $CI->config->site_url($uri);
	}

}

if( !function_exists('url') ){

	function url( $text, $uri ){

		if( !is_array($uri) ){
			$uri = func_get_args();
			array_shift($uri);
		}
		return '<a href="' . site_url($uri) . '">' . htmlentities($text) . '</a>';
	}

}