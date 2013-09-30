<?php
/**
* 
*/
class Medias extends Admin_Controller
{
	
	public function __construct()
	{
		parent::__construct();
		$this->layout->setTheme('admin_media');
	}

	/**
	*	List all medias of the current model referent
	*	@param object $model
	*	@param int $model_id
	*/
	public function index( $model, $model_id ){

		$this->data['model'] = $model;
		$model_ref = singular(ucfirst($model));
		$this->data['model_id'] = intval($model_id);
		$this->data['medias'] = $this->Media->find('all',array(
			'conditions'=>array('model'=>$model_ref, 'model_id'=>intval($model_id))
		));
		
		$this->load->model($model_ref);
		$this->data['thumbID'] = $this->$model_ref->find('first',array(
			'fields'=>array('media_id'),
			'conditions'=>array('id'=>$this->data['model_id'])
		));
		$this->layout->assets_js('plupload/plupload');
		$this->layout->assets_js('plupload/plupload.html5');
		$this->layout->assets_js('plupload/plupload.flash');
		$this->layout->view('admin/medias/index',$this->data);
	}


	/**
	*	upload and send info to template medias
	*	@param object $model
	*	@param int $model_id
	*/
	public function upload( $model, $model_id ){
		$media = array(
			'model'=>singular(ucfirst($model)),
			'model_id'=>intval($model_id)
		);
		$this->Media->save($media);
		$this->data['media'] = $this->Media->read();

		$this->data['model'] = $this->data['media']['model'];
		$this->data['model_id'] = $this->data['media']['model_id'];

		$model = singular(ucfirst($this->data['model']));
		$this->load->model($model);
		$this->data['thumbID'] = $this->$model->find('first',array(
			'fields'=>array('media_id'),
			'conditions'=>array('id'=>$this->data['model_id'])
		));
		$this->layout->view('admin/Medias/medias',$this->data);

		$view = $this->load->view('admin/Medias/medias','',true);
		echo json_encode(array(
			"error"=>false,
			'html'=> $view
		));
		die();
	}
	/**
	*	Allow to send info to insert image in tinymce
	*	@param object $model
	*	@param int $model_id
	*/
	public function view( $model, $model_id ){

		$data['alt'] = $this->input->post('alt',true);
		$data['src'] = $this->input->post('src',true);
		$data['align'] = $this->input->post('align',true);
		$this->load->view('admin/Medias/send',$data);

		return true;
	}

	/**
	*	Allow to give a main image for model
	*/
	public function mainThumb(){
		if( isset($_GET['media_id']) && isset($_GET['model']) ){
			$media_id = intval($_GET['media_id']);
			$model 	  = $_GET['model'];

			$data['media'] = $this->Media->find('first',array(
				'conditions'=>array('id'=>$media_id)
			));

			if(empty($data['media'])){
				return false;
			}else{
				$model = singular(ucfirst($data['media']['model']));
				$media_id = $data['media']['id'];
				$this->load->model($model);
				$data_model = $this->$model->find('first',array(
					'conditions'=>array('id'=>$data['media']['model_id'])
				));
        		$this->$model->saveField('media_id',$media_id, $data_model['id']);
			}
			return true;
		}
		
	}

	public function delete() {
		if(isset($_GET['media_id'])){
			$id = intval($_GET['media_id']);
			//Get media
			$data['media'] = $this->Media->find('first',array(
				'conditions'=>array('id'=>$id)
			));
			//Get related post
			$model = singular(ucfirst($data['media']['model']));
			$this->load->model($model);
			$data['post'] = $this->$model->find('first',array(
				'conditions'=>array('id'=>$data['media']['model_id'])
			));
			//if $data['media'] is main image 
			if(!empty($data['post'])){
				$this->$model->saveField('media_id',null, $data['post']['id']);
			}
			//delete the image in folder
			$pathinfo = pathinfo($data['media']['path']);
			foreach(glob(realpath($pathinfo['dirname'].'/'.$pathinfo['filename'].'_*x*.jpg')) as $v){
				unlink($v);
			}
			foreach(glob(realpath($pathinfo['dirname'].'/'.$pathinfo['filename'].'.'.$pathinfo['extension'])) as $v){
				unlink($v);
			}
			//delete the image in database
			$this->Media->delete($id);
		}
		return true;
	}


	public function reorder(){

	}

}