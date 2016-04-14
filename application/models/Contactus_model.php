<?php
class Contactus_model extends CI_Model{
	  public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }
	public function addContact($file_name){
		
		$data =[
			'name'=>set_value('name'),
			'email'=>set_value('email'),
			'mobile'=>set_value('mobile'),
			'file_name' =>json_encode($file_name)
		];
		if($this->db->insert('contactus', $data)){
			return true;
		}
		return false;
	}
}