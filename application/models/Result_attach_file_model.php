<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Result_attach_file_model extends CI_Model
{
  public function __construct()
  {
    parent::__construct();
  }

  public function getPhoto($id=''){
		$file_path = 'http://122.155.197.104/sysdamrongdham/upload/result_attach_file/';
		if($id!=''){
					$sql_where = "WHERE keyin_id='".$id."' AND (file_system_name LIKE('%.jpg%') OR file_system_name LIKE('%.png%'))  ";
		}else{
					$sql_where = "";
		}
		$sql = "SELECT file_id AS id, file_system_name AS src
						FROM `dt_result_attach_file`
						".$sql_where."
						ORDER BY file_id DESC";
		$dataPhoto = array();
		$query = array();
		$query = $this->db->query($sql);
    foreach ($query->result() as $row)
    {
				$dataPhoto[] = array(
											       'id'=>$row->id,
											       'src'=>$file_path.$row->src
										         );
				}
		return $dataPhoto;
	}
  public function addPhoto($id='', $file_system_name=''){
      $sql = "INSERT INTO dt_result_attach_file SET keyin_id='".$id."', file_name='".$file_system_name."', file_system_name='".$file_system_name."' ";
  		$query = $this->db->query($sql);
  }

  public function deletePhoto($id=''){
      $sql = "DELETE FROM dt_result_attach_file WHERE file_id='".$id."' ";
  		$query = $this->db->query($sql);
  }
}
