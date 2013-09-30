<?php
/**
* 
*/
class Media extends MY_Model
{

	protected $_table_name = "medias";
	protected $beforeSave  = array('upload');
	//protected $afterFind  = array('getThumb');

	public function __construct()
	{
		parent::__construct();
	}

	/**
	*	Verif medias and move it
	*	@param array $data
	*/
	public function upload ($data) {
		if(isset($_FILES['file']) && !empty($_FILES['file'])){

			//Define some var
			$model = ucfirst(singular($data['model']));
			$this->load->model($model);
			$file = $_FILES['file'];
			$pathinfo  = pathinfo($file['name']);
			$media_fields = $this->$model->media_fields[$model];
			$default_path = site_url('img/uploads/');
			$extension = strtolower($pathinfo['extension']) == 'jpeg' ? 'jpg' : $pathinfo['extension'];
			$array_extension = $media_fields['extension'];

			//if bad extension
			if(!in_array($extension, $array_extension)){
				return false;
			}
			//Sanitize filename
			$filename = strtolower(slug($pathinfo['filename'],'-'));

			//create folders
			if(empty($media_fields['upload_path'])){
				if(!file_exists($default_path)){
					mkdir($default_path,0777);
					$filepath = $default_path;
				}
			}else{
				$filepath = $this->getUploadPath($data['model_id'], $media_fields['upload_path']);
				if(!file_exists(trim($filepath,' '))){
					mkdir($filepath,0777,true);
				}
			}
			//upload image
			move_uploaded_file($file['tmp_name'], $filepath.'/'.$filename.'.'.$extension);
			$data['path'] = $filepath.'/'.$filename.'.'.$extension;
			$data['name'] = $filename;
		}
		return $data;
	}

	/**
	*	Change upload path
	*	@param int $model_id
	*	@param string $path
	*/
	public function getUploadPath( $model_id, $path ){
		$search 	= array('/','/%id', '%mid', '%cid', '%y', '%m');
		$replace 	= array('/',$model_id, ceil($model_id/1000), ceil($model_id/100), date('Y'), date('m'));
		$file  		= str_replace($search, $replace, $path);
		return trim($file[0],'/');
	}

}