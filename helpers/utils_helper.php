<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('debug'))
{	
	/**
	* debug an array. display the filename where debug is 
	* @param array $fields fields
	**/
    function debug( $var )
    {
    	$debug = debug_backtrace();
    	echo '<p><span href="#" style="color:#2980b9;font-family:Arial"><strong>' . $debug[0]['file'] . '</strong> L. ' . $debug[0]['line'] . ' </span></p>';
    	?>
		<div style="background:#F5F5F5;border:1px solid #ccc;padding:20px;color: #2c3e50;">
    	<?php
        echo '<pre>';
        print_r($var);
        echo "<pre>";
        ?>
		</div>
        <?php
    }   
}

if(!function_exists('filter_data')){
	/**
	* Prepare data for insert or edit
	* @param array $fields fields
	**/
	function filter_data($fields){
		$data = array();
		foreach ($fields as $k=>$field) {
			$data[$field] = $this->input->post($field);
		}
		return $data;
	}
}
if(!function_exists('filter_id')){
	/**
	* Be sure the ID is an int
	* @param int $id id
	**/
	function filter_id($id){
		return intval($id);
	}
}

if(!function_exists('redirect_referer')){
	/**
	* Redirect to the referer
	**/
	function redirect_referer(){
		$CI =& get_instance();
		if (isset($_SERVER['HTTP_REFERER'])){
		    $CI->session->set_userdata('prev_url', $_SERVER['HTTP_REFERER']);
		}
		else{
		    $CI->session->set_userdata('prev_url', base_url());
		}
		return redirect($CI->session->userdata('prev_url'), 'refresh');
	}
}





