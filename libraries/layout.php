<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Layout{

	private $CI;
	private $var = array();
	private $layout = 'default';

	/**
	* Init CI
	**/
	public function __construct() {
		$this->CI = get_instance();
		$this->var['content'] = '';
		$this->var['title_for_layout'] = '';
		$this->var['charset'] = $this->CI->config->item('charset');
		$this->var['css'] = array();
		$this->var['js'] = array();
	}

	/**
	*	Add a view with some parameters in a template
	**/
	public function view( $name, $data = array() ) {
		$this->var['content'] .= $this->CI->load->view($name, $data, true);
		$this->CI->load->view('../views/layout/' . $this->layout, $this->var);
	}

	/**
	*	Add a several view with some parameters in a template
	**/
	public function views( $name, $data = array() ) {
		$this->var['content'] .= $this->CI->load->view($name, $data, true);
		return $this;
	}

	/**
	*	Set the default theme by an another
	**/
	public function setTheme( $layout ) {
		if( is_string($layout) && 
			!empty($layout) && 
			file_exists(APPPATH.'views/layout/' . $layout . '.php')
		){
			$this->layout = $layout;
			return true;
		}
		return false;
	}

	/**
	*	Set the title page
	**/
	public function setTitleForLayout( $title ){
		if( is_string($title) AND !empty($title) ) {
			$this->var['title_for_layout'] = $title;
			return true;
		}
	}

	/**
	*	Set the charset
	**/
	public function setCharset( $charset) {
		if( is_string($charset) AND !empty($charset) ) {
			$this->var['charset'] = $charset;
			return true;
		}
	}

	/**
	*	Add a css for a view in a template
	**/
	public function assets_css( $name ) {
		if( is_string($name) AND !empty($name) ) {
			$this->var['css'][] = css_url( $name );
			return true;
		}
		return false;
	}

	/**
	*	Add a js for a teplate view
	**/
	public function assets_js( $name ) {
		if( is_string($name) AND !empty($name) ) {
			$this->var['js'][] = js_url( $name );
			return true;
		}
		return false;
	}
}