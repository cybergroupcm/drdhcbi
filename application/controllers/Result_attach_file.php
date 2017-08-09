<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Result_attach_file extends MY_Controller {
  public function __construct()
	{
		parent::__construct();
  }

  public function getPhoto($id=0)
	{
    if (isset($_SERVER['HTTP_ORIGIN'])) {
				header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
				header('Access-Control-Allow-Credentials: true');
				header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}
    $this->load->model('Result_attach_file_model','AttachFile');
    $res_photo = array();
    $res_photo = $this->AttachFile->getPhoto($id);
    echo json_encode($res_photo);

  }

  public function addPhoto($id=0)
	{
		if (isset($_SERVER['HTTP_ORIGIN'])) {
			header("Access-Control-Allow-Origin: *");
			header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
			header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
			header('Access-Control-Allow-Credentials: true');
			header('Access-Control-Max-Age: 86400');    // cache for 1 day
		}
    $this->load->model('Result_attach_file_model','AttachFile');
		$postdata = file_get_contents("php://input");

    if (isset($postdata)) {
        $res_data = json_decode($postdata);
        //echo json_encode(array('keyin_id'=>'123'));

				if (isset($res_data->id) && isset($res_data->data_image)){
          $data_image = $res_data->data_image;
          $photo_file = $res_data->id.'_'.time().".png";

					list($type, $data) = explode(';', $data_image);
					list(, $data)      = explode(',', $data);
					$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $data_image));
					$image_name = "upload/result_attach_file/".$photo_file;
					file_put_contents( $image_name, $data);
					chmod($image_name,0777);
          $this->AttachFile->addPhoto($res_data->id, $photo_file);
          echo json_encode(array('keyin_id'=>$res_data->id,'image_name'=>$image_name));
        }
    }
  }
  public function deletePhoto($id=0)
	{
    if (isset($_SERVER['HTTP_ORIGIN'])) {
        header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
        header('Access-Control-Allow-Credentials: true');
        header('Access-Control-Max-Age: 86400');    // cache for 1 day
    }
    $this->load->model('Result_attach_file_model','AttachFile');
    $res_photo = array();
    $res_photo = $this->AttachFile->deletePhoto($id);
  }

}
