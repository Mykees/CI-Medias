<?php
class Script
{
	public $buffer = false;

	/**
	*	Start the script
	**/
	public function scriptstart(){
		ob_start();
		echo '<script type="text/javascript">';
		return true;
	}

	/**
	*	Get all data from scripStart
	**/
	public function scriptend(){
		$this->buffer = ob_get_clean();
		$this->scriptforlayout($this->buffer);
		return true;
	}

	/**
	*	Display script in layout
	**/
	public function scriptforlayout(){
		$html = $this->buffer .'</script>';
		return $html;
	}
}