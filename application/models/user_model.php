<?php
class User_model extends CI_Model{
	  public function __construct()
        {
                // Call the CI_Model constructor
                parent::__construct();
        }
	public function get(){
		$user=$this->db->get('users');
		if($user->num_rows()>0){
			return $user->result();
		}
		return false;
	}
}
